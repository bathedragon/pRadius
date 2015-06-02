<?php
/**
 * Date: 6/1 0001
 * Time: 16:25
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Models\Rad;

use Illuminate\Database\Eloquent\Model;
use DB;

class GroupCheck extends Model {
    protected $table = 'radgroupcheck';
    protected $guarded = ['id'];

    /**
     *
     * @param array $plan
     * @return mixed
     */
    public function make(array $plan) {
        return DB::transaction(function() use($plan){
            $insert_data = [
                [
                    'groupname' => $plan['name'],
                    'attribute' => env('Max_Daily_Traffic'),
                    'op' => ':=',
                    'value' => $plan['daily']
                ],
                [
                    'groupname' => $plan['name'],
                    'attribute' => env('Max_Monthly_Traffic'),
                    'op' => ':=',
                    'value' => $plan['monthly']
                ],
                [
                    'groupname' => $plan['name'],
                    'attribute' => env('Simultaneous_Use'),
                    'op' => ':=',
                    'value' => $plan['simultaneous']
                ]
            ];

            return DB::table('radgroupcheck')->insert($insert_data);
        });
    }

    /**
     *
     * @param $groupname
     * @return array|bool
     */
    public function detail($groupname) {
        $sql = "SELECT groupname,GROUP_CONCAT(attribute) AS attr,GROUP_CONCAT(value) AS val FROM radgroupcheck WHERE groupname=? GROUP BY groupname";
        $result = DB::select(DB::raw($sql),[$groupname]);

        if(!isset($result[0])) return false;
        $row = $result[0];unset($result);

        $attrs = explode(",",str_replace([env('Max_Daily_Traffic'),env('Max_Monthly_Traffic'),env('Simultaneous_Use')],['daily','monthly','simultaneous'],$row->attr));
        $vals = explode(",",$row->val);

        return [
            'groupname' => $row->groupname,
            'detail' => array_combine($attrs,$vals)
        ];
    }
}