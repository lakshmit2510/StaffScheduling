<?php $this->load->view('template/header');
$Activeusr = $this->Dashboard_model->GetUserCount('Active');
$InActiveusr = $this->Dashboard_model->GetUserCount('In-Active');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/evo-calendar.css?random=<?php echo uniqid(); ?>" />
<style>
    .booking {
        position: relative;
        /* background-color: lightblue; */
        /* width: 100%; */
        margin-top: 100px;
    }

    @media (min-width: 1200px) {
        .col-xl-3 {
            flex: 0 0 25%;
            max-width: 21%;
        }
    }

    #eventAddButton {
        display: none;
    }

    .shiftslot {
        background-color: #0b53ca;
        display: inline-block;
        width: 100%;
        color: #fff;
        text-align: center;
        height: 60px;
        margin: 0 5px;
        border-radius: 8px;
        padding: 13px;
        cursor: pointer;
        border: 1px dashed #b5b5b5;
    }

    #shiftslots-div input[type=checkbox] {
        display: none;
    }

    #shiftslots-div input[type=checkbox]:checked+.shiftslot {
        background-color: #11ca11;
        color: #fff;
        border: 1px dashed #333;
    }

    #shiftslots-div input[type=checkbox]:disabled+.shiftslot {
        background-color: #a350b1;
        color: #fff;
        border: 1px dashed #333;
    }

    #shiftslots-div input[type=checkbox]:disabled:not(.highlight-Booked)+.shiftslot {
        background-color: #e60606;
        color: #fff;
        border: 1px dashed #333;
    }

    @media only screen and (max-width: 600px) {
        .docklegend {
            display: inline-block;
            width: 100% !important;
            float: none !important;
        }
    }

    .docklegend {
        /* display: inline-block; */
        width: 35%;
        position: relative;
        float: right;
        right: 0;
        top: 0;
    }

    .docklegend>span {
        width: 100px;
        display: block;
        float: left;
        font-size: 15px;
    }

    .docklegend>span::before {
        content: '';
        width: 26px;
        display: block;
        height: 13px;
        float: left;
        margin: 4px 5px;
        padding: 0px;
    }

    .docklegend>span.free::before {
        background: #0b53ca;
    }

    .docklegend>span.NotAvailable::before {
        background: #e60606;
    }

    .docklegend>span.booked::before {
        background: #a350b1;
    }

    .docklegend>span.select::before {
        background: #11ca11;
    }
</style>

<div class="mt-5"></div>
<?php $this->load->view('template/card-head'); ?>

