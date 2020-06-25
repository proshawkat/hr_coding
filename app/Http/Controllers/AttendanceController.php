<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendance = Attendance::orderBy('att_date', 'DESC')->paginate();
        $employees = Employee::get();
        return view('backend/attendance/form', compact('attendance', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id'                => 'required',
        ], [], [
            'employee_id' => 'employee name'
        ]);

        $atten = new Attendance();
        $atten->employee_id         = $request->employee_id;
        $atten->att_date            = Carbon::today()->toDateString();
        $atten->check_in            = Carbon::now()->toDateTimeString();
        $atten->status              = 1;

        if($atten->save()){
            return redirect()->back()->with([
                'status'    => 'success',
                'message'      => 'Attendance has been successfully added'
            ]);
        }
        //
        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Something wrong!'
        ]);
    }

    public function multipleStore(Request $request)
    {
        foreach ($request->att_status as $value){
            $atten = new Attendance();
            $atten->employee_id = $value;
            $atten->att_date = Carbon::today()->toDateString();
            $atten->check_in = Carbon::now()->toDateTimeString();
            $atten->status = 1;
            $atten->save();
        }
        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Attendance has been successfully added'
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $att = Attendance::with('employee')->where('id', $request->att_id)->first();
        return response()->json($att);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->att_id;

        $atten = Attendance::find($id);

        $atten->check_out           = Carbon::now()->toDateTimeString();
        $atten->status              = 0;

        if($atten->update()){
            return redirect()->back()->with([
                'status'    => 'success',
                'message'      => 'Attendance has been successfully updated'
            ]);
        }
        //
        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Something wrong!'
        ]);
    }

    public function attUpdate(Request $request)
    {
        $id = $request->att_id2;

        $atten = Attendance::find($id);

        $atten->check_in           = $request->checkin_time;
        $atten->check_out          = $request->checkout_time;

        if($atten->update()){
            return redirect()->back()->with([
                'status'    => 'success',
                'message'      => 'Attendance has been successfully updated'
            ]);
        }
        //
        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Something wrong!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function attendanceReport(){
        $attendance = Attendance::orderBy('att_date', 'DESC')->paginate();
        $employees = Employee::get();
        return view('backend/attendance/report', compact( 'attendance', 'employees'));
    }

    public function attendanceReportReq(Request $request){
        $data['title'] = 'Attendance report';

        $from = Carbon::parse($request->from)->format('Y-m-d');
        $to = Carbon::parse($request->to)->format('Y-m-d');

        if($request->employee_id){
            $attendance = Attendance::where('employee_id', $request->employee_id)
                ->where('att_date', '>=', $from)
                ->where('att_date', '<=', $to)->get();
        }else{
            $attendance = Attendance::where('att_date', '>=', $from)
                ->where('att_date', '<=', $to)->get();
        }
        $employees = Employee::get();
        return view('backend/attendance/report', compact('data', 'attendance', 'employees'));
    }
}
