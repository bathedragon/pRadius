<?php
/**
 * Date: 6/1 0001
 * Time: 15:10
 * @author GROOT (pzyme@outlook.com)
 */

namespace App\Http\Middleware;
use Closure;
use Session;

class Member {

    private $role;

    function __construct()
    {
        $this->role = Session::get('role','guest');
    }

    public function handle($request, Closure $next){
        $response = $next($request);

        if( ! in_array($this->role,['member','admin'])) {
            return redirect()->away("/session/new");
        }

        return $response;
    }

}