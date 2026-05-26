<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function agenttype()
    {
        return $this->belongsTo('App\Models\AgentType','agent_type_id')->withDefault(['name' =>'']);
    }
    public function province()
    {
        return $this->belongsTo('App\Address')->withDefault(['name' =>'']);
    }
    public function district()
    {
        return $this->belongsTo('App\Address')->withDefault(['name' =>'']);
    }
    public function commune()
    {
        return $this->belongsTo('App\Address')->withDefault(['name' =>'']);
    }
    public function village()
    {
        return $this->belongsTo('App\Address')->withDefault(['name' =>'']);
    }
    public function user()
    {
    	return $this->belongsTo('App\User')->withDefault(['name' =>'']);
    }
    public function company()
    {
    	return $this->belongsTo('App\Company','company_id')->withDefault(['name' =>'']);
    }
    public function userconnect()
    {
    	return $this->belongsTo('App\User','user_connect')->withDefault(['name' =>'']);
    }
    public static function separate_userconnect_old($userconnect)
    {
      $userconnects=explode(',',$userconnect);
      $usernames='';
    	foreach($userconnects as $key => $value){
        $user=User::where('id',$value)->first();
        if($usernames==''){
            if($user){
                $usernames = $user->name;
            }
        }else{
            if($user){
                $usernames .='|' . $user->name;
            }
        }

      }
      return $usernames;
    }
     public static function separate_userconnect1($userconnect, $limit = null)
    {
        if (!$userconnect) return '';
        $ids = explode(',', $userconnect);
        $names = [];

        foreach ($ids as $id) {
            $user = User::find($id);
            if ($user) {
                $names[] = e($user->name);
            }
        }

        if ($limit && count($names) > $limit) {
            $short = array_slice($names, 0, $limit);
            return implode('<br>', $short) . '<br>...';
        }

        return implode('<br>', $names);
    }
    public static function separate_userconnect($userconnect, $limit = null, $returnArray = false)
    {
        if (!$userconnect) {
            return $returnArray ? ['html' => '', 'has_more' => false] : '';
        }

        $ids = explode(',', $userconnect);
        $names = [];

        foreach ($ids as $id) {
            $user = User::find($id);
            if ($user) {
                $names[] = e($user->name);
            }
        }

        $hasMore = false;

        if ($limit && count($names) > $limit) {
            $short = array_slice($names, 0, $limit);
            $hasMore = true;
            $html = implode('<br>', $short) . '...';
        } else {
            $html = implode('<br>', $names);
        }

        if ($returnArray) {
            return ['html' => $html, 'has_more' => $hasMore];
        }

        return $html;
    }

}
