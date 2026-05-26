<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
