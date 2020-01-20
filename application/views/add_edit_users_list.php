<?php $this->load->view('template/header'); ?>
<style>
    .document-list{
        min-height: 50px;
        max-height: 100px;
        overflow: auto;
        border: 1px solid #cccccc!important;
    }
    .document-text{
        padding: 5px;
    }
    .lds-default {
        display: inline-block;
        position: relative;
        width: 64px;
        height: 64px;
    }
    .lds-default div {
        position: absolute;
        display:block;
        width: 5px;
        height: 5px;
        background:#dea604;
        border-radius: 50%;
        animation: lds-default 1.2s linear infinite;
    }
    .lds-default div:nth-child(1) {
        animation-delay: 0s;
        top: 29px;
        left: 53px;
    }
    .lds-default div:nth-child(2) {
        animation-delay: -0.1s;
        top: 18px;
        left: 50px;
    }
    .lds-default div:nth-child(3) {
        animation-delay: -0.2s;
        top: 9px;
        left: 41px;
    }
    .lds-default div:nth-child(4) {
        animation-delay: -0.3s;
        top: 6px;
        left: 29px;
    }
    .lds-default div:nth-child(5) {
        animation-delay: -0.4s;
        top: 9px;
        left: 18px;
    }
    .lds-default div:nth-child(6) {
        animation-delay: -0.5s;
        top: 18px;
        left: 9px;
    }
    .lds-default div:nth-child(7) {
        animation-delay: -0.6s;
        top: 29px;
        left: 6px;
    }
    .lds-default div:nth-child(8) {
        animation-delay: -0.7s;
        top: 41px;
        left: 9px;
    }
    .lds-default div:nth-child(9) {
        animation-delay: -0.8s;
        top: 50px;
        left: 18px;
    }
    .lds-default div:nth-child(10) {
        animation-delay: -0.9s;
        top: 53px;
        left: 29px;
    }
    .lds-default div:nth-child(11) {
        animation-delay: -1s;
        top: 50px;
        left: 41px;
    }
    .lds-default div:nth-child(12) {
        animation-delay: -1.1s;
        top: 41px;
        left: 50px;
    }
    @keyframes lds-default {
        0%, 20%, 80%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.5);
        }
    }


    .modal-header{        
      border-bottom-width: 1px;
      background: #EEEEEE;
    }

