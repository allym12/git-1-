function getAcceptHeader(uri, accept = null){
    if (accept === 'json') {
        return 'application/json';
    } else if (accept === 'html') {
        return 'text/html, application/xhtml+xml, text/plain, */*';
    } else if (accept) {
        return accept;
    } else if (uri.startsWith('/ajax/')) {
        return '*/*';
    } else if (uri.startsWith('/api/v1/embedd')) {
        return 'text/html, application/xhtml+xml, text/plain, */*';
    } else if (uri.startsWith('/api/') || uri.startsWith('/oauth/') || uri.startsWith('/session/')) {
        return 'application/json';
    } else {
        return '*/*';
    }
}

function doAjaxCall(uri, method = 'GET', input = [], onSuccess = null, acceptType = null, onFailure = null) {
    $.ajax({
        url: uri,
        type: method,
        data: input,
        processData: false,
        contentType: false,
        headers: {
            Accept: getAcceptHeader(uri, acceptType),
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    })
    .done(function (data, responseText, jqXHR) {
        if (onSuccess !== null) {
            onSuccess(data, responseText, jqXHR)
        }
    })
    .fail(function (jqXHR, errorType, thrownError) {
        if (onFailure !== null) {
            onFailure(jqXHR, errorType, thrownError);
        }

        handleApiCallError(uri, method, input, jqXHR, errorType, thrownError);
    });
}

function escapeHtml(text)
{
    if (text == null)
        return '';

    return String(text)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;")
        .replace(/(?:\r\n|\r|\n)/g, "<br />");
}

function handleApiCallError(uri, method, input, jqXHR, errorType, thrownError, suppressErrorMessage = null) {
    console.log('call to ' + method + '@' + uri + ' failed: ' + thrownError);

    var json = null;
    if (jqXHR.responseJSON) {
        json = jqXHR.responseJSON;
    } else {
        try {
            json = JSON.parse(jqXHR.responseText);
        } catch (err) {
            json = null;
        }
    }

    console.log('failed request-id is ' + jqXHR.getResponseHeader('x-request-id'));
    if (json) {
        console.log(json);
    } else {
        console.log(jqXHR.responseText);
    }

    if (Number.isInteger(suppressErrorMessage))
        suppressErrorMessage = jqXHR.status === suppressErrorMessage;

    if (!suppressErrorMessage)
        showErrorMessageBox(extract_error_message(json, thrownError));
}

function extract_error_message(data, thrownError)
{
    if (data?.error?.message) {
        let message = escapeHtml(data.error.message);

        if (data.error.field_errors) {
            message += '<br />';
            for (let [key, value] of Object.entries(data.error.field_errors)) {
                message += '<br /><span style="font-weight: bold;">' + escapeHtml(key) + '</span>: ' + escapeHtml(Array.isArray(value) ? value.join("\n") : value);
            }
        }

        return message;

    } else {
        return thrownError;
    }
}

function showErrorMessageBox(messageHtml) {
    $(".display_ajax_call_error").modal('show');
    $("#display_ajax_call_error_message").html(messageHtml);
}

function showPdf(pdfData, filename = null) {
    var pdf = new Blob([pdfData], {type: 'application/pdf'});

    if (window.navigator && window.navigator.msSaveOrOpenBlob) {
        // IE special
        window.navigator.msSaveOrOpenBlob(pdf);
        return;
    }

    var url = window.URL || window.webkitURL;
    var link = url.createObjectURL(pdf);
    var tag = document.createElement('a');
    tag.href = link;
    tag.download = filename ? filename : 'download.pdf';
    tag.click();

    // Firefox needs a delay
    setTimeout(function() {
        url.revokeObjectURL(tag);
    }, 100);
}

function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

function getFileNameFromJqXHR(jqXHR){
    // assume it is an object with prototype jqXHR
    filename = jqXHR.getResponseHeader('Content-Disposition')?.match(/name=["']?([^;"']+)["']?($|;)/)[1];

    if ((filename === null)
        || (typeof filename === 'undefined')) {
        filename = 'download.pdf';
    }

    return filename;
}

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}

// <FileUpload>
function file_upload_delete(name)
{
    let remove_input = $('input[name="' + name + '_remove"]');
    let new_file_input = $('.file-upload[data-name="' + name + '"] input[type=file]');
    let new_filename = new_file_input.val();

    if (new_filename) {
        remove_input.val(null);
        new_file_input.val(null);

    } else {
        let remove = Boolean(remove_input.val());

        remove_input.val(remove ? null : 1);
    }

    file_upload_show(name);
}

function file_upload_show(name)
{
    let input = $('.file-upload[data-name="' + name + '"]');
    let anchor = input.find('a.custom-file-name');
    if (anchor.length < 1)
        return undefined;

    let show_para = input.find('.custom-file-labelpara');
    let new_filename = input.find('input[type=file]').val();

    let current_node = input.find('.custom-file-current');
    let current_filename = current_node.data('value');
    let current_filename_uri = current_node.data('uri');

    let remove = Boolean($('input[name="' + name + '_remove"]').val());

    let hide = !Boolean(current_filename) && !Boolean(new_filename);

    show_para.toggle(!hide);
    if (!hide)
        anchor
            .text(new_filename ? new_filename.split('\\').pop().split('/').pop() : current_filename)
            .css('text-decoration', (remove ? 'line-through' : ''))
            .attr('href', !Boolean(new_filename) ? current_filename_uri : null)
            .attr('title', remove ? localized.file_upload.will_be_deleted : (Boolean(new_filename) ? localized.file_upload.will_be_uploaded : localized.file_upload.click_to_download))
            .attr('data-original-title', '')
            .attr('data-toggle', 'tooltip')
}

$(document).ready(() => {
    $('.file-upload input.custom-file-input').on('change', (event) => {
        let name = $(event.target).attr('name');

        let new_filename = $('.file-upload[data-name="' + name + '"] input[type=file]').val();

        if (new_filename)
            $('input[name="' + name + '_remove"]').val(null);

        file_upload_show(name);
    }).each(function () {
        file_upload_show($(this).attr('name'));
    });

    $('.file-upload button.custom-file-delete').on('click', (event) => {
        file_upload_delete($(event.target).closest('button').parent().parent().data('name'));
    });
});
// </FileUpload>
