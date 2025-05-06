var table;
var SUBPRIMARYID = 0;
jQuery(function () {
    get_data();
});
function resetform(){
    $('#formevent').val('submit');
}

function get_data() {
    table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        fixedHeader: true,
        pagingType: "full_numbers",
        responsive: !0,
        language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" } },
        drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
        ajax: $.fn.dataTable.pipeline({
            url: API_SERVICE_URL,
            pages: 1, // number of pages to cache
            op: CURRENT_PAGE,
            action: "get_data"
        }),
        columns: [
            { data: 'id', name: 'id', "width": "0%", className: "d-none" },
            { data: 'app_code', name: 'app_code', width: "10%" },
            {
                data: 'file',
                orderable: false,
                render: function (data, type, row) {
                    var details ='';
                    if(row.file)
                    {
                        details = "<a href='" + WEB_API_FOLDER + row.file + "' target='_blank'><img class='dataTable-app-img' src='" + WEB_API_FOLDER + row.file + "'></a>";
                    }
                    return details;
                }, name: 'logo', width: "5%", className: "tbl-img"
            },
            {
                data: 'name',
                render: function (data, type, row) {
                    var details ='';
                    details = "<div>"+ row.app_name +"</div>";
                    if(row.package_name)
                    {
                        details+= "<div>"+ row.package_name +"</div>";
                    }
                    if(row.playstore)
                    {
                        details+= "<div>"+ row.playstore_name +"</div>";
                    }
                    return details;
                }, name: 'logo', width: "20%", className: ""
            },
            { data: 'adx_name', name: 'adx_name', width: "15%" },
            { data: 'status', name: 'status', width: "5%", orderable: false },
            { data: 'status', name: 'status', width: "5%", orderable: false },
            { data: 'status', name: 'status', width: "5%", orderable: false },
            { data: 'notes', name: 'notes', width: "15%", orderable: false },
            { data: 'days', name: 'entry_date', width: "10%" },
        ],
        "columnDefs": [{
            "targets": 10,
            "className": "text-end",
            "data": "id",
            "width": "10%",
            "render": function (data, type, row, meta) {
                var rowid="'"+row.id+"'";
                var html='';
                if(editright == 1)
                {
                    html+='<button class="btn tbl-btn" onclick="restore(' + rowid + ')"><i class="fa-solid fa-rotate"></i></button>';
                }
                if(deleteright == 1)
                {
                    html+='<button class="btn tbl-btn" onclick="delete_record(' + rowid + ')"><i class="fa-regular fa-trash-can"></i></button>';
                }
                return type === 'display' ? html: "";
            }
        }]
    });
}

function restore(id){
    PRIMARY_ID = id;
    $("#restore_modal").modal('show');
}

function restore_current_record(){
    showLoading();
    var req_data = {
        op: CURRENT_PAGE
        , action: "restore"
        , id: PRIMARY_ID
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            hideLoading();
            await table.clearPipeline().draw();
            showMessage(data.message);
            PRIMARY_ID = 0;
            return false;
        }
        else if (data && data != null && data.success == false) {
            hideLoading();
            showError(data.message);
            PRIMARY_ID = 0;
            return false;
        }
    });
}