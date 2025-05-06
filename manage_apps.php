<style>
    #datatable_wrapper > .row:first-child{
        padding-top: .375rem !important;
    }
</style>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-xl-12 col-lg-12">
                <div class="card border-radius-15">
                    <div class="card-body">

                        <div id="formDiv" style="display: none;">
                            <form id="manage_apps_form" class="needs-validation" method="POST" novalidate>
                                <input type="hidden" id="id">
                                <input type="hidden" id="formevent" name ="formevent"value="submit">
                                <div class="row">
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="playstore">Playstore</label>
                                        <select id="playstore" name="playstore" class="form-control select2">
                                        </select>
                                        <div class="invalid-feedback"> Please enter playstore. </div>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="adx">ADX</label>
                                        <select id="adx" name="adx" class="form-control select2">
                                        </select>
                                        <div class="invalid-feedback"> Please enter adx. </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="app_code">App Code</label>
                                        <input type="text" id="app_code" name="app_code" class="form-control" placeholder="Enter app code" />
                                        <div class="invalid-feedback"> Please enter app code. </div>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="app_name">App Name</label>
                                        <input type="text" id="app_name" name="app_name" class="form-control" placeholder="Enter app name" required />
                                        <div class="invalid-feedback"> Please enter app name. </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="package_name">Package Name</label>
                                        <input type="text" id="package_name" name="package_name" class="form-control" placeholder="Enter package name" />
                                        <div class="invalid-feedback"> Please enter package name. </div>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="web_url">Web URL</label>
                                        <input type="text" id="web_url" name="web_url" class="form-control" placeholder="Enter web url" />
                                        <div class="invalid-feedback"> Please enter web URL. </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="notes">Notes</label>
                                        <textarea id="notes" name="notes" class="form-control" placeholder="Enter notes" rows="5"></textarea>
                                        <div class="invalid-feedback"> Please enter notes. </div>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="disp_order">File</label>
                                        <div class="dropzone" id="file" data-plugin="dropzone" data-previews-container="" data-upload-preview-template="#uploadPreviewTemplate" data-page="app" acceptedFiles="image/*" is-multipe="false">
                                            <div class="fallback"><input type="file" name="file" id="file" class="" /></div>
                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                                                <h3>Drop files here or click to upload.</h3>
                                            </div>
                                            <input type="hidden" name="file_name" id="file_name" class="file_name" />
                                        </div>                                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-sm-12">
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input" type="radio" name="status" id="develop_status" value="1" checked>
                                            <label class="form-check-label" for="develop_status">Develop</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input" type="radio" name="status" id="upload_status" value="2">
                                            <label class="form-check-label" for="upload_status">Upload</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input" type="radio" name="status" id="live_status" value="3">
                                            <label class="form-check-label" for="live_status">Live</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input" type="radio" name="status" id="suspended_status" value="4">
                                            <label class="form-check-label" for="suspended_status">Suspended</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-end">
                                        <button class="btn btn-primary offset-sm-3" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive" id="detailsDiv">
                            <div class="row mx-1">
                                <ul class="table-filter col-lg-10">
                                    <li class="table-filter-data active" data-filter-type="1">Developing Apps</li>
                                    <li class="table-filter-data" data-filter-type="2">Upload Apps</li>
                                    <li class="table-filter-data" data-filter-type="3">Live Apps</li>
                                    <li class="table-filter-data" data-filter-type="4">Suspended Apps</li>
                                    <li class="table-filter-data" data-filter-type="5">CTR-0</li>
                                </ul>
                                <div class="col-lg-2 text-end"><button class="btn btn-outline-dark" onclick="export_CSV()"><img src="[ADMIN_PANEL_URL]assets/images/excel-icon.png"/> Export List</button></div>
                            </div>
                            <input type="hidden" id="extra_option" value="1">
                            <div class="user-states d-none">
                                <div class="row mx-5 cnt_show_btn_div"><button class="btn btn-default" id="load_cnt">Load Count</button></div>
                                <div class="row mx-1 cnt_div d-none">
                                    <div class="col-lg-3">
                                        <div class="card border-radius-15 shadow-none border-dark status-data">
                                            <div class="card-body today_cnt_div">
                                                <div class="status-cnt-div"><span class="today_cnt status-cnt">0</span><span class="today_diff status-diff up">76.4%</span><i class="status-diff-symbole fa-solid fa-caret-up d-none"></i></div>
                                                <div class="status-title">Today</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="card border-radius-15 shadow-none border-dark status-data">
                                            <div class="card-body yestarday_cnt_div">
                                                <div class="status-cnt-div"><span class="yestarday_cnt status-cnt">0</span><span class="today_diff status-diff up">76.4%</span><i class="status-diff-symbole fa-solid fa-caret-up d-none"></i></div>
                                                <div class="status-title">Yestarday</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="card border-radius-15 shadow-none border-dark status-data">
                                            <div class="card-body week_cnt_div">
                                                <div class="status-cnt-div"><span class="week_cnt status-cnt">0</span><span class="today_diff status-diff down">76.4%</span><i class="status-diff-symbole fa-solid fa-caret-down d-none"></i></div>
                                                <div class="status-title">Last 7 Days</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="card border-radius-15 shadow-none border-dark status-data">
                                            <div class="card-body month_cnt_div">
                                                <div class="status-cnt-div"><span class="month_cnt status-cnt">0</span><span class="today_diff status-diff up">76.4%</span><i class="status-diff-symbole fa-solid fa-caret-up d-none"></i></div>
                                                <div class="status-title">Last 30 Days</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="datatable" class="table dt-responsive nowrap vertical-middle w-100">
                                <thead>
                                    <tr>
                                        <th class="d-none">id</th>
                                        <th>Appcode</th>
                                        <th>Logo</th>
                                        <th>App Name</th>
                                        <th>ADX</th>
                                        <th>Today</th>
                                        <th>Yesterday</th>
                                        <th>All</th>
                                        <th>Notes</th>
                                        <th>Date</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div>
    <!-- container -->

</div>
<!-- content -->

<div id="user_cnt_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title comman_list_model_header" id="multiple-twoModalLabel">Count</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->