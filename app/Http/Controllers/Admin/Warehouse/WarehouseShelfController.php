<?php

namespace App\Http\Controllers\Admin\Warehouse;

use App\Enum\Warehouse\Shelf\WarehouseShelfIsActiveEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\Shelf\ShelfStoreRequest;
use App\Models\WarehouseShelf;
use App\Models\WarehouseShelfGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class WarehouseShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouseShelves = WarehouseShelf::where('user_id', auth()->user()->id)
                            ->with(['warehouse', 'user'])
                            ->get();
        return view('admin.warehouse.shelf.index', compact('warehouseShelves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = auth()->user()->warehouses;
        $shelfGroups = WarehouseShelfGroup::where('user_id', auth()->user()->id)->get();
        return view('admin.warehouse.shelf.create', compact('warehouses', 'shelfGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShelfStoreRequest $request)
    {
                // dd($request->all());
        $data = $request->except('_token');
        $data['user_id'] = auth()->user()->id;
        if (isset($data['group']))
        {
            unset($data['group']);
        }else{
            $data['shelf_group_id'] = null;
        }
        $create = WarehouseShelf::create($data);

        if($create){
            return redirect()->route('admin.warehouseShelf.index')->with('success', 'Raf başarıyla oluşturuldu.');
        }else{
            return back()->with('error', 'Raf oluşturulurken bir hata oluştu.');
        }
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
    public function edit(WarehouseShelf $warehouseShelf)
    {
        $warehouses = auth()->user()->warehouses;

        return view('admin.warehouse.shelf.edit', compact('warehouses', 'warehouseShelf'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShelfStoreRequest $request, WarehouseShelf $warehouseShelf)
    {
        $data = $request->except('_token');
        $data['user_id'] = auth()->user()->id;
        $update = $warehouseShelf->update($data);

        if($update){
            return redirect()->route('admin.warehouseShelf.index')->with('success', 'Raf başarıyla güncellendi.');
        }else{
            return back()->with('error', 'Raf güncellenirken bir hata oluştu.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseShelf $warehouseShelf)
    {
        $warehouse = WarehouseShelf::where('id', $warehouseShelf->id)->where('user_id', auth()->user()->id)->first();
        if (!$warehouse)
            return response()->json(['status' => false, 'message' => 'Depo bulunamadı.']);
        $delete = $warehouse->delete();
        if ($delete)
            return response()->json(['status' => true, 'message' => 'Depo başarıyla silindi.']);
        else
            return response()->json(['status' => false, 'message' => 'Depo silinirken bir hata oluştu.']);
    }
}
