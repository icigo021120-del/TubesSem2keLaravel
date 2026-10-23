<?php

namespace App\Models;

use App\Models\Concerns\StampsOnCreate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationModule extends Model
{
    use StampsOnCreate;

    protected string $stampColumn = 'created_at';

    public const KATEGORI = ['gempa', 'kebakaran', 'banjir', 'umum'];

    public $timestamps = false;

    protected $fillable = ['judul', 'kategori', 'konten', 'created_by'];

    protected $casts = ['created_at' => 'datetime'];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
