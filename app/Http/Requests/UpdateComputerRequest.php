<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComputerRequest extends FormRequest
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
        $method = $this->method();

        if($method == 'PUT') {
            return [
                'title' => ['required'],
                'description' => ['required'],
                'brand' => ['required'],
                'graphics_card' => ['required'],
                'processor' => ['required'],
                'storage' => ['required'],
                'ram' => ['required'],
                'price' => ['required'],
                'developers' => ['required']
            ];
        }
        // else PATCH
        else {
            return [
                'title' => ['sometimes', 'required'],
                'description' => ['sometimes', 'required'],
                'brand' => ['sometimes', 'required'],
                'graphics_card' => ['sometimes', 'required'],
                'processor' => ['sometimes', 'required'],
                'storage' => ['sometimes', 'required'],
                'ram' => ['sometimes', 'required'],
                'price' => ['sometimes', 'required'],
                'developers' => ['sometimes', 'required']
            ];
        }
    }
}
