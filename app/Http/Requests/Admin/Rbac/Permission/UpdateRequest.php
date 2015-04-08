<?php namespace App\Http\Requests\Admin\Rbac\Permission;

use App\Http\Requests\Admin\Request;

class UpdateRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'display_name' => 'sometimes|max:100',
            'description' => 'sometimes|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '权限名称必须',
            'name.max' => '权限名称最多100个字符',
            'display_name.max' => '权限显示名称最多100个字符',
            'description' => '权限说明最多100字符'
        ];
    }

}
