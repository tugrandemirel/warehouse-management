<?php

namespace App\Http\Requests\Admin\Product\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'data' => 'required|array',
            'data.currency_id' => 'required|integer|exists:currencies,id',
            'data.store_id' => 'required|integer|exists:stores,id',
            'data.company_id' => 'required|integer|exists:companies,id',
            'data.invoice_number' => 'required|string|unique:stocks,invoice_number',
            'data.invoice_date' => 'required|date',
            'option.productStock.*' => 'required|array',
            'option.productStock.*.product_id' => 'required|integer|exists:product_options,id',
            'option.productStock.*.measurement_unit_id' => 'required|integer|exists:measurement_units,id',
            'option.productStock.*.quantity' => 'required|numeric',
            'option.productStock.*.vat' => 'required|numeric',
            'option.productStock.*.price' => 'required|numeric',
            'option.productStock.*.product_total' => 'required|numeric',
            'option.productStock.*.description' => 'nullable|string',

        ];
    }

    public function messages()
    {
        return [
            'data.currency_id.required' => 'Para birimi seçimi zorunludur.',
            'data.currency_id.integer' => 'Para birimi seçimi geçersizdir.',
            'data.currency_id.exists' => 'Para birimi seçimi geçersizdir.',
            'data.store_id.required' => 'Depo seçimi zorunludur.',
            'data.store_id.integer' => 'Depo seçimi geçersizdir.',
            'data.store_id.exists' => 'Depo seçimi geçersizdir.',
            'data.company_id.required' => 'Firma seçimi zorunludur.',
            'data.company_id.integer' => 'Firma seçimi geçersizdir.',
            'data.company_id.exists' => 'Firma seçimi geçersizdir.',
            'data.invoice_number.required' => 'Fatura numarası zorunludur.',
            'data.invoice_number.string' => 'Fatura numarası geçersizdir.',
            'data.invoice_number.unique' => 'Fatura numarası daha önce kullanılmıştır.',
            'data.invoice_date.required' => 'Fatura tarihi zorunludur.',
            'data.invoice_date.date' => 'Fatura tarihi geçersizdir.',
            'option.productStock.*.product_id.required' => 'Ürün seçimi zorunludur.',
            'option.productStock.*.product_id.integer' => 'Ürün seçimi geçersizdir.',
            'option.productStock.*.product_id.exists' => 'Ürün seçimi geçersizdir.',
            'option.productStock.*.measurement_unit_id.required' => 'Ölçü birimi seçimi zorunludur.',
            'option.productStock.*.measurement_unit_id.integer' => 'Ölçü birimi seçimi geçersizdir.',
            'option.productStock.*.measurement_unit_id.exists' => 'Ölçü birimi seçimi geçersizdir.',
            'option.productStock.*.quantity.required' => 'Miktar zorunludur.',
            'option.productStock.*.quantity.numeric' => 'Miktar geçersizdir.',
            'option.productStock.*.vat.required' => 'KDV zorunludur.',
            'option.productStock.*.vat.numeric' => 'KDV geçersizdir.',
            'option.productStock.*.price.required' => 'Fiyat zorunludur.',
            'option.productStock.*.price.numeric' => 'Fiyat geçersizdir.',
            'option.productStock.*.product_total.required' => 'Ürün toplamı zorunludur.',
            'option.productStock.*.product_total.numeric' => 'Ürün toplamı geçersizdir.',
            'option.productStock.*.description.string' => 'Açıklama geçersizdir.',
        ];
    }
}
