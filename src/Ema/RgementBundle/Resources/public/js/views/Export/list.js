$(document).ready(function(){
    var reportsTable = null;
    $('.start-date').datepicker({
        todayHighlight : true,
        language : 'fr',
        daysOfWeekDisabled : [0,6]
    }).on('changeDate', function(e){
        reportsTable.fnReloadAjax();
    });

    $('.end-date').datepicker({
        todayHighlight : true,
        language : 'fr',
        daysOfWeekDisabled : [0,6]
    }).on('changeDate', function(e){
        reportsTable.fnReloadAjax();
    });

    $('.combobox').combobox().on("change", function () {
        if ($(this).val() !== "") {
            reportsTable.fnReloadAjax();
        }
    });

    reportsTable = $('table.reports').dataTable({
        "aoColumns": [
            {"mData": "firstName"},
            {"mData": "lastName"},
            {"mData": "absencesCount"},
            {"mData": "retardsCount"},
            {"mData": "actionUrl"}
        ],
        "bServerSide": false,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "sAjaxSource": $('table.reports').data('url'),
        "aaSorting": [[0, 'asc']],
        "fnServerParams": function (aoData) {
            aoData.push(
                {"name": "from", "value": $(".start-date").val()},
                {"name": "to", "value": $(".end-date").val()},
                {"name": "promoId", "value": $('select.promo.combobox').val()}
            );
        },
        "fnCreatedRow": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            return nRow;
        }
    });
});