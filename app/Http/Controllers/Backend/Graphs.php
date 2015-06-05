<?php
/**
 * Date: 6/1 0001
 * Time: 16:29
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as FacadeRequest;
use App\Models\Graph;
use Cache;
use App\Models\Rad\Check;

class Graphs extends Controller {

    private $type_label = [
        'login' => '登录次数',
        'download' => '下载流量',
        'upload' => '上传流量'
    ];
    private $period_label = [
        'daily' => '按日统计',
        'monthly' => '按月统计',
        'yearly' => '按年统计'
    ];
    private $default_type = 'login';
    private $default_period = 'daily';

    /**
     * @param Request $req
     * @return \Illuminate\View\View
     */
    public function index(Request $req) {

        $type = $req->get('type',$this->default_type);
        $period = $req->get('period',$this->default_period);

        if(!in_array($type,['login','download','upload']) || !in_array($period,['daily','monthly','yearly'])) abort(404);

        $key = 'graph:users:'.$req->get('page',1);
        $users = Cache::remember($key,10,function(){
            return Check::page();
        });

        $username = $req->get('username',$users[0]->username);

        $graph = new Graph($username);

        return view('backend.graph.graph',[
            'data' => $graph->chart($type,$period),
            'period' => $period,
            'type' => $type,
            'username' => $username,
            'users' => $users,
            'type_label' => $this->type_label[$type],
            'period_label' => $this->period_label[$period]
        ]);
    }

    public function getDownloads(Request $req) {
        $this->default_type = 'download';
        return $this->index($req);
    }

    public function getUploads(Request $req) {
        $this->default_type = 'upload';
        return $this->index($req);
    }

    public function getLogins(Request $req) {
        $this->default_type = 'login';
        return $this->index($req);
    }
}