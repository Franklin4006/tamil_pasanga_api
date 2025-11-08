<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = ['description', 'user_id', 'created_by'];

    use HasFactory;

    public function media()
    {
        return $this->hasMany(PostFile::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(PostFile::class, 'post_id');
    }

    protected function createdTime(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->created_at)->diffForHumans()
        );
    }
}
