<div class="row-fluid page-head">
    <h2 class="page-title"><i class="aweso-icon-list-alt"></i> Forms Wizard <small>bootstrap style</small></h2>
    <p class="pagedesc">Builds a wizard out of a formatter tabbable structure.</p>
    <div class="page-bar">
        <div class="btn-toolbar">
            <ul class="nav nav-tabs pull-right">
                <li> <a href="#Tab1" data-toggle="tab">Show Pages</a> </li>
                <li  class="active"> <a href="#Tab2" data-toggle="tab">Page Wizard Steps</a> </li>
            </ul>
        </div>
    </div>
</div>
<!-- // page head -->

<div id="page-content" class="page-content tab-content overflow-y">

<div id="Tab1" class="tab-pane fade in active">
<div class="row-fluid">
<div class="span12">
<div class="page-header">
    <h3><i class="aweso-icon-list-alt opaci35"></i> Wizard <small>full settings in .well-box</small></h3>
</div>
<div class="well well-nice well-box wizard">
<form id="DWZD" class="form-horizontal form-dark" method="" action="" >
<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <ul>
                <li><a href="#tab1fb" data-toggle="tab">Name</a></li>
                <li><a href="#tab2fb" data-toggle="tab">Personal</a></li>
                <li><a href="#tab3fb" data-toggle="tab">Emploament</a></li>
                <li><a href="#tab4fb" data-toggle="tab">Contact</a></li>
                <li><a href="#tab5fb" data-toggle="tab">Address</a></li>
                <li><a href="#tab6fb" data-toggle="tab">Sumary</a></li>
            </ul>
            <div class="number-page pull-right"></div>
        </div>
    </div>
</div>
<div class="section-content item bg-blue-medium padding-top10 padding-bottom10 no-border-top">
    <div id="bar" class="progress progress-info progress-mini no-margin">
        <div class="bar"></div>
    </div>
</div>
<div class="tab-content section-content item">
<div class="tab-pane" id="tab1fb">
    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <legend><i class="fontello-icon-user-4"></i> Persona´s name <span> New Account form</span></legend>
                <ul class="form-list label-left list-bordered dotted">
                    <li class="control-group">
                        <label for="wzNewPrefix" class="control-label">Prefix</label>
                        <div class="controls">
                            <input id="wzNewPrefix" class="span6" type="text" value="" name="wzNewPrefix">
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewFirstName" class="control-label">First Name <span class="required">*</span></label>
                        <div class="controls">
                            <input id="wzNewFirstName" class="span11" type="text" name="wzNewFirstName" value="">
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewLastName" class="control-label">Last Name <span class="required">*</span></label>
                        <div class="controls">
                            <input id="wzNewLastName" class="span11" type="text" name="wzNewLastName" value="">
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewSuffix" class="control-label">Suffix</label>
                        <div class="controls">
                            <input id="wzNewSuffix" class="span6" type="text" name="wzNewSuffix" value="">
                        </div>
                    </li>
                    <!-- // form item -->

                </ul>
            </fieldset>
        </div>
    </div>
</div>
<!-- // tab1 -->

<div class="tab-pane" id="tab2fb">
    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <legend><i class="fontello-icon-vcard"></i> Personal Data <span> Default wizard legend</span></legend>
                <ul class="form-list label-left list-bordered dotted">
                    <li class="control-group">
                        <label for="wzNewMaritalStatus" class="control-label">Marital Status</label>
                        <div class="controls">
                            <input id="wzNewMaritalStatus" class="span6" type="text" name="wzNewMaritalStatus" value="">
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewGenderInput" class="control-label">Gender</label>
                        <div class="controls">
                            <input id="wzNewGenderInput" type="hidden" name="wzNewGender" value="" />
                            <div id="wzNewGender" class="btn-group change" data-toggle="buttons-radio" data-target="wzNewGenderInput">
                                <button type="button" class="btn" class-toggle="btn-green" name="wzNewGender" value="male">&nbsp; Male &nbsp;</button>
                                <button type="button" class="btn" class-toggle="btn-green" name="wzNewGender" value="female">Female</button>
                            </div>
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewDob" class="control-label">Date Of Birth <span class="required">*</span></label>
                        <div class="controls">
                            <input id="wzNewDob" class="span6" type="text" name="wzNewDob" value="">
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewAge" class="control-label">Age</label>
                        <div class="controls">
                            <input id="wzNewAge" class="span4" type="text" name="wzNewAge" value="">
                        </div>
                    </li>
                    <!-- // form item -->

                </ul>
            </fieldset>
        </div>
    </div>
