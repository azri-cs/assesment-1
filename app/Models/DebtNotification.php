<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DebtNotification extends Model
{
    protected $table = 'debt_notifications';

    protected $fillable = ['mobile_number', 'text1', 'amount', 'text2'];
}
