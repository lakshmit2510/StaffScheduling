<?php $this->load->view('template/header'); ?>

<div class="mt-5"></div>
<?php $this->load->view('template/card-head'); ?>
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary be-loading">
                    <h1 class="panel-heading panel-heading-divider my-3"> <?php echo $Title; ?></h1>
                    <hr />
                    <div class="panel-body">
                        <form action="<?php echo base_url('Projects/editProjectDetailsPost'); ?>" class="form-horizontal" method="post">
                            <input type="hidden" value="<?php echo $Project_Details->ProjectCode ?>" name="ProjectCode">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Project Name</label>
                                <div class="col-sm-6">
                                    <input type="text" required="" value="<?php echo $Project_Details->ProjectName ?>" name="projectname" placeholder="Name of the Project" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Location</label>
                                <div class="col-sm-6">
                                    <input type="text" required="" name="location" value="<?php echo $Project_Details->Location ?>" placeholder="Location Name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Project Supervisor</label>
                                <div class="col-sm-6">
                                    <input type="text" required="" name="supervisor" value="<?php echo $Project_Details->ProjectSupervisor ?>" placeholder="Name of the Supervisor" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Project Manager</label>
                                <div class="col-sm-6">
                                    <input type="text" required="" name="manager" placeholder="Name of the manager" class="form-control" value="<?php echo $Project_Details->ProjectManager ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <a href="<?php echo base_url('Projects'); ?>" class="btn btn-space btn-default">Cancel</a>
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