<?php

namespace App\Http\Controllers;

use App\Models\TagList;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function fetchTagList()
    {
        $trending = TagList::select('id', 'name')->where('is_trending', 1)->get()->toArray();
        $more_tags = TagList::select('id', 'name')->get()->toArray();

        return ['status' => 1, 'trending' => $trending, 'more_tags' => $more_tags];
    }
}
