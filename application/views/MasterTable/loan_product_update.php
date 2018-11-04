<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-get-pocket fa-fw"></i> 
            Update Loan Product Details
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
                    <form class="form-horizontal" action="<?php echo base_url('LoanProduct/submitForm'); ?>" method="post">
                        <input type="hidden" class="form-control" value="<?php echo $loan_product[0]->id_loan_product;?>" name="id_loan_product" id="id_loan_product" >
                        <div class="box-body">
                            
                            <div class="col-sm-12 col-md-12">
                                <?php echo form_error('id_loan_type', '<div class="alert alert-warning  " style="border: 1px solid #CC0033; padding: 10px 40px; border-radius: 10px;font-size:14px">', '</div>'); ?>
                            </div>
                            <div class="col-sm-10" style="align-content: center;">
                                <div class="form-group">
                                    <label style="font-size: 17px;" for="name" class="col-sm-4 control-label">Loan Product&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" value="<?php echo $loan_product[0]->loan_product_name;?>" name="loan_product_name" id="loan_product_name" placeholder="">
                                        <?php echo form_error('loan_product_name'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="panel panel-success">
                                <div class="panel-heading"><h4->Principal Amount:</h4-></div>
                                <div class="panel-body">
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="disbursed_by" class="col-sm-4 control-label">Disbursed By
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="disbursed_by" style="width: 385px;"  id="disbursed_by" class="form-control">
                                                        <option value="" > -Select- </option>
                                                        <option <?php if($loan_product[0]->disbursed_by=="Cash"){echo "selected";}?> value="Cash" >Cash </option>
                                                        <option <?php if($loan_product[0]->disbursed_by=="Cheque"){echo "selected";}?> value="Cheque" >Cheque </option>
                                                    </select>
                                                <?php echo form_error('disbursed_by'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="min_principle_ammount" class="col-sm-4 control-label">Minimum Principal Amount 
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo number_format($loan_product[0]->min_principle_ammount,2);?>" style="width: 385px;" class="form-control" name="min_principle_ammount" id="min_principle_ammount" placeholder="Minimum Amount" >
                                                <?php echo form_error('min_principle_ammount'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="dif_principle_ammount" class="col-sm-4 control-label">Default Principal Amount
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo number_format($loan_product[0]->dif_principle_ammount,2);?>"  style="width: 385px;" class="form-control" name="dif_principle_ammount" id="dif_principle_ammount" placeholder="Default Amount" >
                                                <?php echo form_error('dif_principle_ammount'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="max_principle_ammount" class="col-sm-4 control-label">Maximum Principal Amount
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo number_format($loan_product[0]->max_principle_ammount,2);?>" style="width: 385px;" class="form-control" name="max_principle_ammount" id="max_principle_ammount" placeholder="Maximum Amount" >
                                                <?php echo form_error('max_principle_ammount'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        <div class="panel panel-success">
                                <div class="panel-heading"><h4->Interest:</h4-></div>
                                <div class="panel-body">
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="interest_method" class="col-sm-4 control-label">Interest Method
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="interest_method" style="width: 385px;"  id="interest_method" class="form-control">
                                                        <option value="" > -Select- </option>
                                                        <option <?php if($loan_product[0]->interest_method=="Flat Rate"){echo "selected";}?>  value="Flat Rate" >Flat Rate </option>
                                                    </select>
                                                <?php echo form_error('interest_method'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="interest_charged" class="col-sm-4 control-label">How should Interest be <br>charged in Loan Schedule?
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="interest_charged" style="width: 385px;"  id="interest_charged" class="form-control">
                                                        <option value="" > -Select- </option>
                                                        <option <?php if($loan_product[0]->interest_charged=="Include interest normally as per Interest Method"){echo "selected";}?> value="Include interest normally as per Interest Method" >Include interest normally as per Interest Method</option>
                                                        <option <?php if($loan_product[0]->interest_charged=="Charge All Interest on the Released Date"){echo "selected";}?> value="Charge All Interest on the Released Date" >Charge All Interest on the Released Date</option>
                                                        <option <?php if($loan_product[0]->interest_charged=="Charge All Interest on the First Repayment"){echo "selected";}?> value="Charge All Interest on the First Repayment" >Charge All Interest on the First Repayment</option>
                                                        <option <?php if($loan_product[0]->interest_charged=="Charge All Interest on the Last Repayment"){echo "selected";}?> value="Charge All Interest on the Last Repayment" >Charge All Interest on the Last Repayment</option>
                                                    </select>
                                                <?php echo form_error('interest_charged'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="interest_type" class="col-sm-4 control-label">Interest Type
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="row" style="margin-left: 0px;">
                                                <div class="radio3  radio-success  radio-inline">
                                                    <input id="interest_type_percentage" name="interest_type" value='percentage' type="radio" <?php if($loan_product[0]->interest_type=="percentage"){echo "checked";}?> >
                                                    <label for="interest_type_percentage" style="font-size: 16px">
                                                        I want Interest to be percentage % based 
                                                    </label>
                                                </div>
                                                </div>
                                                <div class="row" style="margin-left: 0px;">
                                                <div class="radio3 radio-success radio-inline">
                                                    <input id="interest_type_fixed" name="interest_type" value='fixed' type="radio" <?php if($loan_product[0]->interest_type=="fixed"){echo "checked";}?> >
                                                    <label for="interest_type_fixed" style="font-size: 16px">
                                                        I want Interest to be a fixed amount Per Cycle
                                                    </label>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="interest_period" class="col-sm-4 control-label">Loan Interest Period
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="interest_period" style="width: 385px;"  id="interest_period" class="form-control">
                                                        <option value="" > -Select- </option>
                                                        <option <?php if($loan_product[0]->interest_period=="Day"){echo "selected";}?> value="Day" >Per Day</option>
                                                        <option <?php if($loan_product[0]->interest_period=="Week"){echo "selected";}?> value="Week" >Per Week</option>
                                                        <option <?php if($loan_product[0]->interest_period=="Month"){echo "selected";}?> value="Month" >Per Month</option>
                                                        <option <?php if($loan_product[0]->interest_period=="Year"){echo "selected";}?> value="Year" >Per Year</option>
                                                    </select>
                                                <?php echo form_error('interest_period'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="min_interest" class="col-sm-4 control-label">Minimum Loan Interest %
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo $loan_product[0]->min_interest;?>" style="width: 152px;" class="form-control" name="min_interest" id="min_interest" placeholder="%" maxlength="12" >
                                                <?php echo form_error('min_interest'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="dif_interest" class="col-sm-4 control-label">Default Loan Interest %

                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo $loan_product[0]->dif_interest;?>" style="width: 152px;" class="form-control" name="dif_interest" id="dif_interest" placeholder="%" maxlength="12" >
                                                <?php echo form_error('dif_interest'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="max_interest" class="col-sm-4 control-label">Maximum Loan Interest %

                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo $loan_product[0]->max_interest;?>" style="width: 152px;" class="form-control" name="max_interest" id="max_interest" placeholder="%" maxlength="12" >
                                                <?php echo form_error('max_interest'); ?>
                                            </div> 
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        <div class="panel panel-success">
                                <div class="panel-heading"><h4->Duration:</h4-></div>
                                <div class="panel-body">
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="duration_period" class="col-sm-4 control-label">Loan Duration Period
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="duration_period" style="width: 385px;"  id="duration_period" class="form-control">
                                                        <option value="" > -Select- </option>
                                                        <option <?php if($loan_product[0]->duration_period=="Day"){echo "selected";}?> value="Days" >Days </option>
                                                        <option <?php if($loan_product[0]->duration_period=="Weeks"){echo "selected";}?> value="Weeks" >Weeks </option>
                                                        <option <?php if($loan_product[0]->duration_period=="Months"){echo "selected";}?> value="Months" >Months </option>
                                                        <option <?php if($loan_product[0]->duration_period=="Years"){echo "selected";}?> value="Years" >Years </option>
                                                    </select>
                                                <?php echo form_error('duration_period'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="min_duration" class="col-sm-4 control-label">Minimum Loan Duration
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="min_duration" style="width: 152px;"  id="min_duration" class="form-control">
                                                        <option value="any" > -Any- </option>
                                                        <?php for ($x = 1; $x <= 200; $x++) {?>
                                                        <option <?php if($loan_product[0]->min_duration==$x){echo "selected";}?> value="<?php echo $x;?>" ><?php echo $x;?></option>
                                                        <?php }?>
                                                    </select>
                                                <?php echo form_error('min_duration'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="dif_duration" class="col-sm-4 control-label">Default Loan Duration
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="dif_duration" style="width: 152px;"  id="dif_duration" class="form-control">
                                                        <option value="any" > -Any- </option>
                                                        <?php for ($x = 1; $x <= 200; $x++) {?>
                                                        <option <?php if($loan_product[0]->dif_duration==$x){echo "selected";}?> value="<?php echo $x;?>" ><?php echo $x;?></option>
                                                        <?php }?>
                                                    </select>
                                                <?php echo form_error('dif_duration'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="max_duration" class="col-sm-4 control-label">Maximum Loan Duration
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="max_duration" style="width: 152px;"  id="max_duration" class="form-control">
                                                        <option value="any" > -Any- </option>
                                                        <?php for ($x = 1; $x <= 200; $x++) {?>
                                                        <option <?php if($loan_product[0]->max_duration==$x){echo "selected";}?> value="<?php echo $x;?>" ><?php echo $x;?></option>
                                                        <?php }?>
                                                    </select>
                                                <?php echo form_error('max_duration'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    
                                    
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading"><h4->Repayments:</h4-></div>
                                <div class="panel-body">
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="repayment_cycle" class="col-sm-4 control-label">Repayment Cycle
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="repayment_cycle" style="width: 385px;"  id="repayment_cycle" class="form-control">
                                                        <option value="" > -Select- </option>
                                                        <option <?php if($loan_product[0]->repayment_cycle=="Daily"){echo "selected";}?> value="Daily" >Daily </option>
                                                        <option <?php if($loan_product[0]->repayment_cycle=="Weekly"){echo "selected";}?> value="Weekly" >Weekly </option>
                                                        <option <?php if($loan_product[0]->repayment_cycle=="Monthly"){echo "selected";}?> value="Monthly" >Monthly </option>
                                                    </select>
                                                <?php echo form_error('repayment_cycle'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="min_repayment" class="col-sm-4 control-label">Minimum Number of <br>Repayments
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="min_repayment" style="width: 152px;"  id="min_repayment" class="form-control">
                                                        <option value="any" > -Any- </option>
                                                        <?php for ($x = 1; $x <= 2000; $x++) {?>
                                                        <option <?php if($loan_product[0]->min_repayment==$x){echo "selected";}?> value="<?php echo $x;?>" ><?php echo $x;?></option>
                                                        <?php }?>
                                                    </select>
                                                <?php echo form_error('min_repayment'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="dif_repayment" class="col-sm-4 control-label">Default Number of <br>Repayments
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="dif_repayment" style="width: 152px;"  id="dif_repayment" class="form-control">
                                                        <option value="any" > -Any- </option>
                                                        <?php for ($x = 1; $x <= 2000; $x++) {?>
                                                        <option <?php if($loan_product[0]->dif_repayment==$x){echo "selected";}?> value="<?php echo $x;?>" ><?php echo $x;?></option>
                                                        <?php }?>
                                                    </select>
                                                <?php echo form_error('dif_repayment'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="max_repayment" class="col-sm-4 control-label">Maximum Number of <br>Repayments

                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="max_repayment" style="width: 152px;"  id="max_repayment" class="form-control">
                                                        <option value="any" > -Any- </option>
                                                        <?php for ($x = 1; $x <= 2000; $x++) {?>
                                                        <option <?php if($loan_product[0]->max_repayment==$x){echo "selected";}?> value="<?php echo $x;?>" ><?php echo $x;?></option>
                                                        <?php }?>
                                                    </select>
                                                <?php echo form_error('max_repayment'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading"><h4->Repayment Order:</h4-></div>
                                <div class="panel-body">
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="repayment_order" class="col-sm-4 control-label">Repayment Order
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select multiple=""  name="repayment_order[]" size="7" style="width: 385px;"  id="repayment_order" class="form-control">
                                                        <?php
                                                        $order = $loan_product[0]->repayment_order;
                                                        $order = explode(',',$order);
                                                        print_r($order);
                                                        ?>
                                                        <option value="<?php echo $order[0]?>" > <?php echo $order[0]?> </option>
                                                        <option value="<?php echo $order[1]?>" ><?php echo $order[1]?> </option>
                                                        <option value="<?php echo $order[2]?>" ><?php echo $order[2]?> </option>
                                                        <option value="<?php echo $order[3]?>" ><?php echo $order[3]?> </option>
                                                    </select>
                                                <?php echo form_error('repayment_order'); ?>
                                                <button type="button" onclick="upr()"   id="up" value="up" class="btn"><i class="fa fa-arrow-up"></i> Up</button>
                                                <button type="button" onclick="downr()" value="down" id="down" class="btn btn-danger"><i class="fa fa-arrow-down"></i> Down</button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                   
                                    
                                    
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading"><h4->Penalty :</h4-></div>
                                <div class="panel-body">
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="cal_penalty_on" class="col-sm-4 control-label">Calculate Penalty On
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="cal_penalty_on" style="width: 385px;"  id="cal_penalty_on" class="form-control">
                                                        <option value="" > -Select- </option>
                                                        <option <?php if($loan_product[0]->cal_penalty_on==1){echo "selected";}?> value="1" >Overdue Principal Amount </option>
                                                        <option <?php if($loan_product[0]->cal_penalty_on==2){echo "selected";}?> value="2" >Overdue Principal Amount + Overdue Interest </option>
                                                        <option <?php if($loan_product[0]->cal_penalty_on==3){echo "selected";}?> value="3" >Overdue Principal Amount + Overdue Interest + Overdue Fees </option>
                                                        <option <?php if($loan_product[0]->cal_penalty_on==4){echo "selected";}?> value="4" >Total Overdue Amount</option>
                                                    </select>
                                                                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="panalty_rate" class="col-sm-4 control-label">Penalty Interest Rate %

                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo $loan_product[0]->panalty_rate;?>" style="width: 152px;" class="form-control" name="panalty_rate" id="panalty_rate" placeholder="%" maxlength="3" >
                                                                                            </div> 
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="grace_period" class="col-sm-4 control-label">Grace Period (days)

                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo $loan_product[0]->grace_period;?>" style="width: 152px;" class="form-control" name="grace_period" id="grace_period" placeholder="" maxlength="5" >
                                                                                            </div> 
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="recurring_period" class="col-sm-4 control-label">Recurring period
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-4">
                                                <select name="recurring_period" style="width: 152px;"  id="recurring_period" class="form-control">
                                                        <option value="any" > -Any- </option>
                                                        <?php for($i=1;$i<201;$i++){?>
                                                                <option <?php if($loan_product[0]->recurring_period==$i){echo "selected";}?> value="<?php echo $i?>" >Every<?php echo $i?></option>
                                                        <?php }?>        
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select name="recurring_on" style="width: 152px;margin-left: -92px;"  id="recurring_on" class="form-control">
                                                        <option <?php if($loan_product[0]->recurring_on=="Days"){echo "selected";}?> value="Days" > Days </option>
                                                        <option <?php if($loan_product[0]->recurring_on=="Weeks"){echo "selected";}?> value="Weeks" > Weeks </option>
                                                        <option <?php if($loan_product[0]->recurring_on=="Months"){echo "selected";}?> value="Months" > Months </option>
                                                        <option <?php if($loan_product[0]->recurring_on=="Years"){echo "selected";}?> value="Years" > Years </option>
                                                    </select>
                                                                                            </div>
                                        </div>
                                    </div>
                                       
                                    </div>
                                    
                                </div>
                            </div>
                        <div class="box-footer">
                            <div class="col-sm-6 btn-toolbar"></div>
                            <div class="col-sm-6 btn-toolbar">
                                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                <button <?php if($this->deleteper[0]->loanproductlist == 0){echo 'disabled'; }?> type="submit" value="remove" name="remove" style="margin-right: -34px;" class="btn btn-warning pull-right btn-flat"><i class="fa fa-eraser"></i> Remove</button>
                                <button <?php if($this->editper[0]->loanproductlist == 0){echo 'disabled'; }?> type="submit"onclick="selectAll();" value="update" name="update" class="btn bg-purple pull-right btn-flat"><i class="fa fa-pencil-square-o"></i> Update</button>
                            </div>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->
                <script>
             
                 $(document).ready(function(){

                    });
                    
                    function upr() {
                        var selectedOpts = $('#repayment_order option:selected');                
                        if (selectedOpts.length == 0) {
            
                            alert("Select a column");
            
                            e.preventDefault();
            
                        }
                        var selected = $("#repayment_order").find(":selected");
                        var before = selected.prev();
                        if (before.length > 0)
                            selected.detach().insertBefore(before);
                    }
                    
                    function downr() {
                        var selectedOpts = $('#repayment_order option:selected');                
                        if (selectedOpts.length == 0) {
            
                            alert("Select a column");
            
                            e.preventDefault();
            
                        }
                        var selected = $("#repayment_order").find(":selected");
                        var next = selected.next();
                        if (next.length > 0)
                            selected.detach().insertAfter(next);
                    }
                    
                   function selectAll() 
                    {
                        selectBox = document.getElementById("repayment_order");

                        for (var i = 0; i < selectBox.options.length; i++) 
                        { 
                             selectBox.options[i].selected = true; 
                        } 
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