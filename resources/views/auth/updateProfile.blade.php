@extends('layouts.app')
@section('content')
<div class="content-wrapper">
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">update your profile</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="PUT" action="{{ route('updateProfile') }}">
        @csrf
      <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control"  placeholder="Enter name" value="{{ $user[0]['name'] }}">
          </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{ $user[0]['email'] }}" disabled>
        </div>

        {{-- <div class="form-group">
          <label for="exampleInputFile">File input</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="exampleInputFile">
              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
              <span class="input-group-text">Upload</span>
            </div>
          </div>
        </div> --}}

      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>

@endsection
