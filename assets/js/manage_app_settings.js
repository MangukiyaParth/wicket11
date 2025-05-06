var table;
var subView = 1;
var is_bifurcate = 0;
var extra_setting_fields = [];
var extra_bifurcate_setting_fields = [];
var appData = [];
var OrgData = [];
var MrktData = [];
var OrgAdData = [];
var OrgBifurcateData = [];
var MrktAdData = [];
var MrktBifurcateData = [];
jQuery(function () {
    PRIMARY_ID = localStorage.getItem('primary_id');
    if($(".button-toggle-menu-mobile:visible").length > 0){  $("#main_page_data").css('padding-top', '140px'); }
    // manageDataFilter(false);
    changeSubView(1, false);
    manageDefaultInit();
    fill_app_details();
    get_user_data();
});

async function manageDataFilter(resetDatatable = true){
    var time_filter = $("#time_filter").val();
    var filt = {
        "time_filter": time_filter,
        "sub_view": subView,
        "app_id": PRIMARY_ID
    }
    $("#extra_option").val(JSON.stringify(filt));
    if(resetDatatable) { await table.clearPipeline().draw(); }
}

async function set_is_bifurcate(val = 0){
    is_bifurcate = val;
}


//================= Initial Functions =================
function fill_app_details(){
    showLoading();
    var req_data = {
        op: CURRENT_PAGE
        , action: "get_data"
        , id: PRIMARY_ID
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success) {
            hideLoading();
            appData = data.data;
            setDataVariable(data);
            var logo_url = (appData.file.includes("upload/")) ? WEB_API_FOLDER + appData.file : appData.file;
            var html = `<div class="app-title-div">
                            <div class="app-title">
                                <img class="app-heading-img" src="${logo_url}" />
                                <div class="app-details-div">
                                    <h4>${appData.app_name}</h4>
                                    <h5>${appData.package_name}</h5>
                                </div>
                            </div>
                            <div class="app-action">
                                <a class="btn btn-warning organic-view-btn" href="javascript:void(0)" onclick="getAppSettings(1)">Organic</a>
                                <a class="btn btn-outline-warning marketing-view-btn" href="javascript:void(0)" onclick="getAppSettings(2)">Marketing</a>
                            </div>
                        </div>`;
            $(".page-name").html(html);
            return false;
        }
        else if (data && data != null && !data.success) {
            hideLoading();
            showError(data.message);
            return false;
        }
    });
}

function setDataVariable(data){
    OrgData = data.org_data;
    MrktData = data.mrkt_data;
    OrgAdData = data.org_ad;
    OrgBifurcateData = data.org_bifurcate_ad;
    MrktAdData = data.mrkt_ad;
    MrktBifurcateData = data.mrkt_bifurcate_ad;
}

function changeSubView(v, resetDatatable = true){
    subView = v;
    if(v==1){
        manageDataFilter(resetDatatable);
        $(".sub-view-btn").addClass('btn-light').removeClass('btn-outline-soft-warning');
        $(".user-view-btn").removeClass('btn-light').addClass('btn-outline-soft-warning').blur();
        $(".setting-div").addClass('d-none');
        $(".user-div, .data-extra-filter").removeClass('d-none');
    }
    else if(v==2){
        manageDataFilter(resetDatatable);
        $(".sub-view-btn").addClass('btn-light').removeClass('btn-outline-soft-warning');
        $(".retention-view-btn").removeClass('btn-light').addClass('btn-outline-soft-warning').blur();
        $(".setting-div").addClass('d-none');
        $(".user-div, .data-extra-filter").removeClass('d-none');
    }
    else if(v==3){
        $(".sub-view-btn").addClass('btn-light').removeClass('btn-outline-soft-warning');
        $(".setting-o-view-btn").removeClass('btn-light').addClass('btn-outline-soft-warning').blur();
        $(".setting-div").removeClass('d-none');
        $(".user-div, .data-extra-filter").addClass('d-none');
        manageFormfields(1);
        manage_preview_clr(1);
        manageFormfields(2);
        manage_preview_clr(2);
        FillSettingData();
    }
    else{
        $(".sub-view-btn").addClass('btn-light').removeClass('btn-outline-soft-warning');
        $(".setting-m-view-btn").removeClass('btn-light').addClass('btn-outline-soft-warning').blur();
        $(".setting-div").removeClass('d-none');
        $(".user-div, .data-extra-filter").addClass('d-none');
        manageFormfields(1);
        manage_preview_clr(1);
        manageFormfields(2);
        manage_preview_clr(2);
        FillSettingData();
    }
}

function get_user_data() {
    table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        fixedHeader: true,
        pagingType: "full_numbers",
        responsive: !0,
        language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" } },
        drawCallback: function (res) {
            $(".tot-user").html(res.json.all_count);
            $(".org-user").html(res.json.org_count);
            $(".mrk-user").html(res.json.mrkt_count);
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded") 
        },
        ajax: $.fn.dataTable.pipeline({
            url: API_SERVICE_URL,
            pages: 1, // number of pages to cache
            op: CURRENT_PAGE,
            action: "get_user_data"
        }),
        columns: [
            { data: 'id', name: 'id', "width": "0%", className: "d-none" },
            { data: 'as', name: 'as', width: "5%" },
            { data: 'asname', name: 'asname', width: "5%" },
            { data: 'city', name: 'city', width: "5%" },
            { data: 'continent', name: 'continent', width: "5%" },
            { data: 'country', name: 'country', width: "5%" },
            { data: 'countryCode', name: 'countryCode', width: "5%" },
            { data: 'hosting', name: 'hosting', width: "5%" },
            { data: 'isp', name: 'isp', width: "10%" },
            { data: 'mobile', name: 'mobile', width: "5%" },
            { data: 'org', name: 'org', width: "5%" },
            { data: 'proxy', name: 'proxy', width: "5%" },
            { data: 'query', name: 'query', width: "5%" },
            { data: 'regionName', name: 'regionName', width: "5%" },
            { data: 'installerinfo', name: 'installerinfo', width: "5%" },
            { data: 'installerurl', name: 'installerurl', width: "5%" },
        ]
    });
    // $(".extra-option").css('right', ($("#datatable_filter label").width() + 50)+'px');
    $("#time_filter").on('change cancel.daterangepicker', function(){
        manageDataFilter();
    });
}

function manageDefaultInit(){
    $('#vpn_country').tagEditor({
        placeholder: 'Enter countries ...',
        forceLowercase: false
    });
    $('#bifurcate_location').tagEditor({
        placeholder: 'Enter location ...',
        forceLowercase: false
    });
    $('#bifurcate_vpn_country').tagEditor({
        placeholder: 'Enter countries ...',
        forceLowercase: false
    });

    manageFormfields(1);
    manage_preview_clr(1);
    manageFormfields(2);
    manage_preview_clr(2);
    
    $("#app_color, #app_background_color, #native_background_color, #native_text_color, #native_button_background_color, #native_button_text_color, #native_btn_text").on('input', function(){
        manage_preview_clr(1);
    });
    $("[name='native_btn'], [name='bottom_banner'], [name='list_native']").on("change", function(){
        manageFormfields(1);
        manage_preview_clr(1);
    });
    $("#ad .clr-picker").on('change', function(){
        manage_preview_clr(1);
    });

    $("#bifurcate_app_color, #bifurcate_app_background_color, #bifurcate_native_background_color, #bifurcate_native_text_color, #bifurcate_native_button_background_color, #bifurcate_native_button_text_color, #bifurcate_native_btn_text").on('input', function(){
        manage_preview_clr(2);
    });
    $("[name='bifurcate_native_btn'], [name='bifurcate_bottom_banner'], [name='bifurcate_list_native']").on("change", function(){
        manageFormfields(2);
        manage_preview_clr(2);
    });
    $("#bifurcate .clr-picker").on('change', function(){
        manage_preview_clr(2);
    });
}

