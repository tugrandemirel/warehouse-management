<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getState(Request $request)
    {
        $state = Country::find($request->country)->states()->get();
        if ($state->count() > 0 )
        {
            return responseJson(true, 'İller başarıyla getirildi.', $state);
        }
        else
        {
            return responseJson(false, 'İller getirilirken bir hata oluştu.');
        }
    }
}
