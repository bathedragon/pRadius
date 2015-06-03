<?php
/**
 * Date: 6/1 0001
 * Time: 16:21
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * 申请记录
 * Class Apply
 * @package App\Models
 */
class Apply extends Model {
    protected $table = 'p_member_apply';
    protected $guarded = ['id'];

    public static function lastApply($count = 100) {
        $query = DB::table('p_member_apply');
        $query->limit($count);

        return $query->get();
    }

    public static function delete_batch($id) {
        $query = DB::table('p_member_apply');
        if(!is_array($id)) {
            $id = [intval($id)];
        }
        $query->whereIn('id',$id);
        return $query->delete() > 0;
    }
}