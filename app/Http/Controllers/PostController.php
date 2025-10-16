<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                    ["type" => "video", "url" => asset('/images/videos/post3.mp4')],
                    ["type" => "image", "url" => asset('/images/temp_image/post2.jpeg')],
                    ["type" => "video", "url" => asset('/images/videos/tamil-pasanga.mp4')],
                ]
            ],
            [
                "post_id" => 3,
                "username" => "john_doe",
                "profile_image" => asset('/images/temp_image/profile.jpeg'),
                "caption" => "My vacation pics 🌴",
                "time_ago" => "2h ago",
                "media" => [
                    ["type" => "video", "url" => asset('/images/videos/post3.mp4')],
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
                    ["type" => "video", "url" => asset('/images/videos/tamil-pasanga.mp4')],
                    ["type" => "video", "url" => asset('/images/videos/post2.mp4')],
                    ["type" => "image", "url" => asset('/images/temp_image/post4.jpeg')],
                ]
            ],
        ];

        return $data;
    }

    public function createPost(Request $request)
    {

        // // Step 1: Validate input
        $validated = $request->validate([
            'description' => 'required|string|max:1000',
            'images' => 'array',
            'images.*' => 'file|mimes:jpg,jpeg,png,gif|max:5120', // 5MB max
            'videos' => 'array',
            'videos.*' => 'file|mimes:mp4,mov,avi|max:20480', // 20MB max
        ]);

        DB::beginTransaction();

        try {
            // Step 2: Create the post
            $post = Post::create([
                'description' => $request->description,
            ]);

            // Step 4: Save images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('posts/images', 'public');
                    $post->media()->create([
                        'type' => 'image',
                        'path' => $path,
                    ]);
                }
            }

            // Step 5: Save videos
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $video) {
                    $path = $video->store('posts/videos', 'public');
                    $post->media()->create([
                        'type' => 'video',
                        'path' => $path,
                    ]);
                }
            }

            DB::commit();

            return response()->json(['message' => 'Post created successfully', 'post' => $post], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create post', 'details' => $e->getMessage()], 500);
        }
    }
}
