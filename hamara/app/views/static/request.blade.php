
<form id="request_form" class="form-horizontal col-sm-7" style="padding: 0 !important; margin: 0 !important;" method="post" action="{{ URL::to('request/process') }}">
    <h2>Fill the following fields:</h2>
    <fieldset>
        <div class="row">

            <div class="col-sm-6">
                <div class="panel panel-new">
                    <div class="panel-body">
                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label" for="textinput">Name</label>
                                {{ Form::text('Name', null, array('class' => 'form-control', 'required')) }}
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label" for="textinput">Tel. Off</label>
                                {{ Form::text('Tel_Off', null, array('class' => 'form-control', 'required')) }}
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label" for="textinput">Address</label>
                                {{ Form::text('Address', null, array('class' => 'form-control', 'required')) }}
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label" for="textinput">E-mail</label>
                                {{ Form::text('E_mail', null, array('class' => 'form-control', 'required')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label" for="textinput">Status</label>
                                <br>
                                <label class="radio-inline" for="radios-0">
                                    <input name="Status" id="radios-0" value="Married" type="radio" checked>
                                    Married
                                </label>
                                <label class="radio-inline" for="radios-1">
                                    <input name="Status" id="radios-1" value="Single" type="radio">
                                    Single
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.col-sm-8 -->

            <div class="col-sm-6">
                <div class="panel panel-new">
                    <div class="panel-body">
                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label" for="textinput">Nationality</label>
                                {{ Form::text('Nationality', null, array('class' => 'form-control', 'required')) }}
                            </div>
                        </div>

                        <!-- Prepended text-->
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Sponsor/Company Name</label>
                                        {{ Form::text('SponsorName', null, array('class' => 'form-control', 'required')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Sponsor/Company Tel</label>
                                        {{ Form::text('SponsorTel', null, array('class' => 'form-control', 'required')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Type of Accommodation</label>
                                        {{ Form::text('Type_of', null, array('class' => 'form-control', 'required')) }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.col-sm-4 -->

        </div>

        <label class="control-label" for="textinput">Dependents:</label>

        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>Name</th>
                <th>Spouse</th>
                <th>Gender</th>
                <th>Age</th>
                <th>School</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ Form::text('Depname[]', null, array('class' => 'form-control' )) }}</td>
                <td>{{ Form::text('Depspouse[]', null, array('class' => 'form-control' )) }}</td>
                <td><select class="form-control" name="gender" required="">
                        <option id="Saturday">Boy</option>
                        <option id="Sunday">Girl</option>
                    </select></td>
                <td>{{ Form::text('age[]', null, array('class' => 'form-control' )) }}</td>
                <td>{{ Form::text('school[]', null, array('class' => 'form-control' )) }}</td>
            </tr>

            <tr>
                <td>{{ Form::text('Depname[]', null, array('class' => 'form-control' )) }}</td>
                <td>{{ Form::text('Depspouse[]', null, array('class' => 'form-control' )) }}</td>
                <td><select class="form-control" name="gender" required="">
                        <option id="Saturday">Boy</option>
                        <option id="Sunday">Girl</option>
                    </select></td>
                <td>{{ Form::text('age[]', null, array('class' => 'form-control' )) }}</td>
                <td>{{ Form::text('school[]', null, array('class' => 'form-control' )) }}</td>
            </tr>

            <tr>
                <td>{{ Form::text('Depname[]', null, array('class' => 'form-control' )) }}</td>
                <td>{{ Form::text('Depspouse[]', null, array('class' => 'form-control' )) }}</td>
                <td><select class="form-control" name="gender" required="">
                        <option id="Saturday">Boy</option>
                        <option id="Sunday">Girl</option>
                    </select></td>
                <td>{{ Form::text('age[]', null, array('class' => 'form-control' )) }}</td>
                <td>{{ Form::text('school[]', null, array('class' => 'form-control' )) }}</td>
            </tr>

            <tr>
                <td>{{ Form::text('Depname[]', null, array('class' => 'form-control' )) }}</td>
                <td>{{ Form::text('Depspouse[]', null, array('class' => 'form-control' )) }}</td>
                <td><select class="form-control" name="gender" required="">
                        <option id="Saturday">Boy</option>
                        <option id="Sunday">Girl</option>
                    </select></td>
                <td>{{ Form::text('age[]', null, array('class' => 'form-control' )) }}</td>
                <td>{{ Form::text('school[]', null, array('class' => 'form-control' )) }}</td>
            </tr>
            </tbody>
        </table>
        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-3">
                {{ Form::hidden('form_action', Request::segment(2)) }}
                {{ Form::button('<i class="glyphicon glyphicon-circle-arrow-right"></i> Send', array('type' => 'submit', 'class' => 'btn btn-block btn-primary btn-success'))}}
            </div>
        </div>
    </fieldset>
</form>