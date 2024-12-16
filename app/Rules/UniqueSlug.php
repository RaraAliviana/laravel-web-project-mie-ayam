<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Category;

class UniqueSlug implements Rule
{
    protected $message;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Cek apakah slug sudah ada dalam tabel categories
        if (Category::where('slug', $value)->exists()) {
            $this->message = 'Slug sudah digunakan. Silakan pilih slug lain.';
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message ?? 'Slug tidak valid.';
    }
}
