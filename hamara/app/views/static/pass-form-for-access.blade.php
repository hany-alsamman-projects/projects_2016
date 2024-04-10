<form class="form-horizontal col-sm-7" method="post" action="{{ URL::to('account/process') }}">
    <fieldset>

        <!-- Form Name -->
        <legend>fill the following fields:</legend>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-5">
                <label class="control-label" for="textinput">Villa/Apt</label>
                {{ Form::text('villa_apt', null, array('class' => 'form-control')) }}
            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-5">
                <label class="control-label" for="textinput">Date & Time of Visit </label>
                {{ Form::text('date_time_of_visit', null, array('class' => 'form-control datepicker')) }}
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-5">
                <label class="control-label" for="textinput">Name of Guest</label>
            </div>
        </div>

        <!-- Prepended text-->
        <div class="form-group">
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-addon">Name of Guest</span>
                    {{ Form::text('name_of_guest[]', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">Age</span>
                    {{ Form::text('age_of_guest[]', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>

        <!-- Prepended text-->
        <div class="form-group">
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-addon">Name of Guest</span>
                    {{ Form::text('name_of_guest[]', null, array('class' => 'form-control')) }}

                    <span class="input-group-addon">Age</span>
                    {{ Form::text('age_of_guest[]', null, array('class' => 'form-control')) }}
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
