<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        // dd($this->id);
        $name = null;
        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|max:50|min:4|unique:categories,name,' . $this->id,
                ];
            case 'POST':
                return [
                    'name' => 'required|max:50|min:4|unique:categories',
                ];
        }
    }

    /**
     * messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('category.msg.name-required'),
            'name.unique' => trans('category.msg.name-unique'),
            'name.max' => trans('category.msg.name-max'),
            'name.min' => trans('category.msg.name-min'),
        ];
    }
}
