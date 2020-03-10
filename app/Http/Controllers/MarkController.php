<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Department;
use App\Mark;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function isRole(){
        $r=Cache::get('role');
        if ((int)$r ==2)
        {
            return true;
        }
        else
            return false;
    }

    public function getdept()
    {
        if (!$this->isRole())
            return redirect()->back();
        $staff_id=Session::get('id')   ;
        $dept=DB::select('select distinct d.dept from departments d,classes c where c.staff_id=? and d.id=c.department_id',[$staff_id]);
        return json_encode($dept);
    }

    public function getsem(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();
        $dept=Department::where('dept',$request->dept)->select('id')->get();
        $staff_id=Session::get('id')   ;
        $d= _Class::where('staff_id',$staff_id)->whereIn('department_id',$dept)->select('department_id')->get();
        $sem=Department::whereIn('id',$d)->select('sem')->distinct()->get();
        return json_encode($sem);

    }
    public function getsec(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();
        $dept=Department::where('dept',$request->dept)->where('sem',$request->sem)->select('id')->get();
        $staff_id=Session::get('id')   ;
        $d=_Class::where('staff_id',$staff_id)->whereIn('department_id',$dept)->select('department_id')->get();
        $sec=Department::whereIn('id',$d)->select('sec')->distinct()->get();
        return json_encode($sec);

    }

    public function getsubject(Request $request){
        if (!$this->isRole())
            return redirect()->back();
        $dept=Department::where('dept',$request->dept)->where('sem',$request->sem)->select('id')->get();
        $staff_id=Session::get('id')   ;
        $d=_Class::where('staff_id',$staff_id)->whereIn('department_id',$dept)->select('subject_id')->get();
        $subject=Subject::whereIn('id',$d)->select('subname')->distinct()->get();
        return json_encode($subject);
    }

    public function index()
    {
        if (!$this->isRole())
            return redirect()->back();
        $depts=Department::all();
        $students=Student::all();
        return view('marks.index',compact('depts','students'));
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
        $students=Student::all();
        return view('marks.create',compact('depts','students'));
    }

    public function putmarks(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();
        $subject_id=Subject::where('subname',$request->subname)->get()[0]->id;
        \session(['subject_id'=>$subject_id]);
        $dept=Department::where('dept',$request->dept)->where('sem',$request->sem)->where('sec',$request->sec)->select('id')->get()[0]->id;
        \session(['internal'=>$request->internal]);
        $students=Student::where('department_id',$dept)->get();
        return json_encode($students);
    }

    public function getmarks(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();
        $staff_id=Session::get('id')   ;
        $subject_id=Subject::where('subname',$request->subname)->get()[0]->id;
        $department_id=Department::where('dept',$request->dept)->where('sem',$request->sem)->where('sec',$request->sec)->select('id')->get()[0]->id;
        $internal=(int)($request->internal);
        $students=DB::select('select s.id,s.name,s.usn,m.mark from students s,marks m,subjects sub where s.id=m.student_id and sub.id=m.subject_id and sub.id=? and s.department_id=? and m.ia=?',[1,1,1]);
//        if (count($students))
//            return json_encode($students);
//        else
//            return -1;
        return json_encode($students);
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
        $internal=\session('internal');
        $subject_id=\session('subject_id');
        $marks=$request->all();
        unset($marks['_token']);
        $m['subject_id']=$subject_id;
        $m['ia']=$internal;
        foreach ($marks as $key=>$val){
            $m['student_id']=$key;
            $m['mark']=$val;
            Mark::create($m);
        }
        return redirect()->route('marks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        //
    }
}
