<?php

namespace App\Http\Requests\Admin\Settings\Product\MeasurementUnit;

use Illuminate\Foundation\Http\FormRequest;

class MeasurementUnitUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $measurementUnitId = $this->route('measurementUnit')->id;
        return [
            'name' => 'required|string|min:3|max:15|unique:measurement_units,name,' . $measurementUnitId . ',id,user_id,' . auth()->id(),
            'symbol' => 'required|string|min:1|max:5|unique:measurement_units,symbol,' . $measurementUnitId . ',id,user_id,' . auth()->id(),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ölçü birimi adı alanı zorunludur.',
            'name.string' => 'Ölçü birimi adı alanı metin tipinde olmalıdır.',
            'name.min' => 'Ölçü birimi adı alanı en az 3 karakterden oluşmalıdır.',
            'name.max' => 'Ölçü birimi adı alanı en fazla 10 karakterden oluşmalıdır.',
            'name.unique' => 'Ölçü birimi adı alanı daha önceden kayıt edilmiş.',
            'symbol.required' => 'Ölçü birimi simgesi alanı zorunludur.',
            'symbol.string' => 'Ölçü birimi simgesi alanı metin tipinde olmalıdır.',
            'symbol.min' => 'Ölçü birimi simgesi alanı en az 1 karakterden oluşmalıdır.',
            'symbol.max' => 'Ölçü birimi simgesi alanı en fazla 5 karakterden oluşmalıdır.',
            'symbol.unique' => 'Ölçü birimi simgesi alanı daha önceden kayıt edilmiş.',
        ];
    }
}
