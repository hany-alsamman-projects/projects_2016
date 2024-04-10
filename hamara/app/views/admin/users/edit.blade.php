<div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
<div class="page-header">
    <h3><i class="aweso-icon-list-alt opaci35"></i> Edit Account</h3>
</div>
<div class="row-fluid">
<div class="span8 grider">
<form id="accounForm" class="form-horizontal form-condensed" enctype="multipart/form-data"  method="post" action="{{URL::to("admin/users/$user->id/edit")}}">

<div class="row-fluid">
    <!--
    <div class="span9">
        <div class="control-group no-margin-bottom">
            <label class="control-label label-left">
                <img src="Content/img/demo/demo-avatar9604.jpg" class="thumbnail" width="96" height="96">
            </label>

            <div class="controls">
                <address>
                    <h2>Michael Berger</h2>
                    <strong>Development manager</strong> at <strong><a href="#">ShopGate Inc.</a></strong><br>
                    <abbr title="Work email">e-mail:</abbr>
                    <a href="mailto:#">michael.berger@shopgate.com</a><br>
                    <abbr title="Work Phone">phone:</abbr>
                    (123) 456-7890
                </address>
            </div>
        </div>
    </div>
    -->
    <div class="span12 well well-small well-impressed">
        <button type="submit" class="btn btn-blue">Save Account</button>
        <button class="btn cancel">Cancel</button>
    </div>
</div>

<div class="row-fluid">
<div class="form-dark">
<div class="tabbable tabbable-bordered tabbable-nice tabs-top">
<ul class="nav nav-tabs padding-side">
    <li class="active"><a href="#TabBoxTop1" data-toggle="tab">Account</a></li>
    <li><a href="#TabBoxTop2" data-toggle="tab">Information</a></li>
    <li><a href="#TabBoxTop3" data-toggle="tab">Car Details</a></li>
    <li><a href="#TabBoxTop4" data-toggle="tab">Dependents and Pets</a></li>
</ul>
<div class="tab-content padding20 overflow" id="equalizeContent">
<div class="tab-pane active fade in equalize" id="TabBoxTop1">
    <fieldset>
        <ul class="form-list form-condensed list-bordered dotted">
            <li class="section-form">
                <h4>Account Data</h4>
            </li>
            <!-- // section form divider -->

            <li class="control-group">
                <label for="accountPrefix" class="control-label">Full Name</label>
                <div class="controls">
                    <input id="accountPrefix" class="span6" type="text" value="{{ $user->first_name }}" name="first_name">
                </div>
            </li>

            <li class="control-group">
                <label for="accountPrefix" class="control-label">Email</label>
                <div class="controls">
                    <input id="accountPrefix" class="span6" type="text" value="{{ $user->email }}" name="email">
                    <span class="help-inline help-icon" rel="popover-info" data-content="this field use as account login" data-class="popover-bordered">
                    <i class="booico-help"></i></span>
                </div>
            </li>

            <li class="control-group">
                <label for="accountPrefix" class="control-label">Password</label>
                <div class="controls">
                    <input id="accountPrefix" class="span6 " type="text" value="" name="password">
                </div>
            </li>

            <li class="control-group">
                <label for="accountPrefix" class="control-label">Password confirmation</label>
                <div class="controls">
                    <input id="accountPrefix" class="span6 " type="text" value="" name="password_confirmation">
                </div>
            </li>

            <li class="control-group">
                <label for="accountPrefix" class="control-label">Active Status</label>
                <div class="controls">
                    <label class="radio inline">
                        {{ Form::radio('activated', '1', ($user->activated == 1) ? true : false, array('class'=>'radio')) }}
                        Activate </label>
                    <label class="radio inline">
                        {{ Form::radio('activated', '0', ($user->activated != 1) ? true : false, array('class'=>'radio')) }}
                        Wait Approval </label>
                </div>
            </li>

            <!-- // drop down -->
            <li class="control-group">
                <label for="accountAddressState" class="control-label">Groups <span class="required">*</span></label>
                <div class="controls">
                    {{ Form::select('group_id', $groups, $user_group, array('class' => 'selectpicker')) }}
                </div>
            </li>

            <li class="control-group">
                <label for="accountAddressState" class="control-label">Upload Photo</label>

                <div class="controls">
                    <div class="well well-nice">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-append">
                                <div class="uneditable-input span3"><i
                                        class="fontello-icon-doc-2 fileupload-exists"></i> <span
                                        class="fileupload-preview"></span></div>
                                <span class="btn btn-file"><span class="fileupload-new">Select file</span>
                                <span class="fileupload-exists">Change</span>
                                <input name="upload_photo" type="file"/>
                                </span> <a href="#" class="btn fileupload-exists"
                                           data-dismiss="fileupload">Remove</a></div>
                        </div>
                    </div>
                </div>
            </li>
            <!-- // form item -->

        </ul>
    </fieldset>