</div>
<!-- // tab2 -->

<div class="tab-pane" id="tab3fb">
    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <legend><i class="fontello-icon-bag"></i> Dates of employment <span> Default wizard legend</span></legend>
                <ul class="form-list label-left list-bordered dotted">
                    <li class="control-group">
                        <label for="wzNewEmployer" class="control-label">Employer</label>
                        <div class="controls">
                            <input id="wzNewEmployer" class="span11" type="text" name="wzNewEmployer" value="">
                        </div>
                    </li>

                    <!-- // form item -->
                    <li class="control-group">
                        <label for="wzNewDepartment" class="control-label">Department</label>
                        <div class="controls">
                            <input id="wzNewMiddleName" class="span11" type="text" name="wzNewMiddleName" value="">
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewJob" class="control-label">Account Job</label>
                        <div class="controls">
                            <input id="wzNewJob" class="span11" type="text" name="wzNewJob" value="">
                            <p class="help-block">Lorem ipsum dolor sit amet consectetuer convallis nisl dolor tellus porta. Curabitur accumsan tempus semper eget Aliquam ante Aliquam Curabitur odio tincidunt.</p>
                        </div>
                    </li>
                    <!-- // form item -->

                </ul>
            </fieldset>
        </div>
    </div>
</div>
<!-- // tab3 -->

<div class="tab-pane" id="tab4fb">
    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <legend><i class="fontello-icon-phone"></i> Contact info <span> Default wizard legend</span></legend>
                <ul class="form-list label-left list-bordered dotted">
                    <li class="control-group">
                        <label for="wzNewEmail" class="control-label">Email <span class="required">*</span></label>
                        <div class="controls">
                            <input id="wzNewEmail" class="span11" type="text" name="wzNewEmail" value="">
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewPhoneNumber" class="control-label">Phone <span class="required">*</span></label>
                        <div class="controls">
                            <input id="wzNewPhoneNumber" class="span6 maskPhone" type="text" name="wzNewPhoneNumber" value="">
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewFaxNumber" class="control-label">Fax</label>
                        <div class="controls">
                            <input id="wzNewFaxNumber" class="span6 maskPhone" type="text" name="wzNewFaxNumber" value="">
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <div class="controls">
                            <p>Lorem ipsum dolor sit amet consectetuer convallis nisl dolor tellus porta.</p>
                        </div>
                    </li>
                    <!-- // form item -->

                </ul>
            </fieldset>
        </div>
    </div>
</div>
<!-- // tab4 -->

<div class="tab-pane" id="tab5fb">
    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <legend><i class="fontello-icon-home"></i> Address <span> Default wizard legend</span></legend>
                <ul class="form-list label-left list-bordered dotted">
                    <li class="control-group">
                        <label for="wzNewAddressStreet" class="control-label">Address <span class="required">*</span></label>
                        <div class="controls controls-row">
                            <input id="wzNewAddressStreet" class="span6" type="text" value="" name="wzNewAddressStreet">
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewAddressCity" class="control-label">City <span class="required">*</span></label>
                        <div class="controls">
                            <input id="wzNewAddressCity" class="span6" type="text" value="" name="wzNewAddressCity">
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewAddressState2" class="control-label">State <span class="required">*</span></label>
                        <div class="controls">
                            <select id="wzNewAddressState2" class="span6" name="wzNewAddressState2">
                                <option value="" selected="selected">Select a State</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <label for="wzNewAddressZip" class="control-label">Zip / Postal code <span class="required">*</span></label>
                        <div class="controls">
                            <input id="wzNewAddressZip" class="span4 maskZipcode" type="text" value="" name="wzNewAddressZip">
                        </div>
                    </li>
                    <!-- // form item -->

                </ul>
            </fieldset>
            <!-- // fieldset Input -->
        </div>
    </div>
