<?php

namespace App\Http\Requests\Admin\Company;

use App\Enum\Company\CompanyIsActiveEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CompanyUpdateRequest extends FormRequest
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
        return [
            "name" => "required|string|max:100",
            "degree" => "nullable|string|max:100",
            "tax_administration" => "nullable|string|max:100",
            "tax_number" => "nullable|string|max:100",
            "room_registration_number" => "nullable|string|max:100",
            "description" => "nullable|string",
            "phone" => "nullable|string|max:20",
            "email" => "nullable|email|max:100",
            "website" => "nullable|url|max:100",
            "address" => "nullable|string",
            "post_code" => "nullable|string|max:20",
            "logo" => "nullable|image|mimes:jpg,jpeg,png|max:2048",
            "country_id" => "required|exists:countries,id",
            "state_id" => "required|exists:states,id",
            'is_active' => new Enum(CompanyIsActiveEnum::class),
        ];
    }


    public function messages()
    {
        return [
            "name.required" => "Şirket adı alanı zorunludur.",
            "name.string" => "Şirket adı alanı metin tipinde olmalıdır.",
            "name.max" => "Şirket adı alanı en fazla 100 karakter olmalıdır.",
            "degree.string" => "Ünvan alanı metin tipinde olmalıdır.",
            "degree.max" => "Ünvan alanı en fazla 100 karakter olmalıdır.",
            "tax_administration.string" => "Vergi dairesi alanı metin tipinde olmalıdır.",
            "tax_administration.max" => "Vergi dairesi alanı en fazla 100 karakter olmalıdır.",
            "tax_number.string" => "Vergi numarası alanı metin tipinde olmalıdır.",
            "tax_number.max" => "Vergi numarası alanı en fazla 100 karakter olmalıdır.",
            "room_registration_number.string" => "Oda kayıt numarası alanı metin tipinde olmalıdır.",
            "room_registration_number.max" => "Oda kayıt numarası alanı en fazla 100 karakter olmalıdır.",
            "description.string" => "Açıklama alanı metin tipinde olmalıdır.",
            "phone.string" => "Telefon alanı metin tipinde olmalıdır.",
            "phone.max" => "Telefon alanı en fazla 20 karakter olmalıdır.",
            "email.email" => "E-posta alanı email tipinde olmalıdır.",
            "email.max" => "E-posta alanı en fazla 100 karakter olmalıdır.",
            "website.url" => "Web sitesi alanı için geçerli bir url giriniz.",
            "website.max" => "Web sitesi alanı en fazla 100 karakter olmalıdır.",
            "address.string" => "Adres alanı metin tipinde olmalıdır.",
            "post_code.string" => "Posta kodu alanı metin tipinde olmalıdır.",
            "post_code.max" => "Posta kodu alanı en fazla 20 karakter olmalıdır.",
            "logo.image" => "Logo alanı resim tipinde olmalıdır.",
            "logo.mimes" => "Logo alanı jpg, jpeg, png tipinde olmalıdır.",
            "logo.max" => "Logo alanı en fazla 2048 KB olmalıdır.",
            "country_id.required" => "Ülke alanı zorunludur.",
            "country_id.exists" => "Ülke alanı geçersizdir.",
            "state_id.required" => "Şehir alanı zorunludur.",
            "state_id.exists" => "Şehir alanı geçersizdir.",
        ];
    }
}
