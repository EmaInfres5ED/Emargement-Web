$(document).ready(function(){
    $('.start_date').datepicker({
        todayHighlight : true,
        language : 'fr',
        daysOfWeekDisabled : [0,6]
    });
    $('.end_date').datepicker({
        todayHighlight : true,
        language : 'fr',
        daysOfWeekDisabled : [0,6]
    });

    $('.combobox').combobox();
});