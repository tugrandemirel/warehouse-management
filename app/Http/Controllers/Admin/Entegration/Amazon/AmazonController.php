<?php

namespace App\Http\Controllers\Admin\Entegration\Amazon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AmazonController extends Controller
{
    function register(Request $reg)
    {
        $state = session("n_store");
        session(["amazon_auth_state" => $state]);
        $base_url = "https://sellercentral.amazon.ae/apps/authorize/consent";
        $application_id = env("APPLICATION_ID");

        return redirect()->away($base_url . "?application_id=" . $application_id . "&state=" . $state . "&version=beta");
    }

    function callback(Request $request)
    {
        //$storeId = $request->input('state');

        $selling_partner_id = $request->input('selling_partner_id');
        $spapi_oauth_code = $request->input('spapi_oauth_code');

        //save these parameters to database

        $base_url = 'https://api.amazon.com/auth/o2/token';
        $response = Http::acceptJson()->post($base_url, [
            'grant_type' => 'authorization_code',
            'code' => $spapi_oauth_code,
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
        ]);

        $refresh_token = $response->body("refresh_token");

        $NewStore = Session::get("newStore");
        //dd($NewStore,$NewStore["store"],$response->ok(),$response);
        if ($response->ok()) {
            $storeid = Store::create([
                'store_name' => $NewStore["store"],
                'sku' => $NewStore["sku"],
                'merchant' => $selling_partner_id,
                'country_id' => $NewStore["country"],
                'user_id' => Auth::user()->id,
            ])->id;

            $refresh_token = json_decode($refresh_token)->refresh_token;

            $integration = Integration::where('id', '1')->first();
            // Store::where('id', $storeId)->update(array('merchant' => $selling_partner_id));

            $id = User_amazon_integration::create([
                'user_id' => Auth::user()->id,
                'store_id' => $storeid,
                'admin_integration_id' => $integration->id,
                'refresh_token' => $refresh_token,
            ])->id;
        }

        return redirect('integration/mystore')->with('success1', 'success1');
    }

