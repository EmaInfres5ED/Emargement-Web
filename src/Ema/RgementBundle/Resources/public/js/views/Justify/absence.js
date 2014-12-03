$(document).ready(function(){
    $('.combobox').combobox().on("change", function () {
        if ($(this).val() !== "") {
            var id = $(this).val();

            $.ajax({
                type: 'POST',
                dataType: "json",
                url: $('.justify-checkboxes').data('url'),
                data: {
                    'studentId': id,
                },
                success: function(result) {
                    var hidden = null;
                    if ($('.hidden-absence').val() != null ) {
                        hidden = $('.hidden-absence').val();
                    }
                    $('.justify-checkboxes').empty();
                    for (var i=0; i<result.length; i++) {
                        var checkbox =
                            '<div class="checkbox">' +
                                '<label>' +
                                    '<input name="absenceId[]" value="' + result[i].id + '" type="checkbox"/>' +
                                    'Absence du ' + result[i].startDate + ' au ' + result[i].endDate +
                                '</label>' +
                            '</div>';

                        $('.justify-checkboxes').append(checkbox);
                    }
                    if (hidden !=  null) {
                        $('.justify-checkboxes input[value="' + hidden + '"]').prop('checked', true);
                    }
                }
            });
        }
    });
    $('.combobox').trigger('change');
});
