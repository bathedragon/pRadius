<?php
/**
 * Date: 6/1 0001
 * Time: 15:07
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as FacadeRequest;
use Validator;
use App\Models\Plan as PlanModel;

class Plan extends Controller {

    public function index() {
        return view('backend.plan.index');
    }

    public function create() {
        return view('backend.plan.create');
    }

    public function store() {
        $input = FacadeRequest::only(['name','daily','monthly','price','simultaneous']);
        $input['daily'] = preg_replace('/[^\d]/','',$input['daily']);
        $input['monthly'] = intval(preg_replace('/[^\d]/','',$input['monthly'])) * 1024;
        $input['simultaneous'] = preg_replace('/[^\d]/','',$input['simultaneous']);

        //todo 验证流量的最大值
        $vadalitor = Validator::make($input,[
            'name' => ['required','regex:/^[a-zA-Z]+$/'],
            'daily' => 'required|numeric',
            'monthly' => 'required|numeric',
            'simultaneous' => 'required|numeric',
            'price' => 'required'
        ],[
            'name.required' => '方案名称不能为空',
            'name.regex' => '方案格式错误',
            'daily.required' => '流量不能为空',
            'daily.numeric' => '流量必须是数字',
            'monthly.numeric' => '流量不能为空',
            'price.required' => '流量必须是数字',
            'simultaneous.required' => '同时登录不能为空',
            'simultaneous.numeric' => '登录设备数量必须是数字'
        ]);

        if($vadalitor->fails()) {
            return [
                'ret' => false,
                'error' => $vadalitor->messages()->first()
            ];
        }

        $plan = PlanModel::instance();
        $ret = $plan->make($input);

        return [
            'ret' => true
        ];
    }

    public function show() {}

    public function edit() {}

    public function update() {}
}