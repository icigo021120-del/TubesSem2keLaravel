<?php

namespace App\Models;

use App\Models\Concerns\StampsOnCreate;
use Illuminate\Database\Eloquent\Model;

class AssemblyPoint extends Model
{
    use StampsOnCreate;

    protected string $stampColumn = 'created_at';

    public $timestamps = false;

    protected $fillable = ['nama_titik', 'lokasi', 'kapasitas', 'deskripsi'];

    protected $casts = ['created_at' => 'datetime'];
}
