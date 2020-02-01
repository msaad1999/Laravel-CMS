<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;

class AdminMediaController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('monitor')->only('index');
        $this->middleware('moderator')->except('view');
    }

    public function index(){

        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function create(){

        return view('admin.media.create');
    }

    public function store(Request $request){

        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move('img', $name);
        Photo::create([
            'file'=>$name,
            ]);
    }

    public function destroy($id){

        $photo = Photo::findOrFail($id);
        unlink(public_path().$photo->file);
        $photo->delete();
        return redirect(route('media.index'));
    }

    public function destroyMany(Request $request){

        if(isset($request->delete)){

            // $this->destroy($request->photo_id);
            return $request->photo_id;
            return redirect(route('media.index'));
        }
        elseif (isset($request->deleteMany) && !empty($request->checkBoxArray)) {

            $photos = Photo::findOrFail($request->checkBoxArray);
            foreach($photos as $photo){

                unlink(public_path().$photo->file);
                $photo->delete();
            }
            return redirect(route('media.index'));
        }
        else {
            return redirect(route('media.index'));
        }
    }
}
