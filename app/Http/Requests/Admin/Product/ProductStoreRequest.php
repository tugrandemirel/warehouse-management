<?php

namespace App\Http\Requests\Admin\Product;

use App\Enum\Product\ProductOption\ProductOptionIsActiveEnum;
use App\Rules\TaxRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'option.image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option.manufacturer_name' => 'required|string|max:255',
            'option.manufacturer_brand' => 'required|string|max:255',
            'option.description' => 'required|string|max:255',
            'option.short_description' => 'required|string|max:255',
            'option.price' => 'required|numeric',
            'option.color' => 'required',
            'option.weight' => 'required|numeric',
            'option.width' => 'required|numeric',
            'option.height' => 'required|numeric',
            'option.length' => 'required|numeric',
            'option.product_code' => 'required|string|max:255',
            'option.is_active' => ['required', new Enum(ProductOptionIsActiveEnum::class)],
            'option.market_place' => 'nullable|array',
            'option.currency_id' => 'required|numeric',
            'option.number_id' => 'required|numeric',
            'option.measurement_unit_id' => 'required|numeric',
            'option.tax' => ['nullable', new TaxRule()],
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
            'name.required' => 'Ürün adı alanı zorunludur.',
            'name.string' => 'Ürün adı alanı metin tipinde olmalıdır.',
            'name.max' => 'Ürün adı alanı en fazla 255 karakter olmalıdır.',
            'option.image.required' => 'Ürün resmi alanı zorunludur.',
            'option.image.image' => 'Ürün resmi alanı resim tipinde olmalıdır.',
            'option.image.mimes' => 'Ürün resmi alanı jpeg,png,jpg,gif,svg tipinde olmalıdır.',
            'option.image.max' => 'Ürün resmi alanı en fazla 2048 karakter olmalıdır.',
            'option.manufacturer_name.required' => 'Ürün üretici adı alanı zorunludur.',
            'option.manufacturer_name.string' => 'Ürün üretici adı alanı metin tipinde olmalıdır.',
            'option.manufacturer_name.max' => 'Ürün üretici adı alanı en fazla 255 karakter olmalıdır.',
            'option.manufacturer_brand.required' => 'Ürün markası alanı zorunludur.',
            'option.manufacturer_brand.string' => 'Ürün markası alanı metin tipinde olmalıdır.',
            'option.manufacturer_brand.max' => 'Ürün markası alanı en fazla 255 karakter olmalıdır.',
            'option.description.required' => 'Ürün açıklaması alanı zorunludur.',
            'option.description.string' => 'Ürün açıklaması alanı metin tipinde olmalıdır.',
            'option.description.max' => 'Ürün açıklaması alanı en fazla 255 karakter olmalıdır.',
            'option.short_description.required' => 'Ürün kısa açıklaması alanı zorunludur.',
            'option.short_description.string' => 'Ürün kısa açıklaması alanı metin tipinde olmalıdır.',
            'option.short_description.max' => 'Ürün kısa açıklaması alanı en fazla 255 karakter olmalıdır.',
            'option.price.required' => 'Ürün fiyatı alanı zorunludur.',
            'option.price.numeric' => 'Ürün fiyatı alanı sayı tipinde olmalıdır.',
            'option.color.required' => 'Ürün rengi alanı zorunludur.',
            'option.weight.required' => 'Ürün ağırlığı alanı zorunludur.',
            'option.weight.numeric' => 'Ürün ağırlığı alanı sayı tipinde olmalıdır.',
            'option.width.required' => 'Ürün genişliği alanı zorunludur.',
            'option.width.numeric' => 'Ürün genişliği alanı sayı tipinde olmalıdır.',
            'option.height.required' => 'Ürün yüksekliği alanı zorunludur.',
            'option.height.numeric' => 'Ürün yüksekliği alanı sayı tipinde olmalıdır.',
            'option.length.required' => 'Ürün uzunluğu alanı zorunludur.',
            'option.length.numeric' => 'Ürün uzunluğu alanı sayı tipinde olmalıdır.',
            'option.product_code.required' => 'Ürün kodu alanı zorunludur.',
            'option.product_code.string' => 'Ürün kodu alanı metin tipinde olmalıdır.',
            'option.product_code.max' => 'Ürün kodu alanı en fazla 255 karakter olmalıdır.',
            'option.is_active.required' => 'Ürün durumu alanı zorunludur.',
            'option.is_active.boolean' => 'Ürün durumu alanı boolean tipinde olmalıdır.',
            'option.market_place.array' => 'Ürün market alanı dizi tipinde olmalıdır.',
            'option.currency_id.required' => 'Ürün para birimi alanı zorunludur.',
            'option.currency_id.numeric' => 'Ürün para birimi alanı sayı tipinde olmalıdır.',
            'option.number_id.required' => 'Ürün numara alanı zorunludur.',
            'option.number_id.numeric' => 'Ürün numara alanı sayı tipinde olmalıdır.',
            'option.measurement_unit_id.required' => 'Ürün ölçü birimi alanı zorunludur.',
            'option.measurement_unit_id.numeric' => 'Ürün ölçü birimi alanı sayı tipinde olmalıdır.',
        ];
    }
}
