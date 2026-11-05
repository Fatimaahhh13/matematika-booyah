<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tutor extends Model
{
    use HasFactory;

    protected $table = 'tutors';

    protected $fillable = [
        'user_id',
        'branch_id',
        'phone',
        'address',
        'status',
        'avatar',
    ];

    /**
     * Relasi ke tabel Branch (Cabang)
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * Relasi ke tabel User (untuk nama, email, dll)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}