@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header" >
                      <h3 class="card-title">Create Webinar</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('createWebinar') }}">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Topic</label>
                          <input type="text" class="form-control" id="topicInput" name="topic" placeholder="Enter topic">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Starting Time</label>
                            <input type="date" class="form-control" id="startTime" name="startTime" placeholder="Enter starting time">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">duration (hours)</label>
                            <input type="number" class="form-control" id="duration" name="duration" placeholder="Enter duration">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                          </div>
                          <div class="form-group">
                            <label>Agenda</label>
                            <textarea class="form-control" rows="3" name="agenda" placeholder="Enter agenda"></textarea>
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
