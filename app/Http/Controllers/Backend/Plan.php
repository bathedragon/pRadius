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
use App\Models\Rad\Group;

class Plan extends Controller {

    private $rules = [
        'name' => ['required','regex:/^[a-zA-Z]+$/'],
        'daily' => 'required|numeric',
        'monthly' => 'required|numeric',
        'simultaneous' => 'required|numeric',
        'idletimeout' => 'required|numeric',
        'sessiontimeout' => 'required|numeric',
        'acctinterval' => 'required|numeric',
        'price' => 'required'
    ];
    private $messages = [
        'name.required' => '方案名称不能为空',
        'name.regex' => '方案格式错误',
        'daily.required' => '流量不能为空',
        'daily.numeric' => '流量必须是数字',
        'monthly.numeric' => '流量不能为空',
        'price.required' => '流量必须是数字',
        'simultaneous.required' => '同时登录不能为空',
        'simultaneous.numeric' => '登录设备数量必须是数字'
    ];

    public function index() {
        $plan = PlanModel::instance();
        return view('backend.plan.index',[
            'plans' => $plan->getAll()
        ]);
    }

    public function create() {
        return view('backend.plan.create');
    }

    public function store() {
        $input = FacadeRequest::only(['name','daily','monthly','price','simultaneous','idletimeout','sessiontimeout','acctinterval']);
        $input['daily'] = preg_replace('/[^\d]/','',$input['daily']);
        $input['monthly'] = intval(preg_replace('/[^\d]/','',$input['monthly'])) * 1024;
        $input['simultaneous'] = preg_replace('/[^\d]/','',$input['simultaneous']);
        $input['idletimeout'] = preg_replace('/[^\d]/','',$input['idletimeout']) * 3600;
        $input['sessiontimeout'] = preg_replace('/[^\d]/','',$input['sessiontimeout']) * 3600;
        $input['acctinterval'] = preg_replace('/[^\d]/','',$input['acctinterval']) * 60;

        //todo 验证流量的最大值
        $vadalitor = Validator::make($input,$this->rules,$this->messages);

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

    public function edit($name) {
        $plan = PlanModel::instance();
        return view('backend.plan.edit',[
            'plan' => $plan->detail($name)
        ]);
    }

    public function postEdit() {
        $input = FacadeRequest::only(['name','daily','monthly','price','simultaneous','idletimeout','sessiontimeout','acctinterval']);
        $input['daily'] = preg_replace('/[^\d]/','',$input['daily']);
        $input['monthly'] = intval(preg_replace('/[^\d]/','',$input['monthly'])) * 1024;
        $input['simultaneous'] = preg_replace('/[^\d]/','',$input['simultaneous']);
        $input['idletimeout'] = preg_replace('/[^\d]/','',$input['idletimeout']) * 3600;
        $input['sessiontimeout'] = preg_replace('/[^\d]/','',$input['sessiontimeout']) * 3600;
        $input['acctinterval'] = preg_replace('/[^\d]/','',$input['acctinterval']) * 60;

        //todo 验证流量的最大值
        $vadalitor = Validator::make($input,$this->rules,$this->messages);

        if($vadalitor->fails()) {
            return [
                'ret' => false,
                'error' => $vadalitor->messages()->first()
            ];
        }

        $plan = PlanModel::instance();
        $ret = $plan->make($input,true);

        return [
            'ret' => true
        ];
    }

    public function update() {}


    public function postDelete() {
        $name = FacadeRequest::input('name');

        $members = Group::members($name);
        if(!empty($members)) {
            return [
                'ret' => false,
                'error' => '以下用户正在使用,不能删除:'.implode(",",array_fetch($members,'username'))
            ];
        }

        $plan = PlanModel::instance();
        $plan->remove($name);

        return ['ret' => true];
    }
}