@extends('layouts.app')
@section('content')
   
       
        <div class="card card-default">
            <div class="card-header">All Users</div>
            @if($users->count() > 0)
              <div class="card-body">
              <table class="table"> 
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>username</th>
                    <th>permissions</th>
                  </tr>
                </thead>
                  <tbody>
                  @foreach($users as $user)
                        <tr>
                            <td>
                         <!-- <img src=" {{asset('storage/'.$user->image)}}" alt="" width="80px" height="50px"> -->
                        
                         <img src="{{ $user->hasPicture() ? asset('storage/'.$user->getPicture()) : $user->getGravatar() }}" alt="" style="border-radius:50%" width="60px" height="50px">
                            </td>
                            <td>
                            {{$user->name}}
                            </td>
                            <td>
                            @if(!$user->isAdmin())
                         <form action="{{route('users.make-admin',$user->id)}}" method="post">
                         @csrf  
                         <button class="btn btn-success" type="submit">Make admin</button>
                         </form>
                            @else
                            {{$user->role}}
                            @endif
                            </td>
                        

                        </tr>
                     @endforeach
                  </tbody>
              </table>
              @else
              <div class="card-body">
              <h1 class="text-center"> No Users Yet.</h1>
              </div>
              @endif
             </div>    
        </div>
@endsection