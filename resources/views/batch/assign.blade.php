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
                  <a class="btn btn-primary btn-sm float-right" href="{{ route('batch.index', []) }}">Back</a>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                          <dl class="row">
                              <dt class="col-sm-2">Batch Name: </dt>
                              <dd class="col-sm-10">{{ $batch->batch_name }}</dd>
                          </dl>
                          <dl class="row">
                              <dt class="col-sm-2">Subject Name: </dt>
                              <dd class="col-sm-10">{{ $batch->subject_name }}</dd>
                          </dl>
                          <dl class="row">
                              <dt class="col-sm-2">Teacher Name: </dt>
                              <dd class="col-sm-10">{{ $batch->teacher_name }}</dd>
                          </dl>
                          <dl class="row">
                              <dt class="col-sm-2">Student Count: </dt>
                              <dd class="col-sm-10">{{ $batch->student_count }}</dd>
                          </dl>
                          <dl class="row">
                              <dt class="col-sm-2">Batch Date Time: </dt>
                              <dd class="col-sm-10">{{ date('Y-m-d h:i A', strtotime($batch->batch_date_time)) }}</dd>
                          </dl>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col md-12">

                          <ul class="nav nav-tabs" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link active" data-toggle="tab" href="#assign">Assign Student</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" data-toggle="tab" href="#un_assign">Assigned Students</a>
                              </li>
                          </ul>

                          <!-- Tab panes -->
                          <div class="tab-content">
                              <div id="assign" class="container tab-pane active"><br>
                                  <form id="assign_student" action="{{ url('batch/assign_add', []) }}" method="POST">
                                      @csrf
                                      {{-- <p><b>Selected rows data:</b></p>
                                        <pre id="example-console-rows"></pre>
                                      
                                        <p><b>Form data as submitted to the server:</b></p>
                                        <pre id="example-console-form"></pre> --}}
                                      <!-- Nav tabs -->
                                      <input type="hidden" name="batch_id" value="{{ $id }}">
                                      <input type="hidden" name="input_method" value="assign">
                                      <button class="btn btn-primary mb-3" type="submit">Assign Student</button>
                                      <div class="table-responsive">
                                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                              <thead>
                                                  <tr>
                                                      <th></th>
                                                      <th>Roll No.</th>
                                                      <th>Name</th>
                                                      <th>Mobile</th>
                                                      <th title="Date of birth">DOB</th>
                                                  </tr>
                                              </thead>
                                              <tfoot>
                                                  <tr>
                                                      <th></th>
                                                      <th>Roll No.</th>
                                                      <th>Name</th>
                                                      <th>Mobile</th>
                                                      <th title="Date of birth">DOB</th>
                                                  </tr>
                                              </tfoot>
                                              <tbody>
                                                  @if (count($students) > 0)
                                                      @forelse ($students as $item)
                                                          <tr>
                                                              <td>{{ $item->id }}</td>
                                                              <td>{{ $item->roll_no }}</td>
                                                              <td>{{ $item->name }}</td>
                                                              <td>{{ $item->mobile }}</td>
                                                              <td>{{ $item->dob }}</td>
                                                          </tr>
                                                      @empty
                                                          <tr>
                                                              <td colspan="3">No Records</td>
                                                          </tr>
                                                      @endforelse
                                                  @endif
                                              </tbody>
                                          </table>
                                      </div>
                                  </form>
                              </div>
                              <div id="un_assign" class="container tab-pane fade"><br>
                                  <form id="un_assign_student" action="{{ url('batch/assign_add', []) }}" method="POST">
                                      @csrf
                                      {{-- <p><b>Selected rows data:</b></p>
                                        <pre id="example-console-rows"></pre>
                                      
                                        <p><b>Form data as submitted to the server:</b></p>
                                        <pre id="example-console-form"></pre> --}}
                                      <!-- Nav tabs -->
                                      <input type="hidden" name="batch_id" value="{{ $id }}">
                                      <input type="hidden" name="input_method" value="delete">
                                      <button class="btn btn-primary mb-3" type="submit">Delete Student</button>
                                      <div class="table-responsive">
                                          <table class="table table-bordered" id="dataTable-two" width="100%"
                                              cellspacing="0">
                                              <thead>
                                                  <tr>
                                                      <th></th>
                                                      <th>Roll No.</th>
                                                      <th>Name</th>
                                                      <th>Mobile</th>
                                                      <th title="Date of birth">DOB</th>
                                                  </tr>
                                              </thead>
                                              <tfoot>
                                                  <tr>
                                                      <th></th>
                                                      <th>Roll No.</th>
                                                      <th>Name</th>
                                                      <th>Mobile</th>
                                                      <th title="Date of birth">DOB</th>
                                                  </tr>
                                              </tfoot>
                                              <tbody>

                                                  @if (count($assigned_students) > 0)
                                                      @forelse ($assigned_students as $i)
                                                          <tr>
                                                              <td>{{ $i->id }}</td>
                                                              <td>{{ $i->roll_no }}</td>
                                                              <td>{{ $i->name }}</td>
                                                              <td>{{ $i->mobile }}</td>
                                                              <td>{{ $i->dob }}</td>
                                                          </tr>
                                                      @empty
                                                          <tr>
                                                              <td colspan="3">No Records</td>
                                                          </tr>
                                                      @endforelse
                                                  @endif

                                              </tbody>
                                          </table>
                                      </div>
                                  </form>
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
  @push('scripts')

      <script>
          $(document).ready(function() {
              var table = $('#dataTable').DataTable({
                  'columnDefs': [{
                      'targets': 0,
                      'checkboxes': {
                          'selectRow': true
                      }
                  }],
                  'select': {
                      'style': 'multi',
                  },
                  'order': [
                      [1, 'asc']
                  ]
              });
              var tableTwo = $('#dataTable-two').DataTable({
                  'columnDefs': [{
                      'targets': 0,
                      'checkboxes': {
                          'selectRow': true
                      }
                  }],
                  'select': {
                      'style': 'multi',
                  },
                  'order': [
                      [1, 'asc']
                  ]
              });
              // Handle form submission event 
              $('#assign_student').on('submit', function(e) {
                  var form = this;

                  var rows_selected = table.column(0).checkboxes.selected();

                  // Iterate over all selected checkboxes
                  $.each(rows_selected, function(index, rowId) {
                      // Create a hidden element 
                      $(form).append(
                          $('<input>')
                          .attr('type', 'hidden')
                          .attr('name', 'assign_student_id[]')
                          .val(rowId)
                      );
                  });

                  // FOR DEMONSTRATION ONLY
                  // The code below is not needed in production

                  var values = $("input[name='assign_student_id[]']")
                      .map(function() {
                          return $(this).val();
                      }).get();
                  if (!values.length > 0) {
                      alert('Please Select Students from Table');
                      e.preventDefault();
                  }

                  // Prevent actual form submission

              });
              // Handle form submission event 
              $('#un_assign_student').on('submit', function(e) {
                  var form = this;

                  var rows_selected = tableTwo.column(0).checkboxes.selected();

                  // Iterate over all selected checkboxes
                  $.each(rows_selected, function(index, rowId) {
                      // Create a hidden element 
                      $(form).append(
                          $('<input>')
                          .attr('type', 'hidden')
                          .attr('name', 'delete_student_id[]')
                          .val(rowId)
                      );
                  });

                  // FOR DEMONSTRATION ONLY
                  // The code below is not needed in production

                  var delete_values = $("input[name='delete_student_id[]']")
                      .map(function() {
                          return $(this).val();
                      }).get();

                  if (!delete_values.length > 0) {
                      alert('Please Select Students from Table');
                      e.preventDefault();
                  }

                  // Prevent actual form submission

              });
          });

      </script>
  @endpush
