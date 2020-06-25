@extends('layouts.app')
@section('css')
    <style>
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 900px;
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
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#single-sign-in">
                                    Single Sign In
                                </button>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#multiple-sigin">
                                    Multiple Sign In
                                </button>
                                <ul class="pagination pagination-sm float-right">
                                    {{ $attendance->links() }}
                                </ul>
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
                                    <th class="text-center" style="width: 275px">Action</th>
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
                                            <td class="text-center">
                                                @if( $value->status == 1)
                                                    <button onclick="checkOut({{ $value->id }})" class="btn float-left mr-1 btn-sm btn-primary">
                                                        <i class="fas fa-clock"></i> Check Out
                                                    </button>
                                                @else
                                                    <span class="btn float-left mr-1 btn-sm btn-outline-success">Checked Out</span>
                                                @endif
                                                <button onclick="manageAtt({{ $value->id }})" class="btn float-right ml-1 btn-sm btn-info">
                                                    Manage Attendance
                                                </button>
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

    <div class="modal fade" id="single-sign-in">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="post" action="{{ route('attendance.store') }}" id="quickForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Attendance</h4>
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
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="multiple-sigin">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="post" action="{{ route('attendance.multiple.store') }}" id="quickForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Attendance</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table-bordered table">
                            <thead>
                                <td>Name</td>
                                <td>Status</td>
                            </thead>
                            <tbody>
                                @foreach($employees as $value)
                                    <tr>
                                        <td>{{ $value->first_name . " " . $value->last_name }}</td>
                                        <td><input type="checkbox" name="att_status[]" value="{{ $value->id }}"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="single-sign-out">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="post" action="{{ route('attendance.update') }}" id="quickForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Attendance</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="real-time">
                            <input hidden type="text" id="att_id" name="att_id">
                            <div id="time"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm Checkout</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="manage-att">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="post" action="{{ route('attendance.attUpdate') }}" id="quickForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="employee_name"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input hidden type="text" id="att_id2" name="att_id2">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="checkin_time">Checkin Time</label>
                                <div class="input-group date" id="checkin_time" data-target-input="nearest">
                                    <input type="text" id="check_in" class="form-control datetimepicker-input" name="checkin_time" data-target="#checkin_time"/>
                                    <div class="input-group-append" data-target="#form_time" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="checkout_time">Checkout Time</label>
                                <div class="input-group date" id="checkout_time" data-target-input="nearest">
                                    <input type="time" name="checkout_time" class="form-control datetimepicker-input" data-target="#checkout_time"/>
                                    <div class="input-group-append" data-target="#checkout_time" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save change</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section('js')
    <script>
        function checkOut(id){
            $('#single-sign-out').modal('show');
            $('#att_id').val(id)
        }

        function manageAtt(id){
            $('#manage-att').modal('show');
            $('#att_id2').val(id)
            var att_id = id;
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('attendance.edit') ?>",
                method: 'POST',
                data: {att_id:att_id, _token:token},
                success: function(data) {
                    $("#employee_name").text(data.employee.first_name);
                    $("#check_in").val(data.check_in);
                    $("#check_out").val(data.check_out);
                }
            });
        }

        var timeDisplay = document.getElementById("time");


        function refreshTime() {
            var dateString = new Date().toLocaleString("en-US", {timeZone: "Asia/Dhaka"});
            var formattedString = dateString.replace(", ", " - ");
            timeDisplay.innerHTML = formattedString;
        }

        setInterval(refreshTime, 1000);
    </script>
@endsection
