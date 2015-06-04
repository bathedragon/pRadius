<?php
/**
 * Date: 15/6/1
 * Time: 22:34
 * User: Pzyme
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rad\Check;

class Dashboard extends Controller {
    
    public function index() {
        return view('backend.report.online',[
            'members' => Check::online()
        ]);
    }
    
    public function create() {}
    
    public function store() {}
    
    public function show() {}
    
    public function edit() {}
    
    public function update() {}
    
    public function destroy() {}
}