<?php

namespace App\Http\Controllers\Admin\Product;

use App\Enum\Settings\Product\Currency\CurrencyIsDefaultEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Models\Currency;
use App\Models\MarketPlace;
use App\Models\Number;
use App\Models\Product;
use App\Models\ProductMarketPlace;
use App\Models\ProductOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected object $currency;
    protected object $numbers;
    protected object $marketPlaces;
    protected object $mainConfig;
    protected object $measurementUnits;
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
            $this->mainConfig = auth()->user()->getMainConfig();
            $this->measurementUnits = auth()->user()->getMeasurementUnits();
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
        $products = Product::with(['user:id,name', 'productOptions' => function($query){
                $query->with(['productMarketPlaces', 'number', 'currency', 'measurementUnit']);
            }])
            ->where('user_id', auth()->user()->id)
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
            'mainConfig' => $this->mainConfig,
            'measurementUnits' => $this->measurementUnits,
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
        $option = $data['option'];
        unset($data['option']);
        $product = Product::create($data);
        if($option['image']) {
            $product->addMediaFromRequest('option.image')
                ->toMediaCollection('product');
        }
        unset($option['image']);
        $productMarketPlace = $option['market_place'];
        unset($option['market_place']);
        $option['product_id'] = $product->id;
        $pOcreate = ProductOption::create($option);
        foreach ($productMarketPlace as $key => $value) {
            ProductMarketPlace::create([
                'product_option_id' => $pOcreate->id,
                'market_place_id' => $key,
                'stock_code' => $value['code'],
            ]);
        }
        return redirect()->route('admin.product.index')->with('success', 'Ürün başarıyla kaydedildi.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

            $product->load(['productOptions', 'productOptions' => function($query){
                $query->with(['productMarketPlaces' => function($query){
                    $query->with('marketPlace');
                }]);
            }]);
            return view('admin.product.edit', [
                'product' => $product,
                'numbers' => $this->numbers,
                'currency' => $this->currency,
                'marketPlaces' => $this->marketPlaces,
                'mainConfig' => $this->mainConfig,
                'measurementUnits' => $this->measurementUnits,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->except('_token');
        $option = $data['option'];
        unset($data['option']);
        $pUpdate = $product->update($data);
        if(isset($option['image'])) {
            $product->addMediaFromRequest('option.image')
                ->toMediaCollection('product');
        }
        unset($option['image']);
        $productMarketPlace = $option['market_place'];
        unset($option['market_place']);
        $option['product_id'] = $product->id;
        $cPOption = ProductOption::where('product_id', $product->id)->first();
        $cPOption->update($option);
        $cPMarketPlace = ProductMarketPlace::where('product_option_id', $cPOption->id)->get();
        foreach ($cPMarketPlace as $key => $value) {
            $value->delete();
        }
        foreach ($productMarketPlace as $key => $value) {
            ProductMarketPlace::create([
                'product_option_id' => $cPOption->id,
                'market_place_id' => $key,
                'stock_code' => $value['code'],
            ]);
        }
        return redirect()->route('admin.product.index')->with('success', 'Ürün başarıyla güncellendi.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        return deleteModel($product, 'Ürün');
    }

}
