<?php
/**
 * Date: 6/1 0001
 * Time: 15:02
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Request as FacadeRequest;
use App\Models\Rad\Check;
use App\Models\Rad\Group;
use Session;
use App\Models\Traffic;
use App\Models\Graph;
use App\Models\Operator;
use Input;

class Sessions extends Controller {


    public function index() {

        return view('login');
    }

    public function login() {
        $username = FacadeRequest::input('username');
        $password = FacadeRequest::input('password');

        if(Check::login($username,$password)) {
            Session::put('role','member');
            Session::put('username',$username);
            Session::put('user_group',Group::belong($username));

            return [
                'ret' => true,
                'redirect' => url('member/profile/'.$username)
            ];
        }

        if(Operator::login($username,$password)) {
            Session::put('role','admin');
            Session::put('username',$username);
            Session::put('user_group','admin');

            Operator::login_update($username,[
                'last_login' => Carbon::now()->format('Y-m-d H:i:s'),
                'last_login_ip' => Input::ip()
            ]);

            return [
                'ret' => true,
                'redirect' => url('admin')
            ];
        }

        return [
            'ret' => false
        ];
    }

    public function destroy() {
        Session::flush();
        return redirect()->away("/");
    }

    public function profile($username) {
        if($username != Session::get('username')) abort(404);

        if( !Check::exist($username)) abort(404);

        $traffic = new Traffic($username);
        $graph = new Graph($username);

        return view('profile',[
            'total' => $traffic->total(),
            'used' => [
                'today' => $traffic->daily(),
                'month' => $traffic->monthly()
            ],
            'graph' => $graph->monthly()
        ]);
    }
}