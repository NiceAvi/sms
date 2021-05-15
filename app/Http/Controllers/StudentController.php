<?php

namespace App\Http\Controllers;

use App\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = student::all();
        return view('student.index', compact('students'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        $students = student::select('roll_no', 'name', 'mobile', 'dob')->get();
        return $students;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('student.add');
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
            'roll_no' => 'required|numeric|gt:0',
            'name' => 'required|string',
            'address' => 'required|string',
            'mobile' => 'required|digits:10',
            'dob' => 'required|date'
        ]);

        $input = $request->all();
        $user = student::create($input);
        return back()->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        //
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {
        //
        $request->validate([
            'roll_no' => 'required|numeric|gt:0',
            'name' => 'required|string',
            'address' => 'required|string',
            'mobile' => 'required|digits:10',
            'dob' => 'required|date'
        ]);
        $input = $request->all();
        $user = $student->update($input);
        return redirect()->route('student.index')->with('success', 'Student Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $student)
    {
        //
        $is_student = DB::table('table_batch_student')->where('student_id', $student->id)->first();
        if ($is_student != null) {
            return redirect()->route('student.index')
                ->with('error', 'Student not deleted. because student assigned to batch.');
        }
        $student->delete();

        return redirect()->route('student.index')
            ->with('success', 'Student deleted successfully');
    }
}
