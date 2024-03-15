@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
           <div class="row">
               <div class="col-6 mb-3 mt-3">
                   <label for="name" class="form-label">Name:</label>
                   <input type="text"
                          class="form-control @if($errors->has('name')) is-invalid @endif"
                          id="name"
                          placeholder="Enter name" name="name" value="{{ old('name') }}">
                   @error('name')
                   <div class="invalid-feedback">
                       {{$message}}
                   </div>
                   @enderror
               </div>

               <div class="col-6 mb-3 mt-3">
                   <label for="email" class="form-label">Email:</label>
                   <input type="email"
                          class="form-control @if($errors->has('email')) is-invalid @endif"
                          id="email"
                          placeholder="Enter email" value="{{ old('email') }}" name="email">
                   @error('email')
                   <div class="invalid-feedback">
                       {{$message}}
                   </div>
                   @enderror
               </div>

               <div class="col-6 mb-3">
                   <label for="password" class="form-label">Password:</label>
                   <input type="password"
                          class="form-control @if($errors->has('password')) is-invalid @endif"
                          id="password"
                          placeholder="Enter password" name="password">
                   @error('password')
                   <div class="invalid-feedback">
                       {{$message}}
                   </div>
                   @enderror
               </div>
               <div class="col-6 mb-3">
                   <label for="group" class="form-label">Group:</label>
                   <select
                       class="form-control @if($errors->has('group_id')) is-invalid @endif"
                       id="group" name="group_id">
                       <option value="0">Chọn nhóm</option>
                       <option value="1">Group 1</option>
                       <option value="2">Group 2</option>
                       <option value="3">Group 3</option>
                       <option value="4">Group 4</option>
                   </select>
                   @error('group_id')
                   <div class="invalid-feedback">
                       {{$message}}
                   </div>
                   @enderror
               </div>
           </div>



            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-dark">Quay lại</a>
        </form>
    </div>
@endsection
