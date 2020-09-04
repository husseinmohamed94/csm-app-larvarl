@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row text-center">
               <div class="col-md-4">
                  <div class="card text-white bg-info">
                        <div class="card-header"> Userrs</div>
                        <div class="card-body">{{$Users_count}}</div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card text-white bg-danger">
                        <div class="card-header"> Posts</div>
                        <div class="card-body">{{$posts_count}}</div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card text-white bg-success">
                        <div class="card-header"> Categories</div>
                        <div class="card-body">{{$category_count}}</div>
                  </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
