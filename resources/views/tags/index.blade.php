@extends('layouts.app')
@section('content')

        <div class="clearfix">
        <a href="{{route('tags.create')}}" class="btn btn-success float-right">Add tags</a>
        </div>
        <div class="card card-default">
            <div class="card-header">All Tags</div>
              <div class="card-body">
        
              <table class="table"> 
                  <tbody>
                  @foreach($tags as $tag)
                        <tr>
                            <td>
                            {{$tag->name}}  <span class="badge badge-primary ml-2">{{$tag->posts->count()}}</span>
                            </td>
                
                          <td>
                          <form class="float-right ml-2" action="{{route('tags.destroy',$tag->id)}} " method ="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                          </form>
                          <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-primary btn-sm float-right">edit</a>
                          </td>

                        </tr>
                     @endforeach
                  </tbody>
              </table>
             </div>    
        </div>
@endsection