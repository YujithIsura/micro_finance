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
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa   fa-users  fa-fw"></i> 
            Add Guarantor
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
                        function validate_form(){
                            
                            $('.validation_errors').remove();
//                            var val2 = $("#blackList").val();
//                            var val2 = $("button[type=submit][clicked=true]").val();
                            var button_val = $('form').find("button[type=submit]:focus" ).val();
//                            alert(val2);
//                            return false;
                            
//                            if($('#blackList').val() == 'blackList' || $('#remove').val()== 'remove' ){ 
                            if( button_val == 'blackList' || button_val == 'remove' ){ 
                                
                                var id_borrower = $('#id_borrower').val();

                                if (id_borrower == ''){
                                    alert('Select a customer first.');
                                    return false;
                                } else {
//                                    alert('ok'); return false;
                                    return true;
                                }
                            }
                            
                            var return_value = true;
                                                        
                            $('.required').each(function(){
//                            $('input[calss=required]').each(function(){
                                var value = $(this).val();
//                                    alert(value);
                                if ( value == '' || value == null){
                                    var req_div = '<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> This field is required! </div>';
                                    $(this).after(req_div);
                                    return_value = false;
                                }
                            });
                            
                            var nic = $('#nic').val();
                            var nic_regex = /^[0-9]{9}[vVxX]$/;
                            var nic_regex_new = /^[0-9]{12}$/;
                            
                            var result = nic_regex.test(nic);
                            var result2 = nic_regex_new.test(nic);
                                
                            if( (nic != '') && (result != true && result2 != true )){
                                
                                var div_string = '<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> Invalid NIC number! </div>';
                                $('#nic').after(div_string);
                                return_value = false;
                            }
//                            return false;
                            if(return_value == false){
                                alert('Form Submission Error! \n\n Please check the form');
                            }
                                
                            return return_value;
                        }
                       
                    </script>
                    <!-- form start -->
                    <!--<form class="form-horizontal" action="<?php // echo base_url('customer/submitForm'); ?>"  method="post">-->
                    <form class="form-horizontal" action="<?php echo base_url('Guarantor_con/submitForm'); ?>" enctype="multipart/form-data" onsubmit="return validate_form();" method="post">
                        <input type="hidden" class="form-control" name="id_borrower" id="id_borrower" >
                        <?php echo form_error('id_borrower', '<div class="alert alert-warning  col-sm-12" style="border: 1px solid #CC0033; padding: 10px 20px; border-radius: 10px;font-size:14px">', '</div>'); ?>
                        <?php // echo form_error('id_collector','<div class="help-block validation_errors" style="color:red;"> ', '</div>' ); ?>
                        <div class="box-body">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="title" class="col-sm-4 control-label">Title&nbsp;
                                        <span style="color:red;" >*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="title"  id="title" class="form-control required">
                                            <option value="" >--Select--</option>
                                            <option value="Mr." >Mr.</option>
                                            <option value="Miss" >Miss</option>
                                            <option value="Mrs." >Mrs.</option>
                                            <option value="Ms." >Ms.</option>
                                        </select>
                                        <?php echo form_error('title'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">Name&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" name="guarantor_name" id="guarantor_name" placeholder="Full Name">
                                        <!--<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i>  sdff sd fsd fs dfgd</div>-->
                                        <?php // echo form_error('user_name', '<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');  ?>
                                        <?php echo form_error('guarantor_name'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nic" class="col-sm-4 control-label">NIC &nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" name="nic" id="nic" placeholder="" maxlength="12">
                                        <?php echo form_error('nic'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="col-sm-4 control-label">Area &nbsp;
                                        <!--<span style="color:red;" >*</span>-->
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="area_id"  id="area_id" class="form-control">
                                            <option value="" >--Select--</option>
                                            <?php if(!empty($areaList)){
                                                foreach ($areaList as $area){ ?>                                            
                                            <option value="<?php echo $area->id_areaList; ?>" ><?php echo $area->name; ?></option>                                            
                                            <?php }}?>
                                        </select>
                                        <?php echo form_error('area_id'); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="dob" class="col-sm-4 control-label">Date of Birth &nbsp;</label>
                                    <div class="col-sm-8 ">
                                        <div class=" input-group">
                                            <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd"  name="dob" id="dob" placeholder="">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <?php echo form_error('dob'); ?>
                                    </div>
                                </div>
                                <div class="form-group-sm" style="margin-left: 185px;width: 58%;">
                                            <label for="logo" class="control-label">Guarantor Photo&nbsp;</label> <br>                                                                 
                                                         
                                                                          
                                        <!--</div>-->
                                      <div class="row">
                                        <!--<div class="col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1" style="border:1px solid #E0E0E0;min-height: 145px;">--> 
                                         <div class="col-sm-4">

                                        <img id="img" name="img" src="http://www.rmasurveying.com/wp-content/themes/slick/images/employee_default.png"  style="width:100%;height:auto;" />

                                        <span class="btn btn-info btn-file">
                                            Select Image <input type="file" id="filename" name="filename" onchange="//setImg();">
                                        </span>


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
                                    <label for="contact_no" class="col-sm-4 control-label">Contact No.&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="contact_no1" id="contact_no1" maxlength="10" minlength="10">
                                        <?php echo form_error('contact_no1'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="contact_no_2" class="col-sm-4 control-label">Cont. No (op) </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " name="contact_no2" id="contact_no2" maxlength="10">
                                        <?php echo form_error('contact_no2'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " name="email" id="email" >
                                        <?php echo form_error('email'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gender" class="col-sm-4 control-label">Gender &nbsp;
                                        <!--<span style="color:red;" >*</span>-->
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="gender"  id="gender" class="form-control">
                                            <option value="" >--Select--</option>
                                            <option value="Male" >Male</option>
                                            <option value="Female" >Female</option>
                                            <option value="Other" >Other</option>
                                        </select>
                                        <?php echo form_error('gender'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="branch" class="col-sm-4 control-label">Job &nbsp;
                                        <!--<span style="color:red;" >*</span>-->
                                    </label>
                                    <div class="col-sm-8">
                                       <input type="text" class="form-control" name="job" id="job" placeholder="">
                                        <?php echo form_error('job'); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="address" class="col-sm-4 control-label">
                                        Address
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="address" name="address" class="form-control" placeholder="Address" ></textarea>
                                        <?php echo form_error('address'); ?>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-sm-6 btn-toolbar">
                                
                            </div>
                            <div class="col-sm-6 btn-toolbar">
                                <button type="reset" value="refresh" name="refresh" class="btn btn-warning pull-right btn-flat btn-lg-" onclick="remove_validation_errors();">&nbsp;<i class="fa fa-fw fa-fw fa-refresh"></i>  Reset &nbsp;</button>

                                <button <?php if($this->saveper[0]->guaranterlist == 0){echo 'disabled'; }?> type="submit" value="saveNew" name="saveNew" class="btn bg-purple pull-right btn-flat"><i class="fa fa-pencil-square-o"></i> Save & New</button>
                               
                                <button <?php if($this->saveper[0]->guaranterlist == 0){echo 'disabled'; }?> type="submit" value="saveClose" name="saveClose" class="btn btn-info pull-right btn-flat"><i class="fa fa-arrow-circle-up"></i> Save & Close</button>
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
                    
                </script>


                <!--*************************end of creating your amazing application!********************-->
            </div><!-- /.box-body -->
            <div class="apnel-footer">
                <!--Footer-->
            </div><!-- /.box-footer-->
        </div><!-- /.box -->

    </section><!-- /.content -->
</div> <!-- /.content-wrapper -->