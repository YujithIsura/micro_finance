<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa  fa-tags fa-fw"></i> 
            Setup User
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
                    <br>
                    <div class="panel-body well" style="/*background-color:#;*/">
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                         <a onclick="createUser()" style="margin-left: 18px;width: 130px;margin-bottom: -30px;margin-top: -13px;" class="btn btn-block btn-social btn-dropbox">
                            <i class="fa fa-user-plus"></i> Create User
                          </a>
                                </div>
                        </div>
                        <div class="col-sm-12">
                            <table id="my_data_table" name="Custermer_list_table" class="table table-bordered table-striped table-hover table-responsive ">
                                <thead style="background-color: white;">
                                    <tr>
                                        <th>User Name</th>
                                        <th>User Roll</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($user_list)) {
                                        foreach ($user_list as $list) {
                                            ?>
                                            <tr>
                                                <td><?php echo $list->userName; ?></td>
                                                <td><?php echo $list->status; ?></td>
                                                <td class="text-blue text-center">                                        
                                                        <a type="button" href="<?php echo base_url('Setup_user_control/update_view') . '/' . $list->id; ?>"><i class="fa fa-hand-o-up "></i></a>

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
               
                
                 $(document).ready(function(){
                        $("input, textarea, select").click(
                            function (){
                               $(this).siblings('.validation_errors').remove('');
                               $(this).parent().siblings('.validation_errors').remove('');
                            }
                        );
                    });
                
                 function createUser() {
                    $('#userModal').modal('show');
                }
                    
                </script>
                <div class="modal fade userModal  " tabindex="-1"   data-backdrop="static" data-keyboard="false" id="userModal" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content center ">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create a User</h4>
            </div>
            <div class="modal-body"> 
                <form class="form-horizontal" action="<?php echo base_url("Setup_user_control/CreateUser"); ?>" method="POST">
                    <!--                                <div class="row" style="margin-left:40px;">  
                                                        <div class="form-group">
                                                            <div class="col-sm-3">
                                                                <label for="name" class="control-label form-inline">Name</label>
                                                            </div>
                                                            <div class="input-group">
                                                                <input class="form-control" style="margin-left:15px; width: 350px;" type="text" class="text box"   name="name" required  id="name"/>
                                                            </div>
                                                        </div>
                                                    </div>
                    -->
                      <ul  class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#createUser">Create User</a></li>
                            <!--<li ><a data-toggle="tab" href="#siteList">Site List</a></li>-->

                        </ul>
                    <div class="box-body tab-content">
                    <div id="createUser" class="col-sm-12 tab-pane fade in active">
                        <div class="row" style="margin-left:40px;">  
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <label for="name" class="control-label form-inline">User Name</label>
                                </div>
                                <div class="input-group">
                                    <input class="form-control" style="margin-left:15px; width: 350px;" type="text" class="text box"  name="uname" required  id="uname"/> 
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-left:40px;">  
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <label for="type" class="control-label form-inline">User Type</label>
                                </div>
                                <div class="input-group">
                                    <select class="text box form-control apprDiv" style="margin-left:15px;width:350px" name="usertype" required>
                                        <option value="Admin">Admin</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Loan Officer">Loan Officer</option>
                                        <option value="Accountant">Accountant</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row" style="margin-left:40px;">  
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <label for="password" class="control-label form-inline">Password</label>
                                </div>
                                <div class="input-group">
                                    <input class="form-control" style="margin-left:15px; width: 350px;" placeholder="Password" type="password" class="text box" style="width:250px" name="npassword" required  id="npassword"/> 
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left:40px;">  
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <label for="cpassword" class="control-label form-inline">Password</label>
                                </div>
                                <div class="input-group">
                                    <input class="form-control" style="margin-left:15px; width: 350px;" type="password" placeholder="Confirm Password" class="text box" style="width:250px" name="cpassword" required  id="cpassword"/><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="btn-toolbar">
                        <input type="submit" value="Save&Close" name="Save&Close" class="btn btn-warning pull-right" style="padding: 2x;"/>
                        <input type="submit" value="Save&New" name="Save&New" class="btn btn-success pull-right" onclick=" " style="margin: 0px 0px 0px 0px;" />
                    </div>
                </form>
            </div>      
        </div>

    </div>
</div>

                <!--*************************end of creating your amazing application!********************-->
            </div><!-- /.box-body -->
            <div class="apnel-footer">
                <!--Footer-->
            </div><!-- /.box-footer-->
        </div><!-- /.box -->

    </section><!-- /.content -->
</div> <!-- /.content-wrapper -->