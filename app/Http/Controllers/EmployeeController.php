<?php

namespace App\Http\Controllers;

use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/employee/add_employee');
    }

    public function employeeInsert(Request $request){
//        dd($request->all());
        $request->validate([
            'first_name'                => 'required',
            'last_name'                 => 'required',
            'number_1'                  => 'required',
            'date_of_birth'             => 'required',
            'gender'                    => 'required',
            'nid'                       => 'required',
        ]);

        $requestAll = $request->all();
        $requestAll['date_of_birth'] = Carbon::parse($request->date_of_birth);

        if ($request->has('photo')) {
            $image      = $request->file('photo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/employee', $fileName);
            $requestAll['photo']                       = $fileName;
        }

//        dd($requestAll);
        $employee = Employee::create($requestAll);

        if(!empty($employee)){
            return redirect()->back()->with([
                'status'    => 'success',
                'message'      => 'Employee has been successfully added'
            ]);
        }
//
        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Something wrong!'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageEmployee(){
        $employees = Employee::get();
//        dd($employees);
        return view('backend/employee/manage_employee', compact('employees'));
    }

    public function delete($id)
    {
        Employee::where('id',$id)->delete();
        return redirect()->route('employee.show')
            ->with('success','Employee deleted successfully');
    }


    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('backend/employee/edit_employee')->with(['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $request->validate([
            'first_name'                => 'required',
            'last_name'                 => 'required',
            'number_1'                  => 'required',
            'date_of_birth'             => 'required',
            'gender'                    => 'required',
            'nid'                       => 'required',
        ]);

        $requestAll = $request->all();
        $requestAll['date_of_birth'] = Carbon::parse($request->date_of_birth);

        if ($request->has('photo')) {
            $image      = $request->file('photo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/employee', $fileName);
            $requestAll['photo']                       = $fileName;
        }
        $employee->fill($requestAll)->save();

        if(!empty($employee)){
            return redirect()->back()->with([
                'status'    => 'success',
                'message'      => 'Employee has been successfully added'
            ]);
        }
    }
}
