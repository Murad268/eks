<?php

namespace Modules\Blog\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $supportedLanguages = LaravelLocalization::getSupportedLanguagesKeys();

        $rules = [];

        foreach ($supportedLanguages as $lang) {
            $rules["name.$lang"] = 'required|string';
            $rules["desc.$lang"] = 'required|string';
        }
        $rules['image'] = 'required|image|mimetypes:image/jpeg,image/png|max:2048';
        $rules['banner'] = 'required|image|mimetypes:image/jpeg,image/png|max:2048';

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function messages(): array
    {
        $supportedLanguages = LaravelLocalization::getSupportedLanguagesKeys();

        $customMessages = [];

        foreach ($supportedLanguages as $lang) {
            $customMessages["name.$lang.required"] = "The name field for language $lang is required.";
            $customMessages["desc.$lang.required"] = "The description field for language $lang is required.";
            $customMessages["name.$lang.string"] = "The name field for language $lang must be a string.";
            $customMessages["desc.$lang.string"] = "The description field for language $lang must be a string.";
        }

        $customMessages['image.required'] = "The image field is required.";
        $customMessages['image.image'] = "The image must be a valid image file.";
        $customMessages['image.mimetypes'] = "The image must be in jpeg or png format.";
        $customMessages['image.max'] = "The image may not be greater than 2MB in size.";
        $customMessages['banner.required'] = "The banner field is required.";
        $customMessages['banner.image'] = "The banner must be a valid image file.";
        $customMessages['banner.mimetypes'] = "The banner must be in jpeg or png format.";
        $customMessages['banner.max'] = "The banner may not be greater than 2MB in size.";

        return $customMessages;
    }
}