function manageFormfields(type = 1){
    if(type == 1){
        if($("[name='native_btn']:checked").val() == "default"){
            $("#native_btn_text").val('');
            $("#native_btn_text").prop('readonly', true);
        }
        else{
            $("#native_btn_text").removeAttr('readonly');
        } 

        if($("[name='list_native']:checked").val() == "hide"){
            $("#list_native_cnt").val('');
            $("#list_native_cnt").prop('readonly', true);
        }
        else{
            $("#list_native_cnt").removeAttr('readonly');
        } 
    }
    else{
        if($("[name='bifurcate_native_btn']:checked").val() == "default"){
            $("#bifurcate_native_btn_text").val('');
            $("#bifurcate_native_btn_text").prop('readonly', true);
        }
        else{
            $("#bifurcate_native_btn_text").removeAttr('readonly');
        }

        if($("[name='bifurcate_list_native']:checked").val() == "hide"){
            $("#bifurcate_list_native_cnt").val('');
            $("#bifurcate_list_native_cnt").prop('readonly', true);
        }
        else{
            $("#bifurcate_list_native_cnt").removeAttr('readonly');
        } 
    }
}

function manage_preview_clr(type = 1){
    if(type == 1){
        var header_bg = $("#app_color").val();
        if(header_bg != "" && color_regex.test(header_bg)){
            $(".ad-mobile-div .mobile-header").css('background-color', header_bg);
        }
        var app_bg = $("#app_background_color").val();
        if(app_bg != "" && color_regex.test(app_bg)){
            $(".ad-mobile-div .mobile-footer").css('background-color', app_bg);
        }
        var native_bg = $("#native_background_color").val();
        if(native_bg != "" && color_regex.test(native_bg)){
            $(".ad-mobile-div .mobile-body").css('background-color', native_bg);
        }
        var native_text = $("#native_text_color").val();
        if(native_text != "" && color_regex.test(native_text)){
            $(".ad-mobile-div .mobile-body .Test-Ad-title").css('color', native_text);
            $(".ad-mobile-div .mobile-body .Test-Ad-subtitle").css('color', native_text);
        }
        var btn_bg = $("#native_button_background_color").val();
        if(btn_bg != "" && color_regex.test(btn_bg)){
            $(".ad-mobile-div .default-btn").css('background-color', btn_bg);
        }
        var btn_text = $("#native_button_text_color").val();
        if(btn_text != "" && color_regex.test(btn_text)){
            $(".ad-mobile-div .default-btn").css('color', btn_text);
        }
        var default_text_type = $("[name='native_btn']:checked").val();
        if(default_text_type == 'default'){
            $(".ad-mobile-div .default-btn").html('Defalut');
        }
        else {
            var default_text_manual = $("#native_btn_text").val();
            $(".ad-mobile-div .default-btn").html(default_text_manual);
        }

        if($("[name='bottom_banner']:checked").val() == "hide"){
            $(".ad-mobile-div .bottom-ad").addClass('d-none');
        }
        else if($("[name='bottom_banner']:checked").val() == "native"){
            $(".ad-mobile-div .bottom-ad").removeClass('d-none');
            $(".ad-mobile-div .bottom-ad").prop('src', ROOT_URL + 'assets/images/nativeBanner.jpg');
        }
        else if($("[name='bottom_banner']:checked").val() == "banner"){
            $(".ad-mobile-div .bottom-ad").removeClass('d-none');
            $(".ad-mobile-div .bottom-ad").prop('src', ROOT_URL + 'assets/images/banner.jpg');
        }
    }
    else {
        var header_bg = $("#bifurcate_app_color").val();
        if(header_bg != "" && color_regex.test(header_bg)){
            $(".bifurcate-mobile-div .mobile-header").css('background-color', header_bg);
        }
        var app_bg = $("#bifurcate_app_background_color").val();
        if(app_bg != "" && color_regex.test(app_bg)){
            $(".bifurcate-mobile-div .mobile-footer").css('background-color', app_bg);
        }
        var native_bg = $("#bifurcate_native_background_color").val();
        if(native_bg != "" && color_regex.test(native_bg)){
            $(".bifurcate-mobile-div .mobile-body").css('background-color', native_bg);
        }
        var native_text = $("#bifurcate_native_text_color").val();
        if(native_text != "" && color_regex.test(native_text)){
            $(".bifurcate-mobile-div .mobile-body").css('color', native_text);
        }
        var btn_bg = $("#bifurcate_native_button_background_color").val();
        if(btn_bg != "" && color_regex.test(btn_bg)){
            $(".bifurcate-mobile-div .default-btn").css('background-color', btn_bg);
        }
        var btn_text = $("#bifurcate_native_button_text_color").val();
        if(btn_text != "" && color_regex.test(btn_text)){
            $(".bifurcate-mobile-div .default-btn").css('color', btn_text);
        }
        var default_text_type = $("[name='bifurcate_native_btn']:checked").val();
        if(default_text_type == 'default'){
            $(".bifurcate-mobile-div .default-btn").html('Defalut');
        }
        else {
            var default_text_manual = $("#bifurcate_native_btn_text").val();
            $(".bifurcate-mobile-div .default-btn").html(default_text_manual);
        }

        if($("[name='bifurcate_bottom_banner']:checked").val() == "hide"){
            $(".bifurcate-mobile-div .bottom-ad").addClass('d-none');
        }
        else if($("[name='bifurcate_bottom_banner']:checked").val() == "native"){
            $(".bifurcate-mobile-div .bottom-ad").removeClass('d-none');
            $(".bifurcate-mobile-div .bottom-ad").prop('src', ROOT_URL + 'assets/images/nativeBanner.jpg');
        }
        else if($("[name='bifurcate_bottom_banner']:checked").val() == "banner"){
            $(".bifurcate-mobile-div .bottom-ad").removeClass('d-none');
            $(".bifurcate-mobile-div .bottom-ad").prop('src', ROOT_URL + 'assets/images/banner.jpg');
        }
    }
}

