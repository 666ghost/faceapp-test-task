<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExchangeRateHistory extends Model
{
    protected $table = 'exchange_rates_history';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'request_time'
    ];
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->request_time = $model->freshTimestamp();
        });
    }

    public function rates(): ?HasMany
    {
        return $this->hasMany(ExchangeRate::class, 'history_id');
    }

}
