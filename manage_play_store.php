
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-xl-12 col-lg-12">
                    <div class="card border-radius-15">
                        <div class="card-body">

                            <div id="formDiv" style="display: none;">
                                <form id="manage_play_store_form" class="needs-validation" method="POST" novalidate>
                                    <input type="hidden" id="id">
                                    <input type="hidden" id="formevent" name ="formevent"value="submit">
                                    <div class="row">
                                        <div class="mb-3 col-sm-6">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" required />
                                            <div class="invalid-feedback"> Please enter name. </div>
                                        </div>
                                        <div class="mb-3 col-sm-6">
                                            <label class="form-label" for="device_owner">Device Owner</label>
                                            <input type="text" id="device_owner" name="device_owner" class="form-control" placeholder="Enter device owner" required />
                                            <div class="invalid-feedback"> Please enter device owner. </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-sm-6">
                                            <label class="form-label" for="service_number">Service Number</label>
                                            <input type="text" id="service_number" name="service_number" class="form-control" placeholder="Enter service number" required />
                                            <div class="invalid-feedback"> Please enter service number. </div>
                                        </div>
                                        <div class="mb-3 col-sm-6">
                                            <label class="form-label" for="remark">Remark</label>
                                            <input type="text" id="remark" name="remark" class="form-control" placeholder="Enter Remark" />
                                            <div class="invalid-feedback"> Please enter Remark. </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-sm-12">
                                            <div class="form-check form-check-inline form-radio-success">
                                                <input class="form-check-input" type="radio" name="status" id="upload_status" value="1" checked>
                                                <label class="form-check-label" for="upload_status">Upload</label>
                                            </div>
                                            <div class="form-check form-check-inline form-radio-success">
                                                <input class="form-check-input" type="radio" name="status" id="review_status" value="2">
                                                <label class="form-check-label" for="review_status">In Review</label>
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
                                        <div class="mb-3 col-sm-3 d-none">
                                            <label class="form-label" for="button">Button Text</label>
                                            <input type="text" id="button" name="button" class="form-control" placeholder="Enter Button Text" value="Buy Now" required />
                                            <div class="invalid-feedback"> Please enter Button Text. </div>
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
                                <div class="extra-option">
                                    <select class="form-select" id="extra_option">
                                        <option value="">All</option>
                                        <option value="1">Upload</option>
                                        <option value="2">In Review</option>
                                        <option value="3">Live</option>
                                        <option value="4">Suspended</option>
                                    </select>
                                </div>
                                <table id="datatable" class="table dt-responsive nowrap vertical-middle w-100">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id</th>
                                            <th>Name</th>
                                            <th>Device Owner</th>
                                            <th>Service Number</th>
                                            <th>Remark</th>
                                            <th>Status</th>
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