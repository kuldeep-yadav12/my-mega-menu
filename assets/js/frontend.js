(function ($) {


    'use strict';


    $(document).ready(function () {


        function updateMmmDropdownWidth() {


            var viewportWidth = window.innerWidth;


            var dropdownWidth = Math.min(viewportWidth - 20, 1100);


            if (dropdownWidth < 300) dropdownWidth = 300;


            $('.mmm-dropdown.mmm-fullwidth').css('width', dropdownWidth + 'px');


        }
        updateMmmDropdownWidth();


        $(window).on('resize', updateMmmDropdownWidth);
        // Click trigger


        $(document).on('click', '.mmm-wrapper[data-trigger="click"] .mmm-item.has-mega > a', function (e) {


            e.preventDefault();


            var $li = $(this).closest('.mmm-item'), open = $li.hasClass('mmm-open');


            $li.closest('.mmm-nav').find('.mmm-item.mmm-open').removeClass('mmm-open');


            if (!open) $li.addClass('mmm-open');


        });
        // Hover trigger


        $(document).on('mouseenter', '.mmm-wrapper[data-trigger="hover"] .mmm-item.has-mega', function () {


            var $li = $(this);


            $li.closest('.mmm-nav').find('.mmm-item.mmm-open').removeClass('mmm-open');


            $li.addClass('mmm-open');


        });





        $(document).on('mouseleave', '.mmm-wrapper[data-trigger="hover"] .mmm-item.has-mega', function () {


            $(this).removeClass('mmm-open');


        });


        $(document).on('click', '.mmm-hamburger', function () {


            $(this).toggleClass('is-open');


            $(this).closest('.mmm-wrapper').find('.mmm-mobile-panel').toggleClass('is-open');


            $(this).attr('aria-expanded', $(this).hasClass('is-open') ? 'true' : 'false');


        });


        $(document).on('click', '.mmm-m-item.has-mega > a', function (e) {


            e.preventDefault();


            $(this).closest('.mmm-m-item').toggleClass('mmm-open');


        });


        $(document).on('click', function (e) {


            if (!$(e.target).closest('.mmm-wrapper').length) {


                $('.mmm-item.mmm-open').removeClass('mmm-open');


                $('.mmm-mobile-panel.is-open').removeClass('is-open');


                $('.mmm-hamburger.is-open').removeClass('is-open').attr('aria-expanded', 'false');


            }


        });


        $(document).on('keydown', function (e) {


            if (e.key === 'Escape') {


                $('.mmm-item.mmm-open').removeClass('mmm-open');


                $('.mmm-mobile-panel.is-open').removeClass('is-open');


                $('.mmm-hamburger.is-open').removeClass('is-open').attr('aria-expanded', 'false');


            }


        });


    });


})(jQuery);


