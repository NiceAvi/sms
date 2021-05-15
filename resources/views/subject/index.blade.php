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
                  <a class="btn btn-primary btn-sm float-right" href="{{ route('subject.create', []) }}">Add Subject</a>
              </div>
              <div class="card-body">
                  @if (Session::has('success'))
                      <div class="alert alert-success">
                          {{ Session::get('success') }}
                          @php
                              Session::forget('success');
                          @endphp
                      </div>
                  @endif
                  @if (Session::has('error'))
                      <div class="alert alert-danger">
                          {{ Session::get('error') }}
                          @php
                              Session::forget('error');
                          @endphp
                      </div>
                  @endif
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th width=150>Action</th>
                              </tr>
                          </tfoot>
                          <tbody>
                              @forelse ($subjects as $item)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ $item->name }}</td>
                                      <td>

                                          <form action="{{ route('subject.destroy', $item->id) }}" method="POST">

                                              <a class="btn btn-info btn-sm"
                                                  href="{{ route('subject.edit', $item->id) }}">Edit</a>

                                              @csrf
                                              @method('DELETE')

                                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subject')">Delete</button>
                                          </form>
                                      </td>
                                  </tr>
                              @empty
                                  <tr>
                                      <td colspan="3">No Records</td>
                                  </tr>
                              @endforelse
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>

      </div>
      <!-- /.container-fluid -->
  @endsection
