(function ($) {
    'use strict';

    var state = { itemId: null, enabled: false };

    $(document).ready(function () {
        bindAll();
    });

    function buildModal(itemId) {

        $('#mmm-overlay').remove();

        var html = `
    <div id="mmm-overlay">
        <div id="mmm-modal">

            <div class="mmm-head">
                <h3>
                    <span class="mmm-head-icon">&#9776;</span>
                    <span id="mmm-title">Mega Menu</span>
                </h3>
                <button class="mmm-close-btn" id="mmm-close">&times;</button>
            </div>

            <div class="mmm-tabs">
                <button class="mmm-tab is-on">Content</button>
            </div>

            <div class="mmm-body">

                <div class="mmm-toggle-row">
                    <div class="mmm-tgl-text">
                        <strong>Enable the Mega Menu.</strong>
                        <span id="mmm-tgl-sub">It is currently disabled.</span>
                    </div>
                    <label class="mmm-switch">
                        <input type="checkbox" id="mmm-toggle" />
                        <span class="mmm-slider"></span>
                    </label>
                </div>

                <div class="mmm-badge" id="mmm-badge"></div>

                <!-- ✅ ELEMENTOR BUTTON -->
                <div style="margin-top:15px;">
                    <button type="button"
                        class="button button-primary mmm-edit-elementor"
                        data-item-id="${itemId}">
                        Edit Mega Menu (Elementor)
                    </button>
                </div>
<div id="mmm-elementor-wrap" style="display:none; margin-top:15px;">
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
    <strong>Elementor Editor</strong>
    <button id="mmm-back" class="button">← Back</button>
</div>

<iframe id="mmm-elementor-frame"
    style="width:100%; height:600px; border:1px solid #ccc; border-radius:6px;">
</iframe>
</div>
            </div>
        </div>
    </div>
    `;

        $('body').append(html);

        // Set initial checkbox state and button disabled state
        $('#mmm-toggle').prop('checked', state.enabled);
        $('.mmm-edit-elementor').prop('disabled', !state.enabled).css('opacity', state.enabled ? '1' : '0.5').css('cursor', state.enabled ? 'pointer' : 'not-allowed');
    }

    function bindAll() {

        $(document).on('click', '.mmm-open-btn', function (e) {
            e.preventDefault();
            e.stopPropagation();

            state.itemId = $(this).data('item-id');
            state.enabled = $(this).data('enabled') == 1;

            buildModal(state.itemId); // ✅ FIX

            var label = $(this).closest('.menu-item').find('.edit-menu-item-title').first().val()
                || $(this).closest('.menu-item').find('.menu-item-title').first().text().trim()
                || 'Item #' + state.itemId;

            openModal(label);
        });

        $(document).on('click', '#mmm-close', closeModal);

        $(document).on('click', '#mmm-overlay', function (e) {
            if ($(e.target).is('#mmm-overlay')) closeModal();
        });

        $(document).on('change', '#mmm-toggle', function () {
            var isChecked = $(this).is(':checked');
            doToggle(isChecked);
            // Enable/disable edit button based on checkbox
            $('.mmm-edit-elementor').prop('disabled', !isChecked).css('opacity', isChecked ? '1' : '0.5').css('cursor', isChecked ? 'pointer' : 'not-allowed');
        });

        // ✅ BACK BUTTON
        $(document).on('click', '#mmm-back', function () {

            // iframe clear
            $('#mmm-elementor-frame').attr('src', '');

            // iframe hide
            $('#mmm-elementor-wrap').hide();

            // normal UI show
            $('.mmm-toggle-row').show();
            $('#mmm-badge').show();
            $('.mmm-edit-elementor').show();

        });
        // ✅ ELEMENTOR CLICK (new tab open)
        $(document).on('click', '.mmm-edit-elementor', function () {

            // Prevent click if button is disabled
            if ($(this).prop('disabled')) {
                return false;
            }

            var itemId = $(this).data('item-id');
            console.log('Edit button clicked, itemId:', itemId);

            // Open a blank new tab/window immediately (synchronous)
            var newTab = window.open('', '_blank');
            console.log('New tab opened:', newTab);

            $.post(mmmAdmin.ajaxUrl, {
                action: 'mmm_get_elementor_template',
                nonce: mmmAdmin.nonce,
                item_id: itemId
            }, function (res) {
                console.log('AJAX response:', res);

                if (res.success) {
                    // Set the URL in the already-opened tab
                    newTab.location = res.data.edit_url;
                    console.log('Set location to:', res.data.edit_url);
                } else {
                    alert('Elementor open error');
                    newTab.close(); // Close the blank tab if there's an error
                }

            }).fail(function (xhr, status, error) {
                console.log('AJAX failed:', status, error);
                alert('AJAX request failed');
                if (newTab) newTab.close();
            });

        });
    }

    function openModal(label) {
        $('#mmm-title').text(label);
        $('#mmm-overlay').addClass('is-open');
        $('body').css('overflow', 'hidden');
    }

    function closeModal() {
        $('#mmm-overlay').removeClass('is-open');
        $('body').css('overflow', '');
    }

    function doToggle(enabled) {
        state.enabled = enabled;

        // Update hidden input so menu save keeps the current toggle state.
        var button = $('.mmm-open-btn[data-item-id="' + state.itemId + '"]');
        var hidden = $('input.mmm-enabled-val[name="mmm_enabled[' + state.itemId + ']"]');
        hidden.val(enabled ? '1' : '0');
        button.data('enabled', enabled ? 1 : 0);
        button.toggleClass('mmm-active', enabled);
        button.html(enabled ? '&#9776; Mega Menu &#10003;' : '&#9776; Mega Menu');

        $.post(mmmAdmin.ajaxUrl, {
            action: 'mmm_toggle',
            nonce: mmmAdmin.nonce,
            item_id: state.itemId,
            enabled: enabled ? '1' : '0'
        });
    }

})(jQuery);