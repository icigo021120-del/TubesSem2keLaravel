<?php

namespace App\Models;

use App\Models\Concerns\StampsOnCreate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    use StampsOnCreate;

    protected string $stampColumn = 'waktu_lapor';

    public const STATUS = ['menunggu', 'diproses', 'selesai', 'palsu'];

    public $timestamps = false;

    protected $fillable = ['user_id', 'deskripsi_kejadian', 'lokasi_kejadian', 'status_laporan', 'foto_bukti'];

    protected $casts = ['waktu_lapor' => 'datetime'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fotoUrl(): ?string
    {
        return $this->foto_bukti ? asset('storage/' . $this->foto_bukti) : null;
    }

    public function hapusFoto(): void
    {
        if ($this->foto_bukti) {
            Storage::disk('public')->delete($this->foto_bukti);
        }
    }
}
