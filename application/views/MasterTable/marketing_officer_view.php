<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa  fa-user fa-fw"></i> 
            Loan Officer
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
                        <div class="alert alert-info information col-sm-12" style="border: 2px solid #0099CC; padding: 10px 40px; border-radius: 10px; font-size:16px">
                            <i class="fa fa-thumbs-o-up fa-fw"></i>
                            <?php echo $this->session->flashdata('success_msg'); ?>
                        </div>
                        <?php $this->session->set_flashdata("success_msg", "");
                    } ?>
                    <?php 
                        $error_msg = $this->session->flashdata('error_msg');
                        if (!empty($error_msg)) { ?>
                        <div class="alert alert-warning information col-sm-12" style="border: 2px solid #CC0033;padding: 10px 40px; border-radius: 10px;font-size:16px">
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
                        function validate_form(){
                            
                            var return_value = true;
                            $('.validation_errors').remove();
                            
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
//                            if( (result != true && result2 != true )){
//                                
//                                var div_string = '<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> Invalid NIC number! </div>';
//                                $('#nic').after(div_string);
//                                return_value = false;
//                            }
//                            return false;
                            if(return_value == false){
                                alert('Form Submission Error!');
                            }
                                
                            return return_value;
                        }
                    </script>
                    <!-- form start -->
                    <form class="form-horizontal" action="<?php echo base_url('marketingOfficer/submitForm'); ?>" method="post" onsubmit="return validate_form();">
                        <input type="hidden" class="form-control" name="id_marketing_officer" id="id_marketing_officer" >
                        <?php echo form_error('id_marketing_officer', '<div class="alert alert-warning  col-sm-12" style="border: 1px solid #CC0033; padding: 10px 40px; border-radius: 10px;font-size:14px">', '</div>'); ?>
                        <?php // echo form_error('id_marketing_officer','<div class="help-block validation_errors" style="color:red;"> ', '</div>' ); ?>
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
                                    <label for="nic" class="col-sm-4 control-label">NIC &nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nic" id="nic" maxlength="12" placeholder="">
                                        <?php echo form_error('nic'); ?>
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
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="contact_no" class="col-sm-4 control-label">Contact No.&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="contact_no" id="contact_no" maxlength="10">
                                        <?php echo form_error('contact_no'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="contact_no" class="col-sm-4 control-label">Fax No.&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="fax_no" id="fax_no" maxlength="10">
                                        <?php echo form_error('fax_no'); ?>
                                    </div>
                                </div>
                                <div hidden="" class="form-group">
                                    <label for="branch" class="col-sm-4 control-label">Branch &nbsp;
                                        <span style="color:red;" >*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="branch"  id="branch" class="form-control">
                                            <option value="" >--Select--</option>
                                            <?php if(!empty($branch_list)){
                                                        foreach ($branch_list as $branch){
                                            ?>
                                            <option value="<?php echo $branch->id_branch ?>" ><?php echo $branch->branch_name ?> </option>
                                            <?php                        
                                                        }
                                            }
                                            ?> 
                                        </select>
                                        <?php echo form_error('branch'); ?>
                                    </div>
                                </div>
<!--                                <div class="form-group">
                                    <label for="assest_no" class="col-sm-4 control-label">Worth (Rs.)&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="worth" id="worth" placeholder="">
                                        <?php // echo form_error('worth'); ?>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label for="address" class="col-sm-4 control-label">
                                        Address 
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="address" name="address" class="form-control " placeholder="address" ></textarea>
                                        <?php echo form_error('address'); ?>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-sm-6 btn-toolbar"></div>
                            <div class="col-sm-6 btn-toolbar">
                                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                <button <?php if($this->deleteper[0]->loanofficerlist == 0){echo 'disabled'; }?> type="submit" value="remove" name="remove" class="btn btn-warning pull-right btn-flat"><i class="fa fa-eraser"></i> Remove</button>
                                
                                <button <?php if($this->editper[0]->loanofficerlist == 0){echo 'disabled'; }?> type="submit" value="update" name="update" class="btn bg-purple pull-right btn-flat"><i class="fa fa-pencil-square-o"></i> Update</button>
                                
                                <button <?php if($this->saveper[0]->loanofficerlist == 0){echo 'disabled'; }?> type="submit" value="submit" name="submit" class="btn btn-info pull-right btn-flat"><i class="fa fa-arrow-circle-up"></i> Submit</button>
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
                                        <th>Title </th>
                                        <th>Name</th>
                                        <th>NIC </th>                                
                                        <th>Joined Date</th>
                                        <th>Contact No. </th>
                                        <th>Fax No. </th>
                                        <!--<th>Branch </th>-->
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($collector_list)) {
                                        foreach ($collector_list as $list) {
                                            ?>
                                            <tr>
                                                <td> <?php echo $list->id_marketing_officer; ?></td>
                                                <td><?php echo $list->title ?></td>
                                                <td><?php echo $list->name ?></td>
                                                <td><?php echo $list->nic ?></td>
                                                <td><?php echo $list->joined_date ?></td>
                                                <td><?php echo $list->contact_no ?></td>
                                                <td><?php echo $list->fax_no ?></td>
                                                <!--<td><?php // echo $list->branch_name  ?></td>-->
                                                <td><?php echo $list->address ?></td>
                                                <td class="text-blue text-center">                                        
                                                    <button type="button" onclick="load_this_detail(this, '<?php echo $list->id_marketing_officer ?>');"><i class="fa fa-hand-o-up "></i></button>
                                                </td>
<!--                                                <td><?php // echo $list->name ?></td>
                                                <td><?php // echo $list->name ?></td>-->
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
                function load_this_detail(this_element, asset_type_id ){
                    $('.validation_errors').remove();
                    var id_marketing_officer = $(this_element).closest('tr').find(':nth-child(1)').html(); 
                    var title = $(this_element).closest('tr').find(':nth-child(2)').html();
                    var name = $(this_element).closest('tr').find(':nth-child(3)').html();
                    var nic = $(this_element).closest('tr').find(':nth-child(4)').html();
                    var joined_date = $(this_element).closest('tr').find(':nth-child(5)').html();
                    var contact_no = $(this_element).closest('tr').find(':nth-child(6)').html();
//                    var branch = $(this_element).closest('tr').find(':nth-child(7)').html();
                    var address = $(this_element).closest('tr').find(':nth-child(8)').html();
//                    alert (id_assetsList +' - '+ name+' - '+description +' - '+status );
//                    branch =  ( branch == 'Branch 1')? '1' : '2';
                    $('#id_marketing_officer').val(id_marketing_officer);      
                    $('#title').val(title);      
                    $('#name').val(name);      
                    $('#nic').val(nic);      
                    $('#joined_date').val(joined_date);      
                    $('#contact_no').val(contact_no);      
//                    $('#branch').val(branch_id);      
                    $('#address').val(address);      
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