<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExchangeRate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'rate', 'currency_id', 'history_id'
    ];
    public $timestamps = false;

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function history(): BelongsTo
    {
        return $this->belongsTo(ExchangeRateHistory::class);
    }
}
