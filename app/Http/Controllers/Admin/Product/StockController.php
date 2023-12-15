<?php

namespace App\Http\Controllers\Admin\Product;

use App\Enum\Product\ProductOption\ProductOptionIsActiveEnum;
use App\Http\Controllers\Controller;
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
                        'product.productOptions' => function($query) {
                            $query->where('is_active', ProductOptionIsActiveEnum::ACTIVE);
                        },
                        'measurementUnit',
                        'currency',
                        'store',
                        'company'
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
