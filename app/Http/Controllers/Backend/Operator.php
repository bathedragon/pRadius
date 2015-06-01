<?php
/**
 * Date: 15/6/1
 * Time: 22:36
 * User: Pzyme
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Input;
use Validator;
use App\Models\Operator as OperatorModel;
use Hash;

class Operator extends Controller {
    
    public function index() {
        $data = OperatorModel::all();
        return view('backend.operator.index',['operators' => $data]);
    }
    
    public function create() {

        return view('backend.operator.create');
    }
    
    public function store() {
        $input = Input::only(['email','password']);
        $validator = Validator::make($input,[
            'email' => 'required|email',
            'password' => 'required|alpha_dash'
        ],[
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式错误',
            'password.required' => '密码不能为空',
            'password.alpha_dash' => '密码仅允许字母、数字、破折号（-）以及底线（_）'
        ]);

        if($validator->fails()) {
            return [
                'ret' => false,
                'error' => $validator->messages()->first()
            ];
        }

        $error = '';
        try{
            $input['password'] = Hash::make($input['password']);
            $input['created_ip'] = Input::ip();

            $operator = new OperatorModel();
            $operator->setRawAttributes($input);
            $ret = $operator->save();
        } catch(\Exception $e) {
            $ret = false;
            //$error = $e->getMessage();
            $error = '邮箱已经在使用';
        }

        return ['ret' => $ret,'error' => $error];
    }
    
    public function show() {}
    
    public function edit() {}
    
    public function update() {}
    
    public function destroy() {}

    public function postDelete() {
        $operator = OperatorModel::find(Input::get("id"));
        if(isset($operator->email) && $operator->email == $this->username) {
            return [
                'ret' => false,
                'error' => '不能删除自己'
            ];
        }

        $ret = $operator->delete();
        return [
            'ret' => $ret
        ];
    }
}