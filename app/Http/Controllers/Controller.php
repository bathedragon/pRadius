<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Session;
use View;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    protected $role;
    protected $username;
    protected $user_group;

    function __construct() {
        $this->init();
        $this->share();
    }

    private function init() {
        $this->role = Session::get('role','guest');
        $this->username = Session::get('username','guest');
        $this->user_group = Session::get('user_group','guest');
    }

    private function share() {
        View::share('username',$this->username);
        View::share('user_group',$this->user_group);
    }
}
