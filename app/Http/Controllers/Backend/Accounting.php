<?php
/**
 * Date: 15/6/6
 * Time: 00:36
 * User: Pzyme
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cache;
use App\Models\Rad\Check;
use App\Models\Traffic;

class Accounting extends Controller {
    
    public function index(Request $req) {
        $key = 'graph:users:'.$req->get('page',1);
        $users = Cache::remember($key,10,function(){
            return Check::page();
        });

        $records = Traffic::page(10,$req->get('username',null));

        return view('backend.accounting.index',[
            'users' => $users,
            'records' => $records,
            'query' => $req->only(['page','username']),
            'username' => $req->get('username')
        ]);
    }
    
    public function create() {}
    
    public function store() {}
    
    public function show() {}
    
    public function edit() {}
    
    public function update() {}
    
    public function destroy() {}
}