<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa   fa-users  fa-fw"></i> 
            Borrowers
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
                    <form class="form-horizontal" action="<?php echo base_url('Borrower/submitForm'); ?>" enctype="multipart/form-data" onsubmit="return validate_form();" method="post">
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
                                        <input type="text" class="form-control required" name="name" id="name" placeholder="Name">
                                        <!--<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i>  sdff sd fsd fs dfgd</div>-->
                                        <?php // echo form_error('user_name', '<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');  ?>
                                        <?php echo form_error('name'); ?>
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
                                        <select name="id_areaList"  id="id_areaList" class="form-control">
                                            <option value="" >--Select--</option>
                                            <?php if(!empty($areaList)){
                                                foreach ($areaList as $area){ ?>                                            
                                            <option value="<?php echo $area->id_areaList; ?>" ><?php echo $area->name; ?></option>                                            
                                            <?php }}?>
                                        </select>
                                        <?php echo form_error('id_areaList'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="col-sm-4 control-label">Marketing Officer &nbsp;
                                        <!--<span style="color:red;" >*</span>-->
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="id_marketing_officer"  id="id_marketing_officer" class="form-control">
                                            <option value="" >--Select--</option>
                                            <?php if(!empty($m_officer)){
                                                foreach ($m_officer as $officer){ ?>                                            
                                            <option value="<?php echo $officer->id_marketing_officer; ?>" ><?php echo $officer->name; ?></option>                                            
                                            <?php }}?>
                                        </select>
                                        <?php echo form_error('id_marketing_officer'); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="joined_date" class="col-sm-4 control-label">Joined Date &nbsp;</label>
                                    <div class="col-sm-8 ">
                                        <div class=" input-group">
                                            <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd"  name="joined_date" id="joined_date" placeholder="">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <?php echo form_error('joined_date'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-4 control-label">Status &nbsp;
                                        <!--<span style="color:red;" >*</span>-->
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="status"  id="status" class="form-control">
                                            <!--<option value="" >--Select--</option>-->
                                            <option value="1" >Active</option>
                                            <option value="0" >Inactive</option>
                                            <!--<option value="Other" >Other</option>-->
                                        </select>
                                        <?php echo form_error('status'); ?>
                            </div>
                                </div>
                                <div class="form-group-sm" style="margin-left: 185px;width: 58%;">
                                            <label for="logo" class="control-label">Borrower Photo&nbsp;</label> <br>                                                                 
                                                         
                                                                          
                                        <!--</div>-->
                                      <div class="row">
                                        <!--<div class="col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1" style="border:1px solid #E0E0E0;min-height: 145px;">--> 
                                         <div class="col-sm-4">

                                        <img id="img" name="img" src="http://www.rmasurveying.com/wp-content/themes/slick/images/employee_default.png"  style="width:100%;height:auto;" />

                                        <span class="btn btn-info btn-file">
                                            Select Image <input type="file" id="filename" onchange="setAttach();" name="filename" onchange="//setImg();">
                                        </span>
                                        <input type="hidden" id="attach" name="attach" value="0">
                                        <input type="hidden" id="oldimg" name="oldimg" value="">

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
                                        <input type="text" class="form-control" name="contact_no" id="contact_no" maxlength="10" minlength="10">
                                        <?php echo form_error('contact_no'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="contact_no_2" class="col-sm-4 control-label">Cont. No (op) </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " name="contact_no_2" id="contact_no_2" maxlength="10">
                                        <?php echo form_error('contact_no_2'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="branch" class="col-sm-4 control-label">Gender &nbsp;
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
                                    <label for="distance" class="col-sm-4 control-label">Distance&nbsp;(Km.)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="distance" id="distance" placeholder="">
                                        <?php echo form_error('distance'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-4 control-label">
                                        Address
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="address" name="address" class="form-control" placeholder="address" ></textarea>
                                        <?php echo form_error('address'); ?>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="communication_address" class="col-sm-4 control-label">
                                        Corresponding Address
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="communication_address" name="communication_address" class="form-control" placeholder="address" ></textarea>
                                        <?php echo form_error('communication_address'); ?>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-sm-6 btn-toolbar">
                                <button <?php if($this->editper[0]->borrowerlist == 0){echo 'disabled'; }?> class="btn btn-primary- bg-gray  pull-right btn-flat-" name="blackList" id="blackList" 
                                        value="blackList" type="submit">
                                    <span class="fa-stack fa-lg- fa-fw ">
                                      <i class="fa fa-list fa-stack-1x"></i>
                                      <i class="fa fa-ban fa-stack-2x text-danger"></i>
                                    </span>
                                    &nbsp; BlackLIst Borrower
                                </button>
                                <button <?php if($this->deleteper[0]->borrowerlist == 0){echo 'disabled'; }?> type="submit" value="remove" name="remove" id="remove" class="btn btn-warning pull-right btn-flat-">
<!--                                    <i class="fa fa-eraser"></i>
                                    Remove-->
                                    <span class="fa-stack fa-lg- fa-fw ">
                                      <i class="fa fa-user fa-stack-1x"></i>
                                      <i class="fa fa-ban fa-stack-2x text-info"></i>
                                    </span>
                                     &nbsp; Remove Borrower
                                </button>
                            </div>
                            <div class="col-sm-6 btn-toolbar">
                                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                <button type="reset" value="refresh" name="refresh" class="btn btn-warning pull-right btn-flat btn-lg-" onclick="remove_validation_errors();">&nbsp;<i class="fa fa-fw fa-fw fa-refresh"></i>  Reset &nbsp;</button>
<!--                                <button type="submit" value="remove" name="remove" id="remove" class="btn btn-warning pull-right btn-flat"><i class="fa fa-eraser"></i> Remove</button>-->
                                
                                <button type="submit" value="update" name="update" <?php if($this->editper[0]->borrowerlist == 0){echo 'disabled'; }?>  class="btn bg-purple pull-right btn-flat"><i class="fa fa-pencil-square-o"></i> Update</button>
                               
                                <button type="submit" value="submit" name="submit" <?php if($this->saveper[0]->borrowerlist == 0){echo 'disabled'; }?> class="btn btn-info pull-right btn-flat"><i class="fa fa-arrow-circle-up"></i> Submit</button>
                            </div>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->

                <div class="box box-primary col-sm-12">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-table fa-fw"></i> Table</h3>
                    </div><!-- /.box-header -->
                    <br>
                    <div class="panel-body well" style="/*background-color:#;*/">
                        <br>
                        <div class="col-sm-12">
                            <table id="my_data_table" name="Custermer_list_table" class="table table-bordered table-striped table-hover table-responsive ">
                                <thead style="background-color: white;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>NIC </th>                                
                                        <!--<th>Joined Date</th>-->
                                        <th>Contact No. </th>
                                        <!--<th>Branch </th>-->
                                        <th>Address</th>
                                        <th>Action</th>
                                        <!--hidden collmns-->
                                        <th class="hidden">Title</th>
                                        <th class="hidden">Joined_date</th>
                                        <th class="hidden">branch</th>
                                        <th class="hidden">gender</th>
                                        <th class="hidden">distance</th>
                                        <th class="hidden">id_arealist</th>
                                        <th class="hidden">id_marketing_officer</th>
                                        <th class="hidden">relative_type</th>
                                        <th class="hidden">communication_address</th>
                                        <th class="hidden">job</th>
                                        <th class="hidden">status</th>
                                        <th class="hidden">contact_no_2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($borrower_list)) {
                                        foreach ($borrower_list as $list) {
                                            ?>
                                            <tr>
                                                <td><?php echo $list->id_borrower; ?></td>
                                                <td><?php echo $list->name; ?></td>
                                                <td><?php echo $list->nic; ?></td>
                                                <!--<td><?php // echo $list->joined_date ?></td>-->
                                                <td><?php echo $list->contact_no; ?></td>
                                                <!--<td><?php // echo ($list->branch == '1') ? 'Branch 1' : 'Branch 2'; ?></td>-->
                                                <td><?php echo $list->address; ?></td>
                                                <td class="text-blue text-right">                                        
                                                    <button type="button" onclick="load_this_detail(this, '<?php echo $list->id_borrower ?>');"><i class="fa fa-hand-o-up "></i></button>
                                                </td>
                                                <td class="hidden"><?php echo $list->title; ?></td>
                                                <td class="hidden"><?php echo $list->joined_date; ?></td>
                                                <td class="hidden"><?php echo $list->branch; ?></td>
                                                <td class="hidden"><?php echo $list->gender; ?></td>
                                                <td class="hidden"><?php echo $list->distance; ?></td>
                                                <td class="hidden"><?php echo $list->id_areaList; ?></td>
                                                <td class="hidden"><?php echo $list->id_marketing_officer; ?></td>
                                                <td class="hidden"><?php echo $list->relative_type ?></td>
                                                <td class="hidden"><?php echo $list->communication_address ?></td>
                                                <td class="hidden"><?php echo $list->job; ?></td>
                                                <td class="hidden"><?php echo $list->status; ?></td>
                                                <td class="hidden"><?php echo $list->contact_no_2; ?></td>
                                                <td class="hidden"><?php echo $list->borrower_photo; ?></td>
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
                    var borrower_photo = $(this_element).closest('tr').find(':nth-child(19)').html();
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
                    $('#oldimg').val(borrower_photo);  
                     
                       setImageSource('img',borrower_photo);
//                    alert(gender);
                }
                 function setImageSource(imageId, imageSrc) {
      $('#' + imageId).attr('src', imageSrc);
    }
                
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