<style>
    .user-div .cnt-span{
        font-size: 35px;
        font-weight: 800;
        color: #000;
        margin-right: 10px;
    }

    .user-div .cnt-desc-span{
        font-size: 17px;
        color: #222;
    }

    .copy-btn {
        position: absolute;
        right: 10px;
        font-size: 12px;
    }
</style>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-xl-12 col-lg-12">
                <div class="card border-radius-15">
                    <div class="card-body d-flex justify-content-between filter-div">
                        <div class="app-sub-action">
                          	<a class="btn btn-outline-soft-warning setting-o-view-btn sub-view-btn me-2" href="javascript:void(0)" onclick="changeSubView(3)">Setting (O)</a>
                            <a class="btn btn-light setting-m-view-btn sub-view-btn me-2" href="javascript:void(0)" onclick="changeSubView(4)">Setting (M)</a>
                            <a class="btn btn-light user-view-btn sub-view-btn me-2" href="javascript:void(0)" onclick="changeSubView(1)">User</a>
                            <a class="btn btn-light retention-view-btn sub-view-btn me-2" href="javascript:void(0)" onclick="changeSubView(2)">Retention</a>
                        </div>
                        <div class="data-extra-filter float-right w-25">
                            <!-- <select class="form-select" id="time_filter">
                                <option value="">All</option>
                                <option value="1">Today</option>
                                <option value="2">Yestarday</option>
                            </select> -->
                            <input type="text" class="form-control" id="time_filter" data-toggle="date-range-picker" autocomplete="false">
                        </div>
                    </div>
                </div>
                
                <div class="user-div mt-3 d-none">
                    <div class="row user_cnt_div">
                        <div class="col-sm-3">
                            <div class="card border-radius-15">
                                <div class="card-body text-center p-2 d-flex align-items-center justify-content-center">
                                    <span class="cnt-span tot-user">0</span> <span class="cnt-desc-span">Total cnt</span>
                                </div> <!-- end card-body-->
                            </div>
                        </div> <!-- end card-->
                        <div class="col-sm-3">
                            <div class="card border-radius-15">
                                <div class="card-body text-center p-2 d-flex align-items-center justify-content-center">
                                    <span class="cnt-span org-user">0</span> <span class="cnt-desc-span">Organic cnt</span>
                                </div> <!-- end card-body-->
                            </div>
                        </div> <!-- end card-->
                        <div class="col-sm-3">
                            <div class="card border-radius-15">
                                <div class="card-body text-center p-2 d-flex align-items-center justify-content-center">
                                    <span class="cnt-span mrk-user">0</span> <span class="cnt-desc-span">Marketing cnt</span>
                                </div> <!-- end card-body-->
                            </div>
                        </div> <!-- end card-->
                    </div>
                    <div class="card border-radius-15">
                        <div class="card-body">
                            <div class="table-responsive" id="detailsDiv">
                                <input type="hidden" id="extra_option" />
                                <table id="datatable" class="table dt-responsive nowrap vertical-middle w-100">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id</th>
                                            <th>As</th>
                                            <th>As Name</th>
                                            <th>City</th>
                                            <th>Continent</th>
                                            <th>Country</th>
                                            <th>Country Code</th>
                                            <th>Hosting</th>
                                            <th>ISP</th>
                                            <th>Mobile</th>
                                            <th>Org</th>
                                            <th>Proxy</th>
                                            <th>Query</th>
                                            <th>Region Name</th>
                                            <th>Installer Info</th>
                                            <th>Installer URL</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-radius-15 setting-div mt-3 d-none">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-bordered mb-3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#google" class="nav-link active" data-bs-toggle="tab" role="tab" aria-controls="nav-google" aria-selected="true" onclick="set_is_bifurcate(0)">
                                    Google
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#ad" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="nav-ad" aria-selected="false" tabindex="-1" onclick="set_is_bifurcate(0)">
                                    Ad Setting
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#bifurcate" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="nav-bifurcate" aria-selected="false" tabindex="-1" onclick="set_is_bifurcate(1)">
                                    Bifurcate
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#other" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="nav-other" aria-selected="false" tabindex="-1" onclick="set_is_bifurcate(0)">
                                    Other Setting
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#vpn" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="nav-vpn" aria-selected="false" tabindex="-1" onclick="set_is_bifurcate(0)">
                                    VPN
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#app-remove" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="nav-app-remove" aria-selected="false" tabindex="-1" onclick="set_is_bifurcate(0)">
                                    App Remove Flags
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active show" id="google" role="tabpanel">
                                <div class="row multi-box">
                                    <div class="col-sm-4 px-1">
                                        <div class="box">
                                            <div class="box-header">Google 1</div>
                                            <hr>
                                            <div class="box-body">
                                                <table class="table table-centered table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>Percentage</td>
                                                            <td><input type="text" class="form-control" placeholder="Percentage" id="g1_percentage" name="g1_percentage" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account Name</td>
                                                            <td><input type="text" class="form-control" placeholder="Account Name" id="g1_account_name" name="g1_account_name" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Banner</td>
                                                            <td><input type="text" class="form-control" placeholder="Banner" id="g1_banner" name="g1_banner" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Inter</td>
                                                            <td><input type="text" class="form-control" placeholder="Inter" id="g1_inter" name="g1_inter" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Native</td>
                                                            <td><input type="text" class="form-control" placeholder="Native" id="g1_native" name="g1_native" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Native2</td>
                                                            <td><input type="text" class="form-control" placeholder="Native2" id="g1_native2" name="g1_native2" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>AppOpen</td>
                                                            <td><input type="text" class="form-control" placeholder="AppOpen" id="g1_appopen" name="g1_appopen" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>AppId</td>
                                                            <td><input type="text" class="form-control" placeholder="AppId" id="g1_appid" name="g1_appid" /></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 px-1">
                                        <div class="box">
                                            <div class="box-header">Google 2</div>
                                            <hr>
                                            <div class="box-body">
                                                <table class="table table-centered table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>Percentage</td>
                                                            <td><input type="text" class="form-control" placeholder="Percentage" id="g2_percentage" name="g2_percentage" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account Name</td>
                                                            <td><input type="text" class="form-control" placeholder="Account Name" id="g2_account_name" name="g2_account_name" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Banner</td>
                                                            <td><input type="text" class="form-control" placeholder="Banner" id="g2_banner" name="g2_banner" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Inter</td>
                                                            <td><input type="text" class="form-control" placeholder="Inter" id="g2_inter" name="g2_inter" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Native</td>
                                                            <td><input type="text" class="form-control" placeholder="Native" id="g2_native" name="g2_native" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Native2</td>
                                                            <td><input type="text" class="form-control" placeholder="Native2" id="g2_native2" name="g2_native2" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>AppOpen</td>
                                                            <td><input type="text" class="form-control" placeholder="AppOpen" id="g2_appopen" name="g2_appopen" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>AppId</td>
                                                            <td><input type="text" class="form-control" placeholder="AppId" id="g2_appid" name="g2_appid" /></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 px-1">
                                        <div class="box">
                                            <div class="box-header">Google 3</div>
                                            <hr>
                                            <div class="box-body">
                                                <table class="table table-centered table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>Percentage</td>
                                                            <td><input type="text" class="form-control" placeholder="Percentage" id="g3_percentage" name="g3_percentage" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account Name</td>
                                                            <td><input type="text" class="form-control" placeholder="Account Name" id="g3_account_name" name="g3_account_name" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Banner</td>
                                                            <td><input type="text" class="form-control" placeholder="Banner" id="g3_banner" name="g3_banner" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Inter</td>
                                                            <td><input type="text" class="form-control" placeholder="Inter" id="g3_inter" name="g3_inter" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Native</td>
                                                            <td><input type="text" class="form-control" placeholder="Native" id="g3_native" name="g3_native" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Native2</td>
                                                            <td><input type="text" class="form-control" placeholder="Native2" id="g3_native2" name="g3_native2" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>AppOpen</td>
                                                            <td><input type="text" class="form-control" placeholder="AppOpen" id="g3_appopen" name="g3_appopen" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>AppId</td>
                                                            <td><input type="text" class="form-control" placeholder="AppId" id="g3_appid" name="g3_appid" /></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2 btn-submit-div full-width">
                                    <div class="col-sm-12 text-end">
                                        <button type="button" class="btn btn-primary" onclick="saveGoogleId()">Update</button>
                                        <button type="button" class="btn btn-primary" onclick="addGoogleTestId()">Add Test Id</button>
                                        <button type="button" class="btn btn-primary" onclick="resetGoogleForm()">Reset</button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="ad" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="row">
                                            <div class="col-sm-2"><p class="tab-title m-0">App Color</p></div>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="mb-3 col-sm-6">
                                                        <label class="form-label" for="app_color">App Color for Admin</label>
                                                        <div class="color-group d-flex">
                                                            <input type="text" id="app_color" name="app_color" class="form-control clr-input" placeholder="Enter app color" value="#000000">
                                                            <input type="color" class="clr-picker" />
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col-sm-6">
                                                        <label class="form-label" for="app_background_color">Background Color</label>
                                                        <div class="color-group d-flex">
                                                            <input type="text" id="app_background_color" name="app_background_color" class="form-control  clr-input" placeholder="Enter app background color" value="#FFFFFF">
                                                            <input type="color" class="clr-picker" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2"><p class="tab-title">Native</p></div>
                                            <div class="col-sm-10">
                                                <table class="table table-centered table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>Native Loading</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="native_pre_loading" name="native_loading" class="form-check-input" value="preload">
                                                                    <label class="form-check-label" for="native_pre_loading">Preload</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="native_on_loading" name="native_loading" class="form-check-input" value="onload" checked>
                                                                    <label class="form-check-label" for="native_on_loading">Onload</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bottom Banner</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bottom_native_banner" name="bottom_banner" class="form-check-input" value="native" checked>
                                                                    <label class="form-check-label" for="bottom_native_banner">Native</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bottom_banner" name="bottom_banner" class="form-check-input" value="banner">
                                                                    <label class="form-check-label" for="bottom_banner">Banner</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bottom_banner_hide" name="bottom_banner" class="form-check-input" value="hide">
                                                                    <label class="form-check-label" for="bottom_banner_hide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>All Screen Native</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="allScreenNativeShow" name="all_screen_native" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="allScreenNativeShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="AllScreenNativeHide" name="all_screen_native" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="AllScreenNativeHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>List Native</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="listNativeShow" name="list_native" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="listNativeShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="listNativeHide" name="list_native" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="listNativeHide">Hide</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input type="number" class="form-control" id="list_native_cnt" name="list_native_cnt" value="0" readonly>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Exit Dialoge Native</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="exitDialogeNativeShow" name="exit_dialoge_native" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="exitDialogeNativeShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="exitDialogeNativeHide" name="exit_dialoge_native" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="exitDialogeNativeHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Native Button Text</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="nativeBtnManual" name="native_btn" class="form-check-input" value="manual">
                                                                    <label class="form-check-label" for="nativeBtnManual">Manual</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="nativeBtnDefault" name="native_btn" class="form-check-input" value="default" checked>
                                                                    <label class="form-check-label" for="nativeBtnDefault">Default</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input type="text" class="form-control" id="native_btn_text" name="native_btn_text" placeholder="Native Button Text">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="card border-radius-15 shadow-none border-light">
                                                    <div class="card-body">
                                                        <h3>Native Color</h3>
                                                        <div class="row">
                                                            <div class="mb-3 col-sm-6">
                                                                <label class="form-label" for="native_background_color">Background</label>
                                                                <div class="color-group d-flex">
                                                                    <input type="text" id="native_background_color" name="native_background_color" class="form-control clr-input" placeholder="Enter background" value="#FFFEFF">
                                                                    <input type="color" class="clr-picker" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-sm-6">
                                                                <label class="form-label" for="native_text_color">Text</label>
                                                                <div class="color-group d-flex">
                                                                    <input type="text" id="native_text_color" name="native_text_color" class="form-control clr-input" placeholder="Enter text color" value="#808080">
                                                                    <input type="color" class="clr-picker" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-sm-6">
                                                                <label class="form-label" for="native_button_background_color">Button Background</label>
                                                                <div class="color-group d-flex">
                                                                    <input type="text" id="native_button_background_color" name="native_button_background_color" class="form-control clr-input" placeholder="Enter button background" value="#4285F4">
                                                                    <input type="color" class="clr-picker" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-sm-6">
                                                                <label class="form-label" for="native_button_text_color">Button Text</label>
                                                                <div class="color-group d-flex">
                                                                    <input type="text" id="native_button_text_color" name="native_button_text_color" class="form-control clr-input" placeholder="Enter text color" value="#FFFEFF">
                                                                    <input type="color" class="clr-picker" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2"><p class="tab-title">Inter</p></div>
                                            <div class="col-sm-10">
                                                <table class="table table-centered table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>Alternate with AppOpen</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="alternateWithAppOpenShow" name="alternate_with_appopen" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="alternateWithAppOpenShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="alternateWithAppOpenHide" name="alternate_with_appopen" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="alternateWithAppOpenHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Inter Loading</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="inter_pre_loading" name="inter_loading" class="form-check-input" value="preload">
                                                                    <label class="form-check-label" for="inter_pre_loading">Preload</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="inter_on_loading" name="inter_loading" class="form-check-input" value="onload" checked>
                                                                    <label class="form-check-label" for="inter_on_loading">Onload</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Inter Interval (0 = Hide)</td>
                                                            <td>
                                                                <input type="number" class="form-control" id="inter_interval" name="inter_interval" placeholder="Inter Interval" value="0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Back Click Inter (0 = Hide)</td>
                                                            <td>
                                                                <input type="number" class="form-control" id="back_click_inter" name="back_click_inter" placeholder="Block Click Inter" value="0">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2"><p class="tab-title">App Open</p></div>
                                            <div class="col-sm-10">
                                                <table class="table table-centered table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>App Loading</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="app_open_pre_loading" name="app_open_loading" class="form-check-input" value="preload">
                                                                    <label class="form-check-label" for="app_open_pre_loading">Preload</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="app_open_on_loading" name="app_open_loading" class="form-check-input" value="onload" checked>
                                                                    <label class="form-check-label" for="app_open_on_loading">Onload</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Splash ads</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="splash_ads_preload" name="splash_ads" class="form-check-input" value="inter">
                                                                    <label class="form-check-label" for="splash_ads_preload">Preload</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="splash_ads_onload" name="splash_ads" class="form-check-input" value="openads">
                                                                    <label class="form-check-label" for="splash_ads_onload">Onload</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="splash_ads_hide" name="splash_ads" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="splash_ads_hide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>App Open</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="app_open_onetime" name="app_open" class="form-check-input" value="onetime" checked>
                                                                    <label class="form-check-label" for="app_open_onetime">One Time</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="app_open_everytime" name="app_open" class="form-check-input" value="everytime">
                                                                    <label class="form-check-label" for="app_open_everytime">Every Time</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="app_open_background_hide" name="app_open" class="form-check-input" value="background_hide">
                                                                    <label class="form-check-label" for="app_open_background_hide">Background Hide</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="app_open_hide" name="app_open" class="form-check-input" value="hide">
                                                                    <label class="form-check-label" for="app_open_hide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="btn-submit-div">
                                            <hr>
                                            <div class="row mt-2">
                                                <div class="col-sm-12 text-end">
                                                    <button type="button" class="btn btn-primary" onclick="saveAdSettings()">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 d-flex justify-content-center">
                                        <div class="mobile-div ad-mobile-div">
                                            <div class="mobile-device"></div>
                                            <div class="mobile-design-preview">
                                                <div class="mobile-header">
                                                    <p>App Name Title</p>
                                                </div>
                                                <div class="mobile-body">
                                                    <img src="[ROOT_URL]assets/images/nativeImage.png" alt="" class="mt-1 w-100">
                                                    <div class="my-2" style="color: rgb(128, 128, 128);">
                                                        <div class="Test-Ad-title">Test Ad: Goggle Ads</div>
                                                        <div class="Test-Ad-subtitle">Stay up to date with your Ads Check</div>
                                                    </div>
                                                    <button class="btn btn-primary w-100 default-btn">Default</button>
                                                </div>
                                                <div class="mobile-footer">
                                                    <div class="px-2 start-app-btn"><button class="btn btn-primary w-100 startapp-btn">Start App</button></div>
                                                    <img src="[ROOT_URL]assets/images/banner.jpg" alt="" class="bottom-ad" class="w-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane" id="bifurcate" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="row">
                                            <div class="col-sm-2"><p class="tab-title m-0">Bifurcate</p></div>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="mb-3 col-sm-12">
                                                        <label class="form-label" for="bifurcate_location">Location</label>
                                                        <input type="text" id="bifurcate_location" name="bifurcate_location" class="form-control">
                                                    </div>
                                                    <div class="mb-3 col-sm-12">
                                                        <input type="hidden" name="bifurcate_id" id="bifurcate_id">
                                                        <div class="row d-flex px-2" id="location_div">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2"><p class="tab-title m-0">App Color</p></div>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="mb-3 col-sm-6">
                                                        <label class="form-label" for="bifurcate_app_color">App Color for Admin</label>
                                                        <div class="color-group d-flex">
                                                            <input type="text" id="bifurcate_app_color" name="bifurcate_app_color" class="form-control clr-input" placeholder="Enter app color" value="#000000">
                                                            <input type="color" class="clr-picker" />
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col-sm-6">
                                                        <label class="form-label" for="bifurcate_app_background_color">Background Color</label>
                                                        <div class="color-group d-flex">
                                                            <input type="text" id="bifurcate_app_background_color" name="bifurcate_app_background_color" class="form-control clr-input" placeholder="Enter app background color" value="#FFFFFF">
                                                            <input type="color" class="clr-picker" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2"><p class="tab-title">Native</p></div>
                                            <div class="col-sm-10">
                                                <table class="table table-centered table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>Native Loading</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_native_pre_loading" name="bifurcate_native_loading" class="form-check-input" value="preload">
                                                                    <label class="form-check-label" for="bifurcate_native_pre_loading">Preload</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_native_on_loading" name="bifurcate_native_loading" class="form-check-input" value="onload" checked>
                                                                    <label class="form-check-label" for="bifurcate_native_on_loading">Onload</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bottom Banner</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_bottom_native_banner" name="bifurcate_bottom_banner" class="form-check-input" value="native" checked>
                                                                    <label class="form-check-label" for="bifurcate_bottom_native_banner">Native</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_bottom_banner" name="bifurcate_bottom_banner" class="form-check-input" value="banner">
                                                                    <label class="form-check-label" for="bifurcate_bottom_banner">Banner</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_bottom_banner_hide" name="bifurcate_bottom_banner" class="form-check-input" value="hide">
                                                                    <label class="form-check-label" for="bifurcate_bottom_banner_hide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>All Screen Native</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_allScreenNativeShow" name="bifurcate_all_screen_native" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_allScreenNativeShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_AllScreenNativeHide" name="bifurcate_all_screen_native" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_AllScreenNativeHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>List Native</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_listNativeShow" name="bifurcate_list_native" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_listNativeShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_listNativeHide" name="bifurcate_list_native" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_listNativeHide">Hide</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input type="number" class="form-control" id="bifurcate_list_native_cnt" name="bifurcate_list_native_cnt" value="0" readonly>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Exit Dialoge Native</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_exitDialogeNativeShow" name="bifurcate_exit_dialoge_native" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_exitDialogeNativeShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_exitDialogeNativeHide" name="bifurcate_exit_dialoge_native" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_exitDialogeNativeHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Native Button Text</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_nativeBtnManual" name="bifurcate_native_btn" class="form-check-input" value="manual">
                                                                    <label class="form-check-label" for="bifurcate_nativeBtnManual">Manual</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_nativeBtnDefault" name="bifurcate_native_btn" class="form-check-input" value="default" checked>
                                                                    <label class="form-check-label" for="bifurcate_nativeBtnDefault">Default</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input type="text" class="form-control" id="bifurcate_native_btn_text" name="bifurcate_native_btn_text" placeholder="Native Button Text">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="card border-radius-15 shadow-none border-light">
                                                    <div class="card-body">
                                                        <h3>Native Color</h3>
                                                        <div class="row">
                                                            <div class="mb-3 col-sm-6">
                                                                <label class="form-label" for="bifurcate_native_background_color">Background</label>
                                                                <div class="color-group d-flex">
                                                                    <input type="text" id="bifurcate_native_background_color" name="bifurcate_native_background_color" class="form-control clr-input" placeholder="Enter background" value="#FFFEFF">
                                                                    <input type="color" class="clr-picker" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-sm-6">
                                                                <label class="form-label" for="bifurcate_native_text_color">Text</label>
                                                                <div class="color-group d-flex">
                                                                    <input type="text" id="bifurcate_native_text_color" name="bifurcate_native_text_color" class="form-control clr-input" placeholder="Enter text color" value="#808080">
                                                                    <input type="color" class="clr-picker" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-sm-6">
                                                                <label class="form-label" for="bifurcate_native_button_background_color">Button Background</label>
                                                                <div class="color-group d-flex">
                                                                    <input type="text" id="bifurcate_native_button_background_color" name="bifurcate_native_button_background_color" class="form-control clr-input" placeholder="Enter button background" value="#4285F4">
                                                                    <input type="color" class="clr-picker" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-sm-6">
                                                                <label class="form-label" for="bifurcate_native_button_text_color">Button Text</label>
                                                                <div class="color-group d-flex">
                                                                    <input type="text" id="bifurcate_native_button_text_color" name="bifurcate_native_button_text_color" class="form-control clr-input" placeholder="Enter text color" value="#FFFEFF">
                                                                    <input type="color" class="clr-picker" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2"><p class="tab-title">Inter</p></div>
                                            <div class="col-sm-10">
                                                <table class="table table-centered table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>Alternate with AppOpen</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_alternateWithAppOpenShow" name="bifurcate_alternate_with_appopen" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_alternateWithAppOpenShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_alternateWithAppOpenHide" name="bifurcate_alternate_with_appopen" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_alternateWithAppOpenHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Inter Loading</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_inter_pre_loading" name="bifurcate_inter_loading" class="form-check-input" value="preload">
                                                                    <label class="form-check-label" for="bifurcate_inter_pre_loading">Preload</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_inter_on_loading" name="bifurcate_inter_loading" class="form-check-input" value="onload" checked>
                                                                    <label class="form-check-label" for="bifurcate_inter_on_loading">Onload</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Inter Interval (0 = Hide)</td>
                                                            <td>
                                                                <input type="number" class="form-control" id="bifurcate_inter_interval" name="bifurcate_inter_interval" placeholder="Inter Interval" value="0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Back Click Inter (0 = Hide)</td>
                                                            <td>
                                                                <input type="number" class="form-control" id="bifurcate_back_click_inter" name="bifurcate_back_click_inter" placeholder="Back Click Inter" value="0">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2"><p class="tab-title">App Open</p></div>
                                            <div class="col-sm-10">
                                                <table class="table table-centered table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>App Loading</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_app_open_pre_loading" name="bifurcate_app_open_loading" class="form-check-input" value="preload">
                                                                    <label class="form-check-label" for="bifurcate_app_open_pre_loading">Preload</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_app_open_on_loading" name="bifurcate_app_open_loading" class="form-check-input" value="onload" checked>
                                                                    <label class="form-check-label" for="bifurcate_app_open_on_loading">Onload</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Splash ads</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_splash_ads_preload" name="bifurcate_splash_ads" class="form-check-input" value="inter">
                                                                    <label class="form-check-label" for="bifurcate_splash_ads_preload">Preload</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_splash_ads_onload" name="bifurcate_splash_ads" class="form-check-input" value="openads">
                                                                    <label class="form-check-label" for="bifurcate_splash_ads_onload">Onload</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_splash_ads_hide" name="bifurcate_splash_ads" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_splash_ads_hide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>App Open</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_app_open_onetime" name="bifurcate_app_open" class="form-check-input" value="onetime" checked>
                                                                    <label class="form-check-label" for="bifurcate_app_open_onetime">One Time</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_app_open_everytime" name="bifurcate_app_open" class="form-check-input" value="everytime">
                                                                    <label class="form-check-label" for="bifurcate_app_open_everytime">Every Time</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_app_open_background_hide" name="bifurcate_app_open" class="form-check-input" value="background_hide">
                                                                    <label class="form-check-label" for="bifurcate_app_open_background_hide">Background Hide</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_app_open_hide" name="bifurcate_app_open" class="form-check-input" value="hide">
                                                                    <label class="form-check-label" for="bifurcate_app_open_hide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2"><p class="tab-title">Other Setting</p></div>
                                            <div class="col-sm-10">
                                                <table class="table table-centered table-borderless">
                                                    <tbody id="bifurcate_setting_table">
                                                        <tr>
                                                            <td>All Ads</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_allAdsShow" name="bifurcate_all_ads" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_allAdsShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_allAdsHide" name="bifurcate_all_ads" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_allAdsHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Full Screen (Navigation)</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_fullscreenShow" name="bifurcate_fullscreen" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_fullscreenShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_fullscreenHide" name="bifurcate_fullscreen" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_fullscreenHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>VersionCode for adBlock</td>
                                                            <td>
                                                                <input type="text" id="bifurcate_adblock_version" name="bifurcate_adblock_version" class="form-control" placeholder="0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Continue Screen</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_continueSceenShow" name="bifurcate_continue_screen" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_continueSceenShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_continueSceenHide" name="bifurcate_continue_screen" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_continueSceenHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Let's Start Screen</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_letsStartScreenShow" name="bifurcate_lets_start_screen" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_letsStartScreenShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_letsStartScreenHide" name="bifurcate_lets_start_screen" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_letsStartScreenHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Age/Gender Start Screen</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_ageScreenShow" name="bifurcate_age_screen" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_ageScreenShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_ageScreenHide" name="bifurcate_age_screen" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_ageScreenHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Next Screen</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_nextScreenShow" name="bifurcate_next_screen" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_nextScreenShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_nextScreenHide" name="bifurcate_next_screen" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_nextScreenHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Next Inner Screen</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_nextInnerScreenShow" name="bifurcate_next_inner_screen" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_nextInnerScreenShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_nextInnerScreenHide" name="bifurcate_next_inner_screen" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_nextInnerScreenHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Contact Screen</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_contactScreenShow" name="bifurcate_contact_screen" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_contactScreenShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_contactScreenHide" name="bifurcate_contact_screen" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_contactScreenHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Start Screen</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_startScreenShow" name="bifurcate_start_screen" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_startScreenShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_startScreenHide" name="bifurcate_start_screen" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_startScreenHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Real Casting Flow</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_realCastingFlowShow" name="bifurcate_real_casting_flow" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_realCastingFlowShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_realCastingFlowHide" name="bifurcate_real_casting_flow" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_realCastingFlowHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dialog For App Stop</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_appStopShow" name="bifurcate_app_stop" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_appStopShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_appStopHide" name="bifurcate_app_stop" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_appStopHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <button type="button" class="btn btn-outline-info rounded-pill" onclick="add_setting_field()"><span class="fa-plus"></span> Add Field</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2"><p class="tab-title">VPN Setting</p></div>
                                            <div class="col-sm-10">
                                                <table class="table table-centered table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>VPN</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_vpnShow" name="bifurcate_vpn" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_vpnShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_vpnHide" name="bifurcate_vpn" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_vpnHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>VPN Dialog</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_vpnDialogShow" name="bifurcate_vpn_dialog" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_vpnDialogShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_vpnDialogHide" name="bifurcate_vpn_dialog" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_vpnDialogHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>VPN Dialog Open</td>
                                                            <td>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_vpnDialogOpenShow" name="bifurcate_vpn_dialog_open" class="form-check-input" value="show">
                                                                    <label class="form-check-label" for="bifurcate_vpnDialogOpenShow">Show</label>
                                                                </div>
                                                                <div class="form-check form-radio-success form-check-inline">
                                                                    <input type="radio" id="bifurcate_vpnDialogOpenHide" name="bifurcate_vpn_dialog_open" class="form-check-input" value="hide" checked>
                                                                    <label class="form-check-label" for="bifurcate_vpnDialogOpenHide">Hide</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td>VPN List Country</td>
                                                            <td>
                                                                <input type="text" id="bifurcate_vpn_country" name="bifurcate_vpn_country" class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>VPN URL</td>
                                                            <td>
                                                                <input type="text" id="bifurcate_vpn_url" name="bifurcate_vpn_url" class="form-control" placeholder="VPN URL">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>VPN Carrier Id</td>
                                                            <td>
                                                                <input type="text" id="bifurcate_vpn_carrier_id" name="bifurcate_vpn_carrier_id" class="form-control" placeholder="VPN Carrier Id">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="btn-submit-div">
                                            <hr class="mt-0">
                                            <div class="row mt-2">
                                                <div class="col-sm-12 text-end">
                                                    <button type="button" class="btn btn-primary" onclick="saveBifurcate_AdSettings()">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 d-flex justify-content-center">
                                        <div class="mobile-div bifurcate-mobile-div">
                                            <div class="mobile-device"></div>
                                            <div class="mobile-design-preview">
                                                <div class="mobile-header">
                                                    <p>App Name Title</p>
                                                </div>
                                                <div class="mobile-body">
                                                    <img src="[ROOT_URL]assets/images/nativeImage.png" alt="" class="mt-1 w-100">
                                                    <div class="my-2" style="color: rgb(128, 128, 128);">
                                                        <div class="Test-Ad-title">Test Ad: Goggle Ads</div>
                                                        <div class="Test-Ad-subtitle">Stay up to date with your Ads Check</div>
                                                    </div>
                                                    <button class="btn btn-primary w-100 default-btn">Default</button>
                                                </div>
                                                <div class="mobile-footer">
                                                    <div class="px-2 start-app-btn"><button class="btn btn-primary w-100 startapp-btn">Start App</button></div>
                                                    <img src="[ROOT_URL]assets/images/banner.jpg" alt=""  class="bottom-ad" class="w-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane" id="other" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-2"><p class="tab-title">Setting</p></div>
                                    <div class="col-sm-10">
                                        <table class="table table-centered table-borderless">
                                            <tbody id="setting_table">
                                                <tr>
                                                    <td>All Ads</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="allAdsShow" name="all_ads" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="allAdsShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="allAdsHide" name="all_ads" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="allAdsHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Full Screen (Navigation)</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="fullscreenShow" name="fullscreen" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="fullscreenShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="fullscreenHide" name="fullscreen" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="fullscreenHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>VersionCode for adBlock</td>
                                                    <td>
                                                        <input type="text" id="adblock_version" name="adblock_version" class="form-control" placeholder="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Continue Screen</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="continueSceenShow" name="continue_screen" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="continueSceenShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="continueSceenHide" name="continue_screen" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="continueSceenHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Let's Start Screen</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="letsStartScreenShow" name="lets_start_screen" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="letsStartScreenShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="letsStartScreenHide" name="lets_start_screen" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="letsStartScreenHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Age/Gender Start Screen</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="ageScreenShow" name="age_screen" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="ageScreenShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="ageScreenHide" name="age_screen" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="ageScreenHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Next Screen</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="nextScreenShow" name="next_screen" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="nextScreenShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="nextScreenHide" name="next_screen" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="nextScreenHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Next Inner Screen</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="nextInnerScreenShow" name="next_inner_screen" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="nextInnerScreenShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="nextInnerScreenHide" name="next_inner_screen" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="nextInnerScreenHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Contact Screen</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="contactScreenShow" name="contact_screen" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="contactScreenShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="contactScreenHide" name="contact_screen" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="contactScreenHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Start Screen</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="startScreenShow" name="start_screen" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="startScreenShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="startScreenHide" name="start_screen" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="startScreenHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Real Casting Flow</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="realCastingFlowShow" name="real_casting_flow" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="realCastingFlowShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="realCastingFlowHide" name="real_casting_flow" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="realCastingFlowHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Dialog For App Stop</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="appStopShow" name="app_stop" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="appStopShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="appStopHide" name="app_stop" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="appStopHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-2 btn-submit-div full-width">
                                    <div class="col-sm-12 text-end">
                                        <button type="button" class="btn btn-primary" onclick="saveOtherSettings()">Update</button>
                                        <button type="button" class="btn btn-primary" onclick="add_setting_field()">Add Field</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane" id="vpn" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-2"><p class="tab-title">VPN Setting</p></div>
                                    <div class="col-sm-10">
                                        <table class="table table-centered table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>VPN</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="vpnShow" name="vpn" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="vpnShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="vpnHide" name="vpn" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="vpnHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>VPN Dialog</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="vpnDialogShow" name="vpn_dialog" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="vpnDialogShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="vpnDialogHide" name="vpn_dialog" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="vpnDialogHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>VPN Dialog Open</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="vpnDialogOpenShow" name="vpn_dialog_open" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="vpnDialogOpenShow">Show</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="vpnDialogOpenHide" name="vpn_dialog_open" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="vpnDialogOpenHide">Hide</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>VPN List Country</td>
                                                    <td>
                                                        <input type="text" id="vpn_country" name="vpn_country" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>VPN URL</td>
                                                    <td>
                                                        <input type="text" id="vpn_url" name="vpn_url" class="form-control" placeholder="VPN URL">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>VPN Carrier Id</td>
                                                    <td>
                                                        <input type="text" id="vpn_carrier_id" name="vpn_carrier_id" class="form-control" placeholder="VPN Carrier Id">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-2 btn-submit-div full-width">
                                    <div class="col-sm-12 text-end">
                                        <button type="button" class="btn btn-primary" onclick="saveVPNSettings()">Update</button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="app-remove" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-2"><p class="tab-title">App Remove Flags</p></div>
                                    <div class="col-sm-10">
                                        <table class="table table-centered table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>flags</td>
                                                    <td>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="forceUpdate" name="app_remove_flag" class="form-check-input" value="force_update">
                                                            <label class="form-check-label" for="forceUpdate">Force Update</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="skipUpdate" name="app_remove_flag" class="form-check-input" value="skip_update">
                                                            <label class="form-check-label" for="skipUpdate">Skip Update</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="moveApp" name="app_remove_flag" class="form-check-input" value="move_app">
                                                            <label class="form-check-label" for="moveApp">Move App</label>
                                                        </div>
                                                        <div class="form-check form-radio-success form-check-inline">
                                                            <input type="radio" id="normal" name="app_remove_flag" class="form-check-input" value="normal" checked>
                                                            <label class="form-check-label" for="normal">Normal</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Version</td>
                                                    <td><input type="text" id="app_version" name="app_version" class="form-control" placeholder="App Version"></td>
                                                </tr>
                                                <tr>
                                                    <td>Title</td>
                                                    <td><input type="text" id="app_remove_title" name="app_remove_title" class="form-control" placeholder="Title"></td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td><input type="text" id="app_remove_description" name="app_remove_description" class="form-control" placeholder="Description"></td>
                                                </tr>
                                                <tr>
                                                    <td>URL</td>
                                                    <td><input type="text" id="app_remove_url" name="app_remove_url" class="form-control" placeholder="URL"></td>
                                                </tr>
                                                <tr>
                                                    <td>Button Name</td>
                                                    <td><input type="text" id="app_remove_button_name" name="app_remove_button_name" class="form-control" placeholder="Button Name"></td>
                                                </tr>
                                                <tr>
                                                    <td>Skip Button Name</td>
                                                    <td><input type="text" id="app_remove_skip_button_name" name="app_remove_skip_button_name" class="form-control" placeholder="Skip Button Name"></td>
                                                </tr>
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-2 btn-submit-div full-width">
                                    <div class="col-sm-12 text-end">
                                        <button type="button" class="btn btn-primary" onclick="saveAppRemoveSettings()">Update</button>
                                    </div>
                                </div>
                            </div>
                                <!-- end preview code-->
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

