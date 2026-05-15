(function($){
    'use strict';
    $(document).ready(function(){

        // Mobile: click pe toggle
        $('.mmm-item.has-dropdown > a').on('click', function(e){
            if($(window).width() <= 768){
                e.preventDefault();
                var $li = $(this).closest('.mmm-item');
                var isOpen = $li.hasClass('mmm-open');
                $('.mmm-item').removeClass('mmm-open');
                if(!isOpen){ $li.addClass('mmm-open'); }
            }
        });

        // Bahar click pe band karo
        $(document).on('click', function(e){
            if(!$(e.target).closest('.mmm-wrapper').length){
                $('.mmm-item').removeClass('mmm-open');
            }
        });

        // Escape key
        $(document).on('keydown', function(e){
            if(e.key === 'Escape'){ $('.mmm-item').removeClass('mmm-open'); }
        });

        // Resize pe reset
        $(window).on('resize', function(){
            if($(window).width() > 768){
                $('.mmm-item').removeClass('mmm-open');
            }
        });
    });
})(jQuery);
