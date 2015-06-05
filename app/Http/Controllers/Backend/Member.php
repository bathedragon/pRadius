<?php
/**
 * Date: 6/1 0001
 * Time: 16:16
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as FacadeRequest;
use App\Models\Apply;
use App\Models\Rad\Check;
use App\Models\Traffic;

class Member extends Controller {

    public function apply() {

        return view('backend.member.apply',[
            'applies' => Apply::lastApply()
        ]);
    }

    public function agree() {
        $id = FacadeRequest::input('id');
        $apply = Apply::find($id);
        if(Check::exist($apply->username)) {
            return [
                'ret' => false,
                'error' => '该用户名已存在,无法通过'
            ];
        }

        $ret = Check::make([
            'username' => $apply->username,
            'password' => $apply->password,
            'groupname' => $apply->plan
        ]);

        return [
            'ret' => $ret
        ];
    }

    public function reject() {
        $id = FacadeRequest::input('id');
        $apply = Apply::find($id);
        $ret = $apply->delete();

        return [
            'ret' => $ret
        ];
    }

    public function deleteBatch() {
        $id = FacadeRequest::input("id");
        if(stripos($id,",") !== false) $id = explode(",",$id);
        return [
            'ret' => Apply::delete_batch($id)
        ];
    }

    public function index() {

        return view('backend.member.index',[
            'members' => Check::page()
        ]);
    }

    public function create() {}

    public function store() {}

    public function show() {}

    public function edit() {}

    public function update() {}

    public function delete() {
        $ret = Check::destroy(FacadeRequest::input('username'));

        return ['ret' => $ret];
    }
}