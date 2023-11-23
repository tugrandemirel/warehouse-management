<?php

namespace App\Http\Controllers\Admin\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::where('user_id', auth()->user()->id)->get();
        return view('admin.warehouse.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.warehouse.create');
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
            'name' => 'string|required|min:3|max:50',
            'description' => 'string|required|min:10|max:255',
        ],[
            'name.required' => 'Depo adı alanı zorunludur.',
            'name.min' => 'Depo adı alanı en az 3 karakterden oluşmalıdır.',
            'name.max' => 'Depo adı alanı en fazla 50 karakterden oluşmalıdır.',
            'description.required' => 'Depo açıklaması alanı zorunludur.',
            'description.min' => 'Depo açıklaması alanı en az 10 karakterden oluşmalıdır.',
            'description.max' => 'Depo açıklaması alanı en fazla 255 karakterden oluşmalıdır.',
        ]);
        $data['user_id'] = auth()->user()->id;
        $create = Warehouse::create($data);
        if ($create)
            return redirect()->route('admin.warehouse.index')->with('success', 'Depo başarıyla oluşturuldu.');
        else
            return redirect()->route('admin.warehouse.index')->with('error', 'Depo oluşturulurken bir hata oluştu.');
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
    public function edit(Warehouse $warehouse)
    {
        $warehouse = Warehouse::where('id', $warehouse->id)->where('user_id', auth()->user()->id)->first();
        if (!$warehouse)
            return redirect()->route('admin.warehouse.index')->with('error', 'Depo bulunamadı.');
        return view('admin.warehouse.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {

        $data = $request->validate([
            'name' => 'string|required|min:3|max:50',
            'description' => 'string|required|min:10|max:255',
        ],[
            'name.required' => 'Depo adı alanı zorunludur.',
            'name.min' => 'Depo adı alanı en az 3 karakterden oluşmalıdır.',
            'name.max' => 'Depo adı alanı en fazla 50 karakterden oluşmalıdır.',
            'description.required' => 'Depo açıklaması alanı zorunludur.',
            'description.min' => 'Depo açıklaması alanı en az 10 karakterden oluşmalıdır.',
            'description.max' => 'Depo açıklaması alanı en fazla 255 karakterden oluşmalıdır.',
        ]);
        $data['user_id'] = auth()->user()->id;
        $update = $warehouse->update($data);
        if ($update)
            return redirect()->route('admin.warehouse.index')->with('success', 'Depo başarıyla güncellendi.');
        else
            return redirect()->route('admin.warehouse.index')->with('error', 'Depo güncellenirken bir hata oluştu.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse = Warehouse::where('id', $warehouse->id)->where('user_id', auth()->user()->id)->first();
        if (!$warehouse)
            return response()->json(['status' => false, 'message' => 'Depo bulunamadı.']);
        $delete = $warehouse->delete();
        if ($delete)
            return response()->json(['status' => true, 'message' => 'Depo başarıyla silindi.']);
        else
            return response()->json(['status' => false, 'message' => 'Depo silinirken bir hata oluştu.']);
    }
}