<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row wizard-row">
            <div class="col-md-12 fuelux">
                <h1 class="panel-heading panel-heading-divider my-3"><?= $Title ?> </h1>
                <hr />
                <?php if ($this->session->flashdata('type') == 'done') { ?>
                    <div role="alert" class="alert alert-success alert-dismissible">
                        <div class="message">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Success!</strong> <?php echo $this->session->flashdata('done'); ?>.
                        </div>
                    </div>
                <?php } else if ($this->session->flashdata('type') == 'error') { ?>
                    <div role="alert" class="alert alert-danger alert-dismissible">
                        <div class="message">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Error!</strong> <?php echo $this->session->flashdata('msg'); ?>.
                        </div>
                    </div>
                <?php } ?>
                <h3 class="panel-heading panel-heading-divider my-3">Please Select Date to Create Booking </h3>

                <!-- calender  -->
                <div class="row booking">
                    <div id="evoCalendar" class="sidebar-hide"></div>
                </div>

                <form action="<?= base_url('Booking/Save') ?>" class="form-horizontal" method="post" enctype="multipart/form-data" id="booking-form">

                    <input type="hidden" name="FullName" required="true" id="FullName">
                    <input type="hidden" name="ICNumber" required="true" id="ICNumber">
                    <!-- <input type="hidden" name="EmailAddress" value="<?php echo $UserData->EmailAddress1 ?>"> -->
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="col-sm-6 control-label">Employee Name</label>
                            <div class="col-sm-9">
                                <select class="form-control required" required="true" id="EmployeeName" name="UserId">
                                    <option value="">--- Choose Employee ----</option>
                                    <?php
                                    foreach ($Users as $key => $value) {
                                        echo '<option value="' . $value->UserUID . '">' . $value->FullName . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="col-sm-6 control-label">Email Address</label>
                            <div class="col-sm-9">
                                <input name="EmailAddress" type="text" id="EmailAddress" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- Card stats -->
                    <div id="ShiftDetails">
                        <h3>Please Select Shift</h3>
                        <div class=" row docklegend"><span class="free"> Available</span><span class="booked"> Booked</span><span class="select">Selected</span><span class="NotAvailable" style="width: 116px">NotAvailable</span>
                        </div>
                        <div class="row mb-5 pt-5">
                            <?php foreach ($Shifts as $value) { ?>
                                <div class="col-xl-3 col-lg-6" id="highlight" style="margin-bottom: 15px">
                                    <div id="shiftslots-div" data-shift-id="<?php echo $value->ShiftID; ?>">
                                        <input type="checkbox" name="shiftTiming" class="freeslots" id="<?php echo $value->ShiftID; ?>" value="<?php echo $value->StartTime ?> - <?php echo $value->EndTime ?>" disabled="true">
                                        <label class="shiftslot" for="<?php echo $value->ShiftID; ?>"><?php echo $value->StartTime ?> - <?php echo $value->EndTime ?></label>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- table data -->
                    <div class="row mt-4" id="booking-detail-Summary" style="display:none;">
                        <div class="col-sm-8">
                            <h2 class="text-primary">Booking Summary</h2>
                            <table class="table shadow-sm border">
                                <thead class="thead-light">
                                    <th class="text-primary">Date</th>
                                    <th class="text-primary">Time</th>
                                    <th class="text-primary">Action</th>
                                </thead>
                                <tbody class="list">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <div class="col-sm-10" style="padding: 15px 0;">
                                <button type="submit" class="btn btn-success btn-lg" id="submitButton" disabled>Confirm & Proceed to Book <i class="fa fa-check-circle fa-big ml-2" style="font-size: 18px; "></i></button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('template/footer'); ?>
<script src="<?php echo base_url() ?>assets/js/evo-calendar.js?random=<?php echo uniqid(); ?>" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/lib/parsley/parsley.min.js" type="text/javascript"></script>

<script type="text/javascript">
    String.prototype.hashCode = function() {
        var hash = 0,
            i, chr;
        if (this.length === 0) return hash;
        for (i = 0; i < this.length; i++) {
            chr = this.charCodeAt(i);
            hash = ((hash << 5) - hash) + chr;
            hash |= 0; // Convert to 32bit integer
        }
        return hash;
    };

    $(document).ready(function() {

        $('#ShiftDetails').hide();
        $('#shiftslots-div input,#evoCalendar').on("change", tableData);
        var bookingDate = <?php echo (json_encode($Booking_data)) ?>;
        var myEvents = [];
        $.each(bookingDate, function(key, item) {
            myEvents.push({
                name: "Working Day",
                date: item.StartDate,
                type: "event",
                everyYear: true
            });
        });
        $('#evoCalendar').evoCalendar({
            format: 'mm/dd/yyyy',
            titleFormat: 'MM yyyy',
            eventHeaderFormat: 'MM d, yyyy',
            todayHighlight: true,
            calendarEvents: myEvents,
            onSelectDate: function(date) {
                var UserID = $("input[name=UserId]").val();
                var selectedDate = $(date.currentTarget).attr('date-val');
                var dateArr = selectedDate.split('/');
                var newDate = dateArr[2] + '-' + dateArr[0] + '-' + dateArr[1];
                datas = new FormData();
                datas.append('selectedDate', newDate);

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>Booking/getAvailableShiftTimings',
                    data: datas,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.be-loading').addClass('be-loading-active');
                    },
                    success: function(data) {
                        var parseData = JSON.parse(data);
                        $('.be-loading').addClass('be-loading-active');
                        $('.freeslots').prop("disabled", false);
                        $('#ShiftDetails').find('.freeslots').prop('checked', false);
                        $('#ShiftDetails').find('.freeslots').prop('disabled', false);
                        $('#ShiftDetails').find('.freeslots').removeClass('highlight-Booked');
                        if (parseData.length > 0) {
                            $.each(parseData, function(idx, item) {
                                var ele = $("[id='" + item.ShiftID + "']");

                                if (parseInt(item.AvailableBookings) == parseInt(item.Count)) {
                                    ele.prop("disabled", true);
                                } else {
                                    if (item.StartDate == newDate && parseInt(item.UserID) == UserID) {
                                        ele.prop("disabled", true);
                                        ele.addClass('highlight-Booked');
                                    } else {
                                        ele.prop("disabled", false);
                                        ele.removeClass('highlight-Booked');
                                    }
                                }
                            });
                        }
                        $('#ShiftDetails').show();
                    },
                });
            },
        });

        var prevDate = '';
        var prevSlot = '';

        function tableData() {
            var date = $('.calendar-active').attr('date-val');
            var shiftSlot = $('.freeslots:checked').val();
            var bookingShiftId = $(".freeslots:checked").attr("id");

            $("#booking-detail-Summary").slideDown();
            var isExists = $('#' + date.hashCode());
            var tableRow = '<tr id="' + date.hashCode() + '" >';

            tableRow += '<input type="hidden" value="' + bookingShiftId + '" name="Shift_Id[]"/>';
            tableRow += '<td class="name">' + date + '</td>';
            tableRow += '<input type="hidden" value="' + date + '" name="Day[]"/>';
            tableRow += '<td class="shiftSlot">' + shiftSlot + '</td>';
            tableRow += '<input type="hidden" value="' + shiftSlot + '" name="shiftSlot[]"/>';
            tableRow += '<td>';
            tableRow += '<button type="button" class="btn btn-primary delete-shift" style="margin-left:10px"> Delete </button>';
            tableRow += '</td>';
            tableRow += '</tr>';

            if (prevDate === date && prevSlot !== shiftSlot) {
                isExists.replaceWith(tableRow);
            } else if (prevDate !== date) {
                $('#booking-detail-Summary tbody').prepend(tableRow);
            }
            prevDate = date;
            prevSlot = shiftSlot;
            $("#submitButton").prop('disabled', false);
        }

        $('#booking-detail-Summary').on('click', '.delete-shift', function() {
            var trEle = $(this).parents('tr');
            trEle.remove();
        });

        $(document).on('click', '.freeslots', function() {
            var limit = 1; //$('#SlotNos').val();
            if (limit == '') {
                $.gritter.add({
                    title: 'Please choose Number of docs',
                    time: 1000,
                    class_name: "color danger"
                });
                return false;
            }

            if (limit == 1) {
                $('.freeslots').not(this).prop('checked', false);
                return true;
            }
        });

        $('#EmployeeName').change(function() {
            datas = new FormData();
            datas.append('EmployeeName', $(this).val());
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('Booking/getUserInfo/') ?>',
                data: datas,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.be-loading').addClass('be-loading-active');
                },
                success: function(data) {
                    $('.be-loading').removeClass('be-loading-active');
                    $('#ICNumber').empty();
                    $('#ICNumber').val(data.ID);
                    $('#EmailAddress').empty();
                    $('#EmailAddress').val(data.EmailAddress1);
                    $('#FullName').val(data.FullName);
                }
            });
        });

        $('.submitButton').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                type: 'post',
                url: '<?php echo base_url('Booking/Save/') ?>',
                data: $('#booking-form').serialize(),
                success: function(res) {
                    console.log(res);
                    window.location.reload();
                }
            });
        });
    });
</script>