function FillSettingData(){
    let appSettingData = [];
    let adData = [];
    let adBifurcateData = [];
    if(subView == 3){
        appSettingData = OrgData;
        adData = OrgAdData;
        adBifurcateData = OrgBifurcateData;
    }
    else{
        appSettingData = MrktData;
        adData = MrktAdData;
        adBifurcateData = MrktBifurcateData;
    }

    $("#g1_percentage").val((appSettingData && appSettingData.g1_percentage) ? appSettingData.g1_percentage : '');
    $("#g2_percentage").val((appSettingData && appSettingData.g2_percentage) ? appSettingData.g2_percentage : '');
    $("#g3_percentage").val((appSettingData && appSettingData.g3_percentage) ? appSettingData.g3_percentage : '');
    $("#g1_account_name").val((appSettingData && appSettingData.g1_account_name) ? appSettingData.g1_account_name : '');
    $("#g2_account_name").val((appSettingData && appSettingData.g2_account_name) ? appSettingData.g2_account_name : '');
    $("#g3_account_name").val((appSettingData && appSettingData.g3_account_name) ? appSettingData.g3_account_name : '');
    $("#g1_banner").val((appSettingData && appSettingData.g1_banner) ? appSettingData.g1_banner : '');
    $("#g2_banner").val((appSettingData && appSettingData.g2_banner) ? appSettingData.g2_banner : '');
    $("#g3_banner").val((appSettingData && appSettingData.g3_banner) ? appSettingData.g3_banner : '');
    $("#g1_inter").val((appSettingData && appSettingData.g1_inter) ? appSettingData.g1_inter : '');
    $("#g2_inter").val((appSettingData && appSettingData.g2_inter) ? appSettingData.g2_inter : '');
    $("#g3_inter").val((appSettingData && appSettingData.g3_inter) ? appSettingData.g3_inter : '');
    $("#g1_native").val((appSettingData && appSettingData.g1_native) ? appSettingData.g1_native : '');
    $("#g2_native").val((appSettingData && appSettingData.g2_native) ? appSettingData.g2_native : '');
    $("#g3_native").val((appSettingData && appSettingData.g3_native) ? appSettingData.g3_native : '');
    $("#g1_native2").val((appSettingData && appSettingData.g1_native2) ? appSettingData.g1_native2 : '');
    $("#g2_native2").val((appSettingData && appSettingData.g2_native2) ? appSettingData.g2_native2 : '');
    $("#g3_native2").val((appSettingData && appSettingData.g3_native2) ? appSettingData.g3_native2 : '');
    $("#g1_appopen").val((appSettingData && appSettingData.g1_appopen) ? appSettingData.g1_appopen : '');
    $("#g2_appopen").val((appSettingData && appSettingData.g2_appopen) ? appSettingData.g2_appopen : '');
    $("#g3_appopen").val((appSettingData && appSettingData.g3_appopen) ? appSettingData.g3_appopen : '');
    $("#g1_appid").val((appSettingData && appSettingData.g1_appid) ? appSettingData.g1_appid : '');
    $("#g2_appid").val((appSettingData && appSettingData.g2_appid) ? appSettingData.g2_appid : '');
    $("#g3_appid").val((appSettingData && appSettingData.g3_appid) ? appSettingData.g3_appid : '');

    var all_ads = (adData && adData.all_ads) ? adData.all_ads : 'hide';
    var fullscreen = (adData && adData.fullscreen) ? adData.fullscreen : 'hide';
    var continue_screen = (adData && adData.continue_screen) ? adData.continue_screen : 'hide';
    var lets_start_screen = (adData && adData.lets_start_screen) ? adData.lets_start_screen : 'hide';
    var age_screen = (adData && adData.age_screen) ? adData.age_screen : 'hide';
    var next_screen = (adData && adData.next_screen) ? adData.next_screen : 'hide';
    var next_inner_screen = (adData && adData.next_inner_screen) ? adData.next_inner_screen : 'hide';
    var contact_screen = (adData && adData.contact_screen) ? adData.contact_screen : 'hide';
    var start_screen = (adData && adData.start_screen) ? adData.start_screen : 'hide';
    var real_casting_flow = (adData && adData.real_casting_flow) ? adData.real_casting_flow : 'hide';
    var app_stop = (adData && adData.app_stop) ? adData.app_stop : 'hide';

    $("[name='all_ads'][value='"+all_ads+"']").prop('checked', true);
    $("[name='fullscreen'][value='"+fullscreen+"']").prop('checked', true);
    $("#adblock_version").val((adData && adData.adblock_version) ? adData.adblock_version : '');
    $("[name='continue_screen'][value='"+continue_screen+"']").prop('checked', true);
    $("[name='lets_start_screen'][value='"+lets_start_screen+"']").prop('checked', true);
    $("[name='age_screen'][value='"+age_screen+"']").prop('checked', true);
    $("[name='next_screen'][value='"+next_screen+"']").prop('checked', true);
    $("[name='next_inner_screen'][value='"+next_inner_screen+"']").prop('checked', true);
    $("[name='contact_screen'][value='"+contact_screen+"']").prop('checked', true);
    $("[name='start_screen'][value='"+start_screen+"']").prop('checked', true);
    $("[name='real_casting_flow'][value='"+real_casting_flow+"']").prop('checked', true);
    $("[name='app_stop'][value='"+app_stop+"']").prop('checked', true);
    extra_setting_fields = [];
    $("#setting_table tr.extra").remove();
    if(adData && adData.additional_fields != "" && adData.additional_fields != null){
        var additional_fields = JSON.parse(adData.additional_fields);
        var loop_idx = 0;
        additional_fields.forEach((fields) => {
            var new_index = Date.now().toString()+loop_idx;
            var new_field = {
                field_name: fields.field_name,
                field_type: fields.field_type,
                idx: new_index
            };
            extra_setting_fields.push(new_field);
            add_extra_setting_field(new_field, new_index, fields.value, fields.value2, 0);
            loop_idx++;
        });
    }


    var vpn = (adData && adData.vpn) ? adData.vpn : 'hide';
    var vpn_dialog = (adData && adData.vpn_dialog) ? adData.vpn_dialog : 'hide';
    var vpn_dialog_open = (adData && adData.vpn_dialog_open) ? adData.vpn_dialog_open : 'hide';
    $("[name='vpn'][value='"+vpn+"']").prop('checked', true);
    $("[name='vpn_dialog'][value='"+vpn_dialog+"']").prop('checked', true);
    $("[name='vpn_dialog_open'][value='"+vpn_dialog_open+"']").prop('checked', true);
    $("#vpn_url").val((adData && adData.vpn_url) ? adData.vpn_url : '');
    $("#vpn_carrier_id").val((adData && adData.vpn_carrier_id) ? adData.vpn_carrier_id : '');
    
    clearTageditor('#vpn_country');
    if(adData && adData.vpn_country && adData.vpn_country != ""){
        JSON.parse(adData.vpn_country).forEach(tag => {
            $('#vpn_country').tagEditor('addTag', tag, true); 
        });
    }

    var app_remove_flag = (appSettingData && appSettingData.app_remove_flag) ? appSettingData.app_remove_flag : 'normal';
    $("[name='app_remove_flag'][value='"+app_remove_flag+"']").prop('checked', true);
    $("#app_version").val((appSettingData && appSettingData.app_version) ? appSettingData.app_version : '');
    $("#app_remove_title").val((appSettingData && appSettingData.app_remove_title) ? appSettingData.app_remove_title : '');
    $("#app_remove_description").val((appSettingData && appSettingData.app_remove_description) ? appSettingData.app_remove_description : '');
    $("#app_remove_url").val((appSettingData && appSettingData.app_remove_url) ? appSettingData.app_remove_url : '');
    $("#app_remove_button_name").val((appSettingData && appSettingData.app_remove_button_name) ? appSettingData.app_remove_button_name : '');
    $("#app_remove_skip_button_name").val((appSettingData && appSettingData.app_remove_skip_button_name) ? appSettingData.app_remove_skip_button_name : '');

    /*** Ad Setting ***/
    var native_loading = (adData && adData.native_loading) ? adData.native_loading : 'onload';
    var bottom_banner = (adData && adData.bottom_banner) ? adData.bottom_banner : 'native';
    var all_screen_native = (adData && adData.all_screen_native) ? adData.all_screen_native : 'hide';
    var list_native = (adData && adData.list_native) ? adData.list_native : 'hide';
    var exit_dialoge_native = (adData && adData.exit_dialoge_native) ? adData.exit_dialoge_native : 'hide';
    var native_btn = (adData && adData.native_btn) ? adData.native_btn : 'default';
    var alternate_with_appopen = (adData && adData.alternate_with_appopen) ? adData.alternate_with_appopen : 'hide';
    var inter_loading = (adData && adData.inter_loading) ? adData.inter_loading : 'onload';
    var app_open_loading = (adData && adData.app_open_loading) ? adData.app_open_loading : 'onload';
    var splash_ads = (adData && adData.splash_ads) ? adData.splash_ads : 'hide';
    var app_open = (adData && adData.app_open) ? adData.app_open : 'onetime';

    $("#app_color").val((adData && adData.app_color) ? adData.app_color : '#000000');
    $("#app_background_color").val((adData && adData.app_background_color) ? adData.app_background_color : '#FFFFFF');
    $("[name='native_loading'][value='"+native_loading+"']").prop('checked', true);
    $("[name='bottom_banner'][value='"+bottom_banner+"']").prop('checked', true);
    $("[name='all_screen_native'][value='"+all_screen_native+"']").prop('checked', true);
    $("[name='list_native'][value='"+list_native+"']").prop('checked', true);
    $("#list_native_cnt").val((adData && adData.list_native_cnt) ? adData.list_native_cnt : '0');
    $("[name='exit_dialoge_native'][value='"+exit_dialoge_native+"']").prop('checked', true);
    $("[name='native_btn'][value='"+native_btn+"']").prop('checked', true);
    $("#native_btn_text").val((adData && adData.native_btn_text) ? adData.native_btn_text : '');
    $("#native_background_color").val((adData && adData.native_background_color) ? adData.native_background_color : '#FFFEFF');
    $("#native_text_color").val((adData && adData.native_text_color) ? adData.native_text_color : '#808080');
    $("#native_button_background_color").val((adData && adData.native_button_background_color) ? adData.native_button_background_color : '#4285F4');
    $("#native_button_text_color").val((adData && adData.native_button_text_color) ? adData.native_button_text_color : '#FFFEFF');
    $("[name='alternate_with_appopen'][value='"+alternate_with_appopen+"']").prop('checked', true);
    $("[name='inter_loading'][value='"+inter_loading+"']").prop('checked', true);
    $("#inter_interval").val((adData && adData.inter_interval) ? adData.inter_interval : '0');
    $("#back_click_inter").val((adData && adData.back_click_inter) ? adData.back_click_inter : '0');
    $("[name='app_open_loading'][value='"+app_open_loading+"']").prop('checked', true);
    $("[name='splash_ads'][value='"+splash_ads+"']").prop('checked', true);
    $("[name='app_open'][value='"+app_open+"']").prop('checked', true);
    
    clearTageditor('#bifurcate_location');
    manage_bifurcate_location();

    if(adData && adData.additional_fields != "" && adData.additional_fields != null){
        var additional_fields = JSON.parse(adData.additional_fields);
        var loop_idx = 0;
        additional_fields.forEach((fields) => {
            var new_index = Date.now().toString()+loop_idx;
            var new_field = {
                field_name: fields.field_name,
                field_type: fields.field_type,
                idx: new_index
            };
            extra_bifurcate_setting_fields.push(new_field);
            add_extra_setting_field(new_field, new_index, fields.value, fields.value2, 1);
            loop_idx++;
        });
    }

    manageFormfields(1);
    manage_preview_clr(1);
    manageFormfields(2);
    manage_preview_clr(2);
    manageSelectedColor();
}

