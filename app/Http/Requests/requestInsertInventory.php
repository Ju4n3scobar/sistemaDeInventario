<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestInsertInventory extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'user'=>'required|min:4|unique:inventory,user',
            'name'=>'required|min:5',
            'classification' =>'required',
            'reference' => 'required|min:5',
            'status' => 'required',
            'price' => 'required',
        ];
    }
}
