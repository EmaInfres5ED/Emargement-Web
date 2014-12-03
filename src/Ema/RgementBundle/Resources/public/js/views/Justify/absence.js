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
                    $('.justify-checkboxes').empty();
                    for (var i=0; i<result.length; i++) {
                        var checkbox =
                            '<div class="checkbox">' +
                                '<label>' +
                                    '<input value="' + result[i].id + '" type="checkbox">' +
                                    'Absence du ' + result[i].startDate + ' au ' + result[i].endDate +
                                '</label>' +
                            '</div>';

                        $('.justify-checkboxes').append(checkbox);
                    }
                }
            });
        }
    });
});
