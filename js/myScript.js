/**
 * Created by lenik on 2/19/2016.
 */
$(document).ready(function () {
    $('#firstname').keyup(function () {
        $.get('includes/autocomplete.php',
            {firstname: $(this).val()},
            function (data) {
                $('#dataListNames').empty();
                $("#dataListNames").html(data);
            })
    });


});