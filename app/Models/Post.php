<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    // use SoftDeletes;
    
    // quy uoc ten table
    /*
        Ten Model Post => table: posts
        Ten Model: ProductCategory => table: product_categories
    */

    // dat ten table theo minh mong muon, khong thao quy uoc
    protected $table = 'posts';

    // quy uoc khoa chinh. Mac dinh laravel se lay field id lam khoa chinh
    protected $primaryKey = 'id';
    // public $incrementing = false;
    // protected $keyType =' string';
    public $timestamps = true;

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    protected $attributes = [
        'status' => 0
    ];

    protected $fillable = ['title', 'content', 'status'];
}
