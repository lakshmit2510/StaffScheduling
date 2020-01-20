<?php $this->load->view('template/header'); ?>
<style type="text/css">
.dockslot{
  background-color: #d8d8d8;
  display: inline-block;
  width: 15%;
  text-align: center;
  height: 100px;
  border-radius: 8px;
  padding: 25px;
  margin: 5px;
  cursor: pointer;
  border: 1px dashed #b5b5b5;
}
#dockslots-div input[type=checkbox]{
  display: none!important;
}
#dockslots-div input[type=checkbox]:disabled + .dockslot{
  background-color: #eb6357;
  color: #fff;
  border: 1px dashed #333;
}
#dockslots-div input[type=checkbox]:checked + .dockslot{
  background-color: #11ca11;
  color: #fff;
  border: 1px dashed #333;
}
.border-dotted { 
  border: 2px dotted #ccc;
  padding: 20px 25px;
}  

.booking .card-header{
  background:#f0f0f0;
}
</style>

    <div class="mt-5"></div>
    <?php $this->load->view('template/card-head'); ?>

      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default">
                <?php if(!empty($QR)) { ?>
                <div class="panel-heading panel-heading-divider">Verified Successfully</div>
                <?php } else { ?>
                <h1 class="my-3 panel-heading panel-heading-divider">Thank you</h1>
                <hr/>
                <?php
                } ?>
                <div class="panel-body">

                  
                  <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible" style="width:100%;">
                    <div class="row">
                      <div class="col-sm-1">
                        <div class="icon text-center">
                          <span class="fa fa-check" style="font-size:40px;margin-top:10px;"></span>
                        </div>
                      </div>
                      <div class="col-sm-11">
                        <div class="message">

                          <?php if(!empty($QR)) { ?>
                          <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><h4><b>Your Job Order No : <?php echo $RefNos;?>.</b></h4> <strong>Success!</strong> has verfied successfully. Status has been changed to <b><?php echo $status; ?></b>.<br> 
                          <?php } else { ?>
                          <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><h4><b>Your Job Order No : <?php echo $RefNos;?>.</b></h4> <strong>Success!</strong> Your booking is confirmed.
                            <p>Below booking details email to your registerd email address</p>
                            <a href="<?php echo base_url('Booking/Add');?>" class="btn btn-ml btn-default">Next Booking</a> 
                          <?php } ?>
                          <a onclick="PrintElem('.printview')" class="btn btn-md btn-danger"><i class="fa fa-print"></i> Print</a>
                        </div>
                      </div>
                    </div>
                  </div>
                      


                <?php
                  $RefNoList = explode(",",$RefNos);
                  foreach ($RefNoList as $index=>$RefNo) {
                ?>

                <?php $book = $this->Booking_model->getBookingDetailID($RefNo,'RefNo'); ?>
                
                <div class="card booking  my-3 shadow-sm">
                  <div class="card-header" id="heading<?=$index?>">
                    <h5 class="mb-0"  data-toggle="collapse" data-target="#collapse<?=$index?>" aria-expanded="true" aria-controls="collapse<?=$index?>">
                      <div class="row">
                        <div class="col">
                          Job Order : <?php echo $book->BookingRefNo;?> 
                        </div>
                        <div class="col">
                          Booking Date : <?=date('m/d/Y',strtotime($book->CheckIn))?>
                        </div>
                        <div class="col">
                          Check In / Check Out : <?=date('H:i',strtotime($book->CheckIn)).' <b>To</b> '.date('H:i',strtotime($book->CheckOut))?>
                        </div>
                        <div class="col text-right">
                          <button class="btn btn-danger btn-sm" onclick="PrintElem('#printview<?=$index?>')"><i class="fa fa-print"></i> Print</button>
                        </div>
                      </div>
                    </h5>
                  </div>

                  <div id="collapse<?=$index?>" class="collapse show" aria-labelledby="heading<?=$index?>">
                    <div class="card-body printview" id="printview<?=$index?>">


                      <div class="row">
                        <div class="col-sm-2">
                          <img src="<?php echo base_url($book->QRCode);?>" width="120" style="max-width:100%l">
                        </div>
                        <div class="col-sm-6">
                          <h3 class="mt-3"><b><i class="fa fa-book"></i>  Booking Information</b></h3>
                          <table class="table">
                            <tr>
                              <td><b>Job Order No</b></td>
                              <td><?php echo $book->BookingRefNo;?></td>
                            </tr>
                            <tr>
                              <td><b>Booked On</b></td>
                              <td><?php echo date('m/d/Y',strtotime($book->BookedOn));?></td>
                            </tr>
                            <tr>
                              <td><b>Booking Date</b></td>
                              <td><?php echo date('m/d/Y',strtotime($book->CheckIn));?></td>
                            </tr>
                            <tr>
                              <td><b>Check-In / Check-Out</b></td>
                              <td><?php echo date('H:i',strtotime($book->CheckIn)).' <b>To</b> '.date('H:i',strtotime($book->CheckOut));?></td>
                            </tr>
                            <tr>
                              <td><b>Booking Mode</b></td>
                              <td><?php echo $book->BookMode?></td>
                            </tr>
                            <tr>
                              <td><b>Docks Type / Dock.No</b></td>
                              <td><?php echo $book->DockType.' / '.$book->SlotName;?></td>
                            </tr>
                            <tr>
                              <td><b>P.O No / W.O No </b></td>
                              <td><?php echo $book->PONumber;?></td>
                            </tr>
                            <tr>
                              <td><b>D.o Number </b></td>
                              <td><?php echo $book->DONumber;?></td>
                            </tr>
                            <tr>
                              <td><b>Airway Bill.No</b></td>
                              <td><?php echo $book->BillNo;?></td>
                            </tr>
                            <tr>
                              <td><b>B/L No</b></td>
                              <td><?php echo $book->BLNo;?></td>
                            </tr>
                            <tr>
                              <td><b>Operation</b></td>
                              <td><?php echo $book->Area;?></td>
                            </tr>
                          </table>

                          <h3><b><i class="fa fa-truck"></i> Vehicle Information</b></h3>
                          <table class="table">
                            <tr>
                              <td width="290"><b>Vehicle Number</b></td>
                              <td><?php echo $book->VehicleNo?></td>
                            </tr>
                            <tr>
                              <td width="290"><b>Vehicle Type</b></td>
                              <td><?php echo $book->Type?></td>
                            </tr>
                            <tr>
                              <td width="290"><b>Driver Name</b></td>
                              <td><?php echo $book->DriverName?></td>
                            </tr>
                          </table>
                          <h3><b><i class="fas fa-truck-loading"></i> Delivery Information</b></h3>
                          <table class="table">
                            <tr>
                              <td><b>Company (Delivery To)</b></td>
                              <td><?php echo $book->CompanyName;?></td>
                            </tr>
                            <tr>
                              <td><b>Building Name</b></td>
                              <td><?php echo $book->BuildingName;?></td>
                            </tr>
                            <tr>
                              <td><b>Building Address</b></td>
                              <td><?php echo $book->BuildingAddress?></td>
                            </tr>
                          </table>
                        </div>
                        
                      </div>

                    </div>
                  </div>
                </div>

                  

               <?php
                  }
                ?>

                <!-- <div class="invoice">
                <div class="row invoice-header">
                  <div class="col-xs-7">
                    <div class="invoice-logo"><img src="<?php echo base_url('assets/img/logo.png');?>" width="25%"></div>
                  </div>
                  <div class="col-xs-5 invoice-order"><span class="invoice-id">Invoice #2308</span><span class="incoice-date">August 23, 2016</span></div>
                </div>
                <div class="row invoice-data">
                  <div class="col-xs-5 invoice-person"><span class="name">Kristopher Donny</span><span>Developer and Designer</span><span>donny@designer.co</span><span>661 Bubby Street</span><span>United States</span></div>
                  <div class="col-xs-2 invoice-payment-direction"><i class="icon mdi mdi-chevron-right"></i></div>
                  <div class="col-xs-5 invoice-person"><span class="name">Elliot Mark</span><span>CEO at BLX</span><span>ceoblx@company.co</span><span>839 Owagner Drive</span><span>United States</span></div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <table class="invoice-details">
                      <tr>
                        <th style="width:60%">Description</th>
                        <th style="width:17%" class="hours">Hours</th>
                        <th style="width:15%" class="amount">Amount</th>
                      </tr>
                      <tr>
                        <td class="description">Web design (Etiam sagittis metus sit amet mauris gravida hendrerit)</td>
                        <td class="hours">60</td>
                        <td class="amount">$4,200.00</td>
                      </tr>
                      <tr>
                        <td class="description">Responsive design (Etiam sagittis metus sit amet mauris gravida hendrerit)</td>
                        <td class="hours">10</td>
                        <td class="amount">$1,500.00</td>
                      </tr>
                      <tr>
                        <td class="description">Logo design (Cras faucibus tincidunt elit id rhoncus.)</td>
                        <td class="hours">12</td>
                        <td class="amount">$1,700.00</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td class="summary">Subtotal</td>
                        <td class="amount">$7,400,00</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td class="summary">Discount (20%)</td>
                        <td class="amount">$1,480,00</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td class="summary total">Total</td>
                        <td class="amount total-value">$5,920</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 invoice-payment-method"><span class="title">Payment Method</span><span>Credit card</span><span>Credit card type: mastercard</span><span>Number verification: 4256981387</span></div>
                </div>
                <div class="row">
                  <div class="col-md-12 invoice-message"><span class="title">Thank you for contacting us</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis massa nisl. Sed fringilla turpis id mi ultrices, et faucibus ipsum aliquam. Sed ut eros placerat, facilisis est eu, congue felis.</p>
                  </div>
                </div>
                <div class="row invoice-company-info">
                  <div class="col-sm-6 col-md-2 logo"><img src="assets/img/logo-symbol.png" alt="Logo-symbol"></div>
                  <div class="col-sm-6 col-md-4 summary"><span class="title">Beagle Company</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                  </div>
                  <div class="col-xs-6 col-md-3 phone">
                    <ul class="list-unstyled">
                      <li>+1(535)-8999278</li>
                      <li>+1(656)-3558302</li>
                    </ul>
                  </div>
                  <div class="col-xs-6 col-md-3 email">
                    <ul class="list-unstyled">
                      <li>beagle@company.co</li>
                      <li>beagle@support.co</li>
                    </ul>
                  </div>
                </div>
                <div class="row invoice-footer">
                  <div class="col-md-12">
                    <button class="btn btn-lg btn-space btn-default">Save PDF</button>
                    <button class="btn btn-lg btn-space btn-default">Print</button>
                    <button class="btn btn-lg btn-space btn-primary">Pay now</button>
                  </div>
                </div>
              </div> -->          
              </div>
            </div>
          </div>

    <?php $this->load->view('template/card-foot'); ?>

    <?php $this->load->view('template/footer'); ?>

    <script type="text/javascript">
      
      function PrintElem(elem) {
        var data = "";
        $(elem).each(function(){
          data += "<div style='page-break-after: always;margin-top:50px;'>";
          data += $(this).html();
          data += "</div>";
        })
        Popup(data);
      }

      function Popup(data) 
      {
        var mywindow = window.open('', 'my div', 'height=800,width=700');
        mywindow.document.write('<html><head><title></title>');
        mywindow.document.write('<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" type="text/css"/>');  
        mywindow.document.write('<style type="text/css" media="print">@page{size:auto;margin:1mm} .table>tbody>tr>td{ padding:5px; }body{padding:30px;} </style></head><body>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.onload = function(){
          mywindow.print();
          mywindow.close();                        
        };

      }
      

    </script>