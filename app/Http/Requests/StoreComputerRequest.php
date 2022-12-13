<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComputerRequest extends FormRequest
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
            'title' => ['required'],
            'description' =>['required'],
            'brand'  =>['required'],
            'graphics_card'  =>['required'],
            'processor'  =>['required'],
            'storage' =>['required'],
            'ram' =>['required'],
            'price' =>['required'],
            // 'developers'is an array coming in from the request.
            // Laravel is clever enough to traverse through each element in the developers array
           //  and check if it exists as an id in the developers table
            'developers' =>['required' , 'exists:developers,id']
        ];
    }
}
