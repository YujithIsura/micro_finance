<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa  fa-tags fa-fw"></i> 
            Collateral Type List
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
                    <form class="form-horizontal" action="<?php echo base_url('assetsList/submitForm'); ?>" method="post">
                        <input type="hidden" class="form-control" name="id_assetsList" id="id_assetsList" >
                        <?php // echo form_error('id_assetsList', '<div class="alert alert-warning  col-sm-6" style="border: 1px solid #CC0033; padding: 10px 40px; border-radius: 10px;font-size:14px">', '</div>'); ?>
                        <?php echo form_error('id_assetsList','<div class="help-block validation_errors" style="color:red;"> ', '</div>' ); ?>
                        <div class="box-body">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">Name&nbsp;<span style="color:red;" >*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                        <!--<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i>  sdff sd fsd fs dfgd</div>-->
                                        <?php // echo form_error('user_name', '<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');  ?>
                                        <?php echo form_error('name'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-4 control-label">Description</label>
                                    <div class="col-sm-8">
                                        <?php echo form_error('description'); ?>
                                        <textarea id="description" name="description" class="form-control" placeholder="Description" ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-sm-6 btn-toolbar">
                                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                <button <?php if($this->deleteper[0]->collateraltypelist == 0){echo 'disabled'; }?> type="submit" value="remove" name="remove" class="btn btn-warning pull-right btn-flat"><i class="fa fa-eraser"></i> Remove</button>
                                <button <?php if($this->editper[0]->collateraltypelist == 0){echo 'disabled'; }?> type="submit" value="update" name="update" class="btn bg-purple pull-right btn-flat"><i class="fa fa-pencil-square-o"></i> Update</button>
                                <button <?php if($this->saveper[0]->collateraltypelist == 0){echo 'disabled'; }?> type="submit" value="submit" name="submit" class="btn btn-info pull-right btn-flat"><i class="fa fa-arrow-circle-up"></i> Submit</button>
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
                                        <th>Collateral Type Name</th>
                                        <th>Description</th>
                                        <th>Status</th>                                
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($list)) {
                                        foreach ($list as $list_item) {
                                            ?>
                                            <tr>
                                                <td> <?php echo $list_item->id_assetsList; ?></td>
                                                <td><?php echo $list_item->name ?></td>
                                                <td><?php echo $list_item->description ?></td>
                                                <td><?php echo ($list_item->status == '1') ? 'Active' : 'Removed'; ?></td>
                                                <td class="text-blue text-right">                                        
                                                    <button type="button" onclick="load_this_area(this);"><i class="fa fa-hand-o-up "></i></button>
                                                </td>
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
                function load_this_area(this_element){
//                    var id_assetsList = $(this_element).closest('tr').find("td:first").html();
                    var id_assetsList = $(this_element).closest('tr').find(':nth-child(1)').html(); 
                    var name = $(this_element).closest('tr').find(':nth-child(2)').html();
                    var description = $(this_element).closest('tr').find(':nth-child(3)').html();
                    var status = $(this_element).closest('tr').find(':nth-child(4)').html();
//                    alert (id_assetsList +' - '+ name+' - '+description +' - '+status );
                          
                    $('#id_assetsList').val(id_assetsList);      
                    $('#name').val(name);      
                    $('#description').val(description);      
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