function manage_bifurcate_location(active_id){
    let adBifurcateData = [];
    if(subView == 3){
        adBifurcateData = OrgBifurcateData;
    }
    else{
        adBifurcateData = MrktBifurcateData;
    }
        
    var bhtml = "";
    adBifurcateData.forEach(function(bifurcateData) {
        var activeClass = (bifurcateData.id == active_id) ? 'active' : '';
        bhtml += `<div class="blocation ${activeClass} d-flex align-items-center loc-${bifurcateData.id}">
            <span class="cursor-pointer" onclick="edit_bifurcate('${bifurcateData.id}')">${bifurcateData.bifurcate_location}</span>
            <i class="fa fa-close ms-1 text-danger cursor-pointer" onclick="conform_delete_bifurecate('${bifurcateData.id}')"></i>
        </div>`;
    });
    bhtml += `<div class="blocation d-flex align-items-center">
            <span class="cursor-pointer" onclick="edit_bifurcate('NEW')"><i class="fa fa-plus me-1"></i>New</span>
    </div>`;
    $("#location_div").html(bhtml);
}

function edit_bifurcate(id){
    clearTageditor('#bifurcate_location');
    clearTageditor('#bifurcate_vpn_country');
    $("#bifurcate_id").val("");
    extra_bifurcate_setting_fields = [];
    $("#bifurcate_setting_table tr.extra").remove();
    
    if(id != "NEW"){
        $(`.blocation`).removeClass('active');
        $(`.loc-${id}`).addClass('active');
        let adBifurcateData = [];
        if(subView == 3){
            adBifurcateData = OrgBifurcateData;
        }
        else{
            adBifurcateData = MrktBifurcateData;
        }
        adBifurcateData = adBifurcateData.find((o) => { return o.id === id });

        $("#bifurcate_id").val(adBifurcateData.id ? adBifurcateData.id : "");
        if(adBifurcateData && adBifurcateData.bifurcate_location && adBifurcateData.bifurcate_location != ""){
            $('#bifurcate_location').tagEditor('addTag', adBifurcateData.bifurcate_location.split(','), true); 
        }

        var bifurcate_native_loading = (adBifurcateData && adBifurcateData.native_loading) ? adBifurcateData.native_loading : 'onload';
        var bifurcate_bottom_banner = (adBifurcateData && adBifurcateData.bottom_banner) ? adBifurcateData.bottom_banner : 'native';
        var bifurcate_all_screen_native = (adBifurcateData && adBifurcateData.all_screen_native) ? adBifurcateData.all_screen_native : 'hide';
        var bifurcate_list_native = (adBifurcateData && adBifurcateData.list_native) ? adBifurcateData.list_native : 'hide';
        var bifurcate_exit_dialoge_native = (adBifurcateData && adBifurcateData.exit_dialoge_native) ? adBifurcateData.exit_dialoge_native : 'hide';
        var bifurcate_native_btn = (adBifurcateData && adBifurcateData.native_btn) ? adBifurcateData.native_btn : 'default';
        var bifurcate_alternate_with_appopen = (adBifurcateData && adBifurcateData.alternate_with_appopen) ? adBifurcateData.alternate_with_appopen : 'hide';
        var bifurcate_inter_loading = (adBifurcateData && adBifurcateData.inter_loading) ? adBifurcateData.inter_loading : 'onload';
        var bifurcate_app_open_loading = (adBifurcateData && adBifurcateData.app_open_loading) ? adBifurcateData.app_open_loading : 'onload';
        var bifurcate_splash_ads = (adBifurcateData && adBifurcateData.splash_ads) ? adBifurcateData.splash_ads : 'hide';
        var bifurcate_app_open = (adBifurcateData && adBifurcateData.app_open) ? adBifurcateData.app_open : 'onetime';

        $("#bifurcate_app_color").val((adBifurcateData && adBifurcateData.app_color) ? adBifurcateData.app_color : '#000000');
        $("#bifurcate_app_background_color").val((adBifurcateData && adBifurcateData.app_background_color) ? adBifurcateData.app_background_color : '#FFFFFF');
        $("[name='bifurcate_native_loading'][value='"+bifurcate_native_loading+"']").prop('checked', true);
        $("[name='bifurcate_bottom_banner'][value='"+bifurcate_bottom_banner+"']").prop('checked', true);
        $("[name='bifurcate_all_screen_native'][value='"+bifurcate_all_screen_native+"']").prop('checked', true);
        $("[name='bifurcate_list_native'][value='"+bifurcate_list_native+"']").prop('checked', true);
        $("#bifurcate_list_native_cnt").val((adBifurcateData && adBifurcateData.list_native_cnt) ? adBifurcateData.list_native_cnt : '0');
        $("[name='bifurcate_exit_dialoge_native'][value='"+bifurcate_exit_dialoge_native+"']").prop('checked', true);
        $("[name='bifurcate_native_btn'][value='"+bifurcate_native_btn+"']").prop('checked', true);
        $("#bifurcate_native_btn_text").val((adBifurcateData && adBifurcateData.native_btn_text) ? adBifurcateData.native_btn_text : '');
        $("#bifurcate_native_background_color").val((adBifurcateData && adBifurcateData.native_background_color) ? adBifurcateData.native_background_color : '#FFFEFF');
        $("#bifurcate_native_text_color").val((adBifurcateData && adBifurcateData.native_text_color) ? adBifurcateData.native_text_color : '#808080');
        $("#bifurcate_native_button_background_color").val((adBifurcateData && adBifurcateData.native_button_background_color) ? adBifurcateData.native_button_background_color : '#4285F4');
        $("#bifurcate_native_button_text_color").val((adBifurcateData && adBifurcateData.native_button_text_color) ? adBifurcateData.native_button_text_color : '#FFFEFF');
        $("[name='bifurcate_alternate_with_appopen'][value='"+bifurcate_alternate_with_appopen+"']").prop('checked', true);
        $("[name='bifurcate_inter_loading'][value='"+bifurcate_inter_loading+"']").prop('checked', true);
        $("#bifurcate_inter_interval").val((adBifurcateData && adBifurcateData.inter_interval) ? adBifurcateData.inter_interval : '0');
        $("#bifurcate_back_click_inter").val((adBifurcateData && adBifurcateData.back_click_inter) ? adBifurcateData.back_click_inter : '0');
        $("[name='bifurcate_app_open_loading'][value='"+bifurcate_app_open_loading+"']").prop('checked', true);
        $("[name='bifurcate_splash_ads'][value='"+bifurcate_splash_ads+"']").prop('checked', true);
        $("[name='bifurcate_app_open'][value='"+bifurcate_app_open+"']").prop('checked', true);

        var all_ads = (adBifurcateData && adBifurcateData.all_ads) ? adBifurcateData.all_ads : 'hide';
        var fullscreen = (adBifurcateData && adBifurcateData.fullscreen) ? adBifurcateData.fullscreen : 'hide';
        var continue_screen = (adBifurcateData && adBifurcateData.continue_screen) ? adBifurcateData.continue_screen : 'hide';
        var lets_start_screen = (adBifurcateData && adBifurcateData.lets_start_screen) ? adBifurcateData.lets_start_screen : 'hide';
        var age_screen = (adBifurcateData && adBifurcateData.age_screen) ? adBifurcateData.age_screen : 'hide';
        var next_screen = (adBifurcateData && adBifurcateData.next_screen) ? adBifurcateData.next_screen : 'hide';
        var next_inner_screen = (adBifurcateData && adBifurcateData.next_inner_screen) ? adBifurcateData.next_inner_screen : 'hide';
        var contact_screen = (adBifurcateData && adBifurcateData.contact_screen) ? adBifurcateData.contact_screen : 'hide';
        var start_screen = (adBifurcateData && adBifurcateData.start_screen) ? adBifurcateData.start_screen : 'hide';
        var real_casting_flow = (adBifurcateData && adBifurcateData.real_casting_flow) ? adBifurcateData.real_casting_flow : 'hide';
        var app_stop = (adBifurcateData && adBifurcateData.app_stop) ? adBifurcateData.app_stop : 'hide';

        $("[name='bifurcate_all_ads'][value='"+all_ads+"']").prop('checked', true);
        $("[name='bifurcate_fullscreen'][value='"+fullscreen+"']").prop('checked', true);
        $("#bifurcate_adblock_version").val((adBifurcateData && adBifurcateData.adblock_version) ? adBifurcateData.adblock_version : '');
        $("[name='bifurcate_continue_screen'][value='"+continue_screen+"']").prop('checked', true);
        $("[name='bifurcate_lets_start_screen'][value='"+lets_start_screen+"']").prop('checked', true);
        $("[name='bifurcate_age_screen'][value='"+age_screen+"']").prop('checked', true);
        $("[name='bifurcate_next_screen'][value='"+next_screen+"']").prop('checked', true);
        $("[name='bifurcate_next_inner_screen'][value='"+next_inner_screen+"']").prop('checked', true);
        $("[name='bifurcate_contact_screen'][value='"+contact_screen+"']").prop('checked', true);
        $("[name='bifurcate_start_screen'][value='"+start_screen+"']").prop('checked', true);
        $("[name='bifurcate_real_casting_flow'][value='"+real_casting_flow+"']").prop('checked', true);
        $("[name='bifurcate_app_stop'][value='"+app_stop+"']").prop('checked', true);
        
        if(adBifurcateData && adBifurcateData.additional_fields != "" && adBifurcateData.additional_fields != null){
            var additional_fields = JSON.parse(adBifurcateData.additional_fields);
            var loop_idx = 0;
            additional_fields.forEach((fields) => {
                var new_index = Date.now().toString()+loop_idx;
                var new_field = {
                    field_name: fields.field_name,
                    field_type: fields.field_type,
                    idx: new_index
                };
                extra_bifurcate_setting_fields.push(new_field);
                add_extra_setting_field(new_field, new_index, fields.value, fields.value2, 1);
                loop_idx++;
            });
        }

        var vpn = (adBifurcateData && adBifurcateData.vpn) ? adBifurcateData.vpn : 'hide';
        var vpn_dialog = (adBifurcateData && adBifurcateData.vpn_dialog) ? adBifurcateData.vpn_dialog : 'hide';
        var vpn_dialog_open = (adBifurcateData && adBifurcateData.vpn_dialog_open) ? adBifurcateData.vpn_dialog_open : 'hide';
        $("[name='bifurcate_vpn'][value='"+vpn+"']").prop('checked', true);
        $("[name='bifurcate_vpn_dialog'][value='"+vpn_dialog+"']").prop('checked', true);
        $("[name='bifurcate_vpn_dialog_open'][value='"+vpn_dialog_open+"']").prop('checked', true);
        $("#bifurcate_vpn_url").val((adBifurcateData && adBifurcateData.vpn_url) ? adBifurcateData.vpn_url : '');
        $("#bifurcate_vpn_carrier_id").val((adBifurcateData && adBifurcateData.vpn_carrier_id) ? adBifurcateData.vpn_carrier_id : '');
        
        if(adBifurcateData && adBifurcateData.vpn_country && adBifurcateData.vpn_country != ""){
            $('#bifurcate_vpn_country').tagEditor('addTag', JSON.parse(adBifurcateData.vpn_country), true);
        }
    }
    else {
        let adData = [];
        if(subView == 3){
            adData = OrgAdData;
        }
        else{
            adData = MrktAdData;
        }
        
        $(`.blocation`).removeClass('active');
        $("#bifurcate_app_color").val('#000000');
        $("#bifurcate_app_background_color").val('#FFFFFF');
        $("[name='bifurcate_native_loading'][value='onload']").prop('checked', true);
        $("[name='bifurcate_bottom_banner'][value='native']").prop('checked', true);
        $("[name='bifurcate_all_screen_native'][value='hide']").prop('checked', true);
        $("[name='bifurcate_list_native'][value='hide']").prop('checked', true);
        $("#bifurcate_list_native_cnt").val('0');
        $("[name='bifurcate_exit_dialoge_native'][value='hide']").prop('checked', true);
        $("[name='bifurcate_native_btn'][value='default']").prop('checked', true);
        $("#bifurcate_native_btn_text").val('');
        $("#bifurcate_native_background_color").val('#FFFEFF');
        $("#bifurcate_native_text_color").val('#808080');
        $("#bifurcate_native_button_background_color").val('#4285F4');
        $("#bifurcate_native_button_text_color").val('#FFFEFF');
        $("[name='bifurcate_alternate_with_appopen'][value='hide']").prop('checked', true);
        $("[name='bifurcate_inter_loading'][value='onload']").prop('checked', true);
        $("#bifurcate_inter_interval").val('0');
        $("#bifurcate_back_click_inter").val('0');
        $("[name='bifurcate_app_open_loading'][value='onload']").prop('checked', true);
        $("[name='bifurcate_splash_ads'][value='hide']").prop('checked', true);
        $("[name='bifurcate_app_open'][value='onetime']").prop('checked', true);

        $("[name='bifurcate_all_ads'][value='hide']").prop('checked', true);
        $("[name='bifurcate_fullscreen'][value='hide']").prop('checked', true);
        $("#bifurcate_adblock_version").val('');
        $("[name='bifurcate_continue_screen'][value='hide']").prop('checked', true);
        $("[name='bifurcate_lets_start_screen'][value='hide']").prop('checked', true);
        $("[name='bifurcate_age_screen'][value='hide']").prop('checked', true);
        $("[name='bifurcate_next_screen'][value='hide']").prop('checked', true);
        $("[name='bifurcate_next_inner_screen'][value='hide']").prop('checked', true);
        $("[name='bifurcate_contact_screen'][value='hide']").prop('checked', true);
        $("[name='bifurcate_start_screen'][value='hide']").prop('checked', true);
        $("[name='bifurcate_real_casting_flow'][value='hide']").prop('checked', true);
        $("[name='bifurcate_app_stop'][value='hide']").prop('checked', true);

        if(adData && adData.additional_fields != "" && adData.additional_fields != null){
            var additional_fields = JSON.parse(adData.additional_fields);
            var loop_idx = 0;
            additional_fields.forEach((fields) => {
                var new_index = Date.now().toString()+loop_idx;
                var new_field = {
                    field_name: fields.field_name,
                    field_type: fields.field_type,
                    idx: new_index
                };
                extra_bifurcate_setting_fields.push(new_field);
                add_extra_setting_field(new_field, new_index, fields.value, fields.value2, 1);
                loop_idx++;
            });
        }

        $("[name='bifurcate_vpn'][value='hide']").prop('checked', true);
        $("[name='bifurcate_vpn_dialog'][value='hide']").prop('checked', true);
        $("[name='bifurcate_vpn_dialog_open'][value='hide']").prop('checked', true);
        $("#bifurcate_vpn_url").val('');
        $("#bifurcate_vpn_carrier_id").val('');
    }
    manageFormfields(1);
    manage_preview_clr(1);
    manageFormfields(2);
    manage_preview_clr(2);
    manageSelectedColor();
}

