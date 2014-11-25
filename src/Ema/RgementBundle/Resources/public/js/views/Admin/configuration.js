$(document).ready(function(){
    $("#refreshCourses").click(function() {
        $.ajax({
            type: "POST",
            url: $(this).data('url'),
            cache: false,
            success: function(json){
                console.log(json);
                if(json.type == "success") {
                    $(".flash-message").append("<div class=\"alert alert-success\"><em>Succès</em>: " + json.message + "</div>");
                } else {
                    $(".flash-message").append("<div class=\"alert alert-error\"><em>Erreur</em>: " + json.message + "</div>");
                }
            }
        });
    });

    $("#refreshStudentsPromos").click(function() {
        var that = this;
        $.ajax({
            type: "POST",
            url: $(this).data('url'),
            cache: false,
            success: function(json){
                console.log(json);
                if(json.type == "success") {
                    $(".flash-message").append("<div class=\"alert alert-success\"><em>Succès</em>: " + json.message + "</div>");
                } else {
                    $(".flash-message").append("<div class=\"alert alert-danger\"><em>Erreur</em>: " + json.message + "</div>");
                }
            }
        });
    });
})
