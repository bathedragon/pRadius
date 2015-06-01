<?php
/**
 * Date: 6/1 0001
 * Time: 16:19
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;

/**
 * 后台管理员
 * Class Operator
 * @package App\Models
 */
class Operator extends Model {
    protected $table = 'p_operators';
    protected $guarded = ['id'];

    /**
     * 管理员登录
     * @param $email
     * @param $password
     * @return bool
     */
    public static function login($email,$password) {
        $operator = DB::table('p_operators')->where("email",$email)->first();

        if(empty($operator)) return false;

        if( ! Hash::check($password,$operator->password)) return false;

        return true;
    }
}