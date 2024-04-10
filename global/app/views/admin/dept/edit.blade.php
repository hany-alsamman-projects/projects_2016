<div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
    <!--
    <div class="page-header">
        <h3><i class="aweso-icon-list-alt opaci35"></i> Add Department</h3>
    </div>
    -->
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
                        <form id="accounForm" class="form-horizontal" method="post" action="{{URL::to("admin/dept/$id/update")}}">
                            <div class="row-fluid">
                                <div class="span14 form-dark">
                                    <fieldset>
                                        <legend>Department Information
                                        </legend>
                                        <ul class="form-list label-left list-bordered dotted">

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Title</label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="{{ $dept->title }}" name="title">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Slug <small>short name in url</small></label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="{{ $dept->slug }}" name="slug">
                                                </div>
                                            </li>

                                            <!-- // drop down -->
                                            <li class="control-group">
                                                <label for="accountAddressState" class="control-label">Main DEPT <span class="required">*</span></label>
                                                <div class="controls">
                                                    {{ Form::select('parent', $depts, $dept->parent, array('class' => 'span6', 'id' => 'category_id')) }}
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