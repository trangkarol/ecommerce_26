<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|max:50|min:4|unique:products,name,' . $this->id,
            'date_manufacture' => 'required',
            'date_expiration' => 'required|after:date_manufacture',
            'description' => 'required|min:30',
        ];
    }

    /**
     * messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('product.msg.name-required'),
            'name.unique' => trans('product.msg.name-unique'),
            'name.max' => trans('product.msg.name-max'),
            'name.min' => trans('product.msg.name-min'),
            'date_manufacture.required' => trans('product.msg.date-manufacture-required'),
            'date_expiration.required' => trans('product.msg.date-expiration-required'),
            'date_expiration.after' => trans('product.msg.date-expiration-after'),
            'description.required' => trans('product.msg.description-required'),
            'description.min' => trans('product.msg.description-min'),
        ];
    }
}
