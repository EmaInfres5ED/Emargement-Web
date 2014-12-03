$(document).ready(function(){
    var reportsTable = null;

    reportsTable = $('table.justify').dataTable({
        "aoColumns": [
            {"mData": "firstName"},
            {"mData": "lastName"},
            {"mData": "startDate"},
            {"mData": "endDate"},
            {"mData": "actionUrl", 'sWidth' : '80px', 'bSortable' : false}
        ],
        "bServerSide": false,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 10,
        "sAjaxSource": $('table.justify').data('url'),
        "aaSorting": [[0, 'asc']],
        "fnCreatedRow": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $('td:eq(4)', nRow).empty().html($('<input>', {
                class: 'btn btn-primary form-control export-btn',
                type: 'button',
                value : 'Justifier'
            }).click(function() {
                window.location = aData.actionUrl;
            }));
            return nRow;
        }
    });
});
