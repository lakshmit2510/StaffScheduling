<?php $this->load->view('template/header');
$Activeusr = $this->Dashboard_model->GetUserCount('Active');
$InActiveusr = $this->Dashboard_model->GetUserCount('In-Active');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/evo-calendar.css" />
<style>
    .booking {
        position: relative;
        /* background-color: lightblue; */
        width: 100%;
        margin-top: 100px;
    }

    .card-margin {
        margin-left: 20px importent;
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

    .highlight-available {
        background: #3579e8;
    }

    .highlight-Booked {
        background: #e60606;
    }

    .highlight-available .h2 {
        color: #f6f6f9 !important;
    }
</style>

<div class="row booking">
    <div id="evoCalendar" class="sidebar-hide"></div>

</div>
<div class="modal fade" id="addBookingModal" tabindex="-1" role="dialog" aria-labelledby="addShiftModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Booking Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="booking-details-form">
                    <!-- <div class="form-group">
                        <label for="avaialableBookingsField">Available Bookings</label>
                        <input type="number" class="form-control" name="Bookingscount" id="avaialableBookingsField" aria-describedby="availableBookingsHelp" placeholder="Enter available bookings">
                        <small id="availableBookingsHelp" class="form-text text-muted">Please enter the no of bookings available.</small>
                    </div> -->
                    <input type="hidden" name="FullName" value="<?php echo $UserData->FullName ?>">
                    <input type="hidden" name="ICNumber" value="<?php echo $UserData->ICNumber ?>">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input class="form-control emailAddress" name="EmailAddress" placeholder="Please Enter Email address">
                    </div>
                    <!-- <div class="form-group">
                        <label for="endTime">End Time</label>
                        <input class="form-control timepicker" name="Endtime" id="endTime" placeholder="Enter end time">
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-booking" id="booking_details">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Card stats -->
<div id="ShiftDetails">
    <div class="row mb-5 pt-5">
        <?php
        foreach ($Shifts as $value) {
        ?>
            <div class="col-xl-3 col-lg-6" id="highlight" style="margin-bottom: 15px">
                <a href="#" data-toggle="modal" data-target="#addBookingModal" class="card card-hover card-stats highlight-available mb-4 mb-xl-0" data-shift-id="<?php echo $value->ShiftID; ?>">
                    <div class="card-body card-margin">
                        <div class="row pt-3">
                            <div class="col">
                                <span class="h2 font-weight-bold"><?php echo $value->StartTime ?> - <?php echo $value->EndTime ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<div class="row mt-4" id="booking-detail-Summary" style="display:none;">
    <div class="col-sm-8">

        <h2 class="text-primary">Booking Summary</h2>
        <table class="table shadow-sm border">
            <thead class="thead-light">
                <th class="text-primary">Name. </th>
                <th class="text-primary">IC Number</th>
                <th class="text-primary">Email Address</th>
                <th class="text-primary">Date</th>
                <th class="text-primary">Time</th>
            </thead>
            <tbody class="list">

            </tbody>
        </table>
    </div>
</div>


<?php $this->load->view('template/footer'); ?>
<script src="<?php echo base_url() ?>assets/js/evo-calendar.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/lib/parsley/parsley.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {

        // function updateShifts() {
        //     datas = new FormData();
        //     if (!moment($('#evoCalendar').val(), 'DD/MM/YYYY', true).isValid()) {
        //         return true;
        //     }
        // }

        $('#evoCalendar').evoCalendar({
            format: 'mm/dd/yyyy',
            titleFormat: 'MM yyyy',
            eventHeaderFormat: 'MM d, yyyy',
            todayHighlight: true,
            // calendarEvents: myEvents,
            onSelectDate: function(date) {

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
                        $('.be-loading').removeClass('be-loading-active');
                        $('highlight-available').removeClass('highlight-available');
                        $('.card').removeClass('highlight-Booked');
                        if (parseData.length > 0) {
                            $.each(parseData, function(idx, item) {
                                var ele = $("[data-shift-id='" + item.ShiftID + "']");
                                if (parseInt(item.AvailableBookings) == parseInt(item.Count)) {
                                    ele.addClass('highlight-Booked');
                                } else {
                                    ele.removeClass('highlight-Booked');
                                    // $('.card').addClass('highlight-available');
                                }
                            });
                        }
                        $('#ShiftDetails').show();
                    },
                });
            },
        });

        $('#ShiftDetails').hide();

        // $('.save-booking').on('click', function(e) {
        //     e.preventDefault();
        //     e.stopPropagation();
        //     $.ajax({
        //         type: 'post',
        //         url: '<?php echo base_url('Shifts/addShiftsPost/') ?>',
        //         data: $('#booking-form').serialize(),
        //         success: function(res) {
        //             console.log(res);
        //             window.location.reload();
        //         }
        //     });
        // });

        $('#booking_details').on('click', function(e) {
            $('#booking-details-form').parsley().validate();
            if ($('#booking-details-form').parsley().isValid()) {
                var isEditActive = $('#booking-detail-Summary .pono-edit-active');
                var Name = $('[name="FullName"]').val();
                var ICNo = $('[name="ICNumber"]').val();
                var SelectedDay = $('#evoCalendar').attr('date-val');
                var EmailAdd = $('.emailAddress').val();

                // var table = $("#booking-detail-Summary tbody").html('');
                // table.append('<tr>');
                //     table.append('<td>' + Name + '</td>'); // Purchase Order
                //     table.append('<td>' + ICNo + '</td>'); // Purchase Order
                //     table.append('<td>' + EmailAdd + '</td>'); // Purchase Order
                //     table.append('<td>' + SelectedDay + '</td>'); // Purchase Order
                // table.append('</tr>');

                $("#booking-detail-Summary").slideDown();

                var tableRow = '<tr>';
                tableRow += '<td class="name">' + Name + '</td>';
                tableRow += '<input type="hidden" value="' + Name + '" name="fullName[]"/>';
                tableRow += '<td class="buildingname-td">' + ICNo + '</td>';
                tableRow += '<input type="hidden" value="' + ICNo + '" name="IC_Number[]"/>';
                tableRow += '<td class="name">' + EmailAdd + '</td>';
                tableRow += '<input type="hidden" value="' + EmailAdd + '" name="EmailAddress[]"/>';
                tableRow += '<td class="name">' + SelectedDay + '</td>';
                tableRow += '<input type="hidden" value="' + SelectedDay + '" name="Day[]"/>';
                tableRow += '<td>';
                tableRow += '<button type="button" class="btn btn-primary edit-pono" data-toggle="modal" data-target="#exampleModal"> Edit </button>';
                tableRow += '<button type="button" class="btn btn-primary delete-pono" style="margin-left:10px"> Delete </button>';
                tableRow += '</td>';
                tableRow += '</tr>';

                // $("#booking-detail-Summary").slideDown();

                if (Name !== '' && ICNo !== '' && EmailAdd !== '') {
                    if (isEditActive.length > 0) {
                        isEditActive.replaceWith(tableRow);
                    } else {
                        $('#booking-detail-Summary tbody').prepend(tableRow);
                    }

                    // $('.no-pono').hide();
                }

            } else {
                e.stopPropagation();
            }

        });

    });
</script>