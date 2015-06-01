<?php
/**
 * Date: 6/1 0001
 * Time: 14:56
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Models\Rad;

use Illuminate\Database\Eloquent\Model;
use DB;

class Check extends Model {
    protected $table = 'radcheck';
    protected $guarded = ['id'];

    public static function login($username,$password) {
        return DB::table('radcheck')->where('username',$username)->where('value',$password)->exists();
    }
}