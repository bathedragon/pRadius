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
use Illuminate\Pagination\Paginator;

class Accounting extends Controller {
    
    public function index(Request $req) {
        $page = $req->get('page',1);
        $key = 'graph:users:'.$page;

        Paginator::currentPageResolver(function() use($page) {
            return $page;
        });
        $users = Cache::remember($key,10,function(){
            return Check::page();
        });


        $r_page = $req->get('rpage',1);
        Paginator::currentPageResolver(function() use($r_page) {
            return $r_page;
        });

        $records = Traffic::page(10,$req->get('username'));

        return view('backend.accounting.index',[
            'users' => $users,
            'records' => $records,
            'query' => $req->only(['upage','username']),
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