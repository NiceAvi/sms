  @extends('theme.default')
  @section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Batch List</h1>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  {{-- <h6 class="m-0 font-weight-bold text-primary float-left">batch List</h6> --}}
                  <a class="btn btn-primary btn-sm float-right" href="{{ route('batch.create', []) }}">Add Batch</a>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Subject</th>
                                  <th>Teacher</th>
                                  <th>Student Counts</th>
                                  <th>Date Time</th>
                                  <th>Assign/View</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Subject</th>
                                  <th>Teacher</th>
                                  <th>Student Counts</th>
                                  <th>Date Time</th>
                                  <th>Assign/View</th>
                                  <th width=150>Action</th>
                              </tr>
                          </tfoot>
                          <tbody>
                              @forelse ($batches as $item)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ $item->name }}</td>
                                      <td>{{ $item->subject_name }}</td>
                                      <td>{{ $item->teacher_name }}</td>
                                      <td>{{ $item->student_count }}</td>
                                      <td>{{ date('Y-m-d h:i A', strtotime($item->batch_date_time)) }}</td>
                                      <td><a href="{{ route('batch.assign', ['id' => $item->id]) }}">Students</a></td>
                                      <td>

                                          <form action="{{ route('batch.destroy', $item->id) }}" method="POST">

                                              <a class="btn btn-info btn-sm"
                                                  href="{{ route('batch.edit', $item->id) }}">Edit</a>

                                              @csrf
                                              @method('DELETE')

                                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this batch')">Delete</button>
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