</div>
<!-- // tab 1 -->

<div class="tab-pane fade in equalize" id="TabBoxTop2">
    <fieldset>
        <ul class="form-list form-condensed _list-bordered dotted">
            <li class="section-form">
                <h4>Resident Information</h4>
            </li>
            <!-- // section form divider -->

            <li class="control-group">
                <label for="departments" class="control-label">Unit </label>

                <div class="controls controls-row">
                    <input id="departments" class="span6 margin-right5" type="text" value="{{ $user->data->unit }}" name="unit"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="control-group">
                <label for="departmentsJob" class="control-label">Date of Birth </label>

                <div class="controls controls-row">
                    <input class="span6 margin-right5 maskDate" type="text" value="{{ $user->data->date_birth }}" name="date_birth"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="control-group">
                <label for="departmentsAddressStreet" class="control-label">Address </label>

                <div class="controls controls-row">
                    <textarea class="span6 auto" name="address">{{ $user->data->address }}</textarea>
                </div>
            </li>
            <!-- // form item -->

            <li class="control-group">
                <label for="accountAddressStreet" class="control-label">Nationality</label>

                <div class="controls controls-row">
                    <input id="accountAddressStreet" class="span6 margin-right5" type="text" value="{{ $user->data->nationality }}" name="nationality"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="control-group">
                <label for="accountAddressCity" class="control-label">Work Telephone</label>

                <div class="controls">
                    <input class="span6 maskPhoneInt" type="text" value="{{ $user->data->work_tel }}" name="work_tel"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="control-group">
                <label for="accountAddressCity" class="control-label">Mobile phone</label>

                <div class="controls">
                    <input class="span6 maskPhoneInt" type="text" value="{{ $user->data->mobile_tel }}" name="mobile_tel"/>
                </div>
            </li>
            <!-- // form item -->


            <li class="control-group">
                <label for="accountAddressCity" class="control-label">Fax</label>

                <div class="controls">
                    <input class="span6" type="text" value="{{ $user->data->fax }}" name="fax"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="control-group">
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

            <li class="control-group">
                <label for="accountAddressState" class="control-label">Marital Status</label>

                <div class="controls">
                    {{ Form::select('marital', array('0' => 'Single', '1' => 'Married'), $user->data->marital, array('class' => 'selectpicker span6')) }}
                    <span class="help-inline help-icon" rel="popover-info" data-content="when you select single as your marital status you not need to fill spouse fields" data-class="popover-bordered">
                    <i class="booico-help"></i></span>
                </div>
            </li>
            <!-- // form item -->

            <li class="control-group">
                <label for="accountAddressCity" class="control-label">Spouse Full Name</label>

                <div class="controls">
                    <input class="span6" type="text" value="{{ $user->data->spouse_name }}" name="spouse_name"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="control-group">
                <label for="accountAddressCity" class="control-label">Spouse Birth Date</label>

                <div class="controls">
                    <input class="span6 maskDate" type="text" value="{{ $user->data->spouse_birth }}" name="spouse_birth"/>
                </div>
            </li>
            <!-- // form item -->

            <li class="control-group">
                <label for="accountAddressCity" class="control-label">Iqama / Passport No.</label>

                <div class="controls">
                    <input class="span6 maskAcid" type="text" value="{{ $user->data->iqama_pass }}" name="iqama_pass"/>
                </div>
            </li>
            <!-- // form item -->

        </ul>
    </fieldset>
