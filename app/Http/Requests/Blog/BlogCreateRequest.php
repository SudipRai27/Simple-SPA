<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (request()->user()->can('blog_create')) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $rules['title'] = 'required|max:255|unique:blogs';
        $rules['description'] = 'required';
        if (!is_null(request()->category_id)) {
            $rules['category_id'] = 'array';
            $rules['category_id.*'] = 'exists:categories,id';
        }
        $rules['images.*'] = 'image|mimes:jpg,png,jpeg|max:2048';
        return $rules;
    }
}