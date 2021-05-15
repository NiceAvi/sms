@extends('theme.default')
  @section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Subject List</h1>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  {{-- <h6 class="m-0 font-weight-bold text-primary float-left">subject List</h6> --}}
                  <a class="btn btn-primary btn-sm float-right" href="{{ route('subject.index', []) }}">Back</a>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">
                          @if (Session::has('success'))
                              <div class="alert alert-success">
                                  {{ Session::get('success') }}
                                  @php
                                      Session::forget('success');
                                  @endphp
                              </div>
                          @endif
                          <form action="{{ route('subject.store', []) }}" method="POST">
                              @csrf
                              <div class="form-group row">
                                  <label class="col-2 col-form-label" for="name">Subject Name:</label>
                                  <div class="col-10">
                                      <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control">
                                      @if ($errors->has('name'))
                                          <span class="text-danger">{{ $errors->first('name') }}</span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <div class="offset-2 col-10">
                                      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>

              </div>
          </div>

      </div>
      <!-- /.container-fluid -->
  @endsection