    function addstore(Request $request)
    {
        $maxstore = Dropshipping_package::permission($request);

        $countries = DB::Select('SELECT c.id, c.country_name, c.flag_path, c.url_path, c.country_name, c.marketplaceid, IFNULL(t.store_count, 0) AS store_count,IF(' . $maxstore . '>IFNULL(t.store_count, 0),1,0) as package_right
        FROM countries c
        LEFT OUTER JOIN
        (
            SELECT user_id, country_id, count(*) store_count
            FROM stores
            WHERE user_id = ' . Auth::id() . '
            GROUP by user_id, country_id
        ) t
        ON c.id = t.country_id');

        // dd($countries);

        return view('integration.addstore', compact('countries'));
    }

    function linkAmazon(Request $request)
    {
        if ($request->wo_api == 1) {
            $store = Store::create([
                'store_name' => $request->store,
                'sku' => $request->sku,
                'country_id' => $request->countryId,
                'user_id' => auth()->id(),
            ]);

            $id = User_amazon_integration::create([
                'user_id' => auth()->id(),
                'store_id' => $store->id,
                'admin_integration_id' => 0,
                'refresh_token' => 'DisabledApiMerchant',
            ]);

            return response()->json(['status' => true, 'url' => route('integration.mystore')]);
        } else {
            $baseurl = Country::whereId($request->countryId)->value("url_path");
            if ($baseurl) {
                Session::put("newStore", [
                    "store" => $request->store,
                    "sku" => $request->sku,
                    "country" => $request->countryId,
                    "time" => now(),
                ]);

                $uuid = uniqid();

                return response()->json([
                    'status' => true,
                    'url' => $baseurl . "/apps/authorize/consent?application_id=amzn1.sp.solution.0e4f2be9-6e41-4dee-9088-df3206811bad&&version=beta&state=$uuid"
                ]);
            }
        }

        return response()->json(['status' => false, 'message' => 'we have some erros']);
    }

    function savestore(Request $request)
    {
        $maxstore = Dropshipping_package::permission($request);

        $merchantid = '';
        if (isset($request->merchant)) {
            $merchantid = $request->merchant;
        }

        $is_add = DB::Select('SELECT c.id,IF(' . $maxstore . '>IFNULL(t.store_count, 0),1,0) as package_right
        FROM countries c
        LEFT OUTER JOIN
        (
            SELECT user_id, country_id, count(*) store_count
            FROM stores
            WHERE user_id = ' . Auth::id() . '
            GROUP by user_id, country_id
        ) t
        ON c.id = t.country_id
        where c.id = ' . $request->country . '');

        if ($is_add[0]->package_right == 1) {
            $storeid = Store::create([
                'store_name' => $request->store,
                //'stock' => $request->stock,
                // 'budget' => $request->budget,
                'sku' => $request->sku,
                'merchant' => $merchantid,
                'country_id' => $request->country,
                'user_id' => Auth::user()->id,
                // 'price_update_flag' => $request->priceupdate,
                //'stock_update_flag' => $request->stockupdate,
                // 'product_removal_flag' => $request->productremove,
                //'product_insert_flag' => $request->productinsert
            ])->id;

            session(['n_store' => $storeid]);

            return response()->json('{"success":"' . $storeid . '"}');
        } else {
            return response()->json('{"fail":"Mağaza Ekleme Limitinize Ulaşmışsınız..."}');
        }
    }

    function successReturnSpapi(Request $request)
    {
        return view('integration.storelist', ['stores' => $stores]);
    }

    function mystore()
    {
        $stores = Store::join('countries', 'stores.country_id', '=', 'countries.id')
            ->join('users', 'stores.user_id', '=', 'users.id')
            ->leftjoin('user_amazon_integrations', 'stores.id', '=', 'user_amazon_integrations.store_id')
            ->select('stores.*', 'countries.flag_path', 'countries.country_name', 'users.name',
                'user_amazon_integrations.admin_integration_id')->where('stores.user_id', Auth::user()->id)
            ->whereNull('stores.deleted_at')->orderBy('stores.created_at', 'desc')->get();


        $affiliate = auth()->user()->affiliate_code;


        if (!Auth::user()->orion_mail) {
            $orion_mail = $this->email_creat();
            Auth::user()->orion_mail = $orion_mail;
            Auth::user()->save();
        }

        $ser = Vds_server::where("userid", Auth::user()->id)->value("id");
        $nul_serv = vds_servers_provider::where("status", 0)->first();
        if ($ser == null) {
            $orion_mail = $orion_mail ?? Auth::user()->orion_mail;
            Vds_server::create([
                'userid' => Auth::user()->id,
                'orionemail' => $orion_mail,
                'buyermail' => "",
                'sellermail' => "",
                'servercode' => $nul_serv->server_code,
                'ipaddressv4' => $nul_serv->v4_ip,
                'ipaddressv6' => $nul_serv->v6_ip,
                'registerdate' => date("y-m-d"),
                'expiredate' => Auth::user()->plan_todate,
                'os' => $nul_serv->os,
                'vdsusername' => $nul_serv->username,
                'vdspwd' => $nul_serv->password,
                'vdslocalipv4' => $nul_serv->local_v4ip,
                'vdslocalipv6' => $nul_serv->local_v6ip,
                'vdslocalmac' => $nul_serv->local_macip,

            ]);

            $nul_serv->status = 1;
            $nul_serv->save();
        }

        if ($affiliate == "") {
            $random_string = '';
            for ($i = 0; $i < 8; $i++) {
                $number = random_int(0, 36);
                $character = base_convert($number, 10, 36);
                $random_string .= $character;
            }
            $uniqcod = User::where("affiliate_code", $random_string)->first();
            if (!isset($uniqcod)) {
                $user = auth()->user();
                $user->affiliate_code = $random_string;
                $user->save();
            }
        }

        return view('integration.storelist', ['stores' => $stores]);
    }

    private function email_creat()
    {

        $secret = 'dd8f12ad9d7b52e6fff3e075726cd0817d5e5f93';
        $password = '1.Y.t.n.0.x.2.1.,$.%';


        $diz = explode("@", Auth::user()->email);
        $diz = $diz[0] . '_orn_' . Auth::user()->id;

        $url = "https://amazon.orioneffect.com/create_mail_user.php?username=" . $diz . "&password=" . $password . "&secret=" . $secret;


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($data, 1);


        if ($result['status'] == 1) {
            $user = User::find(Auth::user()->id);
            $user->orion_mail = $diz . '@amazon.orioneffect.com';
            $user->save();
        }

        /*  $fields = [
              'username' => $diz[0] . '_orn' . Auth::user()->id,
              'password' => '1.Y.t.n.0.x.2.1.,$.%i',
              //'password' => 'O.r.N.E.f.123.0.9.8.7',
              'hidden_token_for_authorization' => '46b7f9f7f067bb05c60f30d6d09786aec5b0237aaf04be14c32a6a3f336bfdef2b0b2b7c09fc73458309a5f10cba04b0b1fe80d3618534a582a2ad1db6a4f46e',
          ];

          $postvars = '';
          $sep = '';
          foreach ($fields as $key => $value) {
              $postvars .= $sep . urlencode($key) . '=' . urlencode($value);
              $sep = '&';
          }

          $ch = curl_init();

          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_POST, count($fields));
          curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          //  dd(curl_exec($ch));
          return $result = curl_exec($ch);*/
    }

    function changestore($storeid)
    {
        Cache::flush();
        Session::put('storeid', $storeid);

        $countryid = DB::table('stores')->where('stores.id', $storeid)->whereNull('deleted_at')->first();

        Session::put('countryid', $countryid->country_id);

        return redirect()->back()->with('success', Session::get('storeid'));
        //return redirect('integration/mystore')->with('success',Session::get('storeid'));

    }

    function feedbackstatus($status)
    {
        Cache::flush();
        Session::put('feedbk', $status);

        return redirect()->back()->with('success', Session::get('feedbk'));
    }

    function deletestore(Request $request)
    {
        $store = Store::where('id', '=', $request->id)->where('user_id', '=', Auth::user()->id)->firstOrFail();

        $config = (new AmazonUtilsController())->orion_id($store->id);

        $storeSubscription = AwsDestinationSubscription::where('store_id', '=', $store->id)->first();

        if (!empty($storeSubscription)) {
            try {
                $apiInstance = new NotificationsV1Api($config);
                $apiInstance->deleteSubscriptionById($storeSubscription->subscription_id, 'ANY_OFFER_CHANGED');
                $storeSubscription->delete();
            } catch (\Exception $exception) {
                return response()->json($exception->getMessage());
            }
        }

        $store->delete();

        return 1;
    }

    private function real_ip()
    {
        echo $ip = $_SERVER['REMOTE_ADDR'];

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s',
                $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] as $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',
                $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',
                $_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',
                $_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }

        return $ip;
    }
}
