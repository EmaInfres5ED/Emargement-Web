$(document).ready(function(){
    function refreshNotifications() {
        $.ajax({
            type: "POST",
            url: $('ul.alert-dropdown').data('url'),
            cache: false,
            success: function(json){
                $('li.notification-item').remove();
                if (json.length === 0) {
                    $('div.notificationHeader').after(
                        '<li class="notification-item">' +
                            '<a href="#">Aucune notification</a>' +
                        '</li>' +
                        '<li class="divider"></li>'
                    );
                }
                for (var i = 0; i < json.length; i++) {
                    $('div.notificationHeader').after(
                        '<li class="notification-item">' +
                            '<a href="' + $('ul.alert-dropdown').data('url-show') + json[i].id + '">' + json[i].content + '</a>' +
                        '</li>' +
                        '<li class="divider"></li>'
                    );
                }
                $('span.badge-info').empty().append(json.length);
            }
        });
    }
    refreshNotifications();

    $('a.notificationHeaderLink').click(function () {
        $.ajax({
            type: "POST",
            url: $(this).data('url'),
            cache: false,
            success: function (json) {
                if (json.type === "success") {
                    $(".flash-message")
                        .empty()
                        .append("<div class=\"alert alert-success\"><em>Succès</em>: " + json.message + "</div>");
                    refreshNotifications();
                    $('li.dropdown.open a.dropdown-toggle').click();
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