function conform_delete_bifurecate(id){
    $("#delete_bif_modal .conform-btn").attr('onclick',"delete_bifurcate_record('"+id+"')");
    $("#delete_bif_modal").modal('show');
}

function delete_bifurcate_record(id){
    showLoading();
    var req_data = {
        op: CURRENT_PAGE
        , action: "delete_bifurcate_data"
        , id: id
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success) {
            hideLoading();
            $(`.loc-${id}`).remove();
            setDataVariable(data);
            edit_bifurcate('NEW');
            showMessage(data.message);
            return false;
        }
        else if (data && data != null && !data.success) {
            hideLoading();
            showError(data.message);
            return false;
        }
    });
}

//================= Google Functions =================
function saveGoogleId(){
    showLoading();
    var req_data = {
        op: CURRENT_PAGE
        , action: "save_google_data"
        , id: PRIMARY_ID
        , type: (subView == 3) ? 1 : 2
        , g1_percentage: $("#g1_percentage").val()
        , g2_percentage: $("#g2_percentage").val()
        , g3_percentage: $("#g3_percentage").val()
        , g1_account_name: $("#g1_account_name").val()
        , g2_account_name: $("#g2_account_name").val()
        , g3_account_name: $("#g3_account_name").val()
        , g1_banner: $("#g1_banner").val()
        , g2_banner: $("#g2_banner").val()
        , g3_banner: $("#g3_banner").val()
        , g1_inter: $("#g1_inter").val()
        , g2_inter: $("#g2_inter").val()
        , g3_inter: $("#g3_inter").val()
        , g1_native: $("#g1_native").val()
        , g2_native: $("#g2_native").val()
        , g3_native: $("#g3_native").val()
        , g1_native2: $("#g1_native2").val()
        , g2_native2: $("#g2_native2").val()
        , g3_native2: $("#g3_native2").val()
        , g1_appopen: $("#g1_appopen").val()
        , g2_appopen: $("#g2_appopen").val()
        , g3_appopen: $("#g3_appopen").val()
        , g1_appid: $("#g1_appid").val()
        , g2_appid: $("#g2_appid").val()
        , g3_appid: $("#g3_appid").val()
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success) {
            hideLoading();
            setDataVariable(data);
            showMessage(data.message);
            return false;
        }
        else if (data && data != null && !data.success) {
            hideLoading();
            showError(data.message);
            return false;
        }
    });
}

