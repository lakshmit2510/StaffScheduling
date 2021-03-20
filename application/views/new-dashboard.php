<?php $this->load->view('template/header');
$Activeusr = $this->Dashboard_model->GetUserCount('Active');
$InActiveusr = $this->Dashboard_model->GetUserCount('In-Active');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/evo-calendar.css" />
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

    @media only screen and (max-width: 600px) {
        .docklegend {
            display: inline-block;
            width: 100% !important;
            float: none !important;
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
        background: #FF9800;
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
                <?php if ($this->session->flashdata('done')) { ?>
                    <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
                        <div class="icon"><span class="mdi mdi-check"></span></div>
                        <div class="message">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Success!</strong> <?php echo $this->session->flashdata('done'); ?>.
                        </div>
                    </div>
                <?php } ?>
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

                <!-- <h4 class="text-primary font-weight-300 mb-4">
                    <i class="fa fa-info-circle"></i> Inorder to make bookings, Please Check <b>NRIC Details and Airport Pass Details </b> updated or not.
                </h4> -->

                <form action="<?= base_url('Booking/Save') ?>" class="form-horizontal" method="post" enctype="multipart/form-data" id="booking-form">

                    <input type="hidden" required="true" name="FullName" value="<?php echo $UserData->FullName ?>">
                    <input type="hidden" required="true" name="UserId" value="<?php echo $UserData->UserUID ?>">
                    <input type="hidden" required="true" name="ICNumber" value="<?php echo $UserData->ID ?>">
                    <input type="hidden" required="true" name="EmailAddress" value="<?php echo $UserData->EmailAddress1 ?>">

                    <div class="form-group">
                        <h3> Employeement Type</h3>
                        <div class="row">
                            <div class='col-sm-3'>
                                <label  for='fullTime'>
                                    <input type='radio' name='employeementType' id='fullTime' value='Full Time' required/>&nbsp;
                                    Full Time
                                </label>
                            </div>
                            <div class='col-sm-3'>
                                <label  for='fixedFlexi'>
                                    <input type='radio' name='employeementType' id='fixedFlexi' value='Fixed Flexi'/>&nbsp;
                                    Fixed Flexi
                                </label>
                            </div>
                            <div class='col-sm-3'>
                                <label  for='fullTimeFlexi'>
                                    <input type='radio' name='employeementType' id='fullTimeFlexi' value='Full Time Flexi'/>&nbsp;
                                    Full Time Flexi
                                </label>
                            </div>
                            <div class='col-sm-3'>
                                <label  for='partTimeFlexi'>
                                    <input type='radio' name='employeementType' id='partTimeFlexi' value='Part Time Flexi'/>&nbsp;
                                    Part Time Flexi
                                </label>
                            </div>
                        </div>   
                    </div>

                    <h3 class="panel-heading panel-heading-divider my-3">Please Select Date to Create Booking </h3>
                    <!-- calender  -->
                    <div class="row booking">
                        <div id="evoCalendar" class="sidebar-hide"></div>
                    </div>

                    <!-- Card stats -->
                    <div id="ShiftDetails">
                        <h3>Please Select Shift</h3>
                        <div class=" row docklegend"><span class="free"> Available</span><span class="booked"> Booked</span><span class="select">Selected</span><span class="NotAvailable" style="width: 116px">NotAvailable</span>
                        </div>
                        <div class="row mb-5 pt-5" id="shifts-list"></div>
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
                    <div class='col-sm-12'>
                        <label  for='content1'>
                            <input type='checkBox' name='content1' id='content1' value='Yes' required/>&nbsp;
                            If you failed to turn up on booking day without informing on before day will result in $200 minus per pay as per LOA.
                        </label>
                    </div>
                    <div class='col-sm-12'>
                        <label  for='content1'>
                            <input type='checkBox' name='content1' id='content1' value='Yes' required/>&nbsp;
                            If you failed to turn up with informing on before day will result in $50 minus per pay as per LOA.
                        </label>
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
            disabledDate: ["09/20/2020","09/21/2020", "09/22/2020", "09/23/2020"],
            onSelectDate: function(date) {
                var UserID = $("input[name=UserId]").val();
                var selectedDate = $(date.currentTarget).attr('date-val');
                var dateArr = selectedDate.split('/');
                var newDate = dateArr[2] + '-' + dateArr[0] + '-' + dateArr[1];
                datas = new FormData();
                datas.append('selectedDate', newDate);

                $.ajax({
                    type: 'get',
                    url: '<?php echo base_url(); ?>Booking/getShiftsByDateProjectId?selectedDate='+ newDate,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.be-loading').addClass('be-loading-active');
                    },
                    success: function(res) {
                        var data = JSON.parse(res);
                        $('#shifts-list').empty();
                        if(data.length > 0){
                            $.each(data, function(i, item){
                                $('#shifts-list').append(`<div class="col-xl-3 col-lg-6" id="highlight" style="margin-bottom: 15px">
                                    <div id="shiftslots-div" data-shift-id="${item.ShiftID}">
                                        <input type="checkbox" name="shiftTiming" class="freeslots" id="${item.ShiftID}" value="${item.StartTime} - ${item.EndTime}" disabled="true">
                                        <label class="shiftslot" for="${item.ShiftID}">${item.StartTime} - ${item.EndTime}</label>
                                    </div>
                                </div>`);
                            });
                        } else {
                            $('#shifts-list').html('<h3> No Shifts available for Selected Date </h3>');
                        }
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
                                            ele.prop("disabled", false);
                                            ele.addClass('total-Booked');
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
                    }
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
            // if (isExists.length > 0) {
            //     return;
            // }
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
            //   setTimeout(function() {
            //     if ($('#booking-detail-Summary tbody tr').length === 1) {
            //       $('.no-pono').show();
            //     }
            //   }, 100)
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