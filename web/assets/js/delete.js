/**
 * Created by ekiscrim on 11/04/17.
 */
$(document).ready(function() {
    $('.borrar').click(function() {
        if (confirm("¿Estás seguro de borrar esta entrada?"))
        {
            var id = $(this).attr('id');
            var data = 'id=' + id;
            var parent = $(this).parent();

            $.ajax(
                {
                    type: "POST",
                    url: "/delete",
                    data: data,
                    cache: false,

                    success: function () {
                        parent.fadeOut('slow', function () {
                            $(this).remove();
                        });

                    }
                });
        }
    });
});