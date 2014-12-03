$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: $('ul.alert-dropdown').data('url'),
        cache: false,
        success: function(json){
            if (json.length === 0) {
                $('div.notificationHeader').after(
                    '<li>' +
                        '<a href="#">Aucune notification</a>' +
                    '</li>' +
                    '<li class="divider"></li>'
                );
            }
            for (var i = 0; i < json.length; i++) {
                $('div.notificationHeader').after(
                    '<li>' +
                        '<a href="' + $('ul.alert-dropdown').data('url-show') + json[i].id + '">' + json[i].content + '</a>' +
                    '</li>' +
                    '<li class="divider"></li>'
                );
            }
            $('span.badge-info').empty().append(json.length);
        }
    });
});