</style>


    <div class="mt-5"></div>
    <?php $this->load->view('template/card-head'); ?>
    

      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <h1 class="panel-heading panel-heading-divider my-3">
                  <?PHP echo $Title;?>
                  <a href="<?php echo base_url('Users/Add')?>" class="btn btn-space btn-success float-right"><i class="fa fa-plus"></i> Add Record</a>
                </h1>
                <hr/>
                <div class="panel-body">
                  <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th width="30">S.No</th>
                        <th>Name</th>
                        <th>Login ID</th>
                        <th>Vehicle</th>
                        <th>ACRA / UN</th>
                        <th>Supplier Group</th>
                        <th width="140">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if($Users!=0)
                      {
                        $i = 1;
                        foreach($Users as $row)
                        {
                          $logid = array();
                          $logid[] = $row->UserName;
                          $logid[] = $row->EmailAddress1;
                          $logid[] = $row->UniqueID;
                          $loginid = array_filter($logid);
                          $login = implode(" <b style='opacity:0.3;'> (or)</b><br/> ", $loginid);

                          echo '<tr>
                            <td>'.$i++.'</td>
                            <td>'.$row->UserName.'</td>
                            <td>'.$row->UniqueID.'</td>
                            <td>Type: '.$row->Type.'<br/>No. : '.$row->VNo.'</td>
                            <td>'.$row->UAN.'</td>
                            <td>'.$row->GroupName.'</td> 
                            <td>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view'.$row->UserUID.'" data-userId="'.$row->UserUID.'" class="btn btn-space btn-sm btn-info view-btn"><i class="icon icon-left mdi mdi-eye"></i> View</a>
                            <a href="'.base_url('Users/edit/'.$row->UserUID).'" class="btn btn-space btn-sm btn-warning"><i class="icon icon-left mdi mdi-edit"></i> Edit</a>
                          </td>
                          </tr>
                          <div id="view'.$row->UserUID.'" tabindex="-1" role="dialog" class="modal colored-header colored-header-primary fade">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title"><i class="fa fa-user"></i> User Information details</h3>
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="fa fa-times"></span></button>
                              </div>

                              <div class="modal-body">
                                <div class="row">  
                                 <div class="col-md-4">
                                   <h5><i class="fa fa-mdi-account"></i> &nbsp; Name </h5>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$row->UserName.'</h5>
                                 </div>
                                </div>
                                <div class="row">  
                                 <div class="col-md-4">
                                   <h5><i class="fa fa-mdi-email"></i> &nbsp; Email 1</h5>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$row->EmailAddress1.'</h5>
                                 </div>
                                </div>
                                <div class="row">  
                                 <div class="col-md-4">
                                   <h5><i class="fa fa-mdi-email"></i> &nbsp; Email 2</h5>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$row->EmailAddress2.'</h5>
                                 </div>
                                </div>
                                <div class="row">  
                                 <div class="col-md-4">
                                   <h5><i class="fa fa-mdi-phone"></i> &nbsp; Phone </h5>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$row->PhoneNumber.'</h5>
                                 </div>
                                </div>
                                <div class="row">  
                                 <div class="col-md-4">
                                   <h5><i class="fa fa-mdi-pin-account"></i> &nbsp; Login-ID </h5>
                                 </div>
                                 <div class="col-md-8">
                                   <h5 style="line-height:1.6;">'.$login.'</h5>
                                 </div>
                                </div>
                                
                                <div class="row">  
                                 <div class="col-md-4">
                                   <h5><i class="fa fa-mdi-pin-account"></i> &nbsp; Supplier Group </h5>
                                 </div>
                                 <div class="col-md-8">
                                   <h5 style="line-height:1.6;">'.$row->GroupName.'</h5>
                                 </div>
                                </div>
                                
                                <hr/>
                                <div class="row">  
                                 <div class="col-md-4">
                                   <h5><i class="fa fa-mdi-car"></i> &nbsp; Vehicle Type </h5>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$row->Type.'</h5>
                                 </div>
                                </div>
                                
                                <div class="row">  
                                 <div class="col-md-4">
                                   <h5><i class="fa fa-mdi-car"></i> &nbsp; Vehicle No </h5>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$row->VNo.'</h5>
                                 </div>
                                </div>
                                <div class="row">  
                                 <div class="col-md-4">
                                   <h5><i class="fa fa-mdi-calendar"></i> &nbsp; Created On </h5>
                                 </div>
                                 <div class="col-md-5">
                                   <h5>'.date('d/m/Y h:i:s A',strtotime($row->CreatedOn)).'</h5>
                                 </div>
                                </div>
                                <div class="row">  
                                 <div class="col-md-4">
                                   <h5><i class="fa fa-mdi-cloud-download"></i> &nbsp; Attatchements </h5>
                                 </div>
                                 <div class="col-md-8 file-path">
                                   <div class="document-list">
                                   <div class="document-loader">
                                   <div class="lds-default">
                                   <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                    </div>
                                    <div class="document-text"></div>
                                   </div>
                                 </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>';
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

    <?php $this->load->view('template/card-foot'); ?>

    <?php $this->load->view('template/footer'); ?>
    <script src="<?php echo base_url();?>assets/lib/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/datatable.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        
        $("#table3").dataTable({
          buttons:["copy", 
          {
            extend: 'excel',
            className: 'btn btn-default',
            exportOptions: {
              columns: ['th:not(:last-child)']
            }
          },"pdf"],
          lengthMenu:[[10,25,50,-1],[6,10,25,50,"All"]],
          dom:"Bfrtip"
        });

        $('.buttons-html5').addClass('btn btn-default');

        $('#table3').on('click','.view-btn',function(){
            var userId = $(this).attr('data-userId');
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url('Users/fetchAttachments/')?>?userId='+userId,
                dataType: 'JSON',
                beforeSend: function() {
                    $('.document-loader').show();
                    $('.document-text').hide();
                },
                success: function(data){
                    $('.document-loader').hide();
                    $('.document-text').show();
                    if(data && data.length>0){
                        var listStr = '<ul>';
                        data.forEach(function(item){
                            var fileNameArr = item['AttachedFiles'].split('/');
                            listStr += "<li><a href='<?php echo base_url('Users/downloadFile/?filePath=')?>"+item['AttachedFiles']+"' target='_blank'>"+fileNameArr[fileNameArr.length-1]+"</a></li>";
                        });
                         listStr += '</ul>';
                        $('.document-text').html(listStr);
                    }else{
                        $('.document-text').html("<div>No Documents found.</div>");
                    }
                }

            });
        });
      });
    </script>
