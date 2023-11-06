<?php

namespace Modules\Blog\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $supportedLanguages = LaravelLocalization::getSupportedLanguagesKeys();

        $rules = [];

        foreach ($supportedLanguages as $lang) {
            $rules["title.$lang"] = 'required|string';
            $rules["desc.$lang"] = 'required|string';
        }


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
            $customMessages["title.$lang.required"] = "The name field for language $lang is required.";
            $customMessages["desc.$lang.required"] = "The description field for language $lang is required.";
            $customMessages["title.$lang.string"] = "The name field for language $lang must be a string.";
            $customMessages["desc.$lang.string"] = "The description field for language $lang must be a string.";
        }



        return $customMessages;
    }
}
