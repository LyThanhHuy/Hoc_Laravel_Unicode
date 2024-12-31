<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanics extends Model
{
    use HasFactory;

    protected $table = 'mechanics';

    public function carOwner()
    {
        return $this->hasOneThrough(
            Owners::class, // model muon lien ket toi
            Cars::class, // model trung gian
            'mechanic_id', // khoa ngoai cua table trung gian
            'car_id', // khoa ngoai của table muon lien ket toi
            'id', // khoa chinh cua table hien tai
            'id' // khoa chinh cua table trung gian
        );
    }
}
