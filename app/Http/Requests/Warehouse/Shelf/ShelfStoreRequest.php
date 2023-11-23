<?php

namespace App\Http\Requests\Warehouse\Shelf;

use App\Enum\Warehouse\Shelf\WarehouseShelfIsActiveEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ShelfStoreRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'description' => 'nullable|min:3|max:255',
            'code' => 'required|min:3|max:255',
            'warehouse_id' => 'required|exists:warehouses,id',
            'is_active' => ['required', new Enum(WarehouseShelfIsActiveEnum::class)]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Raf adı alanı gereklidir.',
            'name.min' => 'Raf adı alanı en az 3 karakterden oluşmalıdır.',
            'name.max' => 'Raf adı alanı en fazla 255 karakterden oluşmalıdır.',
            'description.min' => 'Raf açıklaması alanı en az 3 karakterden oluşmalıdır.',
            'description.max' => 'Raf açıklaması alanı en fazla 255 karakterden oluşmalıdır.',
            'code.required' => 'Raf kodu alanı gereklidir.',
            'code.min' => 'Raf kodu alanı en az 3 karakterden oluşmalıdır.',
            'code.max' => 'Raf kodu alanı en fazla 255 karakterden oluşmalıdır.',
            'warehouse_id.required' => 'Depo alanı gereklidir.',
            'warehouse_id.exists' => 'Depo alanı geçersizdir.',
            'is_active.required' => 'Aktiflik alanı gereklidir.',
            'is_active.in' => 'Aktiflik alanı geçersizdir.',
        ];
    }
}
