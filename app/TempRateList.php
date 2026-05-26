<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempRateList extends Model
{
    protected $table="temp_rate_lists";
    protected $fillable=['loan_id','user_id','ratedate','principal','rate','payprincipal','total','balance'];
}
