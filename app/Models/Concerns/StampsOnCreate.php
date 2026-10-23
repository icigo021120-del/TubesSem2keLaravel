<?php

namespace App\Models\Concerns;

/**
 * Isi kolom waktu (created_at / waktu_lapor / dst.) dari aplikasi saat data dibuat,
 * supaya zona waktu konsisten (WIB) dan tidak bergantung pada timezone server MySQL.
 */
trait StampsOnCreate
{
    public static function bootStampsOnCreate(): void
    {
        static::creating(function ($model) {
            $column = $model->stampColumn ?? 'created_at';
            if (empty($model->getAttribute($column))) {
                $model->setAttribute($column, now());
            }
        });
    }
}
