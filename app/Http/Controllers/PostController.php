<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function listPost(Request $request)
    {
        try {

            $posts = Post::with(['user', 'files'])->paginate(10);

            $data = [];
            foreach ($posts as $p) {
                $data[] = array(
                    "post_id" => $p->id,
                    "username" => $p->user->username,
                    "profile_image" => $p->user->profile_path,
                    "caption" => $p->description,
                    "time_ago" => $p->created_time,
                    "media" => $p->files,
                );
            }

            return response()->json([
                "success" => 1,
                'message' => 'Post get successfully',
                'data' => $data,
                "current_page" => $posts->currentPage(),
                "last_page" => $posts->lastPage(),
                "total" => $posts->total(),
                "next_page_url" => $posts->nextPageUrl()
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => 0, "message" => 'Failed to get post']);
        }
    }

    public function createPost(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'description' => 'required|string|max:1000',
                'tags' => 'required',
                'files' => 'array',
                'files.*' => 'file|mimes:jpg,jpeg,png,gif,mp4|max:358400', // 350MB max
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 301);
        }


        DB::beginTransaction();

        try {

            $tags = $request->tags;
            $tags_arr = explode(',', $tags);

            $post = Post::create([
                'description' => $request->description,
                'user_id' => 1,
                'created_by' => 1
            ]);

            $post->tags()->attach($tags_arr);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $extension = strtolower($file->getClientOriginalExtension());

                    $type = '';
                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $type = 'image';
                        $path = $file->store('posts/images', 'public');
                    } elseif (in_array($extension, ['mp4'])) {
                        $type = 'video';
                        $path = $file->store('posts/videos', 'public');
                    }

                    if ($type) {
                        $post->media()->create([
                            'type' => $type,
                            'path' => $path,
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json(['message' => 'Post created successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create post', 'details' => $e->getMessage()], 500);
        }
    }
}
