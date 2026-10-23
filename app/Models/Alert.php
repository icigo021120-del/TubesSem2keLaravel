<?php

namespace App\Models;

use App\Models\Concerns\StampsOnCreate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alert extends Model
{
    use StampsOnCreate;

    protected string $stampColumn = 'waktu_kejadian';

    public const TINGKAT = ['waspada', 'siaga', 'awas'];

    public $timestamps = false;

    protected $fillable = ['sensor_id', 'tingkat_bahaya', 'pesan_peringatan'];

    protected $casts = ['waktu_kejadian' => 'datetime'];

    public function sensor(): BelongsTo
    {
        return $this->belongsTo(Sensor::class);
    }
}
