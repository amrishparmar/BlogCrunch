$(document).ready(function() {
    // hide the success message if it is empty, otherwise show
    var $error = $('.error');
    if ($error.html() == '') {
        $error.hide();
    }
    else {
        $error.show();
    }

    // hide the success message if it is empty, otherwise show
    var $success = $('.success');
    if ($success.html() == '') {
        $success.hide();
    }
    else {
        $success.show();
    }
});