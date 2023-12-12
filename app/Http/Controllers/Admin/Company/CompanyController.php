<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\CompanyStoreRequest;
use App\Http\Requests\Admin\Company\CompanyUpdateRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Cache;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = auth()->user()->getCompanies();
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Cache::remember('countries', 60*60*24, function (){
            return Country::all();
        });
       return view("admin.company.create", compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        $data = $request->except("_token");
        $create = Company::create($data);
        if(isset($data['logo']))
            $create->addMediaFromRequest('logo')
                ->toMediaCollection('company');
        if ($create){
            return redirect()->route('admin.company.index')->with('success', 'Şirket başarıyla eklendi.');
        }else{
            return back()->with('error', 'Şirket eklenirken bir hata oluştu.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $company->load('country', 'state');
        $countries = Cache::remember('countries', 60*60*24, function (){
            return Country::all();
        });
        $states = Cache::remember('states_' . $company->country_id, 60*60*24, function () use ($company){
            return $company->country->states;
        });
        return view("admin.company.edit", compact('company', 'countries', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $data = $request->except("_token");
        $update = $company->update($data);
        if(isset($data['logo']))
        {
            $company->clearMediaCollection('company');
            $company->addMediaFromRequest('logo')
                ->toMediaCollection('company');
        }

        if ($update){
            return redirect()->route('admin.company.index')->with('success', 'Şirket başarıyla güncellendi.');
        }else{
            return back()->with('error', 'Şirket güncellenirken bir hata oluştu.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        return deleteModel($company, 'Firma', 'company');
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        $deleteMedia = Company::where('user_id', auth()->user()->id)
            ->whereIn('id', explode(",", $ids))
            ->get();
        foreach ($deleteMedia as $media)
        {
            $media->clearMediaCollection('company');
        }
        $delete = Company::where('user_id', auth()->user()->id)
            ->whereIn('id', explode(",", $ids))
            ->delete();
        dd($delete);
        if ($delete)
            return responseJson(true, 'Firma başarıyla silindi.');
        else
            return responseJson(false, 'Firma silinirken bir hata oluştu.');
    }
}
