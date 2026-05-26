<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThaiCustomer extends Model
{
    protected $connection="mysql_thai";
     public function user()
    {
    	return $this->setConnection('mysql')->belongsTo('App\User')->withDefault(['name' =>'']);
    }
}
