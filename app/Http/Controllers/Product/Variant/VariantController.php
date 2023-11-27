<?php

namespace App\Http\Controllers\Product\Variant;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use App\Models\VariantGroup;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variants = Variant::where('user_id', auth()->user()->id)
                    ->with('variantGroup')
                    ->get();
        return view('admin.product.variant.index', compact('variants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $variantGroups = VariantGroup::where('user_id', auth()->user()->id)->get();
        return view('admin.product.variant.create-edit', compact('variantGroups'));
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
              'variant_group_id' => 'required|in:'.implode(',', VariantGroup::where('user_id', auth()->user()->id)->pluck('id')->toArray()),
              'name' => 'required'
          ]);

        $create = Variant::create($data);
        if($create){
            return redirect()->route('admin.product.variant.index')->with('success', 'Varyant başarıyla eklendi.');
        }else{
            return redirect()->route('admin.product.variant.index')->with('error', 'Varyant eklenirken bir hata oluştu.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Variant $variant)
    {
        $variantGroups = VariantGroup::where('user_id', auth()->user()->id)->get();
        return view('admin.product.variant.create-edit', compact('variant', 'variantGroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variant $variant)
    {
        $data = $request->validate([
              'variant_group_id' => 'required|in:'.implode(',', VariantGroup::where('user_id', auth()->user()->id)->pluck('id')->toArray()),
              'name' => 'required'
          ]);
        $update = $variant->update($data);
        if($update){
            return redirect()->route('admin.product.variant.index')->with('success', 'Varyant başarıyla güncellendi.');
        }else{
            return redirect()->route('admin.product.variant.index')->with('error', 'Varyant güncellenirken bir hata oluştu.');
        }
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
