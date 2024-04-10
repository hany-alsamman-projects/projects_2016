function getContent(){
    var mDivDestino = $('.list-1');
    var practice = $('select[name="practice"]').val()
    var location = $('select[name="location"]').val()

    $.post("/qureshi/finder/mget.php", { lid: location , pid: practice})
        .done(function(data) {
            mDivDestino.html('<li class="layout-50-left"><h6>Lawyers Informations</h6><p>'+data+'</p></li>');
        });
}