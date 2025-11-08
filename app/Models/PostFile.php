<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'path'];
    protected $appends = ['file_url'];
    protected $hidden = ['path', 'post_id', 'created_at', 'updated_at'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getFileUrlAttribute()
    {
        return url('storage/' . $this->path);
    }

}
