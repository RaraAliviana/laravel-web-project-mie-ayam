<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Return true to allow all users, or add custom authorization logic
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
            'nama_menu' => 'required|string|max:255',   // The name is required and should be a string with a max length of 255
            'harga' => 'required|numeric|min:0',         // The price is required, numeric, and should be greater than or equal to 0
            'deskripsi' => 'nullable|string|max:500',    // The description is optional, but if provided, it must be a string and a max length of 500
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'nama_menu' => 'Menu Name',
            'harga' => 'Price',
            'deskripsi' => 'Description',
        ];
    }
}
