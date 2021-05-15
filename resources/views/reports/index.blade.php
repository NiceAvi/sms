  @extends('theme.default')
  @section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Reports</h1>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  {{-- <h6 class="m-0 font-weight-bold text-primary float-left">Student List</h6> --}}
                  {{-- <a class="btn btn-primary btn-sm float-right" href="{{ route('teacher.create', []) }}">Add Teacher</a> --}}
              </div>
              <div class="card-body">
                  <form class="form-inline" action="{{ route('reports', []) }}" method="POST">
                      @csrf
                      <label for="email" class="mr-sm-2">Batch Name:</label>
                      <select name="batch_id" id="batch_id" class="form-control mb-2 mr-sm-2 col-sm-3" required>
                          <option value="">Select batch</option>
                          @foreach ($batches as $item)
                              <option value="{{ $item->id }}" {{ $batch_id == $item->id ? 'selected' : '' }}>
                                  {{ $item->name }}</option>
                          @endforeach
                      </select>
                      <button type="submit" class="btn btn-primary mb-2">Submit</button>
                  </form>
                  <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#students_by_batch">Students by batch</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#teacher_students_report_by_batch">Teacher - Students
                              report by batch</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#weekly_batch_report">Weekly batch report</a>
                      </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                      <div id="students_by_batch" class="tab-pane active"><br>

                          <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable-student" width="100%" cellspacing="0">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Roll No.</th>
                                          <th>Name</th>
                                          <th>Mobile</th>
                                          <th title="Date of birth">DOB</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                          <th>#</th>
                                          <th>Roll No.</th>
                                          <th>Name</th>
                                          <th>Mobile</th>
                                          <th title="Date of birth">DOB</th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                                      @if ($assigned_students)
                                          @foreach ($assigned_students as $item)
                                              <tr>
                                                  <td>{{ $loop->iteration }}</td>
                                                  <td>{{ $item->roll_no }}</td>
                                                  <td>{{ $item->name }}</td>
                                                  <td>{{ $item->mobile }}</td>
                                                  <td>{{ $item->dob }}</td>
                                              </tr>
                                          @endforeach
                                      @endif
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <div id="teacher_students_report_by_batch" class="tab-pane fade"><br>
                          <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable-student-teacher" width="100%"
                                  cellspacing="0">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Roll No.</th>
                                          <th>Student Name</th>
                                          <th>Teacher Name</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                          <th>#</th>
                                          <th>Roll No.</th>
                                          <th>Student Name</th>
                                          <th>Teacher Name</th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                                      @if ($assigned_students_teachers)
                                          @foreach ($assigned_students_teachers as $item)
                                              <tr>
                                                  <td>{{ $loop->iteration }}</td>
                                                  <td>{{ $item->student_roll_no }}</td>
                                                  <td>{{ $item->student_name }}</td>
                                                  <td>{{ $item->teacher_name }}</td>
                                              </tr>
                                          @endforeach
                                      @endif
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <div id="weekly_batch_report" class="tab-pane fade"><br>
                          <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable-batch-week" width="100%" cellspacing="0">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Batch Name</th>
                                          <th>Batch Date</th>
                                          <th>Roll No.</th>
                                          <th>Student Name</th>
                                          <th>Student Mobile</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                          <th>#</th>
                                          <th>Batch Name</th>
                                          <th>Batch Date</th>
                                          <th>Roll No.</th>
                                          <th>Student Name</th>
                                          <th>Student Mobile</th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                                      @if ($week_report)
                                          @foreach ($week_report as $item)
                                              <tr>
                                                  <td>{{ $loop->iteration }}</td>
                                                  <td>{{ $item->batch_name }}</td>
                                                  <td>{{ $item->batch_date }}</td>
                                                  <td>{{ $item->student_roll_no }}</td>
                                                  <td>{{ $item->student_name }}</td>
                                                  <td>{{ $item->student_mobile }}</td>
                                              </tr>
                                          @endforeach
                                      @endif
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>


      <!-- /.container-fluid -->
  @endsection
  @push('scripts')
      <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
      <script>
          $(document).ready(function() {
              $('#dataTable-student').DataTable({
                  dom: 'Bfrtip',
                  buttons: [{
                          extend: 'excelHtml5',
                          title: 'Students by batch Report'
                      },
                      {
                          extend: 'pdfHtml5',
                          title: 'Students by batch Report'
                      }
                  ]
              });
              $('#dataTable-student-teacher').DataTable({
                  dom: 'Bfrtip',
                  buttons: [{
                          extend: 'excelHtml5',
                          title: 'Students and Teachers by batch Report'
                      },
                      {
                          extend: 'pdfHtml5',
                          title: 'Students and Teachers by batch Report'
                      }
                  ]
              });
              $('#dataTable-batch-week').DataTable({
                  dom: 'Bfrtip',
                  buttons: [{
                          extend: 'excelHtml5',
                          title: 'Weekly Batch Report'
                      },
                      {
                          extend: 'pdfHtml5',
                          title: 'Weekly Batch Report'
                      }
                  ]
              });
          });

      </script>
  @endpush
