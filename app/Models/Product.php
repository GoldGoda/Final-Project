<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'img',
        'name',
        'description',
        'price',
        'stock',
        'category_id',
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
