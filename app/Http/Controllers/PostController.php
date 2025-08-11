<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function temp_post_list()
    {
        $data = [
            [
                "post_id" => 1,
                "username" => "john_doe",
                "profile_image" => asset('/images/temp_image/profile.jpeg'),
                "caption" => "My vacation pics 🌴",
                "time_ago" => "2h ago",
                "media" => [
                    ["type" => "image", "url" => asset('/images/temp_image/post1.jpeg')],
                    ["type" => "image", "url" => asset('/images/temp_image/post2.jpeg')]
                ]
            ],
            [
                "post_id" => 2,
                "username" => "john_doe",
                "profile_image" => asset('/images/temp_image/profile.jpeg'),
                "caption" => "My vacation pics 🌴",
                "time_ago" => "2h ago",
                "media" => [
                    ["type" => "video", "url" => asset('/images/temp_video/TamilPasanga.mp4')],
                    ["type" => "image", "url" => asset('/images/temp_image/post2.jpeg')],
                    ["type" => "video", "url" => asset('/images/temp_video/post2.mp4')],
                ]
            ],
            [
                "post_id" => 3,
                "username" => "john_doe",
                "profile_image" => asset('/images/temp_image/profile.jpeg'),
                "caption" => "My vacation pics 🌴",
                "time_ago" => "2h ago",
                "media" => [
                    ["type" => "video", "url" => asset('/images/temp_video/Jana_Nayagan.mp4')],
                ]
            ],
            [
                "post_id" => 4,
                "username" => "john_doe",
                "profile_image" => asset('/images/temp_image/profile.jpeg'),
                "caption" => "My vacation pics 🌴",
                "time_ago" => "12h ago",
                "media" => [
                    ["type" => "image", "url" => asset('/images/temp_image/post3.jpeg')],
                    ["type" => "video", "url" => asset('/images/temp_video/Jana_Nayagan.mp4')],
                    ["type" => "video", "url" => asset('/images/temp_video/TamilPasanga.mp4')],
                    ["type" => "image", "url" => asset('/images/temp_image/post4.jpeg')],
                ]
            ],
        ];

        return $data;
    }
}
