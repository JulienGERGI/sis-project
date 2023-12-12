@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <form action="{{ route('createWebinar') }}" method="get">
                                @csrf
                            <button type="submit" class="btn btn-block btn-primary" >Create Webinar</button>
                            </form>
                        </div>

                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <form action="{{ route('goToCreateJob') }}" method="get">
                            @csrf
                        <button type="submit" class="btn btn-block btn-primary" >Create Job Post</button>
                        </form>
                    </div>

            </div>
                <!-- /.row -->
                <div class="card col-12">
                    <div class="card-header">
                      <h3 class="card-title">My Webinars</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                        <thead>
                        <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Topic</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Start Time</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Duration(hours)</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">password</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Agenda</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"></th>
                        </tr>
                        </thead>
                        <tbody>
                            {{-- @if(isset($webinars)) --}}


                            @foreach($webinars as $webinar)
                            <tr class="odd">
                                <td class="dtr-control sorting_1" tabindex="0">{{ $webinar->topic }}</td>
                                <td>{{  $webinar->startTime}}</td>
                                <td>{{  $webinar->duration}}</td>
                                <td>{{  $webinar->password}}</td>
                                <td>{{  $webinar->agenda}}</td>
                                <td><a href="{{ $webinar->startLink }}" class="button-link">Start</a></td>
                              </tr>
                            @endforeach
                            {{-- @endif --}}


                       </tbody>

                      </table></div></div>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div><!-- /.container-fluid -->


            <div class="card col-12">
                <div class="card-header">
                  <h3 class="card-title">My Job Posts</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                    <thead>
                    <tr>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Title</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Company</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Description</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"></th>
                    </tr>
                    </thead>
                    <tbody>
                        {{-- @if(isset($webinars)) --}}


                        @foreach($jobs as $job)
                        <tr class="odd">
                            <td class="dtr-control sorting_1" tabindex="0">{{ $job->title }}</td>
                            <td>{{  $job->company}}</td>
                            <td>{{  $job->description}}</td>
                            <td><a href="{{ $job->jobUrl }}" class="button-link">Apply</a></td>
                          </tr>
                        @endforeach
                        {{-- @endif --}}


                   </tbody>

                  </table>
                </div></div>
                </div>
                <!-- /.card-body -->
              </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
