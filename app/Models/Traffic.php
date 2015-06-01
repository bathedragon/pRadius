<?php
/**
 * Date: 6/1 0001
 * Time: 16:22
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Rad\Group;

/**
 * 流量
 * Class Traffic
 * @package App\Models
 */
class Traffic extends Model {
    protected $table = 'radacct';
    protected $guarded = ['id'];

    private $username;
    private $group;

    public function __construct($username) {
        $this->username = $username;
        $this->group = Group::belong($username);
        //Carbon::setTestNow(Carbon::create(2015, 5, 31, 12));
    }

    /**
     *
     * @param $username
     * @return array
     */
    public function total() {
        $query = DB::table('radgroupcheck')->where("groupname",$this->group);
        $result = $query->get();

        $_tmp = [];
        foreach($result as $res) {
            switch($res->attribute) {
                case env('Max_Daily_Traffic'):
                    $_tmp['daily'] = $res->value;
                    break;
                case env('Max_Monthly_Traffic'):
                    $_tmp['monthly'] = $res->value;
                    break;
            }
        }
        return $_tmp;
    }

    /**
     * @return int
     */
    public function daily() {
        $today = Carbon::now()->format("Y-m-d");
        $start = $today.' 00:00:00';
        $end = $today.' 23:59:59';

        $sql = "SELECT FLOOR(SUM(acctinputoctets+acctoutputoctets)/1024/1024) as total FROM radacct WHERE username='?' AND acctstarttime > ? AND acctstoptime < ?";
        $result = DB::select(DB::raw($sql),[$this->username,$start,$end]);

        return isset($result[0]->total) ? $result[0]->total : 0;
    }

    /**
     * @return int
     */
    public function monthly() {
        $this_month = Carbon::now()->format("Y-m");
        $start = $this_month.'-01 00:00:00';
        $end = Carbon::parse($this_month.'-15 00:00:00')->endOfMonth();

        $sql = "SELECT FLOOR(SUM(acctinputoctets+acctoutputoctets)/1024/1024) as total FROM radacct WHERE username='?' AND acctstarttime > ? AND acctstoptime < ?";

        $result = DB::select(DB::raw($sql),[$this->username,$start,$end]);

        return isset($result[0]->total) ? $result[0]->total : 0;
    }
}