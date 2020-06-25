<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin', 'middleware' => ['auth']], function() {
    // Role
    Route::get('/role_list','RoleController@index')->name('roles.index');
    Route::get('/roles/add_role','RoleController@create')->name('roles.add');
    Route::get('/roles/destroy/{id}','RoleController@destroy')->name('roles.destroy');
    Route::get('/roles/edit/{id}','RoleController@edit')->name('roles.edit');
    Route::post('/roles/store','RoleController@store')->name('roles.store');
    Route::post('/roles/update/{id}','RoleController@update')->name('roles.update');

    //    Employee
    Route::get('/add_employee','EmployeeController@create')->name('employee.create');
    Route::post('/employee_insert','EmployeeController@employeeInsert')->name('employee.store');
    Route::get('/manage_employee','EmployeeController@manageEmployee')->name('employee.show');
    Route::get('/employe/delete/{id}','EmployeeController@delete')->name('employee.delete');
    Route::get('/employee/edit/{id}','EmployeeController@edit')->name('employee.edit');
    Route::post('/employee/update/{id}','EmployeeController@update')->name('employee.update');

    //    Attendance
    Route::get('/attendance_form','AttendanceController@index')->name('attendance.index');
    Route::post('/atten_insert','AttendanceController@store')->name('attendance.store');
    Route::post('/multiple/store','AttendanceController@multipleStore')->name('attendance.multiple.store');
    Route::post('/atten_update','AttendanceController@update')->name('attendance.update');
    Route::post('/att/edit','AttendanceController@edit')->name('attendance.edit');
    Route::post('/atten_edit','AttendanceController@attUpdate')->name('attendance.attUpdate');
    Route::get('/attendance_report','AttendanceController@attendanceReport')->name('attendance.attendanceReport');
    Route::post('/attendance_report_req','AttendanceController@attendanceReportReq')->name('attendance.attendanceReportReq');

});

