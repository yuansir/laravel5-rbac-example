<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Toastr;

abstract class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function formatErrors(Validator $validator)
    {
        Toastr::error(implode('<br>',array_values($validator->errors()->all())));
        return $validator->errors()->all();
    }
}
