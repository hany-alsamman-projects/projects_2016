<form id="request_form" style="padding: 0 !important; margin: 0 !important;" class="form-horizontal col-sm-7" method="post" action="{{ URL::to('account/process') }}">

    <!-- Form Name -->
    <h2>fill the following fields:</h2>

    <fieldset>

        <!-- Prepended text-->
        <div class="form-group">
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-addon">I, </span>
                    {{ Form::text('I', $user->first_name, array('class' => 'form-control', 'disabled' => 'true')) }}

                    <span class="input-group-addon">resident of unit</span>
                    {{ Form::text('resident_of_unit', $user->data->unit, array('class' => 'form-control', 'disabled' => 'true')) }}
                </div>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-10">
                <label class="control-label" style="text-align: left" for="textinput">have read and understood the rules and would like</label>
            </div>
        </div>

        <!-- Prepended text-->
        <div class="form-group">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon">to invite on</span>
                    {{ Form::text('invite_on', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-5">
                <label class="control-label" for="textinput">Information:</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">Full Name</span>
                    {{ Form::text('guest_full_name', null, array('class' => 'form-control')) }}
                    <span class="input-group-addon">Age</span>
                    {{ Form::text('age', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-5">
                <label class="control-label" for="textinput">Resident note:</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-10">
                <textarea class="form-control" id="textarea" name="resident_note"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">Date</span>
                    {{ Form::text('date', null, array('class' => 'form-control datepicker')) }}
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
