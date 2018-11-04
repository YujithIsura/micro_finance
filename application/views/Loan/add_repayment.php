<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa  fa-map-marker fa-fw"></i>
            Add Repayment
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
                <div class="box box-primary col-sm-10">
                    <div class="box-header with-border">
                        <h3 class="box-title"><h3 class="box-title"><i class="fa fa-pencil-square-o fa-fw"></i> Form</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="<?php echo base_url('Loan/Loan_center_con/pay_repayment'); ?>" method="post">
                        <input type="hidden" value="<?php echo $loan[0]->loan_id;?>" class="form-control" name="loan_id" id="loan_id" >
                        <?php // echo form_error('id_areaList', '<div class="alert alert-warning  col-sm-6" style="border: 1px solid #CC0033; padding: 10px 40px; border-radius: 10px;font-size:14px">', '</div>'); ?>
                        <?php echo form_error('id_areaList','<div class="help-block validation_errors" style="color:red;"> ', '</div>' ); ?>
                        <div class="box-body">
                            <div class="row">
                            <div class="col-sm-12">
                                <div class="box box-info">
                                <table id="my_data_table" name="Loan_table" class="table table-bordered table-striped table-hover table-responsive ">
                                <thead style="background-color: white;">
                                    <tr>
                                        <th>Loan Serial</th>
                                        <th>Released</th>
                                        <th>Principal</th>
                                        <th>Status</th>                                
                                        <th>Repayment</th>                                
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($loan)) {
                                        foreach ($loan as $list_item) {
                                            ?>
                                            <tr>
                                                <td> <?php echo $list_item->serialNo; ?></td>
                                                <td><?php echo $list_item->release_date ?></td>
                                                <td><?php echo number_format($list_item->principle_ammount,2) ?></td>
                                                <td><?php echo ($list_item->approved == '0') ? 'Pending' : 'Active'; ?></td>
                                                <td><?php echo $list_item->repayment_cycle ?></td>
<!--                                                <td class="text-blue text-right">                                        
                                                    <button type="button" onclick="load_this_area(this);"><i class="fa fa-hand-o-up "></i></button>
                                                </td>-->
                                <input type="hidden" name="loan_serial" id="loan_serial" value="<?php echo $list_item->serialNo; ?>">
                                <input type="hidden" name="principal_amount" id="principal_amount" value="<?php echo $list_item->principle_ammount; ?>">
                                <input type="hidden" name="loan_interest" id="loan_interest" value="<?php echo $list_item->ln_intarest; ?>">
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
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Borrower Name&nbsp;</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly="" class="form-control" name="borrower_name" value="<?php echo $loan[0]->name;?>" id="borrower_name" placeholder="">
                                        <input type="hidden" readonly="" class="form-control" name="borrower_id" value="<?php echo $loan[0]->borrower_id;?>" id="borrower_name" placeholder="">
                                        <!--<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i>  sdff sd fsd fs dfgd</div>-->
                                        <?php // echo form_error('user_name', '<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');  ?>
                                        <?php echo form_error('name'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="repayment_amount" class="col-sm-6 control-label">Repayment Amount&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="repayment_amount" id="repayment_amount" placeholder="Number OR Decimal">
                                        <!--<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i>  sdff sd fsd fs dfgd</div>-->
                                        <?php // echo form_error('user_name', '<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');  ?>
                                        <?php echo form_error('repayment_amount'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deposit_to" class="col-sm-6 control-label">Deposit To&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-6">
                                        <select name="deposit_to"  id="deposit_to" class="form-control selectize" >

                                                <option value="" >--Select--</option>
                                                <option value="Cash On Hand" >Cash On Hand</option>
                                                <option value="BOC" >BOC</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pay_method" class="col-sm-6 control-label">Repayment Method&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-6">
                                        <select name="pay_method"  id="pay_method" class="form-control selectize" ">

                                                <option value="" >--Select--</option>
                                                <option value="Cash" >Cash</option>
                                                <option value="Check" >Check</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="collection_date" class="col-sm-6 control-label">Collection Date &nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-6 ">
                                        <div class=" input-group">
                                            <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd"  name="collection_date" id="collection_date" placeholder="">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <?php echo form_error('collection_date'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="collected_by" class="col-sm-6 control-label">Collected By&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-6">
                                        <select name="collected_by"  id="collected_by" class="form-control selectize" >

                                                <option value="" >--Select--</option>
                                                <?php foreach ($collector as $value) {  ?>             
                                                <option value="<?php echo $value->id_marketing_officer ?>" ><?php echo $value->name?></option>
                                                      <?php      }?>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-6 control-label">Description</label>
                                    <div class="col-sm-6">
                                        <?php echo form_error('description'); ?>
                                        <textarea id="description" name="description" class="form-control" placeholder="Description" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="box box-info" style="overflow-y: auto;height: 364px;">
                                <table id="my_data_table" name="Loan_table" class="table table-bordered table-striped table-hover table-responsive ">
                                <thead style="background-color: white;">
                                    <tr>
                                        <th>No</th>
                                        <th>Repayment Date</th>
                                        <th>Due Amount</th>
                                        <th>Pending Due</th>                                
                                        <th>Status</th>                                
                                        <!--<th>Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                    if (!empty($loanShedule)) {
                                        foreach ($loanShedule as $list_item) {
                                            ?>
                                            <tr>
                                                <td> <?php echo $i; ?></td>
                                                <td><?php echo $list_item->repayment_date ?></td>
                                                <td style="text-align: right;"><?php echo number_format($list_item->due_amount,2) ?></td>
                                                <td style="text-align: right;"><?php echo number_format($list_item->pending_due,2) ?></td>
                                                <td><?php echo ($list_item->is_paid == '0') ? 'Unpaid' : 'Paid'; ?></td>
                                                <td hidden=""><input type="hidden" value="<?php echo $list_item->is_paid?>" name="is_paid"></td>
<!--                                                <td class="text-blue text-right">                                        
                                                    <button type="button" onclick="load_this_area(this);"><i class="fa fa-hand-o-up "></i></button>
                                                </td>-->
                                            </tr>
                                            <?php $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-sm-5 btn-toolbar">
                                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                <!--<button type="submit" value="remove" name="remove" class="btn btn-warning pull-right btn-flat"><i class="fa fa-eraser"></i> Remove</button>-->
                                <button type="reset" value="remove" name="refresh" class="btn btn-warning pull-right btn-flat" onclick="remove_validation_errors();"><i class="fa fa-fw fa-fw fa-refresh"></i>  Reset </button>
                                <?php if($_SESSION['session_user_data']['user_type'] == 'admin'){   ?>
                                <button type="submit" value="update" name="update" class="btn bg-purple pull-right btn-flat"><i class="fa fa-pencil-square-o"></i> Update</button>
                                <?php }   ?>
                                <button type="submit" value="submit" name="submit" class="btn btn-info pull-right btn-flat"><i class="fa fa-arrow-circle-up"></i> Submit</button>
                            </div>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->

                
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


                <!--*************************end of creating your amazing application!********************-->
            </div><!-- /.box-body -->
            <div class="apnel-footer">
                <!--Footer-->
            </div><!-- /.box-footer-->
        </div><!-- /.box -->

    </section><!-- /.content -->
</div> <!-- /.content-wrapper -->