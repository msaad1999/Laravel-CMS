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
use Intervention\Image\ImageManagerStatic as Image;
use \DOMDocument;



class PostsController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('monitor')->only('index', 'show');
        $this->middleware('moderator')->only('edit', 'update', 'create', 'store', 'delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = Post::all();

        return view('posts.index', compact('posts'));
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

        return view('posts.create', compact('categories'));
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

        // Post Image
        if($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('img', $name);

            $photo = Photo::create([
                'file' => $name,
                'type' => 'post_image',
                ]);

            $input['photo_id'] = $photo->id;
        }

        // Post Content Images
        // Post Content Images
        $dom = new DomDocument();
		$dom->loadHtml($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

		foreach($images as $img){
			$src = $img->getAttribute('src');

			if(preg_match('/data:image/', $src)){

				preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];

				$filename = uniqid();
				$filepath = "/img/$filename.$mimetype";

				$image = Image::make($src)
				  ->encode($mimetype, 100)
				  ->save(public_path($filepath));

				$new_src = asset($filepath);
				$img->removeAttribute('src');
                $img->setAttribute('src', $new_src);

                Photo::create([
                    'file'=>$filename.'.'.$mimetype,
                    'type'=>'post_content_media'
                    ]);
			}
		}

        $input['body'] = $dom->saveHTML();

        $user = Auth::user();
        $post = $user->posts()->create($input);
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post =  Post::whereSlug($slug)->firstOrFail();

        return view('posts.show', compact('post'));
    }

    public function blogHome(){

        $posts = Post::paginate(3);
        return view('posts.blog-home', compact('posts'));
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

        return view('posts.edit', compact('post', 'categories'));
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

        // Post Image
        if($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();
            $file->move('img', $name);

            if($post->photo){

                $photo = Photo::findOrFail($post->photo->id);
                $photo->update(['file'=>$name]);
                unlink(public_path() . $post->photo->file);
            }
            else {

                $photo = Photo::create([
                    'file'=>$name,
                    'type'=>'post_image'
                    ]);
            }
            $input['photo_id'] = $photo->id;
        }

        // Post Content Images
        $dom = new DomDocument();
		$dom->loadHtml($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

		foreach($images as $img){
			$src = $img->getAttribute('src');

			if(preg_match('/data:image/', $src)){

				preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];

				$filename = uniqid();
				$filepath = "/img/$filename.$mimetype";

				$image = Image::make($src)
				  ->encode($mimetype, 100)
				  ->save(public_path($filepath));

				$new_src = asset($filepath);
				$img->removeAttribute('src');
                $img->setAttribute('src', $new_src);

                Photo::create([
                    'file'=>$filename.'.'.$mimetype,
                    'type'=>'post_content_media',
                    ]);
			}
		}

		$input['body'] = $dom->saveHTML();

        // Post Updation
        Post::whereId($id)->first()->update($input);

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
}
