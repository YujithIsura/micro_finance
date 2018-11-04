<!--/*
 * Developer : Thiwanka Sandaruwan.
 * Date : 2016-02-18  
 */ -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-bars"></i>
            My Company Details
            <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h5 class=" box-title col-sm-11">
                    <?php 
                    $success_msg = $this->session->flashdata('success_msg');
                    if (!empty($success_msg)) { ?>
                        <div class="alert alert-info information col-sm-10" style="border: 2px solid #0099CC; padding: 10px 40px; border-radius: 10px; font-size:16px">
                            <i class="fa fa-thumbs-o-up fa-fw"></i>
                            <?php echo $this->session->flashdata('success_msg'); ?>
                        </div>
                        <?php $this->session->set_flashdata("success_msg", "");
                    } ?>
                    <?php 
                    $error_msg = $this->session->flashdata('error_msg');
                    if (!empty($error_msg)) { ?>
                        <div class="alert alert-warning information col-sm-10" style="border: 2px solid #CC0033;padding: 10px 40px; border-radius: 10px;font-size:16px">
                            <i class="fa fa-thumbs-o-down fa-fw"></i>
                        <?php echo $this->session->flashdata('error_msg'); ?>
                        </div>
                        <?php $this->session->set_flashdata("error_msg", "");
                    } ?>
                <!--<i class="fa  fa-map-marker fa-fw"></i> Area List-->
                    <br>
                </h5>
                
            </div>
               <div class="box-body well">
                  
                <div class="box box-primary col-sm-12 animated zoomIn">
                    <div class="box-header with-border">
                       <div class="col-sm-1 pull-right">
                     <div class="box-tools pull-right">
                        <a type="button" href="<?php echo base_url('Mycompany_controll/selectUpdate').'/'.$list[0]->id; ?>"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</a>
                        
                     </div> 
                    </div>
                    </div><!-- /.box-header -->
                    
                        <br>
                    <div class="panel panel-body well">
                        
                   
                   
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                              <div class="col-sm-5"><strong>Company Name <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->comName; ?></div>
                              &nbsp;
                            </div>

                             <div class="row">
                              <div class="col-sm-5"><strong>Legal Name <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->legalName; ?></div>
                              &nbsp;
                            </div>

                             <div class="row">
                              <div class="col-sm-5"><strong>Address <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->address; ?></div>
                              &nbsp;
                            </div>

                             <div class="row">
                              <div class="col-sm-5"><strong>Country <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->country; ?></div>
                              &nbsp;
                            </div>

                             <div class="row">
                              <div class="col-sm-5"><strong>Phone <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->phone; ?></div>
                              &nbsp;
                            </div>

                            <div class="row">
                              <div class="col-sm-5"><strong>Fax <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->fax; ?></div>
                              &nbsp;
                            </div>

                            <div class="row">
                              <div class="col-sm-5"><strong>Email <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->email; ?></div>
                              &nbsp;
                            </div>

                        </div>
                       <div class="col-sm-6">  

                            <div class="row">
                              <div class="col-sm-5"><strong>Web Site <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->web; ?></div>
                              &nbsp;
                            </div>

                            <div class="row">
                              <div class="col-sm-5"><strong>Currency  <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->currency; ?></div>
                              &nbsp;
                            </div>

                            <div class="row">
                              <div class="col-sm-5"><strong>Financial Year From <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->month; ?></div>
                              &nbsp;
                            </div>

                            <div class="row">
                              <div class="col-sm-5"><strong>TIN No <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->tinNo; ?></div>
                              &nbsp;
                            </div>

                            <div class="row">
                              <div class="col-sm-5"><strong>VAT No <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->vatNo; ?></div>
                              &nbsp;
                            </div>

                            <div class="row">
                              <div class="col-sm-5"><strong>SVAT No <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->svatNo; ?></div>
                              &nbsp;
                            </div>

                            <div class="row">
                              <div class="col-sm-5"><strong>BR No <span class="pull-right">: </span></strong></div>
                              <div class="col-sm-7"><?php echo $list[0]->brNo; ?></div>
                              &nbsp;
                            </div>

                         </div>
                                 
                        </div>
                    </div> 

                    </div>
                    </div>
                </div>
                <script>
                     $(document).ready(function(){
                        $("input, textarea, select").click(
                            function (){
//                                alert("hi");
//                               alert ($(this).siblings('.validation_errors').html());
                               $(this).siblings('.validation_errors').remove('');
                               $(this).parent().siblings('.validation_errors').remove('');
                            }
                        );                        
                    });
                    
                function load_this_area(this_element){
//                    var id_areaList = $(this_element).closest('tr').find("td:first").html();
                    var id_areaList = $(this_element).closest('tr').find(':nth-child(1)').html(); 
                    var name = $(this_element).closest('tr').find(':nth-child(2)').html();
                    var description = $(this_element).closest('tr').find(':nth-child(3)').html();
                    var status = $(this_element).closest('tr').find(':nth-child(4)').html();
//                    alert (id_areaList +' - '+ name+' - '+description +' - '+status );
                          
                    $('#id_areaList').val(id_areaList);      
                    $('#name').val(name);      
                    $('#description').val(description);      
                }
                
                </script>


            </div><!-- /.box-body -->
            <div class="apnel-footer">
                <!--Footer-->
            </div><!-- /.box-footer-->
        </div><!-- /.box -->

    </section><!-- /.content -->
</div> <!-- /.content-wrapper -->