function addGoogleTestId(){
    $("#g1_banner").val('ca-app-pub-3940256099942544/630097811');
    $("#g2_banner").val('ca-app-pub-3940256099942544/630097811');
    $("#g3_banner").val('ca-app-pub-3940256099942544/630097811');

    $("#g1_inter").val('ca-app-pub-3940256099942544/1033173712');
    $("#g2_inter").val('ca-app-pub-3940256099942544/1033173712');
    $("#g3_inter").val('ca-app-pub-3940256099942544/1033173712');

    $("#g1_native").val('ca-app-pub-3940256099942544/2247696110');
    $("#g2_native").val('ca-app-pub-3940256099942544/2247696110');
    $("#g3_native").val('ca-app-pub-3940256099942544/2247696110');
    
    $("#g1_native2").val('ca-app-pub-3940256099942544/2247696110');
    $("#g2_native2").val('ca-app-pub-3940256099942544/2247696110');
    $("#g3_native2").val('ca-app-pub-3940256099942544/2247696110');
    
    $("#g1_appopen").val('ca-app-pub-3940256099942544/3419835294');
    $("#g2_appopen").val('ca-app-pub-3940256099942544/3419835294');
    $("#g3_appopen").val('ca-app-pub-3940256099942544/3419835294');

    $("#g1_appid").val("");
    $("#g2_appid").val("");
    $("#g3_appid").val("");
}

function resetGoogleForm(){
    $("#g1_banner").val("");
    $("#g2_banner").val("");
    $("#g3_banner").val("");
    $("#g1_inter").val("");
    $("#g2_inter").val("");
    $("#g3_inter").val("");
    $("#g1_native").val("");
    $("#g2_native").val("");
    $("#g3_native").val("");
    $("#g1_native2").val("");
    $("#g2_native2").val("");
    $("#g3_native2").val("");
    $("#g1_appopen").val("");
    $("#g2_appopen").val("");
    $("#g3_appopen").val("");
    $("#g1_appid").val("");
    $("#g2_appid").val("");
    $("#g3_appid").val("");
}


