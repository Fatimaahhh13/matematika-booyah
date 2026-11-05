<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relasi ke tabel students (Satu cabang memiliki banyak siswa)
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Relasi ke tabel users / admin cabang / tutor
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relasi ke tabel tutors (Satu cabang memiliki banyak tutor/pengajar)
     */
    public function tutors()
    {
        return $this->hasMany(Tutor::class);
    }
}