<?php
/**
 * Date: 6/1 0001
 * Time: 16:19
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * 后台管理员
 * Class Operator
 * @package App\Models
 */
class Operator extends Model {
    protected $table = 'p_operators';
    protected $guarded = ['id'];
}