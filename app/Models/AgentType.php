<?php

namespace App\Models;

use App\Customer;
use App\PartnerTransfer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class AgentType extends Model
{
    use HasFactory;
    public function Customer():HasMany
    {
        return $this->hasMany(Customer::class);
    }
    public function agenttypetransaction(): HasManyThrough
    {
        return $this->hasManyThrough(PartnerTransfer::class, Customer::class);
    }

}
