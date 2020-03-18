<?php $this->load->view('template/header'); ?>

<style>
    .selection {
        display: none;
    }
</style>

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
                        <form action="<?php echo base_url('KPI_Details/addKPIDetailsPost'); ?>" class="form-horizontal" method="post">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Flight Number</label>
                                <div class="col-sm-6">
                                    <input type="text" required="" name="FlightNumber" placeholder="Enter Flight Number" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Weight</label>
                                <div class="col-sm-6">
                                    <input type="text" required="" name="Weight" placeholder="Enter Input" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Employees</label>
                                <div class="col-sm-6">
                                    <select multiple class="form-control" id="Employees" data-parsley-trigger="keyup" required="true" name="Employees[]">
                                        <!-- <option value="">--- Choose Employees ----</option> -->
                                        <?php
                                        foreach ($Users as $key => $value) {
                                            echo '<option value="' . $value->FullName . '">' . $value->FullName . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <!-- <input type="text" required="" name="ICName" placeholder="Name as for IC" class="form-control"> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date</label>
                                <div class="col-sm-6">
                                    <input type="date" required="" name="date" placeholder="dd/mm/yyyy" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Type</label>
                                <div class="col-sm-6">
                                    <select class="form-control" required="true" name="type">
                                        <option value="">--- Choose Time Type ----</option>
                                        <option value="ETA">Arrival (ETA)</option>
                                        <option value="STD">Departure (STD)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Time</label>
                                <div class="col-sm-6">
                                    <input type="time" required="" displayFormat="HH:mm" name="time" placeholder="Select Time" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Attatch Document</label>
                                <div class="col-sm-6">
                                    <input required="" type="file" name="upload_file" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <a href="<?php echo base_url('IC_Details/update'); ?>" class="btn btn-space btn-default">Cancel</a>
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

                    // $('#Employees').multiSelect({
                    //     noneText: '--- Choose Employee ---'
                    // });

                });
            </script>