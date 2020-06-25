@extends('layouts.app')
@section('css')
    <style>
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px;
                margin: 1.75rem auto;
            }
        }

        .real-time{
            width: 200px;
            margin: auto;
        }
        .real-time #time{
            text-align: center;
            font-size: 20px;
            background: #ccc;
            padding: 1rem .5rem;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Role list</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Attendance Form</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#date-wise-report">
                            Date Wise Report
                        </button>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#report-by-id">
                            Employee Wise Report
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>ID</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Stay</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attendance as $value)
                            <tr>
                                <td>{{ $value->employee->first_name ." ". $value->employee->first_name }}</td>
                                <td>{{ $value->employee->id }}</td>
                                <td>{{ $value->check_in }}</td>
                                <td>{{ $value->check_out }}</td>
                                <td>
                                    @if( $value->check_out != null)
                                        {{ date("H:i:s", ( strtotime($value->check_out) - strtotime($value->check_in) )) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- /.card-body -->
            </div>
        </div>
    </div>
        </section>
    </div>

    <div class="modal fade" id="date-wise-report">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="post" action="{{ route('attendance.attendanceReportReq') }}" id="quickForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Date Wise Report</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="from">From<sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                  </span>
                                </div>
                                <input id="from" name="from" type="text" class="form-control float-right dateTimePicker" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="to">To<sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                  </span>
                                </div>
                                <input id="to" name="to" type="text" class="form-control float-right dateTimePicker" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Request</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="report-by-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="post" action="{{ route('attendance.attendanceReportReq') }}" id="quickForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Employee Wise Report</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="total_set">Employee Name<sup class="text-danger">*</sup></label>
                            <select name="employee_id" id=""  class="form-control">
                                <option value="">Select Option</option>
                                @foreach($employees as $value)
                                    <option value="{{ $value->id }}">{{ $value->first_name . " " . $value->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="from">From<sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                  </span>
                                </div>
                                <input id="from" name="from" type="text" class="form-control float-right dateTimePicker" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="to">To<sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                  </span>
                                </div>
                                <input id="to" name="to" type="text" class="form-control float-right dateTimePicker" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Request</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

