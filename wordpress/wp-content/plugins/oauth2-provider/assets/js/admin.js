(function ($) {

    /** intiate jQuery tabs */
    $("#wo_tabs").tabs({
        beforeActivate: function (event, ui) {
            var scrollTop = $(window).scrollTop();
            window.location.hash = ui.newPanel.selector;
            $(window).scrollTop(scrollTop);
        }
    });

    $('.user_type_ahead').typeahead({
        ajax: ajaxurl + '?action=wo_users_type_ahead',
        timeout: 500,
        displayField: "user_id_options",
        triggerLength: 1,
        method: "get",
        loadingClass: "loading-circle",
        preDispatch: function (query) {
            showLoadingMask(true);
            console.log(query);

            return {
                search: query
            }
        },
        preProcess: function (data) {

            console.log(data);
            showLoadingMask(false);
            if (data.success === false) {
                return false;
            }

            console.log(data.mylist);
            return data.mylist;
        }
    });

    $('.chosen-search-select').chosen();

})(jQuery);

/**
 * [wo_remove_client description]
 * @param  {[type]} client_id [description]
 * @return {[type]}           [description]
 */
function wo_remove_client(client_id) {

    // Ask the user
    if (!confirm('Are you sure you want to delete this client?')) {
        return;
    }

    var data = {
        'action': 'wo_remove_client',
        'data': client_id
    };

    // listen back for JSON and change the secret then show it.
    jQuery.post(ajaxurl, data, function (response) {
        if (response != '1') {
            alert(response);
        } else {
            jQuery("#record_" + client_id + "").remove();
        }
    });
}

/**
 * [wo_regenerate_secret description]
 * @param  {[type]} client_id [description]
 * @return {[type]}           [description]
 */
function wo_regenerate_secret(client_id) {

    // Only preform the action if the user understands
    if (!confirm("Are you sure you want to regenerate the secret? Any clients connected using this client id will be disconnected until they have the new secret.")) {
        return;
    }

    var data = {
        'action': 'wo_regenerate_secret',
        'data': client_id
    };

    // Change the content of the secret
    jQuery('#show_secret_' + client_id + ' h3').text('Regenerating...');
    jQuery.post(ajaxurl, data, function (response) {
        var obj = jQuery.parseJSON(response);
        if (obj.error) {
            alert(obj.error_description);
        } else {
            jQuery('#show_secret_' + client_id + ' h3').text(obj.new_secret);
            alert('Generated Client Secret Successful.');
            //jQuery("#record_" + client_id + "").remove();

        }
    });

}

/**
 * Update a Client
 * @param  {[type]} form [description]
 * @return {[type]}      [description]
 */
function wo_update_client(form) {
    alert('Submit the form');
}