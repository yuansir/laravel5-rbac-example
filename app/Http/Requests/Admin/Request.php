<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Session;

abstract class Request extends FormRequest {

    public function authorize()
    {
        return true;
    }

    protected function formatErrors(Validator $validator)
    {
        Session::flash('am-alert',
            [
                'type' => 'warning',
                'data' => array_values($validator->errors()->all())
            ]
        );
        return $validator->errors()->all();
    }

}
