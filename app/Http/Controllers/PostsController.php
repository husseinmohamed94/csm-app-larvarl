<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use App\category;
use App\Tag;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct(){
        $this->middleware('checkcategory')->only('create'); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        
    $post =  post::create([
          'title'           => $request->title,
          'description'     => $request->description,
          'content'         => $request->content,
          'image'           => $request->image->store('images','public'),
          'category_id'     => $request->categoryID,
          'user_id'         => $request->user_id
      ]);
        if($request->tags){
            $post->tags()->attach($request->tags); 

        }
      
      session()->flash('success','post created successfuly');
      return redirect(route('posts.index'));
    }
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
      $user =$post->user;
      $profile = $user->profile;
     return view('posts.show')->with('post',$post)->with('categories',category::all())
     ->with('profile',$profile)->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        return view('posts.create',['post'=>$post,'categories'=>category::all(),'tags'=>Tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request , post $post)
    {

        
        $date = $request->only(['title','description','content','category_id']);
        if($request->hasFile('image')){
            $image = $request->image->store('images','public');
            Storage::disk('public')->delete($post->image);
            $date['image'] = $image;

        }
          if($request->tags){
            $post->tags()->sync($request->tags);

          }  
        
        $post->update($date);
        session()->flash('success','post updated successfuly');
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
      /*  $post->delete();
        session()->flash('success','post trashed successfuly');
        return redirect(route('posts.index'));*/
      $post = post::withTrashed()->where('id',$id)->first();
      if($post->trashed()){
        Storage::disk('public')->delete('$post->image'); 
          $post->forceDelete();
          session()->flash('success','post   Deletesuccessfuly');
      }else{
          $post->delete();
          session()->flash('success','post trashed  successfuly');
       }
       
       return redirect(route('posts.index'));

    }

    public function trashed(){
        $trashed = post::onlyTrashed()->get();
        return view('posts.index')->withPosts($trashed);
    }
    public function restore($id){
        post::withTrashed()->where('id',$id)->restore();
        session()->flash('success','post restored  successfuly');
         return redirect(route('posts.index'));
    }
}
