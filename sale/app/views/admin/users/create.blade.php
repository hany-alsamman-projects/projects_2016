<div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
    <div class="page-header">
        <h3><i class="aweso-icon-list-alt opaci35"></i> Add User</h3>
    </div>
    <div class="row-fluid">
        <div class="span8 grider">
            <div class="widget widget-simple">
                <div class="widget-header">
                    <h4><i class="fontello-icon-user"></i>
                        Add by
                        <small>{{ Sentry::getUser()->first_name }}</small>
                    </h4>
                </div>
                <div class="widget-content">
                    <div class="widget-body">
                        <form id="accounForm" class="form-horizontal" enctype="multipart/form-data"  method="post" action="{{URL::to('admin/users/create')}}">
                            <div class="row-fluid">
                                <div class="span14 form-dark">
                                    <fieldset>
                                        <legend>User Information
                                        </legend>
                                        <ul class="form-list label-left list-bordered dotted">

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Full Name</label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="" name="first_name">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Email (as user name login)</label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="" name="email">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Password</label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="" name="password">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Phone</label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="" name="phone_number">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Active Status</label>
                                                <div class="controls">
                                                    <label class="radio inline">
                                                        {{ Form::radio('activated', '1') }}
                                                        Activate </label>
                                                    <label class="radio inline">
                                                        {{ Form::radio('activated', '0' , 1) }}
                                                        Wait Approval </label>
                                                </div>

                                            </li>

                                            <!-- // drop down -->
                                            <li class="control-group">
                                                <label for="accountAddressState" class="control-label">Groups <span class="required">*</span></label>
                                                <div class="controls">
                                                    <select id="accountAddressState" class="span6" name="group_id">
                                                        <option value="" selected="selected">Select Group</option>
                                                        @foreach($groups as $group)
                                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
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
                                                        <span class="btn btn-file"> <span
                                                                class="fileupload-new">Select file</span> <span
                                                                class="fileupload-exists">Change</span>
                                                        <input name="upload_photo" type="file"/>
                                                        </span> <a href="#" class="btn fileupload-exists"
                                                                   data-dismiss="fileupload">Remove</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </fieldset>
                                    <!-- // fieldset Input -->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-blue">Submit & Validate</button>
                                        <button class="btn cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>