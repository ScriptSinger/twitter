<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    public $timestamps = ['created_at'];

    protected $fillable = ['category_id', 'username', 'content'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
