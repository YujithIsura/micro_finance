<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-get-pocket fa-fw"></i> 
            Loan Application
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
                    <button class="btn btn-box-tool"  data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body well">
                <!--***********************Start creating your amazing application!**********************-->
                <div class="box box-primary col-sm-10">
                    <div class="box-header with-border">
                        <h3 class="box-title"><h3 class="box-title"><i class="fa fa-pencil-square-o fa-fw"></i> Form</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="<?php echo base_url('Loan/Loan_con/submitForm'); ?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" class="form-control" name="id_loan_type" id="id_loan_type" >
                        <div class="box-body">
                            
                            <div class="col-sm-12 col-md-12">
                                <?php echo form_error('loan_id', '<div class="alert alert-warning  " style="border: 1px solid #CC0033; padding: 10px 40px; border-radius: 10px;font-size:14px">', '</div>'); ?>
                            </div>
                            <div class="col-sm-10" style="align-content: center;">
                                <div class="form-group">
                                    <label style="font-size: 17px;" for="name" class="col-sm-4 control-label">Loan Product&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-8">
                                        <select name="id_loan_product" onchange="getLoanProductDetail()"  id="loan_product_name" class="form-control">
                                            <option value="" >--Select Loan Product--</option>
                                            <?php if(!empty($loan_product_list)){
                                                foreach ($loan_product_list as $product){ ?>                                            
                                            <option value="<?php echo $product->id_loan_product; ?>" ><?php echo $product->loan_product_name; ?></option>                                            
                                            <?php }}?>
                                        </select>
                                        <?php echo form_error('loan_product_name'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-size: 17px;" for="name" class="col-sm-4 control-label">Borrower&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-8">
                                        <select name="borrower_id"  id="borrower" class="form-control">
                                            <option value="" >--Select Borrower--</option>
                                            <?php if(!empty($borrower_list)){
                                                foreach ($borrower_list as $borrower){ ?>                                            
                                            <option value="<?php echo $borrower->id_borrower; ?>" ><?php echo $borrower->id_borrower.'/'.$borrower->name; ?></option>                                            
                                            <?php }}?>
                                        </select>
                                        <?php echo form_error('borrower'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-size: 17px;" for="serialNo" class="col-sm-4 control-label">Loan ID&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly="" value="<?php echo $serialNo; ?>" class="form-control required" name="serialNo" id="serialNo" placeholder="">
                                        <?php echo form_error('serialNo'); ?>
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
                                                        <option value="Cash" >Cash </option>
                                                        <option value="Cheque" >Cheque </option>
                                                    </select>
                                                <?php echo form_error('disbursed_by'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="principle_ammount" class="col-sm-4 control-label"> Principal Amount 
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" onblur="setThousendSeparators('principle_ammount');formValidation();" onkeypress="javascript:return isNumber(event)" style="width: 385px;" class="form-control" name="principle_ammount" id="principle_ammount" placeholder="Principal Amount" >
                                                <span id="principle_amm" style="color:green;" ></span></br>
                                                <span id="principle_amnt" style="color:red;" ></span>
                                                <?php echo form_error('principle_ammount'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="principle_ammount" class="col-sm-4 control-label"> Loan Relese Date
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo Date("Y-m-d"); ?>" style="width: 385px;" class="form-control date-picker" required data-date-format="yyyy-mm-dd" name="release_date" id="release_date" placeholder="" >
                                                <?php echo form_error('release_date'); ?>
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
                                                        <option value="Flat Rate" >Flat Rate </option>
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
                                                        <option value="Include interest normally as per Interest Method" >Include interest normally as per Interest Method</option>
                                                        <option value="Charge All Interest on the Released Date" >Charge All Interest on the Released Date</option>
                                                        <option value="Charge All Interest on the First Repayment" >Charge All Interest on the First Repayment</option>
                                                        <option value="Charge All Interest on the Last Repayment" >Charge All Interest on the Last Repayment</option>
                                                    </select>
                                                <?php echo form_error('loan_schedule'); ?>
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
                                                <div id="percentage" class="row" style="margin-left: 0px;">
                                                <div class="radio3  radio-success  radio-inline">
                                                    <input id="interest_type_percentage" name="interest_type" value='percentage' type="radio" checked>
                                                    <label for="interest_type_percentage" style="font-size: 16px">
                                                        I want Interest to be percentage % based 
                                                    </label>
                                                </div>
                                                </div>
                                                <div id="fixed" class="row" style="margin-left: 0px;">
                                                <div class="radio3 radio-success radio-inline">
                                                    <input id="interest_type_fixed" name="interest_type" value='fixed' type="radio" >
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
                                            <label for="loan_interest" class="col-sm-4 control-label"> Loan Interest %
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-4">
                                                <input type="text" onblur="formValidation2();" onkeypress="javascript:return isNumber(event)" style="width: 152px;" class="form-control" name="loan_interest" id="loan_interest" placeholder="%" maxlength="3" >
                                                <span id="ln_interest" style="color:green;" ></span></br>
                                                <span id="loan_intrst" style="color:red;" ></span>
                                                <?php echo form_error('loan_interest'); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <select name="interest_period" style="width: 225px;margin-left: -127px;"  id="interest_period" class="form-control">
                                                        <option value="" > -Select- </option>
                                                        <option value="Day" >Per Day</option>
                                                        <option value="Week" >Per Week</option>
                                                        <option value="Month" >Per Month</option>
                                                        <option value="Year" >Per Year</option>
                                                    </select>
                                                <?php echo form_error('interest_period'); ?>
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
                                            <label for="loan_duration" class="col-sm-4 control-label"> Loan Duration
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-4">
                                                <input id="loan_duration" onblur="formValidation3();" onkeypress="javascript:return isNumber(event)" style="width: 152px;height: 34px;;text-align: center;" name="loan_duration" min="1" max="200" value='1' type="number" >
                                                </br><span id="ln_dur" style="color:green;" ></span></br>
                                                <span id="loan_durnt" style="color:red;" ></span>
                                                <?php echo form_error('loan_duration'); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <select name="duration_period" style="width: 225px;margin-left: -127px;"  id="duration_period" class="form-control">
                                                        <option value="" > -Select- </option>
                                                        <option value="Days" >Days </option>
                                                        <option value="Weeks" >Weeks </option>
                                                        <option value="Months" >Months </option>
                                                        <option value="Years" >Years </option>
                                                </select>
                                            <?php echo form_error('duration_period'); ?>
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
                                                        <option value="Daily" >Daily </option>
                                                        <option value="Weekly" >Weekly </option>
                                                        <option value="Monthly" >Monthly </option>
                                                    </select>
                                                <?php echo form_error('repayment_cycle'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-10" style="margin-left: -54px;">
                                        <div class="form-group">
                                            <label for="no_of_repayment" class="col-sm-4 control-label"> Number of <br>Repayments
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <input onblur="formValidation4();" onkeypress="javascript:return isNumber(event)" id="no_of_repayment" style="width: 152px;height: 34px;;text-align: center;" name="no_of_repayment" min="1" max="200" value='1' type="number" >
                                                </br><span id="ln_repay" style="color:green;" ></span></br>
                                                <span id="loan_repay" style="color:red;" ></span>
                                                <?php echo form_error('min_repayment'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                          <div class="box box-info collapsed-box box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title">Add Guarantors(Optional)</h3> 

                              <div class="box-tools pull-right">
                                <button type="button" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="box-body"  id="gur_rw">
                                <div class="row">
                                  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="guarantor" class="col-sm-4 control-label">Guarantor 1
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="guarantor0"  id="guarantor0" class="form-control">
                                                        <option value="" > -Select- </option>
                                                        <?php foreach ($guarantor_list as $guarantor) { ?>
                                                            <option value="<?php echo $guarantor->guarantor_id ?>" ><?php echo $guarantor->guarantor_name ?></option>
                                                       <?php }?>
                                                    </select>
                                                <?php echo form_error('guarantor'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                    <label for="discription" class="col-sm-4 control-label">
                                        Description
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="discription0" name="discription0" style="height: 50px;" class="form-control" placeholder="Description" ></textarea>
                                        <?php echo form_error('discription'); ?>
                                    </div>
                                </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label>Choose Files</label>
                                        <input type="file" name="files0[]" multiple/>
                                    </div>
                                </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <button data-toggle="tooltip" id="addLines" title="Add Line" style="margin-left: -65px;" type="button" class="btn btn-primary  btn-md">
                                          <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </div>
                                </div>
                                    </div>
                            </div>
                          </div>
                          <div class="box box-success collapsed-box box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title">Add Collateral(Optional)</h3>

                              <div class="box-tools pull-right">
                                <button type="button" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="box-body" id="coll_rw">
                              <div class="row">
                                  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="collateral" class="col-sm-4 control-label">Collateral 1
                                                <!--<span style="color:red;" >*</span>-->
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="collateral0"  id="collateral0" class="form-control">
                                                        <option value="" > -Select- </option>
                                                        <?php foreach ($collateral_list as $collateral) { ?>
                                                            <option value="<?php echo $collateral->collateral_id ?>" ><?php echo $collateral->collateral_name ?></option>
                                                       <?php }?>
                                                    </select>
                                                <?php echo form_error('collateral'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                    <label for="discriptionColl" class="col-sm-4 control-label">
                                        Description
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="discriptionColl0" name="discriptionColl0" style="height: 50px;" class="form-control" placeholder="Description" ></textarea>
                                        <?php echo form_error('discriptionColl'); ?>
                                    </div>
                                </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label>Choose Files</label>
                                        <input type="file" name="filesColl0[]" multiple/>
                                    </div>
                                </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <button data-toggle="tooltip" id="addLinesColl" title="Add Line" style="margin-left: -65px;" type="button" class="btn btn-primary  btn-md">
                                          <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </div>
                                </div>
                                    </div>
                            </div>
                          </div>
                        <input type="hidden" id="grRowCnt" value="1" name="grRowCnt">
                        <input type="hidden" id="clRowCnt" value="1" name="clRowCnt">
                        <div class="box-footer">
                            <div class="col-sm-6 btn-toolbar"></div>
                            <div class="col-sm-6 btn-toolbar">
                                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                <button type="submit" value="remove" name="remove" style="margin-right: -34px;" class="btn btn-warning pull-right btn-flat"><i class="fa fa-eraser"></i> Remove</button>
                                <button type="submit" onclick="selectAll();" value="submit" name="submit" class="btn btn-info pull-right btn-flat"><i class="fa fa-arrow-circle-up"></i> Submit</button>
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
                    
                     function setThousendSeparators(position){
                          var amount = document.getElementById(position).value;
                    amount = parseFloat(amount.replace(/[^0-9-.]/g, ''));
                    amount = parseFloat(amount);
                    document.getElementById(position).value = '';
                    amount = accounting.toFixed(amount, 2, ",");
                    document.getElementById(position).value = amount;
                    }
                    
                      function isNumber(evt) {
                        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
                        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                            return false;

                        return true;
                    } 
                    
                    var max_principle_ammount;
                    var min_principle_ammount;
                    var max_interest;
                    var min_interest;
                    var max_duration;
                    var min_duration;
                    var min_repayment;
                    var max_repayment;
                      function getLoanProductDetail(){
                        var id_loan_product = $('#loan_product_name').val();
                    $.ajax({
                        url: '<?php echo base_url();?>Loan/Loan_con/getLoanProductDetail',
                        type: 'POST',
                        data: {
                            "id_loan_product" : id_loan_product,
                        },
                        success: function (data) {
                            var json_value = JSON.parse(data);
                            var min_principle_ammount = json_value[0]['min_principle_ammount'];
                            var max_principle_ammount = json_value[0]['max_principle_ammount'];
                            var dif_principle_ammount = json_value[0]['dif_principle_ammount'];
                            var max_principle_ammount = json_value[0]['max_principle_ammount'];
                            var interest_type = json_value[0]['interest_type'];
                            var min_interest = json_value[0]['min_interest'];
                            var max_interest = json_value[0]['max_interest'];
                            var dif_interest = json_value[0]['dif_interest'];
                            var max_duration = json_value[0]['max_duration'];
                            var min_duration = json_value[0]['min_duration'];
                            var dif_duration = json_value[0]['dif_duration'];
                            var min_repayment = json_value[0]['min_repayment'];
                            var max_repayment = json_value[0]['max_repayment'];
                            var dif_repayment = json_value[0]['dif_repayment'];
                           
                            var prin_amm = 'Min '+min_principle_ammount+' - '+max_principle_ammount+' Max';
                            var ln_interest = 'Min '+min_interest+' - '+max_interest+' Max';
                            var ln_duration = 'Min '+min_duration+' - '+max_duration+' Max';
                            var ln_repay = 'Min '+min_repayment+' - '+max_repayment+' Max';
                            $('#principle_amm').text(prin_amm);
                            $('#ln_interest').text(ln_interest);
                            $('#ln_dur').text(ln_duration);
                            $('#ln_repay').text(ln_repay);
                            $('#interest_charged').val(interest_charged);
                            $('#principle_ammount').val(dif_principle_ammount);
                            $('#loan_interest').val(dif_interest);
                            $('#loan_duration').val(dif_duration);
                            $('#no_of_repayment').val(dif_repayment);
                             window.max_principle_ammount = max_principle_ammount;
                             window.min_principle_ammount = min_principle_ammount;
                             window.min_interest = min_interest;
                             window.max_interest = max_interest;
                             window.max_duration = max_duration;
                             window.min_duration = min_duration;
                             window.min_repayment = min_repayment;
                             window.max_repayment = max_repayment;
                           str = "<option value='" + json_value[0]['interest_charged']+ "'>" + json_value[0]['interest_charged']+ "</option> ";
                           str2 = "<option value='" + json_value[0]['disbursed_by']+ "'>" + json_value[0]['disbursed_by']+ "</option> ";
                           str3 = "<option value='" + json_value[0]['interest_method']+ "'>" + json_value[0]['interest_method']+ "</option> ";
                           str4 = "<option value='" + json_value[0]['interest_period']+ "'>" + json_value[0]['interest_period']+ "</option> ";
                           str5 = "<option value='" + json_value[0]['duration_period']+ "'>" + json_value[0]['duration_period']+ "</option> ";
                           str6 = "<option value='" + json_value[0]['repayment_cycle']+ "'>" + json_value[0]['repayment_cycle']+ "</option> ";
                            $("#interest_charged").html(str);
                            $("#disbursed_by").html(str2);
                            $("#interest_method").html(str3);
                            $("#interest_period").html(str4);
                            $("#duration_period").html(str5);
                            $("#repayment_cycle").html(str6);
                            if(interest_type=="percentage"){
                                 $("#percentage").show();
                                 $("#fixed").hide();
                                 $('#interest_type_percentage').attr('checked', true);
                                 $('#interest_type_fixed').attr('checked', false);
                            }else{
                                 $("#fixed").show();
                                 $("#percentage").hide();
                                 $('#interest_type_fixed').attr('checked', true);
                                 $('#interest_type_percentage').attr('checked', false);
                            }
//                            alert(prin_amm);
//                            alert(json_value.length+json_value[0].territory_name);
//                                        var str="<option value=''>--Select--</option>"; 
//                                        for(var i=0; i<json_value.length;i++){
//                                        str += "<option value='" + json_value[i].id_territoryList+ "'>" + json_value[i].territory_name+ "</option> ";
//                                    }
//                            $("#id_territoryList").html(str);
//                            var idTerritory_list = $('#idTerritoryList').val();
//                            alert(idTerritory_list+'d');
//                             $('#id_territoryList option[value="'+idTerritory_list+'"]').attr('selected',true);
//                            alert(idTerritory);
//                             $('#id_territoryList option[value="'+idTerritory+'"]').attr('selected',true);
                        }
                    });
                }
                
                function formValidation(){
                    var principle_ammount = $('#principle_ammount').val();
                    if (Number(principle_ammount) > Number(max_principle_ammount)) {
                         document.getElementById('principle_amnt').innerHTML="Please select values less than max ammount.";
                         return false;
                    }else if(Number(principle_ammount) < Number(min_principle_ammount)){
                         document.getElementById('principle_amnt').innerHTML="Please select values more than min ammount.";
                         return false;
                    }else{
                       document.getElementById('principle_amnt').innerHTML="";
                         return true; 
                    }
//                    alert(principle_ammount);
                }
                
                function formValidation2(){
                    var loan_interest = $('#loan_interest').val();

                    if (Number(loan_interest) > Number(max_interest)) {
                         document.getElementById('loan_intrst').innerHTML="Please select values less than max ammount.";
                         return false;
                    }else if(Number(loan_interest) < Number(min_interest)){
                         document.getElementById('loan_intrst').innerHTML="Please select values more than min ammount.";
                         return false;
                    }else{
                       document.getElementById('loan_intrst').innerHTML="";
                         return true; 
                    }
//                    alert(principle_ammount);
                }
                
                function formValidation3(){
                    var loan_duration = $('#loan_duration').val();

                    if (Number(loan_duration) > Number(max_duration)) {
                         document.getElementById('loan_durnt').innerHTML="Please select values less than max ammount.";
                         return false;
                    }else if(Number(loan_duration) < Number(min_duration)){
                         document.getElementById('loan_durnt').innerHTML="Please select values more than min ammount.";
                         return false;
                    }else{
                       document.getElementById('loan_durnt').innerHTML="";
                         return true; 
                    }
//                    alert(principle_ammount);
                }
                
                function formValidation4(){
                    var no_of_repayment = $('#no_of_repayment').val();

                    if (Number(no_of_repayment) > Number(max_repayment)) {
                         document.getElementById('loan_repay').innerHTML="Please select values less than max ammount.";
                         return false;
                    }else if(Number(no_of_repayment) < Number(min_repayment)){
                         document.getElementById('loan_repay').innerHTML="Please select values more than min ammount.";
                         return false;
                    }else{
                       document.getElementById('loan_repay').innerHTML="";
                         return true; 
                    }
//                    alert(principle_ammount);
                }
                var count=1;
                var cnt=0;
                 $('#addLines').click(function () {
                     count++;
                     cnt++;
                     console.log(cnt);
                   var  str = '<div class="row added'+cnt+'"><div class="col-md-4"><div class="form-group"><label for="guarantor" class="col-sm-4 control-label">Guarantor '+ count +'</label>' +
                              '<div class="col-sm-8"><select name="guarantor'+cnt+'"  id="guarantor'+cnt+'" class="form-control"><option value="" > -Select- </option><?php foreach ($guarantor_list as $guarantor) { ?><option value="<?php echo $guarantor->guarantor_id ?>" ><?php echo $guarantor->guarantor_name ?></option><?php }?></select><?php echo form_error('guarantor'); ?></div>' +
                              '</div></div><div class="col-md-4"><div class="form-group"><label for="discription" class="col-sm-4 control-label">Description</label>' +
                              '<div class="col-sm-8"><textarea id="discription'+cnt+'" name="discription'+cnt+'" style="height: 50px;" class="form-control" placeholder="Description" ></textarea><?php echo form_error('discription'); ?></div>' +
                              '</div></div><div class="col-md-3"><div class="form-group"> <label>Choose Files</label><input type="file" name="files'+cnt+'[]" multiple/>' +
                              '</div></div><div class="col-md-1"><div class="form-group">' +
                              '<button data-toggle="tooltip" id="removeLine'+cnt+'" title="Remove Line" style="margin-left: -65px;" type="button" class="btn btn-danger  btn-md">' +
                              '<span class="glyphicon glyphicon-trash"></span></button></div></div></div>';
                     $("#gur_rw").append(str);
                      $("#removeLine"+cnt).click(function() {
        $('.added'+cnt).remove();
        cnt--;
        count--;
        $('#grRowCnt').val(count);
    });
    $('#grRowCnt').val(count);
                 });
                var countColl=1;
                var cntColl=0;
                 $('#addLinesColl').click(function () {
                     countColl++;
                     cntColl++;
                   var  str = '<div class="row added'+cntColl+'"><div class="col-md-4"><div class="form-group"><label for="collateral" class="col-sm-4 control-label">Collateral '+ countColl +'</label>' +
                              '<div class="col-sm-8"><select name="guarantor'+cntColl+'"  id="guarantor'+cntColl+'" class="form-control"><option value="" > -Select- </option><?php foreach ($collateral_list as $collateral) { ?><option value="<?php echo $collateral->guarantor_id ?>" ><?php echo $guarantor->guarantor_name ?></option><?php }?></select><?php echo form_error('collateral'); ?></div>' +
                              '</div></div><div class="col-md-4"><div class="form-group"><label for="discription" class="col-sm-4 control-label">Description</label>' +
                              '<div class="col-sm-8"><textarea id="discriptionColl'+cntColl+'" name="discriptionColl'+cntColl+'" style="height: 50px;" class="form-control" placeholder="Description" ></textarea><?php echo form_error('discription'); ?></div>' +
                              '</div></div><div class="col-md-3"><div class="form-group"> <label>Choose Files</label><input type="file" name="files'+cntColl+'[]" multiple/>' +
                              '</div></div><div class="col-md-1"><div class="form-group">' +
                              '<button data-toggle="tooltip" id="removeLineColl'+cntColl+'" title="Remove Line" style="margin-left: -65px;" type="button" class="btn btn-danger  btn-md">' +
                              '<span class="glyphicon glyphicon-trash"></span></button></div></div></div>';
                     $("#coll_rw").append(str);
                      $("#removeLineColl"+cntColl).click(function() {
        $('.added'+cntColl).remove();
        cntColl--;
        countColl--;
    });
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