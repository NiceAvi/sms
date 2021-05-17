 @extends('theme.default')
 @section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- Page Heading -->
         <h1 class="h3 mb-2 text-gray-800">Teacher List</h1>


         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3">
                 {{-- <h6 class="m-0 font-weight-bold text-primary float-left">Student List</h6> --}}
                 <a class="btn btn-primary btn-sm float-right" href="{{ route('teacher.index', []) }}">Back</a>
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
                         <form action="{{ route('teacher.update', [$teacher->id]) }}" method="POST">
                             @csrf
                             @method('PUT')
                             <div class="form-group row">
                                 <label class="col-2 col-form-label" for="name">Full Name:</label>
                                 <div class="col-10">
                                     <input id="name" name="name" type="text"
                                         value="{{ $teacher->name ? $teacher->name : old('name') }}" class="form-control">
                                     @if ($errors->has('name'))
                                         <span class="text-danger">{{ $errors->first('name') }}</span>
                                     @endif
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="dob" class="col-2 col-form-label">Date of birth:</label>
                                 <div class="col-10">
                                     <input id="dob" name="dob" type="date"
                                         value="{{ $teacher->dob ? $teacher->dob : old('dob') }}" class="form-control">
                                     @if ($errors->has('dob'))
                                         <span class="text-danger">{{ $errors->first('dob') }}</span>
                                     @endif
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="join_date" class="col-2 col-form-label">Join Date:</label>
                                 <div class="col-10">
                                     <input id="join_date" name="join_date" type="date"
                                         value="{{ $teacher->join_date ? $teacher->join_date : old('join_date') }}"
                                         class="form-control">
                                     @if ($errors->has('join_date'))
                                         <span class="text-danger">{{ $errors->first('join_date') }}</span>
                                     @endif
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="mobile" class="col-2 col-form-label">Mobile No.:</label>
                                 <div class="col-10">
                                     <input id="mobile" name="mobile" maxlength="10" type="text"
                                         value="{{ $teacher->mobile ? $teacher->mobile : old('mobile') }}"
                                         class="form-control">
                                     @if ($errors->has('mobile'))
                                         <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                     @endif
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label class="col-2 col-form-label" for="address">Address:</label>
                                 <div class="col-10">
                                     <input id="address" name="address" type="text"
                                         value="{{ $teacher->address ? $teacher->address : old('address') }}"
                                         class="form-control">
                                     @if ($errors->has('address'))
                                         <span class="text-danger">{{ $errors->first('address') }}</span>
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
