$(document).ready(function () {
	$('.carousel').carousel({
		interval: 5000
	});


    var startDate = new Date();
    var endDate = new Date();

    //from - till function

    $('#dp4').datepicker()
        .on('changeDate', function(ev){
            if (ev.date.valueOf() > endDate.valueOf()){
                $('#alert').show().find('strong').text('The start date can not be greater then the end date');
            } else {
                $('#alert').hide();
                startDate = new Date(ev.date);
                $('#startDate').text($('#dp4').data('date'));
            }
            $('#dp4').datepicker('hide');
        });
    $('#dp5').datepicker()
        .on('changeDate', function(ev){
            if (ev.date.valueOf() < startDate.valueOf()){
                $('#alert').show().find('strong').text('The end date can not be less then the start date');
            } else {
                $('#alert').hide();
                endDate = new Date(ev.date);
                $('#endDate').text($('#dp5').data('date'));
            }
            $('#dp5').datepicker('hide');
       });

    $('.datepicker').datepicker();

    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

});