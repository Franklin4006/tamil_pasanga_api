<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['description'];

    use HasFactory;

    public function media()
{
    return $this->hasMany(PostFile::class); // You need a Media model
}
}
