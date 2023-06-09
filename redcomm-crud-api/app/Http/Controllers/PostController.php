<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $search = $request->get('q');
            
            $post = Post::where(function ($query) use ($term) {
                            $query->where('title', "like", "%" . $search . "%");
                            $query->orWhere('description', "like", "%" . $search . "%");
                        })
                        ->orderBy('id','DESC')
                        ->get();
            
            return response()->json([
                "status" => 201,
                "message" => "Post Berhasil Ditampilkan",
                "data" => $post
            ]);

        }catch(\Exception $e){

            return response()->json([
                "status" => 400,
                 "message" => 'Error'.$e->getMessage(),
                "data" => null
            ]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $post = new Post;

            $post->uuid = Str::uuid()->toString();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->save();


            return response()->json([
                "status" => 201,
                "message" => "Post Berhasil Ditambahkan",
                "data" => $post
            ]);

        }catch(\Exception $e){

            return response()->json([
                "status" => 400,
                 "message" => 'Error'.$e->getMessage(),
                "data" => null
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        try {
            $post = Post::where('uuid',$uuid)
                        ->first();
            
            return response()->json([
                "status" => 201,
                "message" => "Post Berhasil Ditampilkan",
                "data" => $post
            ]);

        }catch(\Exception $e){

            return response()->json([
                "status" => 400,
                 "message" => 'Error'.$e->getMessage(),
                "data" => null
            ]);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        try{

            $post = Post::where('uuid',$uuid)->first();

            $post->uuid = Str::uuid()->toString();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->save();

            return response()->json([
                "status" => 201,
                "message" => "Post Berhasil Diupdate",
                "data" => $post
            ]);

        }catch(\Exception $e){

            return response()->json([
                "status" => 400,
                 "message" => 'Error'.$e->getMessage(),
                "data" => null
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        try{

            $post = Post::where('uuid',$uuid)->first();
            $post->delete();

            DB::statement("SET @count = 0;");
            DB::statement("UPDATE `posts` SET `posts`.`id` = @count:= @count + 1;");
            DB::statement("ALTER TABLE `posts` AUTO_INCREMENT = 1;");

            return response()->json([
                "status" => 201,
                "message" => "Post Berhasil Dihapus",
                "data" => $post
            ]);

        }catch(\Exception $e){

            return response()->json([
                "status" => 400,
                 "message" => 'Error'.$e->getMessage(),
                "data" => null
            ]);

        }
    }
}
