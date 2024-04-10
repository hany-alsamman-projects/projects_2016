<div id="TabTop1" class="tab-pane padding-bottom30 active fade in">

    <div class="page-header">
        <h3><i class="aweso-icon-list-alt opaci35"></i> Import Books from Excel file</h3>
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
                        <form id="accounForm" class="form-horizontal" method="post"  enctype="multipart/form-data" action="{{URL::route('ImportProcess')}}">
                            <div class="row-fluid">
                                <h4 class="simple-header"> File upload
                                    <small>with file input</small>
                                </h4>
                                <div class="well well-nice">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input span4"><i
                                                    class="fontello-icon-doc-2 fileupload-exists"></i> <span
                                                    class="fileupload-preview"></span></div>
                                                <span class="btn btn-file"> <span
                                                        class="fileupload-new">Select file</span> <span
                                                        class="fileupload-exists">Change</span>
                                                <input name="upload_file" type="file"/>
                                                </span> <a href="#" class="btn fileupload-exists"
                                                           data-dismiss="fileupload">Remove</a></div>
                                    </div>
                                </div>
                                <div class="span14 form-dark">
                                    <fieldset>
                                        <legend>
                                        </legend>
                                        <ul class="form-list label-left list-bordered dotted">
                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Import limitation</label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="" name="limit">
                                                </div>
                                            </li>

                                            <!-- // drop down -->
                                            <li class="control-group">
                                                <label for="accountAddressState" class="control-label">DEPT <span class="required">*</span></label>
                                                <div class="controls">
                                                    <select id="accountAddressState" class="span6" name="dept_id">
                                                        <option value="" selected="selected">No Parent (ROOT)</option>
                                                        @foreach($depts as $dept)
                                                        <option value="{{ $dept->id }}">{{ $dept->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </li>

                                        </ul>
                                    </fieldset>

                                    <input type="hidden" name="user_id" value="{{ Sentry::getUser()->id }}">
                                    <input type="hidden" name="created_at" value="">

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