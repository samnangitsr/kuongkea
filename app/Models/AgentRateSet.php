<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $agent_type_id
 * @property mixed $amt1
 * @property mixed $amt2
 * @property mixed $cashdraw_rate
 * @property mixed $currency
 * @property mixed $customer_rate
 * @property mixed $setdate
 * @property mixed $transaction_name_id
 * @property mixed $transfer_rate
 * @property mixed $user_id
 */
class AgentRateSet extends Model
{
    use HasFactory;
}
