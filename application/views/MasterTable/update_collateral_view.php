<!-- Content Wrapper. Contains page content -->
<style>

    .flat-green .bootstrap-switch .bootstrap-switch-primary {
        background-color: royalblue !important;
    }

    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    
    .radio-pink [type="radio"]:checked+label:after {
    border-color: #e91e63;
    background-color: #e91e63;
}
/*Gap*/

.radio-pink-gap [type="radio"].with-gap:checked+label:before {
    border-color: #e91e63;
}

.radio-pink-gap [type="radio"]:checked+label:after {
    border-color: #e91e63;
    background-color: #e91e63;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-automobile fa-fw"></i> 
            Update Collateral
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
                            <?php if($fromLoanCenter==1){?>
                            <a type="button" href="<?php echo base_url('Loan/Loan_center_con')?>" class="btn bg-maroon btn-flat margin pull-right"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
                            <?php }?>
                    </div><!-- /.box-header -->
                    <script>
//                        $(document).ready(function() {
//                            $("form").submit(function(event) { 
//
//                            var val = $("input[type=submit][clicked=true]").val();
//                            alert(val);
//                                event.preventDefault();
//                            // DO WORK
//
//                            });
//                        });
//                        function validate_form(){
//                            
//                            $('.validation_errors').remove();
//                            var val2 = $("#blackList").val();
//                            var val2 = $("button[type=submit][clicked=true]").val();
//                            var button_val = $('form').find("button[type=submit]:focus" ).val();
//                            alert(val2);
//                            return false;
                            
//                            if($('#blackList').val() == 'blackList' || $('#remove').val()== 'remove' ){ 
//                            if( button_val == 'blackList' || button_val == 'remove' ){ 
//                                
//                                var id_borrower = $('#id_borrower').val();
//
//                                if (id_borrower == ''){
//                                    alert('Select a customer first.');
//                                    return false;
//                                } else {
////                                    alert('ok'); return false;
//                                    return true;
//                                }
//                            }
                            
//                            var return_value = true;
//                                                        
//                            $('.required').each(function(){
////                            $('input[calss=required]').each(function(){
//                                var value = $(this).val();
////                                    alert(value);
//                                if ( value == '' || value == null){
//                                    var req_div = '<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> This field is required! </div>';
//                                    $(this).after(req_div);
//                                    return_value = false;
//                                }
//                            });
//                            
//                            var nic = $('#nic').val();
//                            var nic_regex = /^[0-9]{9}[vVxX]$/;
//                            var nic_regex_new = /^[0-9]{12}$/;
//                            
//                            var result = nic_regex.test(nic);
//                            var result2 = nic_regex_new.test(nic);
//                                
//                            if( (nic != '') && (result != true && result2 != true )){
//                                
//                                var div_string = '<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> Invalid NIC number! </div>';
//                                $('#nic').after(div_string);
//                                return_value = false;
//                            }
////                            return false;
//                            if(return_value == false){
//                                alert('Form Submission Error! \n\n Please check the form');
//                            }
//                                
//                            return return_value;
//                        }
                       
                    </script>
                    <!-- form start -->
                    <!--<form class="form-horizontal" action="<?php // echo base_url('customer/submitForm'); ?>"  method="post">-->
                    <form class="form-horizontal" action="<?php echo base_url('Collateral_con/submitForm'); ?>" enctype="multipart/form-data" onsubmit="return validate_form();" method="post">
                        <input type="hidden" class="form-control" value="<?php echo $collateralData[0]->h_id; ?>" name="loan_id" id="loan_id" >
                        <input type="hidden" class="form-control" value="<?php echo $collateralData[0]->id; ?>" name="loan_collateral_id" id="loan_collateral_id" >
                        <?php echo form_error('loan_collateral_id', '<div class="alert alert-warning  col-sm-12" style="border: 1px solid #CC0033; padding: 10px 20px; border-radius: 10px;font-size:14px">', '</div>'); ?>
                        <?php // echo form_error('id_collector','<div class="help-block validation_errors" style="color:red;"> ', '</div>' ); ?>
                        <div class="box-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#addressInfo">Basic Details</a></li>
                                <li><a data-toggle="tab" href="#additionalInfo">Current Status</a></li>
                                <li><a data-toggle="tab" href="#vehicleInfo">For Vehicles only</a></li>

                            </ul>
                            <br>
                            <div class="box-body tab-content">
                             <div id="addressInfo" class="col-sm-12 tab-pane fade in active">    
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="collateral_type" class="col-sm-4 control-label">Type&nbsp;
                                        <span style="color:red;" >*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="collateral_type"  id="collateral_type" class="form-control required">
                                            <option value="" >--Select--</option>
                                            <?php if(!empty($typeList)){
                                                foreach ($typeList as $type){ ?>                                            
                                            <option <?php if($collateralData[0]->collateral_type==$type->id_assetsList){echo 'selected';}?> value="<?php echo $type->id_assetsList; ?>" ><?php echo $type->name; ?></option>                                            
                                            <?php }}?>
                                        </select>
                                        <?php echo form_error('collateral_type'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_name" class="col-sm-4 control-label">Product Name&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $collateralData[0]->product_name ?>" class="form-control required" name="product_name" id="product_name" placeholder="Product Name">
                                        <!--<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i>  sdff sd fsd fs dfgd</div>-->
                                        <?php // echo form_error('user_name', '<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');  ?>
                                        <?php echo form_error('product_name'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="register_date" class="col-sm-4 control-label">Register Date &nbsp;</label>
                                    <div class="col-sm-8 ">
                                        <div class=" input-group">
                                            <input type="text" value="<?php echo $collateralData[0]->register_date ?>" class="form-control date-picker" data-date-format="yyyy-mm-dd"  name="register_date" id="register_date" placeholder="">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <?php echo form_error('register_date'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="value" class="col-sm-4 control-label">Value&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="<?php echo $collateralData[0]->value ?>" name="value" id="value" maxlength="10" minlength="10">
                                        <?php echo form_error('value'); ?>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group-sm" style="margin-left: 185px;width: 58%;">
                                            <label for="logo" class="control-label">Collateral Photo&nbsp;</label> <br>                                                                 
                                                         
                                                                          
                                        <!--</div>-->
                                      <div class="row">
                                        <!--<div class="col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1" style="border:1px solid #E0E0E0;min-height: 145px;">--> 
                                         <div class="col-sm-4">

                                        <img id="img" name="img" src="<?php echo $collateralData[0]->collateral_photo ?>"  style="width:100%;height:auto;" />

                                        <span class="btn btn-info btn-file">
                                            Select Image <input type="file" id="filename" name="filename" onchange="setAttach();" >
                                        </span>
                                        <input type="hidden" id="attach" name="attach" value="0">
                                        <input type="hidden" id="oldimg" name="oldimg" value="<?php echo $collateralData[0]->collateral_photo;?>">

                                    </div>

                                       <!--</div>-->                                       
                                       </div>  
                                      <div class="row">
                                        <div class="col-sm-12"> 
                                          
                                             <b>Note:</b>
                                             <ul>                                              
                                              <li>You can upload- <b>images only (jpeg,jpg).</b></li>
                                              <li>Image should be less than 5MB in size.</li>
                                             </ul>
                                           
                                        </div>
                                      </div>
                                      </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="serial_no" class="col-sm-4 control-label">Serial Number&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="<?php echo $collateralData[0]->serial_no ?>" name="serial_no" id="serial_no" maxlength="10" minlength="10">
                                        <?php echo form_error('serial_no'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="model_name" class="col-sm-4 control-label">Model Name </label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $collateralData[0]->model_name ?>"  class="form-control " name="model_name" id="model_name" maxlength="10">
                                        <?php echo form_error('model_name'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="colour" class="col-sm-4 control-label">Colour</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $collateralData[0]->colour ?>" class="form-control " name="colour" id="colour" >
                                        <?php echo form_error('colour'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="condition" class="col-sm-4 control-label">Condition &nbsp;
                                        <!--<span style="color:red;" >*</span>-->
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="condition"  id="condition" class="form-control">
                                            <option value="" >--Select--</option>
                                            <option <?php if($collateralData[0]->condition=="Excellent"){echo 'selected';}?> value="Excellent" >Excellent</option>
                                            <option <?php if($collateralData[0]->condition=="Good"){echo 'selected';}?> value="Good" >Good</option>
                                            <option <?php if($collateralData[0]->condition=="Fair"){echo 'selected';}?> value="Fair" >Fair</option>
                                        </select>
                                        <?php echo form_error('condition'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="manufact_date" class="col-sm-4 control-label">Date of Manufacture &nbsp;</label>
                                    <div class="col-sm-8 ">
                                        <div class=" input-group">
                                            <input type="text" class="form-control date-picker" value="<?php echo $collateralData[0]->manufact_date ?>" data-date-format="yyyy-mm-dd"  name="manufact_date" id="manufact_date" placeholder="">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <?php echo form_error('manufact_date'); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="description" class="col-sm-4 control-label">
                                        Description
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="description" name="description" class="form-control" placeholder="Description" ><?php echo $collateralData[0]->description ?></textarea>
                                        <?php echo form_error('description'); ?>
                                    </div>
                                </div>
                                
                            </div>
                            
                           </div> 
                             <div id="additionalInfo" class="tab-pane fade in">
                                    <div class="col-sm-12">
                                        <div class="col-sm-8">

                                             <!--Radio group-->
                                             <div class="row">
                                             <div class="col-sm-4">
                                            <div class="radio3  radio-success  radio-inline">
                                                <input <?php if($collateralData[0]->current_status=="Deposited into Branch"){echo 'checked';}?> value="Deposited into Branch" name="group103" type="radio"  id="radio109">
                                                <label style="font-size: 14px"  for="radio109">Deposited into Branch</label>
                                            </div>
                                            </div>
                                              <div class="col-sm-1">
                                             </div>   
                                                <div class="col-sm-4">
                                                <div class=" input-group">
                                                    <input type="text" value='<?php if($collateralData[0]->current_status=="Deposited into Branch"){ echo $collateralData[0]->current_status_date; }?>'  class="form-control date-picker" data-date-format="yyyy-mm-dd"  name="current_status_date0" id="current_status_date0" placeholder="">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                             <div class="row">
                                             <div class="col-sm-4">
                                            <div class="radio3  radio-success  radio-inline">
                                                <input <?php if($collateralData[0]->current_status=="Collateral with Borrower"){echo 'checked';}?> value="Collateral with Borrower" name="group103" type="radio" id="radio110" >
                                                <label style="font-size: 14px" for="radio110">Collateral with Borrower</label>
                                            </div>
                                            </div>
                                              <div class="col-sm-1">
                                             </div>   
                                             <div class="col-sm-4">
                                                <div class=" input-group">
                                                    <input type="text" value='<?php if($collateralData[0]->current_status=="Collateral with Borrower"){ echo $collateralData[0]->current_status_date; }?>' class="form-control date-picker" data-date-format="yyyy-mm-dd"  name="current_status_date1" id="current_status_date1" placeholder="">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                             </div>    
                                            </div>
                                             <div class="row">
                                              <div class="col-sm-4">
                                            <div class="radio3  radio-success  radio-inline">
                                                <input <?php if($collateralData[0]->current_status=="Returned to Borrower"){echo 'checked';}?> value="Returned to Borrower" name="group103" type="radio"  id="radio111">
                                                <label style="font-size: 14px" for="radio111">Returned to Borrower</label>
                                            </div>
                                            </div>
                                             <div class="col-sm-1">
                                             </div>    
                                             <div class="col-sm-4">
                                                <div class=" input-group">
                                                    <input type="text" value='<?php if($collateralData[0]->current_status=="Returned to Borrower"){ echo $collateralData[0]->current_status_date; }?>' class="form-control date-picker" data-date-format="yyyy-mm-dd"  name="current_status_date2" id="current_status_date2" placeholder="">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                </div>    
                                            </div>
                                             <div class="row">
                                              <div class="col-sm-4">    
                                            <div class="radio3  radio-success  radio-inline ">
                                                <input <?php if($collateralData[0]->current_status=="Sold"){echo 'checked';}?> value="Sold" name="group103" type="radio" id="radio112">
                                                <label style="font-size: 14px" for="radio112">Sold</label>
                                            </div>
                                            </div>
                                             <div class="col-sm-1">
                                             </div>
                                             <div class="col-sm-4">
                                                <div class=" input-group">
                                                    <input type="text" value='<?php if($collateralData[0]->current_status=="Sold"){ echo $collateralData[0]->current_status_date; }?>' class="form-control date-picker" data-date-format="yyyy-mm-dd"  name="current_status_date3" id="current_status_date3" placeholder="">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                </div>    
                                            </div>
                                             <div class="row">
                                               <div class="col-sm-4">   
                                            <div class="radio3  radio-success  radio-inline">
                                                <input <?php if($collateralData[0]->current_status=="Lost"){echo 'checked';}?> value="Lost" name="group103" type="radio"  id="radio113" >
                                                <label style="font-size: 14px"  for="radio113">Lost</label>
                                            </div>
                                            </div>
                                             <div class="col-sm-1">
                                             </div>
                                             <div class="col-sm-4">
                                                <div class=" input-group">
                                                    <input value='<?php if($collateralData[0]->current_status=="Lost"){ echo $collateralData[0]->current_status_date; }?>'  type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd"  name="current_status_date4" id="current_status_date4" placeholder="">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                </div>    
                                            </div>

                                            <!--Radio group-->
                                     </div>  
                                    </div>
                                </div>   
                             <div id="vehicleInfo" class="tab-pane fade in">
                                    <div class="col-sm-12">
                                          <div class="col-sm-5">

                                             <div class="form-group-sm">
                                                <label style="font-size: 14px" for="vehicle_registration_no" class="control-label">Registration Number &nbsp;  </label>
                                                
                                                    <input value="<?php echo $collateralData[0]->vehicle_registration_no ?>" type="text" class="form-control" style="text-align: right" name="vehicle_registration_no" id="vehicle_registration_no" placeholder="Vehicle No">
                                                    <?php echo form_error('registration_no'); ?>
                                                
                                            </div>

                                            <div class="form-group-sm">
                                                <label style="font-size: 14px" for="mileage" class="control-label">Mileage &nbsp;  </label>
                                                
                                                    <input value="<?php echo $collateralData[0]->mileage ?>" type="text" class="form-control" style="text-align: right" name="mileage" id="mileage"  placeholder="Mileage">
                                                    <?php echo form_error('mileage'); ?>
                                                
                                            </div>
                                     </div>       

                                    <div class="col-sm-5 col-sm-offset-1">

                                            <div class="form-group-sm">
                                                <label style="font-size: 14px" for="engin_no" class="control-label">Engine Number&nbsp;</label>
                                                
                                                    <input value="<?php echo $collateralData[0]->engin_no ?>" type="text" class="form-control" style="text-align: right" name="engin_no" id="engin_no"  placeholder="Engine No">
                                                    <?php echo form_error('engin_no'); ?>
                                                
                                            </div>

                                            <div class="form-group-sm">
                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>   
                                
                        </div><!-- /.box-body -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-sm-6 btn-toolbar">
                                
                            </div>
                            <div class="col-sm-6 btn-toolbar">
                                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                <button type="reset" value="refresh" name="refresh" class="btn btn-warning pull-right btn-flat btn-lg-" onclick="remove_validation_errors();">&nbsp;<i class="fa fa-fw fa-fw fa-refresh"></i>  Reset &nbsp;</button>

                                <button <?php if($this->editper[0]->loancollaterallist == 0){echo 'disabled'; }?> type="submit" value="updateClose" name="updateClose" class="btn bg-purple pull-right btn-flat"><i class="fa fa-arrow-circle-up"></i> Update & Close</button>
                            </div>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->

                
                <script>
               
                
                 $(document).ready(function(){
                        $("input, textarea, select").click(
                            function (){
                               $(this).siblings('.validation_errors').remove('');
                               $(this).parent().siblings('.validation_errors').remove('');
                            }
                        );
                
                            // Function for Preview Image.
                           $(function () {
            $(":file").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                    var logo = document.getElementById("filename").value;
                    document.getElementById("img").value = logo;
                }
            });
        });
        function imageIsLoaded(e) {
            $('#img').css("display", "block");
            $('#img').attr('src', e.target.result);
            var name = document.getElementById("filename").value;
            var ext = name.split('.').pop();
            if (ext == "jpg" || ext == "jpeg") {
            } else {
            }

        }
        $("#submit").click(function () {
            $('#preview').css("display", "none");
            $('#message').css("display", "block");
        });
        
         
                            
                            
                            });
                     function setAttach(){
                   var img = $('#filename').val();
                   if(img){
                      $('#attach').val(1); 
                   }
//                    alert(img);
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