<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trades extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'uuid',
        'cost',
        'user_name',
        'notes',
        'quantity'
    ];

    public function tradeDetails(){
        return $this->hasMany(TradeDetails::class);
    }
}
