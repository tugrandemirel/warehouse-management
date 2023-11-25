<?php

namespace App\Http\Controllers\Admin\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\WarehouseShelfGroup;
use Illuminate\Http\Request;

class WarehouseShelfGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shelfGroups = WarehouseShelfGroup::where('user_id', auth()->user()->id)
                        ->get();
        return view('admin.warehouse.shelf.group.index', compact('shelfGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.warehouse.shelf.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = WarehouseShelfGroup::create([
            'user_id' => auth()->user()->id,
            'name' =>  $request->input('name')
        ]);

        if ($create)
            return redirect()->route('admin.shelfGroup.index')->with('success',  'Grup başarılı bir şekilde oluşturuldu');
        return redirect()->route('admin.shelfGroup.index')->with('error',  'Grup oluşturulurken bir hata ile karşılaşıldı');
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
