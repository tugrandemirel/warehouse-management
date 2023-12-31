<?php

namespace App\Http\Controllers\Admin\Product;

use App\Enum\Product\ProductOption\ProductOptionIsActiveEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\Store\StoreRequest;
use App\Http\Requests\Admin\Product\Store\UpdateRequest;
use App\Models\Company;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::where('user_id', auth()->user()->id)
                    ->with([
                        'currency',
                        'store',
                        'company',
                        'productStocks' => function ($query){
                            $query->with([
                                'product' => function ($query){
                                    $query->with('productOptions');
                                },
                                'measurementUnit'
                            ]);
                        }
                    ])
                    ->orderByDesc('id')
                    ->get();
        return view('admin.product.stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies          = auth()->user()->getCompanies();
        $stores             = auth()->user()->getStoresWithCache();
        $currencies         = auth()->user()->currencies;
        $measurementUnits   = auth()->user()->measurementUnits;
        $products           = auth()->user()->products()->with('productOptionsIsActive')->get();
        return view('admin.product.stock.create', compact('companies', 'stores', 'currencies', 'measurementUnits', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');
        $stock = Stock::create($data['data']);
        $stock->productStocks()->createMany($data['option']['productStock']);
        return redirect()->route('admin.product.stock.index')->with('success', 'Stok başarıyla oluşturuldu.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $companies          = auth()->user()->getCompanies();
        $stores             = auth()->user()->getStoresWithCache();
        $currencies         = auth()->user()->currencies;
        $measurementUnits   = auth()->user()->measurementUnits;
        $products           = auth()->user()->products()->with('productOptionsIsActive')->get();
        $stock->load('productStocks');
        return view('admin.product.stock.edit', compact('companies', 'stores', 'currencies', 'measurementUnits', 'products', 'stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Stock $stock)
    {
        $data = $request->except('_token', '_method');
        $stock->update($data['data']);
        $stock->productStocks()->delete();
        $stock->productStocks()->createMany($data['option']['productStock']);
        return redirect()->route('admin.product.stock.index')->with('success', 'Stok başarıyla güncellendi.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        if ($stock->delete())
            return responseJson(true, 'Stok başarıyla silindi.');
        else
            return responseJson(false, 'Stok silinirken bir hata oluştu.');
    }


    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        $delete = Stock::where('user_id', auth()->user()->id)
            ->whereIn('id', explode(",", $ids))
            ->delete();
        if ($delete)
            return responseJson(true, 'Stok Kaydı başarıyla silindi.');
        else
            return responseJson(false, 'Stok Kaydı silinirken bir hata oluştu.');
    }
}
