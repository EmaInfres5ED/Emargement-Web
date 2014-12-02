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

    $('table.reports').dataTable({
        "aoColumns": [
            {"mData": "firstName"},
            {"mData": "lastName"},
            {"mData": "absencesCount"},
            {"mData": "retardsCount"},
            {"mData": null}
        ],
        "bServerSide": false,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "sAjaxSource": $('table.reports').data('url'),
        "aaSorting": [[0, 'asc']],
        "fnCreatedRow": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            return nRow;
        }
    });
});