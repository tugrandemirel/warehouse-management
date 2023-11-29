<?php

namespace App\Http\Controllers\Admin\Product;

use App\Enum\Settings\Product\Currency\CurrencyIsDefaultEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Models\Currency;
use App\Models\MarketPlace;
use App\Models\Number;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected object $currency;
    protected object $numbers;
    protected object $marketPlaces;
    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->currency = auth()->user()->getDefaultCurrency();

            $this->numbers = Cache::remember('numbers_'.auth()->user()->id, 60*60*24, function () {
                return Number::where('user_id', auth()->user()->id)
                    ->select('number', 'id')
                    ->get();
            });
            $this->marketPlaces = Cache::remember('marketPlaces_'.auth()->user()->id, 60*60*24, function () {
                return MarketPlace::all();
            });

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('user:id,name', 'productOptions:id,product_id,price,stock,sku,barcode,market_place_id')
            ->where('user_id', auth()->user()->id)
            ->select('id', 'user_id', 'name', 'slug')
            ->paginate(10)
            ->withQueryString()
            ->onEachSide(2)
            ->through(function ($product) {
                $product->setAppends(['product_options_count']);
                return $product;
            });

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', [
            'numbers' => $this->numbers,
            'currency' => $this->currency,
            'marketPlaces' => $this->marketPlaces,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->except('_token');
        $data['image'] = $this->storeImage($request->file('image'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
