@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        @include('backend.message')
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Employee list</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li><a class="btn btn-outline-success" href="{{ route('employee.create') }}">Add Employee</a></li>
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
                    <div class="card card-solid">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="row d-flex align-items-stretch pt-3 pl-3">
                                @foreach($employees as $value)
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-header text-muted border-bottom-0">
                                                Digital Strategist
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h2 class="lead">
                                                            <b>{{ $value->first_name }} {{ $value->last_name }}</b></h2>
                                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                                            <li class="small"><span class="fa-li"><i
                                                                        class="fas fa-lg fa-building"></i></span>
                                                                Address: {{ $value->address }}</li>
                                                            <li class="small"><span class="fa-li"><i
                                                                        class="fas fa-lg fa-phone"></i></span> Phone
                                                                #: {{ $value->number_1 }}</li>
                                                            <li class="small"><span class="fa-li"><i
                                                                        class="fas fa-lg fa-phone"></i></span> Emergency
                                                                #: {{ $value->number_2 }}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-5 text-center">
                                                        @if($value->photo)
                                                            <img width="150"
                                                                 src="{{ url('storage/employee/'. $value->photo) }}"
                                                                 alt="{{ $value->first_name }}" class="img-circle img-fluid">
                                                        @else
                                                            <img width="150" src="{{ url('assets/dist/img/user2-160x160.jpg') }}"
                                                                 alt="" class="img-circle img-fluid">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="text-right">
                                                    <a href="{{ route('employee.edit', $value->id) }}" class="btn btn-sm bg-teal">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('employee.delete', $value->id) }}" class="btn btn-sm bg-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-user"></i> View Profile
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
