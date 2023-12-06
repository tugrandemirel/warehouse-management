<?php

namespace App\Http\Controllers\Admin\Settings\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\Product\MeasurementUnit\MeasurementUnitStoreRequest;
use App\Http\Requests\Admin\Settings\Product\MeasurementUnit\MeasurementUnitUpdateRequest;
use App\Models\MeasurementUnit;
use Illuminate\Http\Request;

class MeasurementUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurementUnits = auth()->user()->measurementUnits()->get();
        return view('admin.settings.product.measurement-unit.index', compact('measurementUnits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.product.measurement-unit.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeasurementUnitStoreRequest $request)
    {
        $data = $request->except('_token');
        $create = MeasurementUnit::create($data);
        if ($create) {
            return redirect()->route('admin.settings.product.measurementUnit.index')->with('success', 'Ölçü Birimi başarıyla kayıt edildi.');
        } else {
            return redirect()->route('admin.settings.product.measurementUnit.index')->with('error', 'Ölçü Birimi kayıt edilemedi.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MeasurementUnit $measurementUnit)
    {
        return view('admin.settings.product.measurement-unit.create-edit', compact('measurementUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MeasurementUnitUpdateRequest $request, MeasurementUnit $measurementUnit)
    {
        $data = $request->except('_token');
        $update = $measurementUnit->update($data);
        if ($update) {
            return redirect()->route('admin.settings.product.measurementUnit.index')->with('success', 'Ölçü Birimi başarıyla güncellendi.');
        } else {
            return redirect()->route('admin.settings.product.measurementUnit.index')->with('error', 'Ölçü Birimi güncellenemedi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeasurementUnit $measurementUnit)
    {
        if ($measurementUnit->delete())
            return response()->json(['status' => true, 'message' => 'Para Birimi başarıyla silindi.']);
        else
            return response()->json(['status' => false, 'message' => 'Para Birimi silinirken bir hata oluştu.']);
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        MeasurementUnit::where('user_id', auth()->user()->id)
            ->whereIn('id', explode(",", $ids))
            ->delete();
        return response()->json(['status' => true, 'message' => 'Para Birimi başarıyla silindi.']);
    }
}
