<script type="text/javascript" src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>

<script>
    function elFinderBrowser (field_name, url, type, win) {
        tinymce.activeEditor.windowManager.open({
            file: '{{URL::to("elfinder/tinymce")}}',// use an absolute path!
            title: 'VIP File Manager v1.0',
            width: 900,
            height: 450,
            resizable: 'yes'
        }, {
            setUrl: function (url) {
                win.document.getElementById(field_name).value = url;
            }
        });
        return false;
    }
    tinymce.init({
        selector: "textarea",
        file_browser_callback : elFinderBrowser,
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor",
        image_advtab: true
    });
</script>

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
                        <form id="accounForm" class="form-horizontal" method="post"  enctype="multipart/form-data"  action="{{URL::route('AddProduct')}}">
                            <div class="row-fluid">
                                <div class="span14 form-dark">
                                    <fieldset>
                                        <legend>Product Information
                                        </legend>
                                        <ul class="form-list label-left list-bordered dotted">

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Title</label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="" name="title">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Description</label>
                                                <div class="controls">
                                                    <input id="accountPrefix" class="span6" type="text" value="" name="subject">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Contents</label>
                                                <div>
                                                    <div style="clear: both"></div>
                                                    <textarea placeholder="test" style="width: 100%"  class="editable" name="content" data-id="body-1">
                                                        <p><br><br></p>
                                                    </textarea>
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

                                            <li class="control-group">
                                                <label for="accountAddressState" class="control-label">Upload Cover</label>

                                                <div class="controls">
                                                     <div class="well well-nice">
                                                         <input name="upload_file" type="file"/>
                                                     </div>
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