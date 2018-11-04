<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa  fa-tags fa-fw"></i> 
            Loans
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
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body well">
                <!--***********************Start creating your amazing application!**********************-->
                <!-- /.box -->

                <div class="box box-primary col-sm-12">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-table fa-fw"></i> Table</h3>
                    </div><!-- /.box-header -->
                    <!--<br>-->
                    <div class="panel-body well" style="/*background-color:#;*/">
                        <!--<br>-->
                        <div class="row">
                            <div class="col-md-3">
                         <a href="<?php echo base_url('Loan/Loan_con/index2'); ?>" style="margin-left: 18px;width: 200px;padding-bottom: 8px;padding-top: 8px;" class="btn btn-block btn-social btn-dropbox">
                            <i class="fa fa-balance-scale"></i> Create Loan Application
                          </a>
                                </div>
                        </div>
                        <div class="col-sm-12">
                            <table id="my_data_table" name="Custermer_list_table" class="table table-bordered table-striped table-hover table-responsive ">
                                <thead style="background-color: white;">
                                    <tr>
                                        <th>Loan Serial</th>
                                        <th>Borrower</th>
                                        <th>Release Date</th> 
                                        <th>Principal Amount</th>
                                        <th>Loan Product</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($loan_list)) {
                                        foreach ($loan_list as $list) {
                                            ?>
                                            <tr>
                                                <td><?php echo $list->serialNo; ?></td>
                                                <td><?php echo $list->name; ?></td>
                                                <td><?php echo $list->release_date; ?></td>
                                                <td><?php echo number_format($list->principle_ammount,2); ?></td>
                                                <td><?php echo $list->loan_product_name; ?></td>
                                                <td class="text-center"><?php $app = $list->approved; 
                                                          if($app=='P'){echo '<small class="label pull-right bg-green">Pending</small>';}elseif ($app=='A') {echo '<small class="label pull-right bg-blue">Approved</small>';
                                                                
                                                            }elseif ($app=='R') {echo '<small class="label pull-right bg-red">Rejected</small>';}  
                                                ?></td>
                                                <form class="form-horizontal" action="<?php echo base_url('Loan/Loan_con/updateView'); ?>" method="post">
                                                <td class="text-blue text-center">                                        
                                                    <button type="submit"><i class="fa fa-hand-o-up "></i></button>
                                                    <input type="hidden" value="<?php echo $list->loan_id ?>" id="loan_id" name="loan_id">
                                                </td>
                                                </form>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <script>
                  $(function () {
                    $('#my_data_table').DataTable({
                      'paging'      : true,
                      'lengthChange': false,
                      'searching'   : true,
                      'ordering'    : true,
                      'info'        : true,
                      'autoWidth'   : false
                    });
                  });
                function load_this_detail(this_element, id_borrower ){
                    $('.validation_errors').remove();
//                    var id_borrower = $(this_element).closest('tr').find(':nth-child(1)').html(); 
                    var name = $(this_element).closest('tr').find(':nth-child(2)').html();
                    var nic = $(this_element).closest('tr').find(':nth-child(3)').html();
                    var contact_no = $(this_element).closest('tr').find(':nth-child(4)').html();
                    var address = $(this_element).closest('tr').find(':nth-child(5)').html();
//                    var contact_no = $(this_element).closest('tr').find(':nth-child(6)').html();
                    var title = $(this_element).closest('tr').find(':nth-child(7)').html();
                    var joined_date = $(this_element).closest('tr').find(':nth-child(8)').html();
                    var branch = $(this_element).closest('tr').find(':nth-child(9)').html();
                    var gender = $(this_element).closest('tr').find(':nth-child(10)').html(); 
                    var distance = $(this_element).closest('tr').find(':nth-child(11)').html();
                    var id_areaList = $(this_element).closest('tr').find(':nth-child(12)').html();
                    var id_marketing_officer = $(this_element).closest('tr').find(':nth-child(13)').html();
                    var relative_type = $(this_element).closest('tr').find(':nth-child(14)').html();
                    var communication_address = $(this_element).closest('tr').find(':nth-child(15)').html();
                    var job = $(this_element).closest('tr').find(':nth-child(16)').html();
                    var status = $(this_element).closest('tr').find(':nth-child(17)').html();
                    var contact_no_2 = $(this_element).closest('tr').find(':nth-child(18)').html();
//                    alert(status);
//                    alert (id_assetsList +' - '+ name+' - '+description +' - '+status );
//                    alert (communication_address );
//                    return;
//                    branch =  ( branch == 'Branch 1')? '1' : '2';
                    $('#id_borrower').val(id_borrower);      
                    $('#title').val(title);      
                    $('#name').val(name);      
                    $('#nic').val(nic);      
                    $('#joined_date').val(joined_date);      
                    $('#contact_no').val(contact_no);      
                    $('#address').val(address);      
//                    $('#branch').val(branch);      
                    $('#gender').val(gender);      
                    $('#distance').val(distance);      
                    $('#id_areaList').val(id_areaList);      
                    $('#id_marketing_officer').val(id_marketing_officer);      
                    $('#relative_type').val(relative_type);      
                    $('#communication_address').val(communication_address);      
                    $('#job').val(job);      
                    $('#status').val(status);      
                    $('#contact_no_2').val(contact_no_2);  
//                    alert(gender);
                }
                
                 $(document).ready(function(){
                        $("input, textarea, select").click(
                            function (){
                               $(this).siblings('.validation_errors').remove('');
                               $(this).parent().siblings('.validation_errors').remove('');
                            }
                        );
                    });
                    
                </script>


                <!--*************************end of creating your amazing application!********************-->
            </div><!-- /.box-body -->
            <div class="apnel-footer">
                <!--Footer-->
            </div><!-- /.box-footer-->
        </div><!-- /.box -->

    </section><!-- /.content -->
</div> <!-- /.content-wrapper -->