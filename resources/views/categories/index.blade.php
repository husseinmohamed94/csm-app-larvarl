@extends('layouts.app')
@section('content')

        <div class="clearfix">
        <a href="{{route('categories.create')}}" class="btn btn-success float-right">Add category</a>
        </div>
        <div class="card card-default">
            <div class="card-header">All categories</div>
              <div class="card-body">
        
              <table class="table"> 
                  <tbody>
                  @foreach($categories as $category)
                        <tr>
                            <td>
                            {{$category->name}}
                            </td>
                
                          <td>
                          <form class="float-right ml-2" action="{{route('categories.destroy',$category->id)}} " method ="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                          </form>
                          <a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary btn-sm float-right">edit</a>
                          </td>

                        </tr>
                     @endforeach
                  </tbody>
              </table>
             </div>    
        </div>
@endsection