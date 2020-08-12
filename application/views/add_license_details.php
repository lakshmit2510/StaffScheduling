<?php $this->load->view('template/header'); ?>

<div class="mt-5"></div>
<?php $this->load->view('template/card-head'); ?>
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary be-loading">
                    <h1 class="my-3 panel-heading panel-heading-divider"><i class="icon mdi mdi-car"></i> <?php echo $Title; ?></h1>
                    <hr />
                    <div class="panel-body">
                        <form action="<?php echo base_url('License_Details/addLicenseDetailsPost'); ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> ADP Holders Name</label>
                                <div class="col-sm-6">
                                    <input type="text" required="" name="ADPHolderName" placeholder="Please Enter the name as per ADP" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">License Number</label>
                                <div class="col-sm-6">
                                    <input type="text" required="" name="licenseNumber" placeholder="Please Enter License Number" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> License Category</label>
                                <div class="col-sm-6">
                                    <input type="text" required="" name="LicenseCategory" placeholder="Please Enter Type Of License" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> License Sub Category</label>
                                <div class="col-sm-6">
                                    <input type="text" required="" name="LicenseSubCategory" placeholder="Please Enter Sub Type Of License" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">License Issue Date</label>
                                <div class="col-sm-6">
                                    <input type="date" required="" name="LicenseIssueDate" placeholder="dd/mm/yyyy" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">License Expiry Date</label>
                                <div class="col-sm-6">
                                    <input type="date" required="" name="LicenseExpiryDate" placeholder="dd/mm/yyyy" class="form-control">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-sm-3 control-label">Date of Issue</label>
                                <div class="col-sm-6">
                                    <input type="date" required="" name="DateofIssue" placeholder="dd/mm/yyyy" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Gender</label>
                                <div class="col-sm-6">
                                    <select class="form-control" required="true" name="Gender">
                                        <option value="">--- Choose Gender ---</option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Race</label>
                                <div class="col-sm-6">
                                    <input type="text" name="race" placeholder="Race" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Attatch IC</label>
                                <div class="col-sm-6">
                                    <input required="" type="file" name="upload_file" />
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <a href="<?php echo base_url('License_Details'); ?>" class="btn btn-space btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="be-spinner">
                        <svg width="50px" height="50px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                            <circle fill="none" stroke-width="5" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                        </svg>
                    </div>

                </div>
            </div>

            <?php $this->load->view('template/card-foot'); ?>

            <?php $this->load->view('template/footer'); ?>
            <script src="<?php echo base_url(); ?>assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('form').parsley();

                    $('select').select2();

                    $('form').submit(function() {
                        $('.be-loading').addClass('be-loading-active');
                    });

                });
            </script>