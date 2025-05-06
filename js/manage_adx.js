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
            { data: 'name', name: 'name', width: "90%" },
        ],
        "columnDefs": [{
            "targets": 2,
            "className": "text-end",
            "data": "id",
            "width": "10%",
            "render": function (data, type, row, meta) {
                var rowid="'"+row.id+"'";
                var html='';
                if(editright == 1)
                {
                    html+='<button class="btn tbl-btn" onclick="edit_adx(' + meta.row + ')"><i class="fa-solid fa-pen"></i></button>';
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
        },messages:{
            name:{
                required:"name is required",
            },
        },
        submitHandler: function(form){
            showLoading();
            var req_data = {
                op: CURRENT_PAGE
                , action: "add_data"
                , name: $('#name').val()
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

function edit_adx(index) {
    if (TBLDATA.length > 0) {
        CURRENT_DATA = TBLDATA[index];
        $('#id').val(CURRENT_DATA.id);
        $('#name').val(CURRENT_DATA.name);
        $('#formevent').val('update');
        changeView('form', true);
    }
}
