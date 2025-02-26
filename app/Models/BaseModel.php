<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseModel extends Model
{
    use HasFactory;

    /**
     * Secara default timestamps dimatikan, bisa diaktifkan di model turunan.
     */
    public $timestamps = false;

    /**
     * Nama kolom timestamps dalam uppercase.
     */
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    /**
     * Nama kolom soft delete dalam uppercase.
     */
    const DELETED_AT = 'DELETED_AT';

    /**
     * Menentukan apakah model turunan menggunakan timestamps atau tidak.
     * Jika iya, maka timestamps diaktifkan.
     */
    protected static function boot()
    {
        parent::boot();

        $instance = new static();

        // Set tabel otomatis sesuai nama class (uppercase)
        $instance->setTable(strtoupper(class_basename(static::class)));

        // Cek apakah model turunan pakai timestamps
        if (defined(get_class($instance) . '::USE_TIMESTAMPS') && $instance::USE_TIMESTAMPS) {
            $instance->timestamps = true;
        }

        // Cek apakah model turunan pakai soft delete
        if (in_array(SoftDeletes::class, class_uses($instance))) {
            $instance->dates[] = self::DELETED_AT;
        }
    }

    /**
     * Override setter untuk semua attributes, otomatis uppercase sebelum disimpan
     */
    public function setAttribute($key, $value)
    {
        if (is_string($value)) {
            $value = strtoupper($value);
        }

        parent::setAttribute($key, $value);
    }
}
