<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function temp_post_list()
    {
        $data = [
            [
                "username" => "john_doe",
                "profile_image" => "https://i.pravatar.cc/100?img=7",
                "caption" => "My vacation pics 🌴",
                "time_ago" => "2h ago",
                "media" => [
                    ["type" => "image", "url" => "https://example.com/image1.jpg"],
                    ["type" => "video", "url" => "https://example.com/video.mp4"],
                    ["type" => "image", "url" => "https://example.com/image2.jpg"]
                ]
            ],
            [
                "username" => "john_doe",
                "profile_image" => "https://i.pravatar.cc/100?img=8",
                "caption" => "My vacation pics 🌴",
                "time_ago" => "2h ago",
                "media" => [
                    ["type" => "image", "url" => "https://example.com/image1.jpg"],
                    ["type" => "video", "url" => "https://example.com/video.mp4"],
                    ["type" => "image", "url" => "https://example.com/image2.jpg"]
                ]
            ],
            [
                "username" => "john_doe",
                "profile_image" => "https://i.pravatar.cc/100?img=11",
                "caption" => "My vacation pics 🌴",
                "time_ago" => "2h ago",
                "media" => [
                    ["type" => "image", "url" => "https://images.pexels.com/photos/276267/pexels-photo-276267.jpeg?auto=compress&cs=tinysrgb&w=600"],
                    ["type" => "video", "url" => "https://flutter.github.io/assets-for-api-docs/assets/videos/bee.mp4"],
                    ["type" => "image", "url" => "https://images.pexels.com/photos/2280547/pexels-photo-2280547.jpeg?auto=compress&cs=tinysrgb&w=600"]
                ]
            ],
            [
                "username" => "john_doe",
                "profile_image" => "https://i.pravatar.cc/100?img=12",
                "caption" => "My vacation pics 🌴",
                "time_ago" => "2h ago",
                "media" => [
                    ["type" => "video", "url" => "https://flutter.github.io/assets-for-api-docs/assets/videos/butterfly.mp4"],
                    ["type" => "image", "url" => "https://images.pexels.com/photos/2280549/pexels-photo-2280549.jpeg?auto=compress&cs=tinysrgb&w=600"],
                    ["type" => "image", "url" => "https://images.pexels.com/photos/4021773/pexels-photo-4021773.jpeg?auto=compress&cs=tinysrgb&w=600"]
                ]
            ],
            [
                "username" => "john_doe",
                "profile_image" => "https://i.pravatar.cc/100?img=13",
                "caption" => "My vacation pics 🌴",
                "time_ago" => "2h ago",
                "media" => [
                    ["type" => "image", "url" => "https://images.pexels.com/photos/3965543/pexels-photo-3965543.jpeg?auto=compress&cs=tinysrgb&w=600"],
                    ["type" => "video", "url" => "https://videos.pexels.com/video-files/3195394/3195394-uhd_2560_1440_25fps.mp4"],
                    ["type" => "image", "url" => "https://images.pexels.com/photos/159045/the-interior-of-the-repair-interior-design-159045.jpeg?auto=compress&cs=tinysrgb&w=600"]
                ]
            ],
            [
                "username" => "john_doe",
                "profile_image" => "https://i.pravatar.cc/100?img=13",
                "caption" => "My vacation pics 🌴",
                "time_ago" => "12h ago",
                "media" => [
                    ["type" => "video", "url" => "https://videos.pexels.com/video-files/5538262/5538262-hd_1920_1080_25fps.mp4"],
                    ["type" => "video", "url" => "https://videos.pexels.com/video-files/4124024/4124024-uhd_2732_1440_25fps.mp4"],
                    ["type" => "video", "url" => "https://videos.pexels.com/video-files/5532772/5532772-uhd_2732_1440_25fps.mp4"]
                ]
            ],
        ];

        return $data;
    }
}
