<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\PostsCreateRequest;
use Illuminate\Support\Facades\Session;
use App\Photo;
use App\User;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Auth;



class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //

        $input = $request->all();

        if($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('img', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $user = Auth::user();
        $user->posts()->create($input);

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $post = Post::findOrFail($id);
        $input = $request->all();

        if($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();
            $file->move('img', $name);

            if($post->photo){

                $photo = Photo::findOrFail($post->photo->id);
                $photo->update(['file'=>$name]);
                unlink(public_path() . $post->photo->file);
            }
            else {

                $photo = Photo::create(['file'=>$name]);
            }
            $input['photo_id'] = $photo->id;
        }

        Auth::user()->posts()->whereId($id)->first()->update($input);

        Session::flash('status', [
            'class' => 'success',
            'message' => 'Post successfully updated',
        ]);

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $post = Post::findOrFail($id);

        if($post->photo){

            unlink(public_path() . $post->photo->file);
            Photo::findOrFail($post->photo->id)->delete();
        }

        $post->delete();

        Session::flash('status', [
            'class' => 'danger',
            'message' => 'Post successfully deleted',
        ]);

        return redirect(route('posts.index'));
    }

    public function post($id){

        $post =  Post::findOrFail($id);

        return view('post', compact('post'));
    }
}
