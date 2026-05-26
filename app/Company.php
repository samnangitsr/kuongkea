<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    static function getbranceinfo(){

        $selcomid=Session('log_into_company_id');
        $company=Company::where('id',$selcomid)->first();
        return $company ;

    }
}
