
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-xl-12 col-lg-12">
                    <div class="card border-radius-15">
                        <div class="card-body">

                            <div id="formDiv" style="display: none;">
                                <form id="manage_adx_form" class="needs-validation" method="POST" novalidate>
                                    <input type="hidden" id="id">
                                    <input type="hidden" id="formevent" name ="formevent"value="submit">
                                    <div class="row">
                                        <div class="mb-3 col-sm-12">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" required />
                                            <div class="invalid-feedback"> Please enter name. </div>
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
                                <table id="datatable" class="table dt-responsive nowrap vertical-middle w-100">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id</th>
                                            <th>Name</th>
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