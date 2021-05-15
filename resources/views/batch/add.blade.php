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
                    <div class="col-md-6">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                                @php
                                    Session::forget('success');
                                @endphp
                            </div>
                        @endif
                        <form action="{{ route('batch.store', []) }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="name">Batch Name:</label>
                                <div class="col-10">
                                    <input id="name" name="name" type="text" value="{{ old('name') }}"
                                        class="form-control">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subject_id" class="col-2 col-form-label">Subject:</label>
                                <div class="col-10">
                                    <select id="subject_id" name="subject_id" class="custom-select">
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('subject_id'))
                                        <span class="text-danger">{{ $errors->first('subject_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="teacher_id" class="col-2 col-form-label">Teacher</label>
                                <div class="col-10">
                                    <select id="teacher_id" name="teacher_id" class="custom-select">
                                        <option value="rabbit">Select Teacher</option>
                                        @foreach ($teachers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('teacher_id'))
                                        <span class="text-danger">{{ $errors->first('teacher_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="batch_date">Batch Date:</label>
                                <div class="col-10">
                                    <input id="batch_date" name="batch_date" type="date" value="{{ old('batch_date') }}"
                                        class="form-control">
                                    @if ($errors->has('batch_date'))
                                        <span class="text-danger">{{ $errors->first('batch_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="time">Batch Time:</label>
                                <div class="col-10">
                                    <input id="time" name="time" type="time" value="{{ old('time') }}"
                                        class="form-control">
                                    @if ($errors->has('time'))
                                        <span class="text-danger">{{ $errors->first('time') }}</span>
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
        <!-- /.container-fluid -->
    @endsection