</div>
<!-- // tab 2 -->

<div class="tab-pane fade in equalize" id="TabBoxTop3">
    <ul class="form-list form-condensed _list-bordered dotted">
        <li class="section-form">
            <h4>CAR DETAILS MUST BE COMPLETED</h4>
        </li>
        <!-- // section form divider -->

        <li class="control-group">
            <label for="accountAddressStreet" class="control-label">Plate No</label>

            <div class="controls controls-row">
                <input class="span6 margin-right5" type="text" value="{{ $user->cars->plate_no }}" name="plate_no"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Color</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->cars->color }}" name="color"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Make</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->cars->make }}" name="make"/>
            </div>
        </li>
        <!-- // form item -->


        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Year</label>

            <div class="controls">
                <input class="span6 maskYear" type="text" value="{{ $user->cars->year }}" name="year"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="section-form">
            <h4>Driver & Maid Details</h4>
        </li>
        <!-- // section form divider -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Name</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->cars->driver_name }}" name="driver_name"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Nationality</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->cars->driver_nat }}" name="driver_nat"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Iqama Copy</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->cars->iqama_copy }}" name="iqama_copy"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Attach Photo</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->cars->driver_photo }}" name="driver_photo"/>
            </div>
        </li>
        <!-- // form item -->

    </ul></div>
<!-- // tab 3 -->

<div class="tab-pane fade in equalize" id="TabBoxTop4">
    <div class="section-form">
        <h4>Dependents</h4>

        <p class="help-block">you want to add one more dependents? <strong><a class="add_more_dep" href="#">click here</a></strong></p>
    </div>

    @foreach( $user->dependents as $dependent)
    <ul id="dependents" class="form-list form-condensed _list-bordered dotted">

        <li class="control-group">
            <label for="accountAddressStreet" class="control-label">Full Name</label>

            <div class="controls controls-row">
                <input class="span6 margin-right5" type="text" value="{{ $dependent->full_name }}" name="full_name[]"/>
            </div>
        </li>

        <li class="control-group">
            <label for="accountPrefix" class="control-label">Gender</label>
            <div class="controls">
                {{ Form::select('gender[]', array('boy' => 'boy', 'girl' => 'girl'), $dependent->gender, array('class' => 'span6')) }}
            </div>
        </li>

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Date of Birth</label>

            <div class="controls">
                <input class="span6 maskDate" type="text" value="{{ $dependent->dep_date_birth }}" name="dep_date_birth[]"/>
            </div>
        </li>

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">School</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $dependent->school }}" name="school[]"/>
            </div>
        </li>

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Iqama / Passport No.</label>

            <div class="controls">
                <input class="span6 maskAcid" type="text" value="{{ $dependent->passport_no }}" name="passport_no[]"/>
            </div>
        </li>

        <li><hr/></li>
    </ul>
    @endforeach

    <ul class="form-list form-condensed _list-bordered dotted">

        <li class="section-form">
            <h4>Pets Info:</h4>
        </li>
        <!-- // section form divider -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Cats</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->pets->cats }}" name="cats"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Dogs</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->pets->dogs }}" name="dogs"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Other</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->pets->info_other }}" name="info_other"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="section-form">
            <h4>Pets Details:</h4>
        </li>
        <!-- // section form divider -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Inoculation Certificate</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->pets->certificate }}" name="certificate"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Collar & Tag</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->pets->collar }}" name="collar"/>
            </div>
        </li>
        <!-- // form item -->

        <li class="control-group">
            <label for="accountAddressCity" class="control-label">Other</label>

            <div class="controls">
                <input class="span6" type="text" value="{{ $user->pets->details_other }}" name="details_other"/>
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
</div>

<script>
    $(document).ready(function () {

        $(".add_more_dep").click(
            function(){


                var clone = $('#dependents').clone();
                clone.find("input").val("");
                clone.appendTo('#dependents:last');

                return false;
            }
        );

    });
</script>