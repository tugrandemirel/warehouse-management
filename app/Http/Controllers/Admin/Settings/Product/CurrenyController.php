<?php

namespace App\Http\Controllers\Admin\Settings\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\Currency\CurrencyStoreRequest;
use App\Http\Requests\Admin\Settings\Currency\CurrencyUpdateRequest;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrenyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = auth()->user()->currencies()->get();
        return view('admin.settings.product.currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.product.currency.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyStoreRequest $request)
    {
        $data = $request->except('_token');
        $control = auth()->user()->currencies()->where('name', strtoupper($data['name']))->first();
        if ($control) {
            return redirect()->route('admin.settings.product.currency.index')->with('error', 'Para birimi zaten mevcut.');
        }
        $currency = auth()->user()->currencies()->create($data);
        if ($currency) {
            return redirect()->route('admin.settings.product.currency.index')->with('success', 'Para birimi başarıyla eklendi.');
        }
        return redirect()->route('admin.settings.product.currency.index')->with('error', 'Para birimi eklenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('admin.settings.product.currency.create-edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyUpdateRequest $request, Currency $currency)
    {
        $data = $request->except(['_token', '_method']);

        if ($currency->update($data)) {
            return redirect()->route('admin.settings.product.currency.index')->with('success', 'Para birimi başarıyla güncellendi.');
        }
        return redirect()->route('admin.settings.product.currency.index')->with('error', 'Para birimi güncellenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        if ($currency->delete())
            return response()->json(['status' => true, 'message' => 'Para Birimi başarıyla silindi.']);
        else
            return response()->json(['status' => false, 'message' => 'Para Birimi silinirken bir hata oluştu.']);
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        Currency::where('user_id', auth()->user()->id)
            ->whereIn('id', explode(",", $ids))
            ->delete();
        return response()->json(['status' => true, 'message' => 'Para Birimi başarıyla silindi.']);
    }
}
