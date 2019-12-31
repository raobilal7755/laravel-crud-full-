@extends('website.main.master')

@section('title','Edit student')
 
@section('body')
    
<div class="container">
    <a href="{{ route('student.index') }}" class="btn btn-outline-warning btn-lg">Back To Student List</a>
    <br>

    {{-- error bag sms --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- end error sms --}}

        <div class="row">
          <div class="col-lg-6">
            <form action="{{ route('student.update',$student->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="">UserName :</label>
              <input type="text" name="name" id="" class="form-control" placeholder="Enter your name" value="{{$student->name}}" >
              </div>
              <div class="form-group">
                <label for="">Email :</label>
                <input type="text" name="email" id="" class="form-control" placeholder="Enter your email" value="{{$student->email}}" >
              </div>
              <div class="form-group">
                <label for="">Address :</label>
                <input type="text" name="address" id="" class="form-control" placeholder="Enter your Address" value="{{$student->address}}" >     
              </div>
              <div class="form-group">
                <label for="">Upload  Image :</label>
                <input type="file" name="image" id="" class="form-control"  >     
              </div>
              <div class="form-group">
                <input type="hidden" name="my_image" value="{{$student->image}}"  >     
              </div>

              <br>
              <input type="submit" value="Submit Form" class="btn btn-info btn-lg">
      
          </form>
      
          </div>


          <div class="col-lg-6 bg-dark">
            <div class="d-flex justify-content-center">
              <div>
                <h2 class="text-center text-white">Profile Picture</h2>
                <img src="{{ url('upload/',$student->image) }}" alt="" id="editimg" class="rounded">
              </div>
            </div>
          </div>
          
        </div>

    
    
</div>





@endsection