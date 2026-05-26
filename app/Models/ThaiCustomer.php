<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $created_at
 */
class ThaiCustomer extends Model
{
    protected $connection="mysql_thai";
     public function user()
    {
    	return $this->setConnection('mysql')->belongsTo('App\User')->withDefault(['name' =>'']);
    }
}
