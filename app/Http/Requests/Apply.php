<?php
/**
 * Date: 6/3 0003
 * Time: 14:48
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Apply extends FormRequest {
    
    public function rules(){
        return [
            'username' => ['required','regex:/^[a-zA-Z]+$/','min:6','max:15'],
            'password' => 'required|alpha_dash|min:6|max:20',
            'plan' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'username.required' => '请提供一个用户名',
            'username.regex' => '用户名仅可使用字母组合',
            'username.min' => '用户名长度 6-15 位',
            'username.max' => '用户名长度 6-15 位',
            'password.required' => '请提供一个密码',
            'password.alpha_dash' => '密码为数字和字母组合',
            'password.min' => '密码最少6位',
            'plan.required' => '请选择一套方案'
        ];
    }
    
    public function authorize() {
        return true;
    }
}