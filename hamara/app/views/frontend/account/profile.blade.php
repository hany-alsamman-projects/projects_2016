@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
<i class="fa fa-user"></i> Edit Account
@stop

{{-- Account page content --}}
@section('account-content')

<!-- check for login error flash var -->
@if (Session::has('success'))
<div class="panel-body">
    <div class="alert alert-success">
        <strong>{{ Session::get('success') }}</strong>
    </div>
</div>
@endif

<div class="row-fluid">
<div class="span8 grider">
<form id="accounForm" class="form-horizontal form-condensed" enctype="multipart/form-data"  method="post">

<input type="hidden" name="_token" value="{{ csrf_token() }}" />

<div class="row-fluid">
    <div class="span12 well well-small well-impressed">
        <button type="submit" class="btn btn-primary">Save Changes</button>

        <a class="btn btn-default" href="{{ URL::to("account") }}">Cancel</a>
        <!--
        <button class="btn btn-default">Cancel</button>
        -->
    </div>
</div>

<div class="row-fluid">
<div class="tab-master col-md-12">
<div class="tabbable tabbable-bordered tabbable-nice tabs-top">
<ul class="nav nav-tabs padding-side">
    <li  class="active"><a href="#TabBoxTop2" data-toggle="tab">Account Information</a></li>
    <li><a href="#TabBoxTop3" data-toggle="tab">Car Details</a></li>
    <li><a href="#TabBoxTop4" data-toggle="tab">Dependents and Pets</a></li>
</ul>
<div class="tab-content col-md-8 overflow" id="equalizeContent">

<div class="tab-pane  active fade in equalize" id="TabBoxTop2">
    <fieldset>
        <ul class="form-list form-condensed _list-bordered dotted">
            <li class="form-group">
                <h4>Resident Information</h4>
            </li>
            <!-- // section form divider -->

            <li class="form-group">
                <label for="accountPrefix" class="control-label">Full Name</label>
                <div class="controls">
                    <input id="accountPrefix" class="form-control" type="text" value="{{ $user->first_name }}" name="first_name">
                </div>
            </li>

            <li class="form-group">
                <label for="departments" class="control-label">Unit </label>

                <div class="controls controls-row">
                    <input id="departments" class="form-control margin-right5" type="text" value="{{ $user->data->unit }}" name="unit"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="form-group">
                <label for="departmentsJob" class="control-label">Date of Birth </label>

                <div class="controls controls-row">
                    <input class="form-control margin-right5 maskDate" type="text" value="{{ $user->data->date_birth }}" name="date_birth"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="form-group">
                <label for="departmentsAddressStreet" class="control-label">Address </label>

                <div class="controls controls-row">
                    <textarea class="form-control auto" name="address">{{ $user->data->address }}</textarea>
                </div>
            </li>
            <!-- // form item -->

            <li class="form-group">
                <label for="accountAddressStreet" class="control-label">Nationality</label>

                <div class="controls controls-row">
                    <input id="accountAddressStreet" class="form-control margin-right5" type="text" value="{{ $user->data->nationality }}" name="nationality"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="form-group">
                <label for="accountAddressCity" class="control-label">Work Telephone</label>

                <div class="controls">
                    <input class="form-control maskPhoneInt" type="text" value="{{ $user->data->work_tel }}" name="work_tel"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="form-group">
                <label for="accountAddressCity" class="control-label">Mobile phone</label>

                <div class="controls">
                    <input class="form-control maskPhoneInt" type="text" value="{{ $user->data->mobile_tel }}" name="mobile_tel"/>
                </div>
            </li>
            <!-- // form item -->


            <li class="form-group">
                <label for="accountAddressCity" class="control-label">Fax</label>

                <div class="controls">
                    <input class="form-control" type="text" value="{{ $user->data->fax }}" name="fax"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="form-group">
                <label for="accountPrefix" class="control-label">Is your family living in KSA?</label>
                <div class="controls">
                    <label class="radio inline">
                        {{ Form::radio('living', '1', ($user->data->living) ? true : false, array('class'=>'radio')) }}
                        yes </label>
                    <label class="radio inline">
                        {{ Form::radio('living', '0', ($user->data->living != 1) ? true : false, array('class'=>'radio')) }}
                        no </label>
                </div>
            </li>

            <li class="form-group">
                <label for="accountAddressState" class="control-label">Marital Status</label>

                <div class="controls">
                    {{ Form::select('marital', array('0' => 'Single', '1' => 'Married'), $user->data->marital, array('class' => 'selectpicker form-control')) }}
                    <span class="help-inline help-icon" rel="popover-info" data-content="when you select single as your marital status you not need to fill spouse fields" data-class="popover-bordered">
                    <i class="booico-help"></i></span>
                </div>
            </li>
            <!-- // form item -->

            <li class="form-group">
                <label for="accountAddressCity" class="control-label">Spouse Full Name</label>

                <div class="controls">
                    <input class="form-control" type="text" value="{{ $user->data->spouse_name }}" name="spouse_name"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="form-group">
                <label for="accountAddressCity" class="control-label">Spouse Birth Date</label>

                <div class="controls">
                    <input class="form-control maskDate" type="text" value="{{ $user->data->spouse_birth }}" name="spouse_birth"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="form-group">
                <label for="accountAddressCity" class="control-label">Iqama / Passport No.</label>

                <div class="controls">
                    <input class="form-control maskAcid" type="text" value="{{ $user->data->iqama_pass }}" name="iqama_pass"/>
                </div>
            </li>
            <!-- // form item -->

        </ul>
    </fieldset>
