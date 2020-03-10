<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Department;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {


    }

    public function isRole(){
        $r=Cache::get('role');
        if ((int)$r ==3)
        {
            return true;
        }
        else
            return false;
    }

    public function index()
    {
        if (!$this->isRole())
            return redirect()->back();
        $students=Student::all();
        return view('students.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->isRole())
            return redirect()->back();
        $depts=Department::all();
        return view('students.create',compact('depts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();
        //dd($request->all());
       $dep=Department::where('dept',$request->dept)
        ->where('sem',$request->sem)
        ->where('sec',$request->sec)
       ->select(['id'])
           ->get()[0]->id;
       $stud=$request->all();
       $stud['department_id']=$dep;
       Student::create($stud);
       return redirect()->route('students.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$this->isRole())
            return redirect()->back();
        $student=Student::find($id);
       // dd($student->department);
        $depts=Department::all();
        return view('students.edit',compact('depts','student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        if (!$this->isRole())
            return redirect()->back();
        $dep=Department::where('dept',$request->dept)
            ->where('sem',$request->sem)
            ->where('sec',$request->sec)
            ->select(['id'])
            ->get()[0]->id;
        $stud=$request->all();
        $stud['department_id']=$dep;
        $student->update($stud);
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