//================= Other Setting Functions =================
function saveOtherSettings(){
    showLoading();
    var extra_field = [];
    $("#setting_table tr.extra").each(function() {
        var idx = $(this).attr('data-index');
        let obj = extra_setting_fields.find(o => o.idx === idx);
        var val1 = "";
        var val2 = "";
        if(obj.field_type == 1){
            val1 = $(this).find("[name='extra_field_"+idx+"']:checked").val();
        }
        else if(obj.field_type == 2){
            val1 = $(this).find("#extraFieldText"+idx+"").val();
        }
        else if(obj.field_type == 3){
            val1 = $(this).find("[name='extra_field_"+idx+"']:checked").val();
            val2 = $(this).find("#extraFieldText"+idx+"").val();
        }
        extra_field.push({
            field_name: obj.field_name,
            field_type: obj.field_type,
            value: val1,
            value2: val2
        });
    });
    
    var req_data = {
        op: CURRENT_PAGE
        , action: "save_oher_settings"
        , id: PRIMARY_ID
        , type: (subView == 3) ? 1 : 2
        , all_ads: $("[name='all_ads']:checked").val()
        , fullscreen: $("[name='fullscreen']:checked").val()
        , adblock_version: $("#adblock_version").val()
        , continue_screen: $("[name='continue_screen']:checked").val()
        , lets_start_screen: $("[name='lets_start_screen']:checked").val()
        , age_screen: $("[name='age_screen']:checked").val()
        , next_screen: $("[name='next_screen']:checked").val()
        , next_inner_screen: $("[name='next_inner_screen']:checked").val()
        , contact_screen: $("[name='contact_screen']:checked").val()
        , start_screen: $("[name='start_screen']:checked").val()
        , real_casting_flow: $("[name='real_casting_flow']:checked").val()
        , app_stop: $("[name='app_stop']:checked").val()
        , additional_fields: JSON.stringify(extra_field)
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success) {
            hideLoading();
            setDataVariable(data);
            showMessage(data.message);
            return false;
        }
        else if (data && data != null && !data.success) {
            hideLoading();
            showError(data.message);
            return false;
        }
    });
}

function add_setting_field() {
    $("#add_setting_field_modal").modal('show');
}

function append_setting_field(){
    var field_name = $("#add_setting_field_modal #field_name").val();
    var field_type = $("#add_setting_field_modal [name='field_type']:checked").val();
    if(field_name && field_name != ""){
        var extra = (is_bifurcate) ? "1" : "";
        var new_index = extra + Date.now().toString();
        var new_field = {
            field_name: field_name,
            field_type: field_type,
            idx: new_index
        };
        if(is_bifurcate){
            extra_bifurcate_setting_fields.push(new_field);
        }
        else {
            extra_setting_fields.push(new_field);
        }
        // var new_index = $("#setting_table tr.extra").length;
        add_extra_setting_field(new_field, new_index, "", "", (is_bifurcate) ? 1 : 0);
        $("#add_setting_field_modal #field_name").val("");
        $("#add_setting_field_modal [name='field_type'][value='1']").prop('checked', true);
        $("#add_setting_field_modal").modal('hide');
    }
    else{showError("Please add field name")}
}

function add_extra_setting_field(fieldData, index = '0', val1 = "", val2 = "", bifurcate_flag = 0){
    var prefix = (bifurcate_flag) ? "bifurcate_" : "";
    var html = `<tr class="extra" id="${prefix}extra${index}" data-index="${index}">
                    <td>
                        <span class="delete-div text-danger cursor-pointer" data-index="${index}" onclick="removeExtraField('${index}')"><i class="fa fa-close"></i></span>
                        ${fieldData.field_name}
                        <input type="hidden" class="fld_name" value="${fieldData.field_name}" />
                    </td>
                    <td>`;
                    if(fieldData.field_type == 3){
                        html+=`<div class="form-check form-radio-success form-check-inline">
                                    <input type="radio" id="${prefix}extraField${index}Show" name="${prefix}extra_field_${index}" class="form-check-input" value="show" ${(val1 == 'show') ? 'checked' : ''}>
                                    <label class="form-check-label" for="extraField${index}Show">Show</label>
                                </div>
                                <div class="form-check form-radio-success form-check-inline">
                                    <input type="radio" id="${prefix}extraField${index}Hide" name="${prefix}extra_field_${index}" class="form-check-input" value="hide" ${(val1 != 'show') ? 'checked' : ''}>
                                    <label class="form-check-label" for="extraField${index}Hide">Hide</label>
                                </div>
                                <input type="text" id="${prefix}extraFieldText${index}" name="${prefix}extraFieldText${index}" class="form-control d-inline w-50" value="${val2}">`;
                    }
                    else if(fieldData.field_type == 2){
                        html+=`<input type="text" id="${prefix}extraFieldText${index}" name="${prefix}extraFieldText${index}" class="form-control" value="${val1}">`;
                    }
                    else{
                        html+=`<div class="form-check form-radio-success form-check-inline">
                                    <input type="radio" id="${prefix}extraField${index}Show" name="${prefix}extra_field_${index}" class="form-check-input" value="show" ${(val1 == 'show') ? 'checked' : ''}>
                                    <label class="form-check-label" for="extraField${index}Show">Show</label>
                                </div>
                                <div class="form-check form-radio-success form-check-inline">
                                    <input type="radio" id="${prefix}extraField${index}Hide" name="${prefix}extra_field_${index}" class="form-check-input" value="hide" ${(val1 != 'show') ? 'checked' : ''}>
                                    <label class="form-check-label" for="extraField${index}Hide">Hide</label>
                                </div>`;
                    }
            html+=`</td>
                </tr>`;
    if(bifurcate_flag){
        $("#bifurcate_setting_table").append(html);
    }
    else{
        $("#setting_table").append(html);
    }
}

function removeExtraField(index){
    if(is_bifurcate){
        $("#bifurcate_setting_table #bifurcate_extra"+index).remove();
        extra_bifurcate_setting_fields = $.grep(extra_bifurcate_setting_fields, function(e){ 
            return e.idx != index; 
        });
    }
    else{
        $("#setting_table #extra"+index).remove();
        extra_setting_fields = $.grep(extra_setting_fields, function(e){ 
            return e.idx != index; 
        });
    }
}

//================= VPN Setting Functions =================
function saveVPNSettings(){
    showLoading();
    var req_data = {
        op: CURRENT_PAGE
        , action: "save_vpn_settings"
        , id: PRIMARY_ID
        , type: (subView == 3) ? 1 : 2
        , vpn: $("[name='vpn']:checked").val()
        , vpn_dialog: $("[name='vpn_dialog']:checked").val()
        , vpn_dialog_open: $("[name='vpn_dialog_open']:checked").val()
        , vpn_url: $("#vpn_url").val()
        , vpn_carrier_id: $("#vpn_carrier_id").val()
        , vpn_country: JSON.stringify($('#vpn_country').tagEditor('getTags')[0].tags)
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success) {
            hideLoading();
            setDataVariable(data);
            showMessage(data.message);
            return false;
        }
        else if (data && data != null && !data.success) {
            hideLoading();
            showError(data.message);
            return false;
        }
    });
}

//================= App Remove Setting Functions =================
function saveAppRemoveSettings(){
    showLoading();
    var req_data = {
        op: CURRENT_PAGE
        , action: "save_app_remove_settings"
        , id: PRIMARY_ID
        , type: (subView == 3) ? 1 : 2
        , app_remove_flag: $("[name='app_remove_flag']:checked").val()
        , app_version: $("#app_version").val()
        , app_remove_title: $("#app_remove_title").val()
        , app_remove_description: $("#app_remove_description").val()
        , app_remove_url: $("#app_remove_url").val()
        , app_remove_button_name: $("#app_remove_button_name").val()
        , app_remove_skip_button_name: $("#app_remove_skip_button_name").val()
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success) {
            hideLoading();
            setDataVariable(data);
            showMessage(data.message);
            return false;
        }
        else if (data && data != null && !data.success) {
            hideLoading();
            showError(data.message);
            return false;
        }
    });
}

//================= Ad Setting Functions =================

