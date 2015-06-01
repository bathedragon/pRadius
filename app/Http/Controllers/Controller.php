<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Session;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    private $role;
    private $username;
    private $user_group;

    function __construct() {
        $this->init();
    }

    private function init() {
        $this->role = Session::get('role','guest');
        $this->username = Session::get('username','guest');
        $this->user_group = Session::get('user_group','guest');
    }
}
