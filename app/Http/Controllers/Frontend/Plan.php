<?php
/**
 * Date: 6/1 0001
 * Time: 16:17
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as FacadeRequest;
use App\Http\Requests\Apply;
use App\Models\Apply as ApplyModel;

class Plan extends Controller {


    public function postApply(Apply $req) {
        $input = $req->only(['username','password','plan']);

        try{
            $plan = new ApplyModel();
            $plan->setRawAttributes($input);
            $ret = $plan->save();
            $message = $ret ? '申请成功' : '申请失败';
        } catch(\Exception $e) {
            $ret = false;
            $message = '已申请,等待处理';
        }

        return [
            'message' => $message
        ];
    }
}