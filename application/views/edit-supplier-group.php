<?php $this->load->view('template/header'); ?>

    <div class="mt-5"></div>
    <?php $this->load->view('template/card-head'); ?>
    
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary be-loading">
                <h1 class="my-3 panel-heading panel-heading-divider"><i class="icon mdi mdi-car"></i> <?php echo $Title;?></h1>
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
 
                
                  <form action="<?=base_url('Supplier/Groups/update/')?>" class="form-horizontal" method="post">
                    <input type="hidden" name="Id" value="<?=$Group->Id?>"/>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Group Name</label>
                      <div class="col-sm-6">
                        <input type="text" name="groupname" placeholder="Supplier Group Name" class="form-control" value="<?=$Group->GroupName?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Alloted Time</label>
                      <div class="col-sm-8">
                        <div class="row">
                          <?php
                            $at = json_decode($Group->AllotedTime);
                            for ($zi=0; $zi < 24; $zi++) { 
                              $zil  = str_pad($zi,2,"0",STR_PAD_LEFT);
                              $zir  = str_pad((($zi+1)%24),2,"0",STR_PAD_LEFT);
                              $checked = in_array($zi,$at)?" checked":"";
                              echo "<div class='col-sm-2'>";
                              echo "<label class='time-slot' for='time{$zi}'>";
                                echo "<input type='checkbox' name='slots[]' id='time{$zi}' value='{$zi}' {$checked}/>";
                                echo "  <small><i class='fa fa-check'></i> {$zil}:30 - {$zir}:30</small>";
                              echo "</label>";
                              echo "</div>";
                            };
                          ?>
                       </div>
                      </div>
                      
                    </div>

                    



                    <div class="form-group">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-space btn-primary">Submit</button>
                        <a href="<?=base_url('Supplier/Groups')?>" class="btn btn-space btn-default">Cancel</a>
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
    <script src="<?php echo base_url();?>assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      var lastChecked = null;
      $(document).ready(function(){ 
        $('form').parsley();

        $('select').select2();

        $('form').submit(function(){
          $('.be-loading').addClass('be-loading-active');
        }); 


       });
    </script>