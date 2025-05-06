var table;
var SUBPRIMARYID = 0;
jQuery(function () {
    get_data();
    $(".table-filter-data").on('click', function(){
        $(".table-filter-data").removeClass('active');
        $(this).addClass('active');
    });
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
            { data: 'name', name: 'name', width: "15%" },
            { data: 'device_owner', name: 'device_owner', width: "15%" },
            { data: 'service_number', name: 'service_number', width: "10%" },
            { data: 'remark', name: 'remark', width: "25%" },
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    var details ='';
                    if(row.status == 1)
                    {
                        details = "<h4 class='m-0'><span class='badge bg-primary-lighten badge-outline-primary'>Upload</span></h4>";
                    }
                    else if(row.status == 2)
                    {
                        details = "<h4 class='m-0'><span class='badge bg-warning-lighten badge-outline-warning'>In Review</span></h4>";
                    }
                    else if(row.status == 3)
                    {
                        details = "<h4 class='m-0'><span class='badge bg-success-lighten badge-outline-success'>Live</span></h4>";
                    }
                    else if(row.status == 4)
                    {
                        details = "<h4 class='m-0'><span class='badge bg-danger-lighten badge-outline-danger'>Suspended</span></h4>";
                    }
                    return details;
                }, name: 'logo', width: "20%"
            },
        ],
        "columnDefs": [{
            "targets": 6,
            "className": "text-end",
            "data": "id",
            "width": "15%",
            "render": function (data, type, row, meta) {
                var rowid="'"+row.id+"'";
                var html='';
                if(editright == 1)
                {
                    html+='<button class="btn tbl-btn" onclick="edit_slider(' + meta.row + ')"><i class="fa-solid fa-pen"></i></button>';
                }
                if(deleteright == 1)
                {
                    html+='<button class="btn tbl-btn" onclick="delete_record(' + rowid + ')"><i class="fa-regular fa-trash-can"></i></button>';
                }
                return type === 'display' ? html: "";
            }
        }]
    });
    $(".extra-option").css('right', ($("#datatable_filter label").width() + 50)+'px');
    $("#extra_option").on('change', async function(){
        await table.clearPipeline().draw();
    });
}
if($('#'+FORMNAME).length){		
    $('#'+FORMNAME).validate({
        rules:{
            name:{
                required: true,			
            },
            device_owner:{
                required: true,			
            },
            service_number:{
                required: true,			
            },
        },messages:{
            name:{
                required:"name is required",
            },
            device_owner:{
                required:"device_owner is required",
            },
            service_number:{
                required:"service number is required",
            },
        },
        submitHandler: function(form){
            showLoading();
            var req_data = {
                op: CURRENT_PAGE
                , action: "add_data"
                , name: $('#name').val()
                , device_owner: $('#device_owner').val()
                , service_number: $('#service_number').val()
                , remark: $('#remark').val()
                , status: $("[name='status']:checked").val()
                , formevent: $('#formevent').val()
                , id: $('#id').val()
            };
            doAPICall(req_data, async function(data){
                if (data && data != null && data.success == true) {
                    changeView('details');
                    showMessage(data.message);
                    resetValidation(FORMNAME);
                    hideLoading();
                    await table.clearPipeline().draw();
                    return false;
                }
                else if (data && data != null && data.success == false) {
                    hideLoading();
                    showError(data.message);
                    return false;
                }
            });
        },
    });
}

function edit_slider(index) {
    if (TBLDATA.length > 0) {
        CURRENT_DATA = TBLDATA[index];
        $('#id').val(CURRENT_DATA.id);
        $('#name').val(CURRENT_DATA.name);
        $('#device_owner').val(CURRENT_DATA.device_owner);
        $('#service_number').val(CURRENT_DATA.service_number);
        $('#remark').val(CURRENT_DATA.remark);
        $("[name='status'][value='"+CURRENT_DATA.status+"'").prop('checked', true);
        $('#formevent').val('update');
        changeView('form', true);
    }
}
