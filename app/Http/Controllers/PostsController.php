<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;
use File;

class PostsController extends Controller
{
    protected function validator(Request $request)
    {
        /*dicustom*/
        return Validator::make($request->all(), [
          'title' => 'required',
          'content' => 'required'
  ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::select('id', 'title', 'date_posted')->orderBy('date_posted', 'desc')->get();

        return view('backEnd.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if ($this->validator($request)->fails()) {
            return redirect()->back()
                    ->withErrors($this->validator($request))
                    ->withInput();
        }

        $request['header'] = substr(strip_tags($request->content), 0, 154);

        $model = Post::create($request->all());

        if ($request->image) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $newFilename = $model->id.'.'.pathinfo($filename, PATHINFO_EXTENSION);
            $destinationPath = 'images/posts/'.$model->id.'/';
            $model->update(['thumbnail'=>$destinationPath.$newFilename]);
            $upload_success = $image->move($destinationPath, $newFilename);
        }
        // $attributes = $model->getOriginal();
        //
        // activity()->performedOn($model)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Post '.$model->name.' is created successfully');

        Session::flash('alert-success', 'Post '.$model->name.' is created successfully');

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('backEnd.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('backEnd.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        if ($this->validator($request)->fails()) {
            return redirect()->back()
                    ->withErrors($this->validator($request))
                    ->withInput();
        }

        $request['header'] = substr(strip_tags($request->content), 0, 154);
        $post = Post::findOrFail($id);
        $post->update($request->all());

        if ($request->image) {
            if ($post->thumbnail) {
                File::delete($post->thumbnail);
            }
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $newFilename = $post->id.'.'.pathinfo($filename, PATHINFO_EXTENSION);
            $destinationPath = 'images/posts/'.$post->id.'/';
            $post->update(['thumbnail'=>$destinationPath.$newFilename]);
            $upload_success = $image->move($destinationPath, $newFilename);
        }

        // $attributes = $post->getOriginal();
        //
        // activity()->performedOn($post)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Post '.$post->name.' is updated successfully');

        Session::flash('alert-success', ' Post '.$post->name.' is updated successfully');

        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        // $attributes = $post->getOriginal();

        // activity()->performedOn($post)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Post '.$post->name.' is deleted successfully');

        Session::flash('alert-warnig', ' Post '.$post->name.' is deleted successfully');

        return redirect('posts');
    }
}
