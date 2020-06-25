@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        @include('backend.message')
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Employee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" method="post" action="{{ route('employee.update', $employee->id) }}" id="quickForm"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Basic Information</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name">First Name <sup class="text-danger">*</sup></label>
                                                    <input value="{{ $employee->first_name }}" type="text" name="first_name" class="form-control"
                                                           id="first_name"
                                                           placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name">Last Name <sup
                                                            class="text-danger">*</sup></label>
                                                    <input value="{{ $employee->last_name }}" type="text" name="last_name" class="form-control"
                                                           id="last_name"
                                                           placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="date_of_birth">Date of Birth <sup
                                                        class="text-danger">*</sup></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                  </span>
                                                    </div>
                                                    <input value="{{ $employee->date_of_birth }}" name="date_of_birth" type="text"
                                                           class="form-control float-right dateTimePicker"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="gender">Gender <sup class="text-danger">*</sup></label>
                                                    <div class="form-group">
                                                        <select name="gender" id="gender" class="form-control select2">
                                                            <option value="">Select option</option>
                                                            <option value="male" {{ $employee->gender == 'male' ? 'selected': '' }}>Male</option>
                                                            <option value="female" {{ $employee->gender == 'female' ? 'selected': '' }}>Female</option>
                                                            <option value="other" {{ $employee->gender == 'other' ? 'selected': '' }}>Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nid">NID <sup class="text-danger">*</sup></label>
                                                    <input value="{{ $employee->nid }}" type="text" name="nid" class="form-control" id="nid"
                                                           placeholder="National Identification Card">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="number_1">Contact Number 1 <sup
                                                            class="text-danger">*</sup></label>
                                                    <input value="{{ $employee->number_1 }}" type="text" name="number_1" class="form-control"
                                                           id="number_1"
                                                           placeholder="Contact Number 1">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="marital_status">Marital Status</label>
                                                    <div class="form-group">
                                                        <select name="marital_status" id="marital_status"
                                                                class="form-control select2">
                                                            <option value="">Select option</option>
                                                            <option value="single" {{ $employee->marital_status == 'single' ? 'selected': '' }}>Single</option>
                                                            <option value="married" {{ $employee->marital_status == 'married' ? 'selected': '' }}>Married</option>
                                                            <option value="divorced" {{ $employee->marital_status == 'divorced' ? 'selected': '' }}>Divorced</option>
                                                            <option value="widowed" {{ $employee->marital_status == 'widowed' ? 'selected': '' }}>Widowed</option>
                                                            <option value="other" {{ $employee->marital_status == 'other' ? 'selected': '' }}>Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="number_2">Contact Number 2</label>
                                                    <input value="{{ $employee->number_2 }}" type="text" name="number_2" class="form-control"
                                                           id="number_2"
                                                           placeholder="Contact Number 2">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="district">District</label>
                                                    <input value="{{ $employee->district }}" type="text" name="district" class="form-control"
                                                           id="district"
                                                           placeholder="District">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="thana">Upzila/Thana</label>
                                                    <input value="{{ $employee->thana }}" type="text" name="thana" class="form-control" id="thana"
                                                           placeholder="Upzila/Thana">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea name="address" id="address" rows="1"
                                                              class="form-control">{{ $employee->address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="photo">Image</label>
                                                    <input name="photo" id="photo" type="file" class="form-control">
                                                </div>
                                                @if($employee->photo)
                                                    <img height="100"
                                                         src="{{ url('storage/employee/'. $employee->photo) }}" alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {

            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-success').addClass('btn-default');
                    $item.addClass('btn-success');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function () {
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                    if (!curInputs[i].validity.valid) {
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-success').trigger('click');
        });
        var loadFile = function (event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