</div>
<!-- // tab5 -->

<div class="tab-pane summary" id="tab6fb">
    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <legend><i class="fontello-icon-th-list-4"></i> Overview form <span> Default wizard legend</span></legend>
                <ul class="summary-list list-bordered dotted">
                    <li class="control-group row-fluid">
                        <div class="span6 well well-small well-nice">
                            <p><span class="label-field">Name</span> <span class="field bold">mr. Jonathan Somerson</span></p>
                            <p><span class="label-field">Marital Status</span> <span class="field">married</span></p>
                            <p><span class="label-field">Gender</span> <span class="field">man</span></p>
                            <p><span class="label-field">Date Of Birth</span> <span class="field">08/08/1978</span></p>
                            <p><span class="label-field">Age</span> <span class="field">34</span></p>
                        </div>
                    </li>
                    <!-- // form item -->

                    <li class="control-group row-fluid">
                        <p><span class="label-field">Email</span> <span class="field bold">j.somerson@example.com</span></p>
                        <p><span class="label-field">Phone</span> <span class="field bold">(123) 456-7890</span></p>
                        <p><span class="label-field">fax</span> <span class="field">(123) 456-7890</span></p>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <p><span class="label-field">Address</span> <span class="field"> 795 Folsom Ave, Suite 600</span></p>
                        <p><span class="label-field">&nbsp;</span> <span class="field">San Francisco, CA 94107</span></p>
                    </li>
                    <!-- // form item -->

                    <li class="control-group">
                        <p><span class="label-field">Employer</span> <span class="field">Twitter, Inc.</span></p>
                        <p><span class="label-field">Department</span> <span class="field">sales Department</span></p>
                        <p><span class="label-field">Job</span> <span class="field">Manager</span></p>
                    </li>
                    <!-- // form item -->

                </ul>
            </fieldset>
        </div>
    </div>
</div>
<!-- // tab6 summary -->

</div>
<div class="section-content footer">
    <ul class="wizard-action wizard-pager">
        <li><a class="previous first btn" href="javascript:void(0);">First</a></li>
        <li><a class="previous btn btn-blue" href="javascript:void(0);"><i class="fontello-icon-left-circle2"></i> Previous</a></li>
        <li><a class="next last btn" href="javascript:void(0);">Last</a></li>
        <li><a class="next btn btn-blue" href="javascript:void(0);">Next <i class="fontello-icon-right-circle2"></i></a></li>
        <li>
            <button type="submit" class="next finish btn btn-green">Send form</button>
        </li>
        <li><a class="next print btn btn-glyph" href="javascript:void(0);"><i class="fontello-icon-print-2"></i></a></li>
        <li><a class="next cancel btn btn-red" href="javascript:void(0);">Cancel</i></a></li>
    </ul>
    <!-- // Action -->

</div>
</form>
</div>
</div>
</div>
<!-- // example row -->
</div>

</div>
<!-- // page content -->

