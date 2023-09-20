<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TradeDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'trades_id',
        'amount',
        'currency'
    ];

    public function trade() : BelongsTo{
        return $this->belongsTo(Trades::class);
    }
}
