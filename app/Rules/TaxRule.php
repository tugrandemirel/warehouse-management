<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TaxRule implements Rule
{
    protected int $maximumDecimalPlaces;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $maximumDecimalPlaces = 2)
    {
        $this->maximumDecimalPlaces = $maximumDecimalPlaces;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $pattern = '/^\d+(\.\d{1,' . $this->maximumDecimalPlaces . '})?$/';
        return preg_match('/^\d+(\.\d{1,2})?$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Lütfen geçerli bir KDV oranı giriniz.';
    }
}
