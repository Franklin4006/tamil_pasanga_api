<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function fetchTagList()
    {
        $trending = Tag::select('id', 'name')->where('is_trending', 1)->get()->toArray();
        $more_tags = Tag::select('id', 'name')->where('is_trending', 0)->get()->toArray();

        return ['status' => 1, 'trending' => $trending, 'more_tags' => $more_tags];
    }
}
