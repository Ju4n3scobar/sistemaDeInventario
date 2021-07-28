<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestStoreLogs extends FormRequest
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
            'tipo'=>'required',
            'user'=>'required|min:5',
            'characteristics' =>'required',
            'employee' => 'required',
            'motivo' => 'required',
            'inventory_id' => 'required',
        ];
    }
}
