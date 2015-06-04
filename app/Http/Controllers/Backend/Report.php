<?php
/**
 * Date: 6/1 0001
 * Time: 16:28
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as FacadeRequest;
use App\Models\Rad\Check;

class Report extends Controller {


    public function getOnline() {
        return view('backend.report.online',[
            'members' => Check::online()
        ]);
    }

    public function getTop() {}
}