<div id="add_setting_field_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title comman_list_model_header" id="multiple-twoModalLabel">Add Field</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="POST">
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <label class="form-label" for="field_name">Field Name</label>
                            <input type="text" id="field_name" name="field_name" class="form-control" placeholder="field name" />
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="form-label" for="field_name">Type</label>
                            <div class="form-check form-radio-success mb-1">
                                <input type="radio" id="field_type_radio" name="field_type" class="form-check-input" value="1" checked>
                                <label class="form-check-label" for="field_type_radio">Radio</label>
                            </div>
                            <div class="form-check form-radio-success mb-1">
                                <input type="radio" id="field_type_text" name="field_type" class="form-check-input" value="2">
                                <label class="form-check-label" for="field_type_text">Textbox</label>
                            </div>
                            <div class="form-check form-radio-success mb-1">
                                <input type="radio" id="field_type_both" name="field_type" class="form-check-input" value="3">
                                <label class="form-check-label" for="field_type_both">Radio + Textbox</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">close</button>
                <button type="button" class="btn btn-primary" onclick="append_setting_field()">Add</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="add_setting_res_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title comman_list_model_header" id="multiple-twoModalLabel">Response</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <button class="btn copy-btn" type="button" id="copy_code">Copy <i class="fa-regular fa-clone"></i></button>
                <div id="res_data"></div>
            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="delete_bif_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-body p-4">
				<div class="text-center">
					<i class="ri-alert-line h1 text-warning"></i>
					<h4 class="mt-2">Are you sure?</h4>
					<p class="mt-3">you want to delete bifurcate data?</p>
					<button type="button" class="btn btn-warning my-2 conform-btn" data-bs-dismiss="modal" onclick="delete_bifurcate_record()">Continue</button>
					<button type="button" class="btn btn-default my-2" data-bs-dismiss="modal" onclick="PRIMARY_ID = 0;">close</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>