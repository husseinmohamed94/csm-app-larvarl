@extends('layouts.app')

@section('content')
@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

<div class="card card-default">
            <div class="card-header"> {{isset($post) ? 'Update post ' :  'Add a new post'}}</div>
              <div class="card-body">
                <form action="{{isset($post) ? route('posts.update',$post->id) : route('posts.store') }}"method="POSt" enctype="multipart/form-data">
                        @csrf
                        @if(isset($post))
                        @method('PUt')
                        @endif
                    
                    <div class="form-group">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <label for="post title">Title:</label>
                        <input type="text" name="title" class="form-control"
                        placeholder="Add a new post" value="{{isset($post) ? $post->title   :  '' }}">
                    </div>
                    <div class="form-group">
                        <label for="post description"> Decription :</label>
                        <textarea name="description" class="form-control" rows="2"  placeholder="Add a  description" > {{isset($post) ?  $post->description :  ''}} </textarea>
                       
                    </div>

                    <div class="form-group">
                        <label for="post content">content :</label>
                        
                       <!-- <textarea name="content" class="form-control" rows="3"  placeholder="Add a  content"></textarea>
                      -->
                        <input id="x" type="hidden" name="content" value="{{isset($post) ?  $post->content :  ''}}"> 
                        <trix-editor input ="x"></trix-editor>
                    </div>
                    @if(isset($post))
                    <div class="form-group">
                    <img src="{{asset('storage/'. $post->image)}}" style="with:100% height:40% " alt=""/>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="postimage">Image :</label>
                        <input type="file" name="image" class="form-control"
                        value="">
                    </div>

                    <div class="form-group">
                        <label for="selectcatgory"> select a catgory </label>
                        <select name="categoryID" class="form-control" id="selectcatgory">
            
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" 
                       
                        >{{$category->name}}</option>
                        @endforeach
                        </select>
                    </div>

                    @if($tags->count() > 0)
                        <div class="form-group">
                            <label for="selectTag"> select at Tag </label>
                            <select name="tags[]" class="form-control tags" id="selectTag " multiple > 
                           
                            @foreach($tags as $tag)
                           
                            <option value="{{$tag->id}}"
                            @if(isset($post))
                            @if($post->hasTag($tag->id))
                            selected
                           @endif
                           @endif
                            >{{$tag->name}}</option>
                          
                            @endforeach
                         

                            </select>
                        </div>  
                    @endif

                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> 

                    <div class="form-group">
                    <button type="submit" class="btn btn-success">{{isset($post) ? 'update post ' :  'Add post'}}</button>
                    </div> 

                </form>
                    
             </div>
        </div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.tags').select2();
});
</script>
@endsection