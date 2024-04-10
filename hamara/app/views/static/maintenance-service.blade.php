<form class="form-horizontal col-sm-7" method="post" action="{{ URL::to('account/process') }}">
    <fieldset>

        <!-- Form Name -->
        <legend>fill the following fields:</legend>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">Unit</span>
                    {{ Form::text('resident_of_unit', $user->data->unit, array('class' => 'form-control', 'disabled' => 'true')) }}

                    <span class="input-group-addon">Function Date </span>
                    {{ Form::text('function_date', null, array('class' => 'form-control datepicker')) }}

                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">Location </span>
                    {{ Form::text('location', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">Time</span>
                    {{ Form::text('time', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-5">
                <label class="control-label" for="textinput">Description of Service(s) Required:</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label class="checkbox-inline" for="checkboxes-0">
                    <input name="service[]" id="checkboxes-0" value="Electrical" type="checkbox">
                    Electrical
                </label>
                <label class="checkbox-inline" for="checkboxes-1">
                    <input name="service[]" id="checkboxes-1" value="Plumbing" type="checkbox">
                    Plumbing
                </label>
                <label class="checkbox-inline" for="checkboxes-2">
                    <input name="service[]" id="checkboxes-2" value="Carpentry" type="checkbox">
                    Carpentry
                </label>
                <label class="checkbox-inline" for="checkboxes-2">
                    <input name="service[]" id="checkboxes-2" value="Air Condition" type="checkbox">
                    Air Condition
                </label>
                <label class="checkbox-inline" for="checkboxes-2">
                    <input name="service[]" id="checkboxes-2" value="Masonary" type="checkbox">
                    Masonary
                </label>
                <label class="checkbox-inline" for="checkboxes-2">
                    <input name="service[]" id="checkboxes-2" value="Paint/Polish" type="checkbox">
                    Paint/Polish
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                      <span class="input-group-addon">
                          <input type="checkbox" value="Other">
                      </span>
                    <input id="prependedcheckbox" name="service[]" class="form-control" placeholder="Other (please specify)" type="text">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label" for="textinput">Permission is granted to enter my villa/unit if I am out:</label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="radio-inline" for="radio-0">
                    <input name="permission" id="radio-0" value="yes" type="radio">
                    Yes
                </label>
                <label class="radio-inline" for="radio-1">
                    <input name="permission" id="radio-1" value="no" type="radio">
                    No
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">I will be available on date</span>
                    {{ Form::text('available_date', null, array('class' => 'form-control datepicker')) }}

                    <span class="input-group-addon">Time </span>
                    {{ Form::text('available_time', null, array('class' => 'form-control')) }}

                </div>
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
