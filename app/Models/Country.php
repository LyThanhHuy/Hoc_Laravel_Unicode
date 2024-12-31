<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'country';

    public function posts() {
        return $this->hasManyThrough(
            Posts::class, // Model muon lien ket
            User::class, // Model trung gian
            'country_id', // Khoa ngoai cua model trung gian
            'user_id', // Khoa ngoai cua model muon lien ket
            'id',
            'id'
        );
    }
}