function saveAdSettings(){
    var req_data = {
        bifurcate_location: ""
        , app_color: $("#app_color").val()
        , app_background_color: $("#app_background_color").val()
        , native_loading: $("[name='native_loading']:checked").val()
        , bottom_banner: $("[name='bottom_banner']:checked").val()
        , all_screen_native: $("[name='all_screen_native']:checked").val()
        , list_native: $("[name='list_native']:checked").val()
        , list_native_cnt: $("#list_native_cnt").val()
        , exit_dialoge_native: $("[name='exit_dialoge_native']:checked").val()
        , native_btn: $("[name='native_btn']:checked").val()
        , native_btn_text: $("#native_btn_text").val()
        , native_background_color: $("#native_background_color").val()
        , native_text_color: $("#native_text_color").val()
        , native_button_background_color: $("#native_button_background_color").val()
        , native_button_text_color: $("#native_button_text_color").val()
        , alternate_with_appopen: $("[name='alternate_with_appopen']:checked").val()
        , inter_loading: $("[name='inter_loading']:checked").val()
        , inter_interval: $("#inter_interval").val()
        , back_click_inter: $("#back_click_inter").val()
        , app_open_loading: $("[name='app_open_loading']:checked").val()
        , splash_ads: $("[name='splash_ads']:checked").val()
        , app_open: $("[name='app_open']:checked").val()
    };
    saveAdsSettings(0, req_data);
}

function saveBifurcate_AdSettings(){
    var extra_field = [];
    $("#bifurcate_setting_table tr.extra").each(function() {
        var idx = $(this).attr('data-index');
        let obj = extra_bifurcate_setting_fields.find(o => o.idx === idx);
        var val1 = "";
        var val2 = "";
        if(obj.field_type == 1){
            val1 = $(this).find("[name='bifurcate_extra_field_"+idx+"']:checked").val();
        }
        else if(obj.field_type == 2){
            val1 = $(this).find("#bifurcate_extraFieldText"+idx+"").val();
        }
        else if(obj.field_type == 3){
            val1 = $(this).find("[name='bifurcate_extra_field_"+idx+"']:checked").val();
            val2 = $(this).find("#bifurcate_extraFieldText"+idx+"").val();
        }
        extra_field.push({
            field_name: obj.field_name,
            field_type: obj.field_type,
            value: val1,
            value2: val2
        });
    });
    var req_data = {
        bifurcate_location: $('#bifurcate_location').tagEditor('getTags')[0].tags.join(',')
        , bifurcate_id: $("#bifurcate_id").val()
        , app_color: $("#bifurcate_app_color").val()
        , app_background_color: $("#bifurcate_app_background_color").val()
        , native_loading: $("[name='bifurcate_native_loading']:checked").val()
        , bottom_banner: $("[name='bifurcate_bottom_banner']:checked").val()
        , all_screen_native: $("[name='bifurcate_all_screen_native']:checked").val()
        , list_native: $("[name='bifurcate_list_native']:checked").val()
        , list_native_cnt: $("#bifurcate_list_native_cnt").val()
        , exit_dialoge_native: $("[name='bifurcate_exit_dialoge_native']:checked").val()
        , native_btn: $("[name='bifurcate_native_btn']:checked").val()
        , native_btn_text: $("#bifurcate_native_btn_text").val()
        , native_background_color: $("#bifurcate_native_background_color").val()
        , native_text_color: $("#bifurcate_native_text_color").val()
        , native_button_background_color: $("#bifurcate_native_button_background_color").val()
        , native_button_text_color: $("#bifurcate_native_button_text_color").val()
        , alternate_with_appopen: $("[name='bifurcate_alternate_with_appopen']:checked").val()
        , inter_loading: $("[name='bifurcate_inter_loading']:checked").val()
        , inter_interval: $("#bifurcate_inter_interval").val()
        , back_click_inter: $("#bifurcate_back_click_inter").val()
        , app_open_loading: $("[name='bifurcate_app_open_loading']:checked").val()
        , splash_ads: $("[name='bifurcate_splash_ads']:checked").val()
        , app_open: $("[name='bifurcate_app_open']:checked").val()
        , all_ads: $("[name='bifurcate_all_ads']:checked").val()
        , fullscreen: $("[name='bifurcate_fullscreen']:checked").val()
        , adblock_version: $("#bifurcate_adblock_version").val()
        , continue_screen: $("[name='bifurcate_continue_screen']:checked").val()
        , lets_start_screen: $("[name='bifurcate_lets_start_screen']:checked").val()
        , age_screen: $("[name='bifurcate_age_screen']:checked").val()
        , next_screen: $("[name='bifurcate_next_screen']:checked").val()
        , next_inner_screen: $("[name='bifurcate_next_inner_screen']:checked").val()
        , contact_screen: $("[name='bifurcate_contact_screen']:checked").val()
        , start_screen: $("[name='bifurcate_start_screen']:checked").val()
        , real_casting_flow: $("[name='bifurcate_real_casting_flow']:checked").val()
        , app_stop: $("[name='bifurcate_app_stop']:checked").val()
        , additional_fields: JSON.stringify(extra_field)
        , vpn: $("[name='bifurcate_vpn']:checked").val()
        , vpn_dialog: $("[name='bifurcate_vpn_dialog']:checked").val()
        , vpn_dialog_open: $("[name='bifurcate_vpn_dialog_open']:checked").val()
        , vpn_url: $("#bifurcate_vpn_url").val()
        , vpn_carrier_id: $("#bifurcate_vpn_carrier_id").val()
        , vpn_country: JSON.stringify($('#bifurcate_vpn_country').tagEditor('getTags')[0].tags)
    };
    saveAdsSettings(1, req_data);
}

function saveAdsSettings(is_bifurcate = 0, req_data){
    showLoading();
    req_data['op'] = CURRENT_PAGE;
    req_data['action'] = "save_ad_settings";
    req_data['id'] = PRIMARY_ID;
    req_data['type'] = (subView == 3) ? 1 : 2;
    req_data['is_bifurcate'] = is_bifurcate;
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success) {
            hideLoading();
            setDataVariable(data);
            if(is_bifurcate){
                $("#bifurcate_id").val(data.data_ref);
                manage_bifurcate_location(data.data_ref);
            }
            showMessage(data.message);
            return false;
        }
        else if (data && data != null && !data.success) {
            hideLoading();
            showError(data.message);
            return false;
        }
    });
}

function getAppSettings(type){
    showLoading();
    let req_data = [];
    req_data['op'] = "manage_app_user";
    req_data['action'] = "get_data";
    req_data['package'] = appData.package_name;
    req_data['installerurl'] = (type == 2) ? 'gclid' : 'organic';
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success) {
            hideLoading();
            $("#add_setting_res_modal #res_data").html('<pre>'+JSON.stringify(data.data, null, 2)+'</pre>');
            $("#add_setting_res_modal").modal('show');
            
            $("#add_setting_res_modal #copy_code").on('click', function(){
                // Create a temporary textarea element
                var tempTextArea = document.createElement('textarea');
                console.log(data.data);
                // Set the text content to the JSON string
                tempTextArea.textContent = JSON.stringify(data.data, null, 2);
                // Append the textarea to the body
                document.body.appendChild(tempTextArea);
                // Select the text in the textarea
                tempTextArea.select();
                tempTextArea.setSelectionRange(0, 99999); // For mobile devices
                // Execute the copy command
                // document.execCommand('copy');
                navigator.clipboard.writeText(tempTextArea.textContent);
                // Remove the temporary textarea
                document.body.removeChild(tempTextArea);
                // Alert the user
                // alert('Code copied to clipboard');
            });

            return false;
        }
        else if (data && data != null && !data.success) {
            hideLoading();
            showError(data.message);
            return false;
        }
    });
}

