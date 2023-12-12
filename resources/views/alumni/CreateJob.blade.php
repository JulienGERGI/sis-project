@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header" >
                      <h3 class="card-title">Create Job Post</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('createJob') }}">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Title</label>
                          <input type="text" class="form-control" id="titleInput" name="title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Company Name</label>
                            <input type="text" class="form-control" id="companyInput" name="company" placeholder="Enter company name">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Job URL</label>
                            <input type="text" class="form-control" id="urlInput" name="jobUrl" placeholder="Enter job URL">
                          </div>
                          <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" name="description" placeholder="Enter description"></textarea>
                          </div>
                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
