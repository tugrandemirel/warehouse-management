<?php

namespace App\Http\Controllers\Admin\Product\Variant;

use App\Http\Controllers\Controller;
use App\Models\VariantGroup;
use Illuminate\Http\Request;

class VariantGroupController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variantGroups = VariantGroup::where('user_id', auth()->user()->id)
                        ->get();
        return view('admin.product.variant.group.index', compact('variantGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.variant.group.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name'=>'required']);
        $create = VariantGroup::create($data);
        if(!$create){
            return redirect()->route('admin.product.variant.group.index')->with('error', 'Varyant grubu oluşturulurken bir hata oluştu.');
        }
        return redirect()->route('admin.product.variant.group.index')->with('success', 'Varyant grubu başarıyla oluşturuldu.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(VariantGroup $variantGroup)
    {
        return view('admin.product.variant.group.create-edit', compact('variantGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VariantGroup $variantGroup)
    {
        $data = $request->validate(['name'=>'required']);
        $update = $variantGroup->update($data);
        if(!$update){
            return redirect()->route('admin.product.variant.group.index')->with('error', 'Varyant grubu güncellenirken bir hata oluştu.');
        }
        return redirect()->route('admin.product.variant.group.index')->with('success', 'Varyant grubu başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VariantGroup $variantGroup)
    {
        $delete = $variantGroup->delete();
        if ($delete)
            return response()->json(['status' => true, 'message' => 'Varyant Grup başarıyla silindi.']);
        else
            return response()->json(['status' => false, 'message' => 'Varyant Grup silinirken bir hata oluştu.']);
    }

}
