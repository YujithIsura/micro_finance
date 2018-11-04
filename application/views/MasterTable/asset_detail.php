<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa  fa-home fa-fw"></i> 
            Asset Detail
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
                    <form class="form-horizontal" action="<?php echo base_url('assetsList/submitAssetDetail'); ?>" method="post">
                        <input type="hidden" class="form-control" name="id_asset" id="id_asset" >
                        <?php // echo form_error('id_assetsList', '<div class="alert alert-warning  col-sm-6" style="border: 1px solid #CC0033; padding: 10px 40px; border-radius: 10px;font-size:14px">', '</div>'); ?>
                        <?php echo form_error('id_asset','<div class="help-block validation_errors" style="color:red;"> ', '</div>' ); ?>
                        <div class="box-body">
                            
                                <div class="col-sm-6">                            
                                    <div class="form-group">
                                        <label for="id_borrower" class="col-sm-4 control-label">Borrower Name&nbsp;
                                            <span style="color:red;" >*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select name="id_borrower"  id="id_borrower" class="form-control selectize" onchange="load_borrower_data();">

                                                <option value="" >--Select--</option>
                                                 <?php  if (!empty($borrower_list)) {
                                                        foreach ($borrower_list as $list) {  ?>

                                                        <option value="<?php echo $list->id_borrower; ?>" ><?php echo $list->name; ?></option>

                                                 <?php } }?>
                                            </select>
                                            <?php echo form_error('id_borrower'); ?>
                                        </div>
                                    </div>
                                </div>
                            <script>
                                function load_borrower_data(){
                                    var id_borrower = $("#id_borrower").val();
//                                    alert(id_borrower);
                                    if(id_borrower != ''){
                                        $.ajax({
                                            url: "<?php echo base_url("process/load_borrower_data") ?>",
                                            type: 'POST',
                                            data: {
                                                "id_borrower": id_borrower,                                                                        
                                            },
//                                            datatype: 'json',
                                            success: function(data) {
//                                                                        alert(data);
                                                var json_value = JSON.parse(data);
                                                $("#nic").val(json_value[0]['nic']);
                                                $("#job").val(json_value[0]['job']);
                                                $("#gender").val(json_value[0]['gender']);
                                                $("#address").val(json_value[0]['address']);
                                                $("#contact_no").val(json_value[0]['contact_no']);
                                                $("#id_areaList").val(json_value[0]['area_name']);
                                                $("#id_marketing_officer").val(json_value[0]['marketing_officer_name']);  
                                            }
                                        });
                                    }
                                    return ;
                                }
                            </script>                            
                            <div class="col-sm-12"><hr></div>                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nic" class="col-sm-4 control-label">NIC &nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nic" id="nic" placeholder="" readonly="true">
                                        <?php echo form_error('nic'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nic" class="col-sm-4 control-label">Job &nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="job" id="job" placeholder="" readonly="true">
                                        <?php echo form_error('job'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id_areaList" class="col-sm-4 control-label">Area &nbsp;
                                        
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="id_areaList" id="id_areaList" placeholder="" readonly="true">
<!--                                        <select name="id_areaList"  id="id_areaList" class="form-control">
                                            <?php // if(!empty($areaList)){
//                                                foreach ($areaList as $area){ ?>                                            
                                            <option value="<?php // echo $area->id_areaList; ?>" ><?php // echo $area->name; ?></option>                                            
                                            <?php // }}?>
                                        </select>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="col-sm-4 control-label">Marketing Officer &nbsp;
                                        
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="id_marketing_officer" id="id_marketing_officer" placeholder="" readonly="true">
<!--                                        <select name="id_marketing_officer"  id="id_marketing_officer" class="form-control">
                                            <option value="" >--Select--</option>
                                            <?php if(!empty($m_officer)){
                                                foreach ($m_officer as $officer){ ?>                                            
                                            <option value="<?php echo $officer->id_marketing_officer; ?>" ><?php echo $officer->name; ?></option>                                            
                                            <?php }}?>
                                        </select>-->
                                    </div>
                                </div>
 

                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="contact_no" class="col-sm-4 control-label">Contact No.&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="" readonly="true" >
                                        <?php echo form_error('contact_no'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="branch" class="col-sm-4 control-label">Gender &nbsp;
                                        
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="gender" id="gender" placeholder="" readonly="true">
                                    </div>
                                </div>
 
                                <div class="form-group">
                                    <label for="address" class="col-sm-4 control-label">
                                        Address
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="address" name="address" class="form-control" placeholder="address" readonly="true" ></textarea>
                                        <?php echo form_error('address'); ?>
                                    </div>
                                </div>
   
                            </div>
                            <div class="col-sm-12"><hr></div>
                            
                            <!--end of customer details-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type" class="col-sm-4 control-label">Class of Asset&nbsp;
                                        <span style="color:red;" >*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="type"  id="type" class="form-control">
                                            <option value="" >--Select--</option>
                                            <option value="Vehicle" >Vehicle</option>
                                            <option value="Jewellery" >Jewellery</option>
                                            <option value="Lands and Buildings" >Lands and Buildings</option>
                                            <!--<option value="Van" >Van</option>-->
                                            <option value="Other" >Other</option>
                                        </select>
                                        <?php echo form_error('type'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="col-sm-4 control-label">Asset Type&nbsp;
                                        <span style="color:red;" >*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="id_assetsTypelist"  id="id_assetsTypelist" class="form-control">
                                            <option value="" >--Select--</option>
                                            <?php if(!empty($assetTypes)){
                                                foreach ($assetTypes as $assetType){ ?>                                            
                                            <option value="<?php echo $assetType->id_assetsList; ?>" ><?php echo $assetType->name; ?></option>                                            
                                            <?php }}?>
                                        </select>
                                        <?php echo form_error('id_assetsTypelist'); ?>
                                    </div>
                                </div>
<!--                                <div class="form-group">
                                    <label for="loan" class="col-sm-4 control-label">Loan&nbsp;
                                        <span style="color:red;" >*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="loan"  id="loan" class="form-control">
                                            <option value="1" >Loan 1</option>
                                            <option value="2" >Loan 2</option>
                                        </select>
                                        <?php // echo form_error('loan'); ?>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label for="duplicate_asset_id" class="col-sm-4 control-label">Duplicate Asset of
                                        <!--<span style="color:red;" >*</span>-->
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="duplicate_asset_id"  id="duplicate_asset_id" class="form-control selectize">
                                             <option value="" >--Select--</option>
                                            <?php if(!empty($asset_details)){
                                                foreach ($asset_details as $asset){ ?>                                            
                                            <option value="<?php echo $asset->id_asset; ?>" ><?php echo $asset->assest_no; ?></option>                                            
                                            <?php }}?>
                                        </select>
                                        <?php echo form_error('duplicate_asset_id'); ?>
                                    </div>
                            </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="assest_no" class="col-sm-4 control-label" >Asset No.&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="assest_no" id="assest_no" onblur="to_upper_case();" placeholder="">
                                        <?php echo form_error('assest_no'); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="worth" class="col-sm-4 control-label">Value (Rs.)&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="worth" id="worth" placeholder="">
                                        <?php echo form_error('worth'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-4 control-label">
                                        Description
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="note" name="note" class="form-control"  ></textarea>
                                        <?php echo form_error('note'); ?>
                                    </div>
                                </div>                                
                            </div>
                            <script>
                                function to_upper_case(){
                                    var assest_no = $('#assest_no').val();
                                    assest_no = assest_no.toUpperCase();
                                    $('#assest_no').val(assest_no);
                                }
                            </script>                        
                            
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-sm-6 btn-toolbar">
                                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                <button type="submit" value="remove" name="remove" class="btn btn-danger pull-right btn-flat"><i class="fa fa-eraser"></i> Remove</button>
                                <?php if($_SESSION['session_user_data']['user_type'] == 'admin'){   ?>
                                <button type="submit" value="update" name="update" class="btn bg-purple pull-right btn-flat" id="update_button"><i class="fa fa-pencil-square-o"></i> Update</button>
                                <?php }   ?>
                                <button type="submit" value="submit" name="submit" class="btn btn-info pull-right btn-flat"><i class="fa fa-arrow-circle-up"></i> Submit</button>
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
                        <div class="col-sm-10">
                            <table id="my_data_table" name="Custermer_list_table" class="table table-bordered table-striped table-hover table-responsive ">
                                <thead style="background-color: white;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Asset No</th>
                                        <th>Type</th>
                                        <th>Asset Type </th>                                
                                        <!--<th>Loan Type</th>-->
                                        <th>Value (Rs.)</th>
                                        <th>Action</th>
                                        <th class="hide">Duplicate Asset</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($asset_details)) {
                                        foreach ($asset_details as $asset_detail) {
                                            ?>
                                            <tr>
                                                <td> <?php echo $asset_detail->id_asset; ?></td>
                                                <td><?php echo $asset_detail->customer_name; ?></td>
                                                <td><?php echo $asset_detail->assest_no ?></td>
                                                <td><?php echo $asset_detail->type ?></td>
                                                <td><?php echo $asset_detail->name ?></td>
                                                <td class="text-right"><?php echo number_format($asset_detail->worth,2,'.','') ?></td>
                                                <!--<td class="text-right"><?php // echo $asset_detail->note ?></td>-->
                                                <td class="text-blue text-right">                                        
                                                    <button type="button" onclick="load_this_detail(this, '<?php echo $asset_detail->id_assetsTypelist ?>', '<?php echo $asset_detail->id_borrower ?>', '<?php echo $asset_detail->note ?>' );"><i class="fa fa-hand-o-up "></i></button>
                                                </td>
                                                <td class="hide"><?php echo $asset_detail->duplicate_asset_id ?></td>
                                                <!--<td><?php // echo $asset_detail->name ?></td>-->
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
                function load_this_detail(this_element, asset_type_id, id_borrower, note){
//                    alert(id_borrower);
//                    var id_assetsList = $(this_element).closest('tr').find("td:first").html();
                    var id_asset = $(this_element).closest('tr').find(':nth-child(1)').html(); 
                    var assest_no = $(this_element).closest('tr').find(':nth-child(3)').html();
                    var type = $(this_element).closest('tr').find(':nth-child(4)').html();
                    var worth = $(this_element).closest('tr').find(':nth-child(6)').html();
                    var duplicate_asset_id = $(this_element).closest('tr').find(':nth-child(8)').html();
//                    alert(duplicate_asset_id);
//                    alert (id_assetsList +' - '+ name+' - '+description +' - '+status );
                          
                    $('#id_asset').val(id_asset);      
                    $('#assest_no').val(assest_no);      
                    $('#id_assetsTypelist').val(asset_type_id);      
                    $('#id_borrower').val(id_borrower);      
                    $("#id_borrower").selectize()[0].selectize.setValue(id_borrower);
                    $('#type').val(type);      
                    $('#worth').val(worth);
                    $('#note').val(note);
                    $('#duplicate_asset_id').val(duplicate_asset_id);
                    $("#duplicate_asset_id").selectize()[0].selectize.setValue(duplicate_asset_id);
                    
//                    $('#update_button').show();
//                    $('#update_button').prop("disabled", true);
                    $('#update_button').prop("disabled", false);
                    load_customer_data();
                    is_asset_used_in_marketing_form(id_asset);
                }
                
                function is_asset_used_in_marketing_form(id_asset){
//                    alert(id_asset);
                    $.ajax({
                        url: "<?php echo base_url("assetsList/is_asset_used_in_marketing_form") ?>",
                        type: 'POST',
                        data: {
                            "id_asset": id_asset,                                                                        
                        },
//                      datatype: 'json',
                        success: function(data) {
//                             alert(data); retrun;
//                            var json_value = JSON.parse(data);
//                            alert(data);
                            if(data === 'TRUE'){
//                                $('#update_button').hide();
                                $('#update_button').prop("disabled", true);
                            } 
                                
                            return;
                        }
                    });
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