</div>
<!-- // tab 2 -->

<div class="tab-pane fade in equalize" id="TabBoxTop3">
    <ul class="form-list form-condensed _list-bordered dotted">
        <li class="form-group">
            <h4>CAR DETAILS MUST BE COMPLETED</h4>
        </li>
        <!-- // section form divider -->

        <li class="form-group">
            <label for="accountAddressStreet" class="control-label">Plate No</label>

            <div class="controls controls-row">
                <input class="form-control margin-right5" type="text" value="{{ $user->cars->plate_no }}" name="plate_no"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Color</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->cars->color }}" name="color"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Make</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->cars->make }}" name="make"/>
            </div>
        </li>
        <!-- // form item -->


        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Year</label>

            <div class="controls">
                <input class="form-control maskYear" type="text" value="{{ $user->cars->year }}" name="year"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="form-group">
            <h4>Driver & Maid Details</h4>
        </li>
        <!-- // section form divider -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Name</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->cars->driver_name }}" name="driver_name"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Nationality</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->cars->driver_nat }}" name="driver_nat"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Iqama Copy</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->cars->iqama_copy }}" name="iqama_copy"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Attach Photo</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->cars->driver_photo }}" name="driver_photo"/>
            </div>
        </li>
        <!-- // form item -->

    </ul></div>
<!-- // tab 3 -->

<div class="tab-pane fade in equalize" id="TabBoxTop4">

    <div style="padding: 15px">
        <h4>Dependents</h4>
        <p class="help-block">you want to add one more dependents? <strong>Contact us</strong></p>
    </div>

    @foreach( $user->dependents as $dependent)
    <ul id="dependents" class="form-list form-condensed _list-bordered dotted">

        <li class="form-group">
            <label for="accountAddressStreet" class="control-label">Full Name</label>

            <div class="controls controls-row">
                <input class="form-control margin-right5" type="text" value="{{ $dependent->full_name }}" name="full_name[]"/>
            </div>
        </li>

        <li class="form-group">
            <label for="accountPrefix" class="control-label">Gender</label>
            <div class="controls">
                {{ Form::select('gender[]', array('boy' => 'boy', 'girl' => 'girl'), $dependent->gender, array('class' => 'form-control')) }}
            </div>
        </li>

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Date of Birth</label>

            <div class="controls">
                <input class="form-control maskDate" type="text" value="{{ $dependent->dep_date_birth }}" name="dep_date_birth[]"/>
            </div>
        </li>

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">School</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $dependent->school }}" name="school[]"/>
            </div>
        </li>

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Iqama / Passport No.</label>

            <div class="controls">
                <input class="form-control maskAcid" type="text" value="{{ $dependent->passport_no }}" name="passport_no[]"/>
            </div>
        </li>

        <li><hr/></li>
    </ul>
    @endforeach

    <ul class="form-list form-condensed _list-bordered dotted">

        <li class="form-group">
            <h4>Pets Info:</h4>
        </li>
        <!-- // section form divider -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Cats</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->pets->cats }}" name="cats"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Dogs</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->pets->dogs }}" name="dogs"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Other</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->pets->info_other }}" name="info_other"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="form-group">
            <h4>Pets Details:</h4>
        </li>
        <!-- // section form divider -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Inoculation Certificate</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->pets->certificate }}" name="certificate"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Collar & Tag</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->pets->collar }}" name="collar"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="form-group">
            <label for="accountAddressCity" class="control-label">Other</label>

            <div class="controls">
                <input class="form-control" type="text" value="{{ $user->pets->details_other }}" name="details_other"/>
            </div>
        </li>
        <!-- // form item -->

    </ul></div>
<!-- // tab 4 -->

</div>
<!-- // Tab content -->
</div>
<!-- // Tabs TOP in BOX -->
</div>
</div>
</form>

</div>
</div>

@stop