<script>
$(document).ready(function () {
    // base - default setting
    $('#wizard').bootstrapWizard();

    // base - tabs top, submit button
    $('#wizard-tabs').bootstrapWizard({
        tabClass: 'nav nav-tabs',
        onTabShow: function (tab, navigation, index) {

            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $myWizard = $('#wizard-tabs');

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $myWizard.find('.wizard .next').hide();
                $myWizard.find('.wizard .save').show();
                $myWizard.find('.wizard .save').removeClass('disabled');
            }
            else {
                $myWizard.find('.wizard .next').show();
                $myWizard.find('.wizard .save').hide();
            }
        }
    });

    // base - tabs left, tabs disabled
    $('#wizard-left').bootstrapWizard({
        tabClass: 'nav nav-tabs',
        onTabClick: function (tab, navigation, index) {
            alert('on tab click disabled, use navigation');
            return false;
        }
    });

    // base - tabs below, submit button, alert
    $('#wizard-below').bootstrapWizard({
        tabClass: 'nav nav-tabs',
        nextSelector: '.send-wizard .next',
        previousSelector: '.send-wizard .previous',
        onTabShow: function (tab, navigation, index) {

            var $total = navigation.find('li').length;
            var $current = index + 1;

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $('#wizard-below').find('.send-wizard .next').hide();
                $('#wizard-below').find('.send-wizard .save').show();
                $('#wizard-below').find('.send-wizard .save').removeClass('disabled');
            }
            else {
                $('#wizard-below').find('.send-wizard .next').show();
                $('#wizard-below').find('.send-wizard .save').hide();
            }
        }
    });
    $('#wizard-below .save').click(function () {
        alert('Finished!, Starting over!');
        $('#wizard-below').find("a[href*='tab1TB']").trigger('click');
    });

    // nav pills, numbering, submit button - well-nice
    $('#wizard-nice').bootstrapWizard({
        tabClass: 'nav nav-pills',
        nextSelector: '.wizard-action .next',
        previousSelector: '.wizard-action .previous',
        onTabShow: function (tab, navigation, index) {

            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $myWizard = $('#wizard-nice');

            $myWizard.find('.number-page').html($current + '.');

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $myWizard.find('.wizard-action .next').hide();
                $myWizard.find('.wizard-action .save').show();
                $myWizard.find('.wizard-action .save').removeClass('disabled');
            }
            else {
                $myWizard.find('.wizard-action .next').show();
                $myWizard.find('.wizard-action .save').hide();
            }
        }
    });

    // nav pills, numbering, submit button well-black
    $('#wizard-black').bootstrapWizard({
        nextSelector: '.wizard-action .next',
        previousSelector: '.wizard-action .previous',
        onTabShow: function (tab, navigation, index) {

            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;

            $('#wizard-black').find('.number-page').html($current + ' <span class="boo-green">of</span> ' + $total);

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $('#wizard-black').find('.wizard-action .next').hide();
                $('#wizard-black').find('.wizard-action .finish').show();
                $('#wizard-black').find('.wizard-action .finish').removeClass('disabled');
                $('#wizard-black').find('.wizard-action .cancel').show();
                $('#wizard-black').find('.wizard-action .cancel').removeClass('disabled');
            }
            else {
                $('#wizard-black').find('.wizard-action .next').show();
                $('#wizard-black').find('.wizard-action .finish').hide();
                $('#wizard-black').find('.wizard-action .cancel').hide();
            }

        }
    });

    // navbar, numbering, progressbar, submit button well-nice
    $('#wizard-progress').bootstrapWizard({
        nextSelector: '.wizard-action .next',
        previousSelector: '.wizard-action .previous',
        firstSelector: '.wizard-action .first',
        lastSelector: '.wizard-action .last',
        onTabShow: function (tab, navigation, index) {

            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;
            var $wizard = $('#wizard-progress');

            $wizard.find('.bar').css({
                width: $percent + '%'
            });

            $wizard.find('.number-page').text($current + ' of ' + $total);

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $wizard.find('.wizard-action .next').hide();
                $wizard.find('.wizard-action .finish').show();
                $wizard.find('.wizard-action .finish').removeClass('disabled');
                $wizard.find('.wizard-action .print').show();
                $wizard.find('.wizard-action .print').removeClass('disabled');
                $wizard.find('.wizard-action .cancel').show();
                $wizard.find('.wizard-action .cancel').removeClass('disabled');
            }
            else {
                $wizard.find('.wizard-action .next').show();
                $wizard.find('.wizard-action .finish').hide();
                $wizard.find('.wizard-action .print').hide();
                $wizard.find('.wizard-action .cancel').hide();
            }

        }

    });
    $('#wizard-progress .finish').click(function () {
        alert('Finished!, Starting over!');
        $('#wizard-progress').find("a[href*='tab1e']").trigger('click');
    });

    // custom button, progressbar indicator, submit button well-black
    $('#wizard-idicator').bootstrapWizard({
        nextSelector: '.wizard-action .next',
        previousSelector: '.wizard-action .previous',
        firstSelector: '.wizard-action .first',
        lastSelector: '.wizard-action .last',
        onTabShow: function (tab, navigation, index) {

            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;
            var $wizard = $('#wizard-idicator');

            $wizard.find('.bar').css({
                width: $percent + '%'
            });

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $wizard.find('.wizard-action .next').hide();
                $wizard.find('.wizard-action .finish').show();
                $wizard.find('.wizard-action .finish').removeClass('disabled');
                $wizard.find('.wizard-action .print').show();
                $wizard.find('.wizard-action .print').removeClass('disabled');
            }
            else {
                $wizard.find('.wizard-action .next').show();
                $wizard.find('.wizard-action .finish').hide();
                $wizard.find('.wizard-action .print').hide();
            }

        }
    });
    $('#wizard-idicator .finish').click(function () {
        alert('Finished!, Starting over!');
        $('#wizard-idicator').find("a[href*='tab1f']").trigger('click');
    });

    $('#accNewAddressState').select2();

    $(function (wizardFormBar) {
        // navbar, numbering, progressbar, submit button well-nice
        wizardFormBar('#DWZD').bootstrapWizard({
            nextSelector: '.wizard-action .next',
            previousSelector: '.wizard-action .previous',
            firstSelector: '.wizard-action .first',
            lastSelector: '.wizard-action .last',
            onTabShow: function (tab, navigation, index) {

                var $total = navigation.find('li').length;
                var $current = index + 1;
                var $percent = ($current / $total) * 100;
                var $wizard = $('#DWZD');

                $wizard.find('.bar').css({
                    width: $percent + '%'
                });

                $wizard.find('.number-page').text($current + ' of ' + $total);

                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $wizard.find('.wizard-action .next').hide();
                    $wizard.find('.wizard-action .finish').show();
                    $wizard.find('.wizard-action .finish').removeClass('disabled');
                    $wizard.find('.wizard-action .print').show();
                    $wizard.find('.wizard-action .print').removeClass('disabled');
                    $wizard.find('.wizard-action .cancel').show();
                    $wizard.find('.wizard-action .cancel').removeClass('disabled');
                }
                else {
                    $wizard.find('.wizard-action .next').show();
                    $wizard.find('.wizard-action .finish').hide();
                    $wizard.find('.wizard-action .print').hide();
                    $wizard.find('.wizard-action .cancel').hide();
                }

            }

        })
        wizardFormBar('#DWZD .finish').click(function () {
            alert('Finished!, Starting over!');
            $('#DWZD').find("a[href*='tab1fb']").trigger('click');
        })

        wizardFormBar('#wzNewAddressState2').select2();
    });

    $("#stepsWizard").bwizard({
        backBtnText: '<i class="fontello-icon-left-circle2"></i> Previous',
        nextBtnText: 'Previous <i class="fontello-icon-right-circle2"></i>',
        autoPlay: false,
        loop: false
    });

    $("#stepsWizardLoop").bwizard({
        backBtnText: '<i class="fontello-icon-left-circle2"></i> Previous',
        nextBtnText: 'Previous <i class="fontello-icon-right-circle2"></i>',
        autoPlay: true,
        loop: true
    });



});
</script>