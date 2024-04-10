
var styler = {}

styler.schemes = {
    'dark-blue': {
        name: 'Dark Blue',
        color1: '#3498db',
        color2: '#202429'
    },
    'dark-green': {
        name: 'Dark Green',
        color1: '#8cbd2e',
        color2: '#202429'
    },
    'dark-jGreen': {
        name: 'Dark Jungle Green',
        color1: '#26a97d',
        color2: '#202429'
    },
    'dark-orange': {
        name: 'Dark Orange',
        color1: '#f55d2d',
        color2: '#202429'
    },
    'light-blue': {
        name: 'Light Blue',
        color1: '#3498db',
        color2: '#fff'
    },
    'light-green': {
        name: 'Light Green',
        color1: '#8cbd2e',
        color2: '#fff'
    },
    'light-jGreen': {
        name: 'Light Jungle Green',
        color1: '#26a97d',
        color2: '#fff'
    },
    'light-orange': {
        name: 'Light Orange',
        color1: '#f55d2d',
        color2: '#fff'
    }
}

styler.output = function(){
    
    return '<div id="styler"> \
                <div class="img"></div> \
                <h2>Color Schemes</h2> \
                <div class="colors"> \
                    ' + styler.generateSchemes() + ' \
                </div> \
            </div>';
}


styler.generateSchemes = function(){
    
    var ret = '';
    
    for (var i in styler.schemes) {
        
        ret += '<a href="#nogo" data-scheme="' + i + '" title="' + styler.schemes[i].name + '"> \
                    <span style="background: ' + styler.schemes[i].color1 + '"></span> \
                    <span style="background: ' + styler.schemes[i].color2 + '"></span> \
                </a>';      
        
    }
    
    return ret;
    
}

$(window).load(function(){

    $('<link rel="stylesheet" href="STYLER/styler.css" />').appendTo("head");
    $(styler.output()).appendTo('body');
    
    $('body').delegate('#styler .colors a', 'click', function(){
        var s = $(this).data('scheme');
        $.get('STYLER/styler.php?scheme=' + s);
        
        $('#scheme').attr('href', 'css/schemes/' + s + '.css');
    
    });

});

