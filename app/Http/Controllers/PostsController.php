<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Auth;

class PostsController extends Controller
{
    public function register(Request $request){
       $user = User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>bcrypt($request->password)
       ]);
       if($user){
           return response()->json([
               'message'=>'success'
           ]);
       }
       return response()->json([
        'message'=>'error'
    ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    $posts = Post::with(['user'])->take(10)->get();
       $posts = Post::with(['user'])->paginate(5);
       return response()->json($posts);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostsController  $postsController
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with(['user','comments.user'])->find($id);
        return response()->json($post);
    }

    public function storeComment(Request $request ){
        $comment = Comment::create([
            'user_id'=>$request->user_id,
            'post_id'=>$request->post_id,
            'body'=>$request->body
        ]);
        $output = Comment::with(['user'])->find($comment->id);
        return response()->json($output);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostsController  $postsController
     * @return \Illuminate\Http\Response
     */
    public function edit(PostsController $postsController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostsController  $postsController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostsController $postsController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostsController  $postsController
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostsController $postsController)
    {
        //
    }
}
