<?php

namespace App\Models;

use App\Models\Concerns\StampsOnCreate;
use Illuminate\Database\Eloquent\Model;

class EvacuationRoute extends Model
{
    use StampsOnCreate;

    protected string $stampColumn = 'created_at';

    public $timestamps = false;

    protected $fillable = ['nama_rute', 'lokasi_asal', 'titik_kumpul', 'deskripsi', 'jarak_meter'];

    protected $casts = ['created_at' => 'datetime'];
}
