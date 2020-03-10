<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\_Class;
use App\Department;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    $events=\App\Event::all();
    return view('welcome',compact('events'));
});


Route::get('/test', function () {
    $students=DB::select('select s.id,s.name,s.usn,m.mark from students s,marks m,subjects sub where s.id=m.student_id and sub.id=m.subject_id and sub.id=? and s.department_id=? and m.ia=?',[1,1,1]);
    dd($students)  ;
});

Route::get('/login', function () {

    return view('login');

})->name('login');

Route::post('/logincheck','HomeController@login')->name('logincheck');
Route::group(['prefix' =>'admin','middleware'=>'auth'],function (){
    Route::get('/home','HomeController@index')->name('home');
    Route::resource('/students','StudentController');
    Route::resource('/attendances','AttendanceController');
    Route::get('/getdept','MarkController@getdept')->name('getdept');
    Route::get('/getsem','MarkController@getsem')->name('getsem');
    Route::get('/getsec','MarkController@getsec')->name('getsec');
    Route::get('/getsubject','MarkController@getsuject')->name('getsubject');
    Route::get('/getalldept','DepartmentController@getalldept')->name('getalldept');
    Route::get('/getallsem','DepartmentController@getallsem')->name('getallsem');
    Route::get('/getallsec','DepartmentController@getallsec')->name('getallsec');
    Route::get('/getattendances','AttendanceController@getattendances')->name('getattend');
    Route::get('/putattendances','AttendanceController@putattendances')->name('putattend');
    Route::get('/getmarks','MarkController@getmarks')->name('getmarks');
    Route::get('/putmarks','MarkController@putmarks')->name('putmarks');
    Route::get('/showclass','DepartmentController@showclass')->name('showclass');
    Route::resource('/marks','MarkController');
    Route::resource('/events','EventController');
    Route::resource('/departments','DepartmentController');
    Route::post('/addclass','DepartmentController@addclass')->name('addclass');
    Route::post('/editclass','DepartmentController@editclass')->name('editclass');
    Route::resource('/staffs','StaffController');
    Route::get('/deletedepts','DepartmentController@deletedepts')->name('deletedepts');
    Route::get('/deletestaff','StaffController@deletestaff')->name('deletestaff');
    Route::get('/getstaff','StaffController@getstaff')->name('getstaff');
    Route::get('/getsubject','SubjectController@getsubject')->name('getsubject');
});





