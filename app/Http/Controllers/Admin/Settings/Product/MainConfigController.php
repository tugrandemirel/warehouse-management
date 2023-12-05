<?php

namespace App\Http\Controllers\Admin\Settings\Product;

use App\Http\Controllers\Controller;
use App\Models\MainConfig;
use Illuminate\Http\Request;

class MainConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainConfig = MainConfig::with('user')->first();
        return view('admin.settings.product.main-config.create-edit', compact('mainConfig'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'stock_prefix' => 'required|string|max:7',
        ], [
            'stock_prefix.required' => 'Stok ön eki alanı zorunludur.',
            'stock_prefix.string' => 'Stok ön eki alanı metin tipinde olmalıdır.',
            'stock_prefix.max' => 'Stok ön eki alanı en fazla 7 karakter olmalıdır.',
        ]);

        $create = MainConfig::create($data);
        if ($create) {
            return redirect()->route('admin.settings.product.mainConfig.index')->with('success', 'Ana yapılandırma başarıyla eklendi.');
        }
        return redirect()->route('admin.settings.product.mainConfig.index')->with('error', 'Ana yapılandırma eklenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.');
    }

    public function edit(MainConfig $mainConfig)
    {
        return view('admin.settings.product.main-config.create-edit', compact('mainConfig'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainConfig $mainConfig)
    {
        $data = $request->validate([
            'stock_prefix' => 'required|string|max:7',
        ], [
            'stock_prefix.required' => 'Stok ön eki alanı zorunludur.',
            'stock_prefix.string' => 'Stok ön eki alanı metin tipinde olmalıdır.',
            'stock_prefix.max' => 'Stok ön eki alanı en fazla 7 karakter olmalıdır.',
        ]);
        $update = $mainConfig->update($data);
        if ($update) {
            return redirect()->route('admin.settings.product.mainConfig.index')->with('success', 'Ana yapılandırma başarıyla güncellendi.');
        }
        return redirect()->route('admin.settings.product.mainConfig.index')->with('error', 'Ana yapılandırma güncellenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.');
    }

}
