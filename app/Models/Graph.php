<?php
/**
 * Date: 15/6/1
 * Time: 21:21
 * User: Pzyme
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;

class Graph extends Model {
    protected $table = 'radacct';
    protected $guarded = ['id'];

    private $username;

    public function __construct($username) {
        $this->username = $username;
    }

    /**
     * 每月流量使用
     * @return array
     */
    public function monthly() {
        $this_month = Carbon::now()->format("Y-m");
        $start = $this_month.'-01 00:00:00';
        $end = Carbon::parse($this_month.'-15 00:00:00')->endOfMonth();

        $data = [];
        $date = Carbon::now()->format("Y-m");
        for($i = 1;$i<32;$i++) {
            $data[$date.'-'.sprintf("%02d", $i)] = [0,0];
        }

        $query = DB::table('radacct')->where('username',$this->username)->where("acctstarttime",">",$start);
        $query->where('acctstoptime','<',$end);
        $result = $query->get();


        foreach($result as $row) {
            list($date,$time) = explode(" ",$row->acctstoptime);
            $data[$date][0] += number_format($row->acctinputoctets/1024/1024,2);
            $data[$date][1] += number_format($row->acctoutputoctets/1024/1024,2);
        }

        return $data;

    }
}