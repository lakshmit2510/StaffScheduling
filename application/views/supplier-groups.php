<?php $this->load->view('template/header'); ?>

      <div class="mb-6"></div>

      <?php $this->load->view('template/card-head'); ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <h1 class="panel-heading panel-heading-divider">
                  <?=$Title?>
                  
                  <a href="<?=base_url('Supplier/Groups/')."add/"?>" class="btn btn-space btn-success float-right"><i class="fa fa-plus"></i> Add Group</a>
                </h1>
                <hr/>
                <div class="panel-body">

                  <?php if($this->session->flashdata('type') == 'done') { ?>
                    <div role="alert" class="alert alert-success alert-dismissible">
                      <div class="message">
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><i class="fa fa-times"></i></button><strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>.
                      </div>
                    </div>
                  <?php } else if($this->session->flashdata('type') == 'error') { ?>
                  <div role="alert" class="alert alert-danger alert-dismissible">
                    <div class="message">
                      <button type="button" data-dismiss="alert" aria-label="Close" class="close"><i class="fa fa-times"></i></button></button><strong>Error!</strong> <?php echo $this->session->flashdata('msg'); ?>.
                    </div>
                  </div>
                  <?php } ?>  

                  <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th width="30">S.No</th>
                        <th>Group Name</th>
                        <th>Alloted Time</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if($Suppliers!=0)
                      {
                        $i=1;
                        foreach($Suppliers as $row)
                        {
                          echo '<tr>
                            <td>'.$i++.'</td>
                            <td>'.$row->GroupName.'</td>';
                            
                            echo '<td>';
                              $a  = json_decode($row->AllotedTime);
                              $ai = 0;
                              for ($zi=0; $zi < 24; $zi++) {
                                
                                if($ai < count($a) && $zi == intval($a[$ai])){
                                  echo str_pad($a[$ai],2,"0",STR_PAD_LEFT).":30 &nbsp;&nbsp;";
                                  $ai++;
                                }
                                else{
                                 echo "&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";                                   
                                }
                                if($zi%6==5){
                                  echo "<br/>";
                                }
                                
                              }

                            echo '</td>'; 
                            
                            ?>
                            <td><a href="<?=base_url('Supplier/Groups/')."edit/".$row->Id?>" class="btn btn-space btn-warning">Edit</a>
                            
                            
                            
                            
                            <a href="<?=base_url('Supplier/Groups/')."delete/".$row->Id?>" onclick="return confirm('Are you sure to delete')" class="btn btn-space btn-danger">Delete</a></td>
                            <?php
                            
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
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
        
      });
    </script>