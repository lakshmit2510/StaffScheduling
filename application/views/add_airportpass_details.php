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
                        <form action="<?php echo base_url('AirportPass/addAirportPass'); ?>" class="form-horizontal" method="post">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Airport Pass Number</label>
                                <div class="col-sm-6">
                                    <input type="text" required="" name="PassNumber" placeholder="Airport Pass Number" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Full Name</label>
                                <div class="col-sm-6">
                                    <select class="form-control" required="true" name="PassName">
                                        <option value="">--- Choose Employee Name ----</option>
                                        <?php
                                        foreach ($Users as $key => $value) {
                                            echo '<option value="' . $value->UserUID . '">' . $value->FullName . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <!-- <input type="text" required="" name="PassName" placeholder="Name as for Pass" class="form-control"> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date of Expiry</label>
                                <div class="col-sm-6">
                                    <input type="date" required="" name="DOE" placeholder="dd/mm/yyyy" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Access Control Areas : </label>
                                <div class="col-sm-6" style="margin-left: 30px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox1">Red - (A)- Apron with Baggage Sorting Area Access</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                        <label class="form-check-label" for="inlineCheckbox2">Red/White - (A)- Apron with no Baggage Sorting Area Access</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                                        <label class="form-check-label" for="inlineCheckbox3">Blue - (B)- Baggage Claim Hall/Arrival Transit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option4">
                                        <label class="form-check-label" for="inlineCheckbox3">Green - (C)- Changi Airfreight Centre</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="option5">
                                        <label class="form-check-label" for="inlineCheckbox3">Yellow - (D)- Departure Transit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox6" value="option6">
                                        <label class="form-check-label" for="inlineCheckbox3">Pink - (T)- Control Tower</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox7" value="option7">
                                        <label class="form-check-label" for="inlineCheckbox3">Brown - (V)- VIP Complex</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Attatch Airport Pass</label>
                                <div class="col-sm-6">
                                    <input type="file" name="upload_file" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <a href="<?php echo base_url('AirportPass/update'); ?>" class="btn btn-space btn-default">Cancel</a>
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