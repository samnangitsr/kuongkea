<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $balance
 * @property mixed $closedate
 * @property mixed $closetime
 * @property mixed $created_at
 * @property mixed $lastsmsid
 * @property mixed $thai_account_id
 * @property mixed $updated_at
 * @property mixed $user_id
 */
class ThaiCloseList extends Model
{
    use HasFactory;
    protected $connection="mysql_thai";
    public function user()
    {
    	return $this->setConnection('mysql')->belongsTo('App\User')->withDefault(['name' =>'']);
    }
    public function account()
    {
        return $this->belongsTo(ThaiAccount::class,'thai_account_id')->withDefault(['accno' =>'']);
    }
}
