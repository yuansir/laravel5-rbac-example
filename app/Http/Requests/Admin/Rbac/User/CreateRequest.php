<?php namespace App\Http\Requests\Admin\Rbac\User;

use App\Http\Requests\Admin\Request;

class CreateRequest extends Request {

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
            'name' => 'required|max:20|alpha_dash|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名称必须',
            'name.alpha_dash' => '用户仅允许字母、数字、破折号（-）以及底线（_）',
            'name.max' => '用户名称最多20个字符',
            'name.unique' => '该用户名称已存在',
            'email.required' => '邮箱必须',
            'email.email' => '邮箱非法',
            'email.unique' => '邮箱已存在',
            'password.max' => '密码最多20个字符'
        ];
    }
}