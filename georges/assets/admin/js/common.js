(function ($, window, document, undefined) {

        // MAKE CODE PRETTY
        // ------------------------------------------------------------------------------------------------ * -->
        var $window = $(window)
        window.prettyPrint && prettyPrint();

        // CHANGE wrapper to table - ONLY DEMO
        // ------------------------------------------------------------------------------------------------ * -->
        $("#btnChangeWrapper1, #btnChangeWrapper2").click(function () {
                $('.widget').toggleClass('widget-simple widget-box');
        });

        // COLLAPSE - WIDGET HEADER
        // ------------------------------------------------------------------------------------------------ * -->
        // Collapsible widget	
        $('.widget-content.collapse')
                .on('shown', function (e) {
                $(e.target)
                        .parent('.widget-collapsible')
                        .children('.widget-header')
                        .removeClass('collapsed');
                $(e.target)
                        .prev('.widget-header')
                        .find('.widget-toggle')
                        .toggleClass('fontello-icon-publish fontello-icon-window');
        });

        $('.widget-content.collapse')
                .on('hidden', function (e) {
                $(e.target)
                        .parent('.widget-collapsible')
                        .children('.widget-header')
                        .addClass('collapsed');
                $(e.target)
                        .prev('.widget-header')
                        .find('.widget-toggle')
                        .toggleClass('fontello-icon-window fontello-icon-publish');
                });

})(jQuery, this, document);

