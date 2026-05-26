<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $address
 * @property mixed $age
 * @property mixed $boss_address
 * @property mixed $bossname
 * @property mixed $created_at
 * @property mixed $email
 * @property mixed $idcard
 * @property mixed $logo
 * @property mixed $name
 * @property mixed $name1
 * @property mixed $nation
 * @property mixed $note_text
 * @property mixed $public_ip
 * @property mixed $qrlogo
 * @property mixed $sex
 * @property mixed $subname
 * @property mixed $subtext
 * @property mixed $tel
 * @property mixed $updated_at
 * @property mixed $website
 */
class Company extends Model
{
    static function getbranceinfo(){

        $selcomid=Session('log_into_company_id');
        $company=Company::where('id',$selcomid)->first();
        return $company ;

    }
}
