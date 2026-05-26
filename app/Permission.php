<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function user()
	{
		return $this->belongsToMany(User::class,'permission_users')->withPivot(['pcdt']);
	}
	public static function getpermission($code)
	{
		$ps=Permission::where('maincode',$code)->orderBy('id')->get();
		return $ps;
	}
    
}
