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
}