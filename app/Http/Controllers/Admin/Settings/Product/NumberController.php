<?php

namespace App\Http\Controllers\Admin\Settings\Product;

use App\Http\Controllers\Controller;
use App\Models\Number;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numbers = auth()->user()->numbers()->get();
        return view('admin.settings.product.number.index', compact('numbers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.product.number.create-edit');
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
            'number' => 'required|string|max:255',
        ]);
        $create = auth()->user()->numbers()->create($data);
        if ($create) {
            return redirect()->route('admin.settings.product.number.index')->with('success', 'Numara başarıyla eklendi.');
        }
        return redirect()->route('admin.settings.product.number.index')->with('error', 'Numara eklenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Number $number)
    {
        return view('admin.settings.product.number.create-edit', compact('number'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Number $number)
    {
        $data = $request->validate([
            'number' => 'required|string|max:255',
        ]);
        $update = $number->update($data);
        if ($update) {
            return redirect()->route('admin.settings.product.number.index')->with('success', 'Numara başarıyla güncellendi.');
        }
        return redirect()->route('admin.settings.product.number.index')->with('error', 'Numara güncellenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Number $number)
    {
        if ($number->delete())
            return response()->json(['status' => true, 'message' => 'Para Birimi başarıyla silindi.']);
        else
            return response()->json(['status' => false, 'message' => 'Para Birimi silinirken bir hata oluştu.']);
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        Number::where('user_id', auth()->user()->id)
            ->whereIn('id', explode(",", $ids))
            ->delete();
        return response()->json(['status' => true, 'message' => 'Para Birimi başarıyla silindi.']);
    }
}
