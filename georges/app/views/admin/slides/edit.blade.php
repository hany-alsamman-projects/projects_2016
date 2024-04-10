<div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
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
                        <form id="accounForm" class="form-horizontal" enctype="multipart/form-data" method="post" action="{{URL::to("admin/slides/$id/edit")}}">
                            <div class="row-fluid">
                                <div class="span14 form-dark">
                                    <fieldset>
                                        <legend>Slide Information
                                        </legend>
                                        <ul class="form-list label-left list-bordered dotted">

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Title</label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="{{$slide->title}}" name="title">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Description <small>optional</small></label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="{{$slide->description}}" name="description">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Position <small>slide order</small></label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="{{$slide->position}}" name="position">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountAddressState" class="control-label">Upload Slide</label>

                                                <div class="controls">
                                                    <div class="well well-nice inline">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail" style="width: 400px; height: 120px;"></div>
                                                            <div>
                                                            <span class="btn btn-file"><span class="fileupload-new">Select image</span> <span class="fileupload-exists">Change</span>
                                                            <input type="file" name="upload_photo" />
                                                            </span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                        </div>
                                                        <small>Dimensional recommended is 800x327 .</small>
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