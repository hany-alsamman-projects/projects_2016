<form class="form-horizontal col-sm-8" method="post" action="{{ URL::to('account/process') }}">
    <fieldset>

        <!-- Form Name -->
        <legend>fill the following fields:</legend>

        <!-- Prepended text-->
        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">Host </span>
                    {{ Form::text('host', null, array('class' => 'form-control', 'required')) }}

                    <span class="input-group-addon">Unit</span>
                    {{ Form::text('resident_of_unit', $user->data->unit, array('class' => 'form-control', 'disabled' => 'true')) }}

                    <span class="input-group-addon">Mobile</span>
                    {{ Form::text('mobile', null, array('class' => 'form-control', 'required')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon">Function Date </span>
                    {{ Form::text('function_date', null, array('class' => 'form-control datepicker', 'required')) }}

                    <span class="input-group-addon">Day</span>
                    {{ Form::text('day', null, array('class' => 'form-control', 'required')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon">Starting</span>
                    {{ Form::text('starting', null, array('class' => 'form-control', 'required')) }}

                    <span class="input-group-addon">Till</span>
                    {{ Form::text('till', null, array('class' => 'form-control', 'required')) }}
                </div>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-10">
                <label class="control-label" style="text-align: left" for="textinput">FUNCTION TYPE</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-10">
                <label class="radio-inline" for="radios-0">
                    <input name="function_type" id="radios-0" value="Kids Party" type="radio">
                    Kids Party
                </label>
                <label class="radio-inline" for="radios-1">
                    <input name="function_type" id="radios-1" value="Adult Party" type="radio">
                    Adult Party
                </label>
                <label class="radio-inline" for="radios-2">
                    <input name="function_type" id="radios-2" value="Teens Party" type="radio">
                    Teens Party
                </label>
                <label class="radio-inline" for="radios-4">
                    <input name="function_type" id="radios-4" value="BBQ Party" type="radio">
                    BBQ Party
                </label>
               </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                      <span class="input-group-addon">
                          <input name="function_type" value="Other" type="radio">
                      </span>
                    <input id="prependedcheckbox" name="function_type_msg" class="form-control" placeholder="Other (please specify)" type="text">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-10">
                <label class="control-label" style="text-align: left" for="textinput">CATERER INFORMATION</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">Food Catering Company:</span>
                    {{ Form::text('food_catering_company[]', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">Mobile Number:</span>
                    {{ Form::text('mobile_number[]', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">Food Catering Company:</span>
                    {{ Form::text('food_catering_company[]', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">Mobile Number:</span>
                    {{ Form::text('mobile_number[]', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-10">
                <label class="control-label" style="text-align: left" for="textinput">REQUIREMENTS</label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="prependedcheckbox">Round Tables</label>
            <div class="col-md-4">
                <div class="input-group">
                      <input id="prependedcheckbox" name="round_tables_num" value="" class="form-control" type="text">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="prependedcheckbox">Rectangular Tables:</label>
            <div class="col-md-4">
                <div class="input-group">
                    <input id="prependedcheckbox" name="rect_tables_num" value="" class="form-control" type="text">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="prependedcheckbox">Plastic Chairs:</label>
            <div class="col-md-4">
                <div class="input-group">
                    <input id="prependedcheckbox" name="chairs_num" class="form-control" type="text">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label class="checkbox-inline" for="checkboxes-0">
                    <input name="special[]" id="checkboxes-0" value="assistance" type="checkbox">
                    Set up assistance fee: <strong>SAR 500</strong>
                </label>
                <label class="checkbox-inline" for="checkboxes-1">
                    <input name="special[]" id="checkboxes-1" value="Extra cleaner" type="checkbox">
                    Extra cleaner fee:  <strong>SAR 100</strong>
                </label>
                <label class="checkbox-inline" for="checkboxes-2">
                    <input name="special[]" id="checkboxes-2" value="Recreation staff " type="checkbox">
                    Recreation staff :  <strong>SAR 150</strong>
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                      <span class="input-group-addon">
                          <input type="checkbox">
                      </span>
                    <input id="prependedcheckbox" name="special[]" class="form-control" placeholder="OTHER (please specify)" type="text">
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-10">
                <label class="control-label" style="text-align: left" for="textinput">MAINTENANCE Department</label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon">Lights</span>
                            {{ Form::text('lights', null, array('class' => 'form-control')) }}

                            <span class="input-group-addon">Electrical Connection</span>
                            {{ Form::text('electrical', null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>

                <label class="checkbox-inline" for="checkboxes-3">
                    <input name="maintenance[]" id="checkboxes-3" value="Extra staff assistance" type="checkbox">
                    Staff assistance fee: <strong>SAR 150</strong>
                </label>
                <label class="checkbox-inline" for="checkboxes-4">
                    <input name="maintenance[]" id="checkboxes-4" value="Electrical Connection Cable" type="checkbox">
                    Electrical Connection Cable:  <strong>SAR 100</strong>
                </label>
                <label class="checkbox-inline" for="checkboxes-5">
                    <input name="maintenance[]" id="checkboxes-5" value="Assistance" type="checkbox">
                    Assistance fee :  <strong>SAR 150</strong>
                </label>
                <span class="help-block"> ALL REQUIREMENTS ARE SUBJECT TO AVAILABILITY BASED ON FIRST REQUESTER FIRST SERVED</span>

            </div>
        </div>

        <div class="form-group">
            <div class="col-md-10">
                <label class="control-label" style="text-align: left" for="textinput">ATTENDEES INFORMATION</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">FIRST NAME:</span>
                    {{ Form::text('first_name[]', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">FAMILY NAME:</span>
                    {{ Form::text('family_name[]', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">NATIONALITY:</span>
                    {{ Form::text('nationality[]', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">FIRST NAME:</span>
                    {{ Form::text('first_name[]', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">FAMILY NAME:</span>
                    {{ Form::text('family_name[]', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">NATIONALITY:</span>
                    {{ Form::text('nationality[]', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">FIRST NAME:</span>
                    {{ Form::text('first_name[]', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">FAMILY NAME:</span>
                    {{ Form::text('family_name[]', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">NATIONALITY:</span>
                    {{ Form::text('nationality[]', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">Residents:</span>
                    {{ Form::text('residents', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">Non Residents:</span>
                    {{ Form::text('non_residents', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">Total:</span>
                    {{ Form::text('total', null, array('class' => 'form-control')) }}
                </div>
                <span class="help-block">GUESTS MUST HAVE A VALID IQAMA, PASSPORT OR NATIONAL ID IN ORDER TO ACCESS AOVC GATE</span>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-3">
                {{ Form::hidden('form_action', Request::segment(2)) }}
                {{ Form::button('<i class="glyphicon glyphicon-circle-arrow-right"></i> Send', array('type' => 'submit', 'class' => 'btn btn-block btn-primary btn-success'))}}
            </div>
        </div>
    </fieldset>
</form>
