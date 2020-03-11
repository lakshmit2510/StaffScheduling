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
                        <form action="<?php echo base_url('Shifts/editShiftsPost'); ?>" class="form-horizontal" method="post">
                            <input type="hidden" value="<?php echo $shift_Details->ShiftID ?>" name="Shift_Id">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Available Bookings</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" value="<?php echo $shift_Details->AvailableBookings ?>" name="Bookingscount" placeholder="Enter available bookings">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Start Time</label>
                                <div class="col-sm-6">
                                    <input class="form-control timepicker" name="StartTime" value="<?php echo $shift_Details->StartTime ?>" placeholder="Enster start time">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">End Time</label>
                                <div class="col-sm-6">
                                    <input class="form-control timepicker" name="Endtime" value="<?php echo $shift_Details->EndTime ?>" placeholder="Enter end time">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <a href="<?php echo base_url('Shifts'); ?>" class="btn btn-space btn-default">Cancel</a>
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
                    $('.timepicker').timepicker({
                        timeFormat: 'HH:mm',
                        interval: 60,
                        // minTime: '10',
                        // maxTime: '6:00pm',
                        // defaultTime: '11',
                        // startTime: '10:00',
                        dynamic: false,
                        dropdown: true,
                        scrollbar: true
                    });
                });
            </script>