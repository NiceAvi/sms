<?php

namespace App\Http\Controllers;

use App\batch;
use App\student;
use App\subject;
use App\teacher;
use App\batch_student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $batches = batch::select('batches.id as id', 'batches.name as name', 'subjects.name as subject_name', 'teachers.name as teacher_name', DB::raw('count(table_batch_student.student_id)"student_count"'), DB::raw("CONCAT(batches.batch_date,' ', batches.time)'batch_date_time'"))
            ->join('subjects', 'subjects.id', 'batches.subject_id')
            ->join('teachers', 'teachers.id', 'batches.teacher_id')
            ->leftJoin('table_batch_student', 'table_batch_student.batch_id', 'batches.id')
            ->groupBy('batches.id', 'batches.name', 'subjects.name', 'teachers.name', 'batches.batch_date', 'batches.time')
            ->get();
        // dd($batches);
        return view('batch.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $subjects = subject::all();
        $teachers = teacher::all();
        $students = student::all();
        return view('batch.add', compact('subjects', 'teachers', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assign($id)
    {
        //
        $batch = batch::select('batches.id as id', 'batches.name as batch_name', 'subjects.name as subject_name', 'teachers.name as teacher_name', DB::raw('count(table_batch_student.student_id)"student_count"'), DB::raw("CONCAT(batches.batch_date,' ', batches.time)'batch_date_time'"))
            ->join('subjects', 'subjects.id', 'batches.subject_id')
            ->join('teachers', 'teachers.id', 'batches.teacher_id')
            ->leftJoin('table_batch_student', 'table_batch_student.batch_id', 'batches.id')
            ->where('batches.id', $id)
            ->groupBy('batches.id', 'batches.name', 'subjects.name', 'teachers.name', 'batches.batch_date', 'batches.time')
            ->first();

        // $students = DB::select("SELECT * FROM students WHERE id NOT IN( SELECT student_id FROM table_batch_student WHERE batch_id = $id)");
        $students = DB::table('students')
            ->whereNotIn('id', function ($query) use ($id) {
                $query->from('table_batch_student')
                    ->where('batch_id', $id)
                    ->select('student_id');
            })
            ->get();

        $assigned_students = student::select('students.id', 'students.roll_no', 'students.name', 'students.mobile', 'students.dob')
            ->leftJoin('table_batch_student', 'table_batch_student.student_id', 'students.id')
            ->where('table_batch_student.batch_id', $id)
            ->get();
        // dd($batch,$students,$assigned_students);
        return view('batch.assign', compact('students', 'id', 'assigned_students', 'batch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_assign(Request $request)
    {
        //
        // dd($request);
        // $request->validate([
        //     'batch_id' => 'required',
        //     'student_id' => 'required',
        // ]);
        if ($request->input_method == 'assign') {
            foreach ($request->assign_student_id as $key => $value) {
                $batch_table = new batch_student();
                $batch_table->batch_id = $request->batch_id;
                $batch_table->student_id = $value;
                $batch_table->save();
            }
        }

        if ($request->input_method == 'delete') {
            foreach ($request->delete_student_id as $key => $value) {
                $is_delete = DB::table("table_batch_student")
                    ->where('student_id', $value)
                    ->where('batch_id', $request->batch_id)
                    ->delete();
            }

            // dd($is_delete);
        }


        return back()->with('success', 'Batch created successfully.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'subject_id' => 'required|string',
            'teacher_id' => 'required|numeric',
            'batch_date' => 'required|date',
            'time' => 'required'
        ]);
        $input = $request->all();
        $user = batch::create($input);
        return back()->with('success', 'Batch created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show(batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(batch $batch)
    {
        //
        $subjects = subject::all();
        $teachers = teacher::all();
        return view('batch.edit', compact('batch', 'subjects', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, batch $batch)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'subject_id' => 'required|string',
            'teacher_id' => 'required|numeric',
            'batch_date' => 'required|date',
            'time' => 'required'
        ]);
        $input = $request->all();
        $user = $batch->update($input);
        return redirect()->route('batch.index')->with('success', 'Batch Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(batch $batch)
    {
        //
        $batch->delete();
        return redirect()->route('batch.index')
            ->with('success', 'Batch deleted successfully');
    }


    public function reports(Request $request)
    {
        $assigned_students = null;
        $assigned_students_teachers = null;
        $week_report = null;
        $batch_id = $request->batch_id ? $request->batch_id : 0;
        if ($batch_id != null) {
            $assigned_students = student::select('students.id', 'students.roll_no', 'students.name', 'students.mobile', 'students.dob')
                ->leftJoin('table_batch_student', 'table_batch_student.student_id', 'students.id')
                ->where('table_batch_student.batch_id', $batch_id)
                ->get();

            $assigned_students_teachers = DB::select("SELECT s.name AS student_name, s.roll_no AS student_roll_no, t.name AS teacher_name FROM students s INNER JOIN table_batch_student bs ON bs.student_id = s.id INNER JOIN batches b ON b.id = bs.batch_id INNER JOIN teachers t ON t.id = b.teacher_id WHERE b.id = $batch_id ");
        }
        $week_report = DB::select("SELECT b.name AS batch_name, b.batch_date AS batch_date, s.roll_no AS student_roll_no, s.name AS student_name, s.mobile AS student_mobile FROM students s INNER JOIN table_batch_student bs ON bs.student_id = s.id INNER JOIN batches b ON b.id = bs.batch_id WHERE WEEK(b.batch_date) = WEEK(NOW()) ORDER BY b.name");
        $batches = batch::select('id', 'name')->get();
        return view('reports.index', compact('batches', 'assigned_students', 'assigned_students_teachers', 'week_report', 'batch_id'));
    }

    public function student_by_batch($batch_id)
    {
        $assigned_students = student::select('students.id', 'students.roll_no', 'students.name', 'students.mobile', 'students.dob')
            ->leftJoin('table_batch_student', 'table_batch_student.student_id', 'students.id')
            ->where('table_batch_student.batch_id', $batch_id)
            ->get();
    }
}
