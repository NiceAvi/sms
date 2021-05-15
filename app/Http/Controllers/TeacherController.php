<?php

namespace App\Http\Controllers;

use App\teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teacher = teacher::all();
        return view('teacher.index', compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('teacher.add');
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
            'join_date' => 'required|date|',
            'name' => 'required|string',
            'address' => 'required|string',
            'mobile' => 'required|digits:10',
            'dob' => 'required|date'
        ]);

        $input = $request->all();
        $user = teacher::create($input);
        return back()->with('success', 'Teacher created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(teacher $teacher)
    {
        //
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, teacher $teacher)
    {
        //
        $request->validate([
            'join_date' => 'required|date|',
            'name' => 'required|string',
            'address' => 'required|string',
            'mobile' => 'required|digits:10',
            'dob' => 'required|date'
        ]);
        $input = $request->all();
        $user = $teacher->update($input);
        return redirect()->route('teacher.index')->with('success', 'Teacher Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(teacher $teacher)
    {
        //
        $is_teacher = DB::table('batches')->where('teacher_id', $teacher->id)->first();
        if ($is_teacher != null) {
            return redirect()->route('teacher.index')
                ->with('error', 'Teacher not deleted. because teacher assigned to batch.');
        }
        $teacher->delete();

        return redirect()->route('teacher.index')
            ->with('success', 'Teacher deleted successfully');
    }
}
