<?php
/**
 * Date: 6/1 0001
 * Time: 16:28
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Request as FacadeRequest;
use App\Models\Rad\Check;
use App\Models\Traffic;

class Report extends Controller {


    public function getOnline() {
        return view('backend.report.online',[
            'members' => Check::online()
        ]);
    }

    public function getTop(Request $req) {
        $period = $req->get('period','lastWeek');
        $order = $req->get('order','traffic');
        $take = $req->get('take',5);
        switch($period) {
            case 'lastWeek':
            default:
                $start = Carbon::now()->subDay(7)->format("Y-m-d 00:00:00");
                $end = Carbon::now()->format("Y-m-d H:i:s");
                break;
            case 'thisMonth':
                $start = Carbon::now()->format("Y-m").'-01 00:00:00';
                $end = Carbon::now()->endOfMonth();
                break;
            case 'lastThreeMonth':
                $start = Carbon::now()->subMonth(3);
                $end = Carbon::now()->format("Y-m-d H:i:s");
                break;
            case 'thisYear':
                $start = Carbon::now()->format("Y").'-01-01 00:00:00';
                $end = Carbon::now()->format("Y-m-d H:i:s");
                break;
        }

        switch($order) {
            case 'traffic':
            default:
                $_order = 'download';
                break;
            case 'time':
                $_order = 'time';
                break;
        }

        return view('backend.report.top',[
            'rows' => Traffic::top($start,$end,intval($take),$_order),
            'period' => $period,
            'order' => $order,
            'take' => $take
        ]);
    }
}