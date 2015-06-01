<?php
/**
 * Date: 6/1 0001
 * Time: 16:22
 * @author GROOT (pzyme@outlook.com)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * 流量
 * Class Traffic
 * @package App\Models
 */
class Traffic extends Model {
    protected $table = 'radacct';
    protected $guarded = ['id'];
}