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

    /**
     * 登录检查
     * @param $username
     * @param $password
     * @return bool
     */
    public static function login($username,$password) {
        return DB::table('radcheck')->where('username',$username)->where('value',$password)->exists();
    }

    /**
     * 检查vpn用户是否存在
     * @param $username
     * @return bool
     */
    public static function exist($username) {
        return DB::table('radcheck')->where('username',$username)->exists();
    }
}