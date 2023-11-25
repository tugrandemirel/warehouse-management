<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apis = Api::with(['user' => function($query){
            $query->where('id', auth()->user()->id);
        }])->get();
        return view('admin.api.index', compact('apis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.api.create');
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
            'key' => 'required',
            'secret' => 'required',
            'shipping_account' => 'required',
            'cargo_id' => 'required',
        ],[
            'key.required' => 'API Key alanı zorunludur.',
            'secret.required' => 'API Secret alanı zorunludur.',
            'shipping_account.required' => 'API Shipping Account alanı zorunludur.',
            'cargo_id.required' => 'API Kargo Seçim alanı zorunludur.',
        ]);
        $data['user_id'] = auth()->user()->id;
        $create = Api::create($data);
        if ($create)
        {
            return redirect()->route('admin.api.index')->with('success', 'Api başarıyla oluşturuldu.');
        }
        else
        {
            return redirect()->route('admin.api.index')->with('error', 'Api oluşturulurken bir hata oluştu.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Api $api)
    {
        return view('admin.api.edit', compact('api'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Api $api)
    {
        $data = $request->validate([
            'key' => 'required',
            'secret' => 'required',
            'shipping_account' => 'required',
            'cargo_id' => 'required',
        ],[
            'key.required' => 'API Key alanı zorunludur.',
            'secret.required' => 'API Secret alanı zorunludur.',
            'shipping_account.required' => 'API Shipping Account alanı zorunludur.',
            'cargo_id.required' => 'API Kargo Seçim alanı zorunludur.',
        ]);
        $update = $api->update($data);
        if ($update)
        {
            return redirect()->route('admin.api.index')->with('success', 'Api başarıyla güncellendi.');
        }
        else
        {
            return redirect()->route('admin.api.index')->with('error', 'Api güncellenirken bir hata oluştu.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Api $api)
    {
        if ($api->delete())
            return response()->json(['status' => true, 'message' => 'API başarıyla silindi.']);
        else
            return response()->json(['status' => false, 'message' => 'API silinirken bir hata oluştu.']);
    }
}
