window.setInterval(function(){
    (function ($) {
        var scan = $('#edit-scanner').val();
        if (scan.length > 9) {
            var boxId = "#edit-order-checklist-" + scan.toLowerCase();
            if($(boxId).length == 0) {
                $('#good').trigger('play');
                alert("You entered an item that is not in this order");
                $('#edit-scanner').val("");
            } else if ($(boxId).is(":checked")) {
                $('#good').trigger('play');
                alert("This item was already scanned");
                $('#edit-scanner').val("");
            } else {
                $(boxId).prop('checked', true);
                $('#bad').trigger('play');
                $(boxId).closest('tr').addClass('checked');
                $('#edit-scanner').val("");
            }
        }
    })(jQuery);
}, 500);

(function ($) {

    // stop "enter" key from triggering form
    $('input,select').keypress(function(event) { return event.keyCode != 13; });

    // add "checked" class when button clicked manually
    $('input:checkbox').click(function() {
        if ($(this).prop('checked')) {
            $(this).closest('tr').addClass('checked');
        } else {
            $(this).closest('tr').removeClass('checked');
        }
    });

    //set focus to input field
    $("#edit-scanner").focus();

})(jQuery);

