<?php

namespace App\Http\Requests\Admin\Settings\Currency;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyUpdateRequest extends FormRequest
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
        $currencyId = $this->route('currency')->id;
        return [
            'name' => 'required|string|min:3|max:15|unique:currencies,name,' . $currencyId . ',id,user_id,' . auth()->id(),
            'symbol' => 'required|string|min:1|max:5|unique:currencies,symbol,' . $currencyId . ',id,user_id,' . auth()->id(),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
'name.required' => 'Para birimi adı alanı zorunludur.',
            'name.string' => 'Para birimi adı alanı metin tipinde olmalıdır.',
            'name.min' => 'Para birimi adı alanı en az 3 karakterden oluşmalıdır.',
            'name.max' => 'Para birimi adı alanı en fazla 10 karakterden oluşmalıdır.',
            'name.unique' => 'Para birimi adı alanı daha önceden kayıt edilmiş.',
            'symbol.required' => 'Para birimi simgesi alanı zorunludur.',
            'symbol.string' => 'Para birimi simgesi alanı metin tipinde olmalıdır.',
            'symbol.min' => 'Para birimi simgesi alanı en az 1 karakterden oluşmalıdır.',
            'symbol.max' => 'Para birimi simgesi alanı en fazla 5 karakterden oluşmalıdır.',
            'symbol.unique' => 'Para birimi simgesi alanı daha önceden kayıt edilmiş.',
        ];
    }
}
