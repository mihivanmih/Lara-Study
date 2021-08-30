<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:200',
            'slug' => 'max:200|',
            'excerpt' => 'max:500|',
            'content_raw' => 'required|string|max:10000|min:5',
            'category_id' => 'required|integer|exists:blog_categories,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Введите заголовок статьи',
            'title.min' => 'Заголовк не может быть меньше [:min] символов',
            'title.max' => 'Заголовк не может быть больше [:max] символов',
            'content_raw.min' => 'Минимальная длина статьи [:min] символов'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Заголовк'
        ];
    }


}
