<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use Image;

class PostController extends Controller
{
    public function create(Request $request) {
        $title = $request->title;
        $file = $request->file('image');
        $fileName = $title.'-'.now().'.'.$file->extension();

        try {
            $img = Image::make($file);
            $img->fit(400, 400);
            $img->save(public_path('dist/img/'.$fileName));
    
            $post = new Post;
            $post->title = $title;
            $post->image = $fileName;
            $post->user_id = $request->user()->id;
            $saved = $post->save();

            return json_encode([
                'status' => 'success',
                'post' => $post
            ]);
        } catch (\Throwable $th) {
            return json([
                'status' => 'fail',
                'message' => $th
            ]);
        }
    }
    
    public function all(Request $request) {
        $posts = Post::all();
        $user = $request->user();
        $posts = $posts->map(function($post) use ($user) {
            $id = $post->id;
            $post['liked'] = $user->whereHas('likes', function($q) use ($id) {
                $q->where('posts.id', $id);
            })->count() > 0;

            return $post;
        });
        
        return json_encode([
            'status' => 'success',
            'posts' => $posts
        ]);
    }

    public function addLike(Request $request, $post_id) {
        try {
            $user = $request->user();
            $user->likes()->attach($post_id);
            $user->save();

            return json_encode([
                'status' => 'success',
                'message' => 'This post has been successfully liked'
            ]);
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'fail',
                'message' => 'Cannot like this post'
            ]);
        }
    }

    public function rmvLike(Request $request, $post_id) {
        try {
            $user = $request->user();
            $user->likes()->detach($post_id);
            $user->save();

            return json_encode([
                'status' => 'success',
                'message' => 'This post has been successfully unliked'
            ]);
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'fail',
                'message' => 'Cannot unlike this post'
            ]);
        }
    }
}
