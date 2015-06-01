<?php
/**
 * Date: 6/1 0001
 * Time: 15:09
 * @author GROOT (pzyme@outlook.com)
 */

namespace App\Http\Middleware;
use Closure;
use Session;

class Administrator {

    private $role;

    function __construct()
    {
        $this->role = Session::get('role','guest');
    }

    public function handle($request, Closure $next){
        $response = $next($request);

        if( ! in_array($this->role,['admin'])) {
            return redirect()->away("/session/new");
        }

        return $response;
    }

}