<form class="form-horizontal col-sm-7" method="post" action="{{ URL::to('account/process') }}">
    <fieldset>

        <!-- Form Name -->
        <legend>fill the following fields:</legend>

        <!-- Prepended text-->
        <div class="form-group">
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-addon">I, </span>
                    {{ Form::text('I', $user->first_name, array('class' => 'form-control', 'disabled' => 'true')) }}

                    <span class="input-group-addon">VILLA/APT. NO</span>
                    {{ Form::text('villa_apt', null, array('class' => 'form-control', 'required' )) }}

                    <span class="input-group-addon">Unit</span>
                    {{ Form::text('resident_of_unit', $user->data->unit, array('class' => 'form-control', 'disabled' => 'true')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label" for="textinput">SPECIFY DAY, DATE AND TIME SERVICES ARE REQUIRED</label>
            </div>
        </div>

        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>Day</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><select class="form-control" name="day" required="">
                        <option id="Saturday">Saturday</option>
                        <option id="Sunday">Sunday</option>
                        <option id="Monday">Monday</option>
                        <option id="Tuesday">Tuesday</option>
                        <option id="Wednesday">Wednesday</option>
                        <option id="Thursday">Thursday</option>
                </select></td>
                <td>{{ Form::text('date', null, array('class' => 'form-control datepicker', 'required' )) }}</td>
                <td>{{ Form::text('time', null, array('class' => 'form-control', 'required' )) }}</td>
            </tr>
            </tbody>
        </table>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-10">
                <label class="control-label" style="text-align: left" for="textinput"><h3>SERVICES REQUIRED</h3></label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-5">
                <label class="control-label" for="textinput">CLEANING SERVICES</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label class="checkbox-inline" for="checkboxes-0">
                    <input name="cleaning[]" id="checkboxes-0" value="Indoor General Cleaning" type="checkbox">
                    Indoor General Cleaning
                </label>
                <label class="checkbox-inline" for="checkboxes-1">
                    <input name="cleaning[]" id="checkboxes-1" value="Carpet Vaccumming" type="checkbox">
                    Carpet Vaccumming
                </label>
                <label class="checkbox-inline" for="checkboxes-2">
                    <input name="cleaning[]" id="checkboxes-2" value="Window Glass Cleaning" type="checkbox">
                    Window Glass Cleaning
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-5">
                <label class="control-label" for="textinput">CARPET CLEANING</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label class="checkbox-inline" for="checkboxes-3">
                    <input name="carpet[]" id="checkboxes-3" value="Indoor General Cleaning" type="checkbox">
                    Carpet Spot Shampoo
                </label>
                <label class="checkbox-inline" for="checkboxes-4">
                    <input name="carpet[]" id="checkboxes-4" value="Carpet Vaccumming" type="checkbox">
                    Carpet Shampooing
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-5">
                <label class="control-label" for="textinput">OTHER SERVICES</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label class="checkbox-inline" for="checkboxes-5">
                    <input name="other[]" id="checkboxes-5" value="Heavy Curtain Cleaning" type="checkbox">
                    Heavy Curtain Cleaning
                </label>
                <label class="checkbox-inline" for="checkboxes-6">
                    <input name="other[]" id="checkboxes-6" value="Curtain Shear - Dry Cleaning" type="checkbox">
                    Curtain Shear - Dry Cleaning
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label class="checkbox-inline" for="checkboxes-7">
                    <input name="other[]" id="checkboxes-7" value="Curtain Shear - Dry Cleaning" type="checkbox">
                    Sofa Steam Cleaning
                </label>
                <label class="checkbox-inline" for="checkboxes-8">
                    <input name="other[]" id="checkboxes-8" value="Curtain Shear - Dry Cleaning" type="checkbox">
                    Skylite Cleaning
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label" for="textinput">Permission is granted to enter my Villa/Unit on above mentioned date:</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label class="radio-inline" for="radio-0">
                    <input name="permission" id="radio-0" checked value="yes" type="radio">
                    Yes
                </label>
                <label class="radio-inline" for="radio-1">
                    <input name="permission" id="radio-1" value="no" type="radio">
                    No
                </label>
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
