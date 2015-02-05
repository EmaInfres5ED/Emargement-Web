$(document).ready(function(){
    $('a.saw-notification-button').click(function () {
        var that = this;
        $.ajax({
            type: "POST",
            url: $(this).data('url'),
            cache: false,
            success: function (json) {
                if (json.type === "success") {
                    $(".flash-message")
                        .empty()
                        .append("<div class=\"alert alert-success\"><em>Succès</em>: " + json.message + "</div>");
                    $(that).remove();
                    var bagdeNumber = $('.badge.badge-info').html()*1 - 1;
                    $('.badge.badge-info').empty().append(bagdeNumber);
                } else {
                    $(".flash-message")
                        .empty()
                        .append("<div class=\"alert alert-error\"><em>Erreur</em>: " + json.message + "</div>");
                }
            }
        });
        return false;
    });
});
