<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WingTransactionName extends Model
{
    use HasFactory;
    protected $table="wing_transaction_names";
    public function agenttype()
    {
        return $this->belongsTo('App\Models\AgentType','agent_type_id')->withDefault(['name' =>'']);
    }
}
