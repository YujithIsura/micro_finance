<style>

    /*Checkboxes styles*/
    .checkb input[type="radio"] { display: none; }

    .checkb input[type="radio"] + label {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 20px;
        font: 14px/16px 'Source Sans Pro', Arial, sans-serif;
        color: #ddd;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }

    .checkb input[type="radio"] + label:last-child { margin-bottom: 0; }

    .checkb input[type="radio"] + label:before {
        content: '';
        display: block;
        width: 18px;
        height: 18px;
        border: 1px solid #021b26;
        position: absolute;
        left: 0;
        top: 0;
        opacity: .6;
        -webkit-transition: all .12s, border-color .08s;
        transition: all .12s, border-color .08s;
    }

    .checkb input[type="radio"]:checked + label:before {
        width: 10px;
        top: -5px;
        left: 5px;
        border-radius: 0;
        opacity: 1;
        border-top-color: transparent;
        border-left-color: transparent;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }

</style>


<!-- Content Wrapper. Contains page content -->


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa  fa-map-marker fa-fw"></i>
            Update User 
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
                    if (!empty($success_msg)) {
                        ?>
                        <div class="alert alert-info information col-sm-10" style="border: 2px solid #0099CC; padding: 10px 40px; border-radius: 10px; font-size:16px">
                            <i class="fa fa-thumbs-o-up fa-fw"></i>
                            <?php echo $this->session->flashdata('success_msg'); ?>
                        </div>
                        <?php
                        $this->session->set_flashdata("success_msg", "");
                    }
                    ?>
                    <?php
                    $error_msg = $this->session->flashdata('error_msg');
                    if (!empty($error_msg)) {
                        ?>
                        <div class="alert alert-warning information col-sm-10" style="border: 2px solid #CC0033;padding: 10px 40px; border-radius: 10px;font-size:16px">
                            <i class="fa fa-thumbs-o-down fa-fw"></i>
                            <?php echo $this->session->flashdata('error_msg'); ?>
                        </div>
                        <?php
                        $this->session->set_flashdata("error_msg", "");
                    }
                    ?>


                    <br>
                </h5>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body well">

                <div class="box box-primary col-sm-10">
                    <div class="box-header with-border">
                        <h3 class="box-title"><h3 class="box-title"><i class="fa fa-pencil-square-o fa-fw"></i> Form</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <input type="hidden" value="<?php // echo $res[0]->id; ?>" class="form-control" name="id" id="id" placeholder=" ">

                    <div class="box-body">
                        
                        <div class="box box-success collapsed-box box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title">Update User Detail</h3> 

                              <div class="box-tools pull-right">
                                <button type="button" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="box-body"  id="gur_rw">
                                <div class="row">
                                   <div class="col-sm-6">
                            <div class="pull-right "  style="margin:-50px 32px -1px -40px; width: 250px; " name="div1" id="hhh" >
                                <form class="form-horizontal" action="<?php echo base_url('Setup_user_control/submitForm') ?>" method="POST">

                                    <div class="tab-content">
                                        <div id="updateUser" class="col-sm-12 tab-pane fade in active">


                                            <input class="form-control" type="hidden" class="text box" style="width:250px" name="id" required value="<?php echo $list[0]->id; ?>"  id="n1" /><br><br>
                                         
                                            <lable>User Name</lable>
                                            <input class="form-control" type="text" disabled="" readonly="" class="text box" style="width:250px" name="username1" required value="<?php echo $list[0]->userName; ?>" id="un" /><br>
                                            <input class="form-control" type="hidden" readonly="" class="text box" style="width:250px" name="uname" required value="<?php echo $list[0]->userName; ?>" id="uname" />
                                            <lable>User Type</lable>
                                            <select class="text box form-control apprDiv"  style="width:250px" name="usertype1" required>
                                                <option value="Admin" <?php if($list[0]->status=='Admin'){echo 'selected';}?> >Admin</option>
                                                <option value="Manager" <?php if($list[0]->status=='Manager'){echo 'selected';}?> >Manager</option>
                                                <option value="Loan Officer" <?php if($list[0]->status=='Loan Officer'){echo 'selected';}?> >Loan Officer</option>
                                                <option value="Accountant" <?php if($list[0]->status=='Accountant'){echo 'selected';}?> >Accountant</option>
                                            </select>
                                            
                                        </div>


                                    </div>
                            </div>
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col-sm-12">
                                            <button style="margin: 0px 5px;" type="button" onclick="pwModel();" value="changePw" id="changePw" name="changePw" class="btn bg-yellow pull-right btn-flat"><i class="fa fa-pencil-square-o"></i> Change Password</button>
                                        <button style="margin: 0px 5px;" type="submit" value="edit" name="edit" class="btn bg-purple pull-right btn-flat"><i class="fa fa-pencil-square-o"></i> Update</button>
                                        <button style="margin: 0px 5px;" type="submit" value="Remove" name="Remove" class="btn btn-danger pull-right btn-flat"><i class="fa fa-eraser"></i> Remove</button>
                                        </div>
                                        </div>
                                </form>
                        </div>
                                    </div>
                            </div>
                          </div>
                          <div class="box box-info collapsed-box box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title">Assign Permission For <?php echo $list[0]->userName;?></h3>

                              <div class="box-tools pull-right">
                                <button type="button" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="box-body" id="coll_rw">
                                  <div class="col-sm-12">
                                      <div class="row"> 
                                      <button onclick="AllPermission();" class="btn btn-primary "><i class="fa fa-add"></i> All Permissions</button>&nbsp;&nbsp; <button onclick="NoPermission();" class="btn btn-primary "><i class="fa fa-add"></i> No Permission</button>&nbsp;&nbsp; <br/> <br/>
                                      </div>
                <form id="myform" action="<?php echo base_url("Setup_user_control/ConfirmPermission"); ?>" method="post" onsubmit="makeSubmit();"> 
                    <input type="hidden" name="userid" id="userid" value="<?php echo $list[0]->userName; ?>"/>
                     <input type="hidden" name="user" id="user" value="<?php echo $list[0]->id; ?>"/>
                     
                        <div class="box box-success col-sm-12 collapsed-box"> 
                            <div class="box-header with-border">
                                <span><i class="icon-folder-open fa fa-th " ></i><h3 class="box-title">&nbsp;Master Tables</h3></span>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse" type="button">
                                     <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body well" >
                                <table class="table table-bordered table-responsive" id="mtable"  style="background-color: white;">
                                        <thead>
                                           <th style="width: 300px;">Master Tables</th>
                                           <th><input type="checkbox"  name="mtall"  id="mtall" value="1"  onchange="checkmtall();"/>&nbsp;All</th>
                                           <th><input type="checkbox"  name="mtadd"  id="mtadd"  value="1" onchange="checkmtadd();"/>&nbsp;Add</th>
                                           <th><input type="checkbox"  name="mtedit" id="mtedit" value="1" onchange="checkmtedit();"/>&nbsp;Edit</th>
                                           <th><input type="checkbox"  name="mtdel"  id="mtdel"  value="1" onchange="checkmtdel();"/>&nbsp;Delete</th>
                                           <th><input type="checkbox"  name="mtvw"   id="mtvw"   value="1" onchange="checkmtvw();"/>&nbsp;View</th>
                                         </thead>

                                        <tbody>

                                        <tr>
                                            <td> Borrower List</td>
                                            <td> <input type="checkbox" name="All0"     id="All0"   value="All0"  onchange="checkmt_all(this);"   /></td>
                                            <td> <input type="checkbox" name="Add0"     id="Add0"   value="1"      onchange="checkmt_add();"   <?php if(isset($saveper[0]->borrowerlist)){if($saveper[0]->borrowerlist>0){echo "checked"; }} ?> /></td>
                                            <td> <input type="checkbox" name="Edit0"    id="Edit0"  value="1"     onchange="checkmt_edit();"   <?php if(isset($editper[0]->borrowerlist)){if($editper[0]->borrowerlist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Delete0"  id="Delete0"value="1"    onchange="checkmt_del();"    <?php if(isset($deleteper[0]->borrowerlist)){if($deleteper[0]->borrowerlist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="View0"    id="View0"  value="1"     onchange="checkmt_vw();"     <?php if(isset($viewper[0]->borrowerlist)){if($viewper[0]->borrowerlist>0){echo "checked"; }} ?>/></td> 
                                        </tr>

                                        <tr>
                                            <td> Loan Officer List</td>
                                            <td> <input type="checkbox" name="All1"    id="All1"    value="All1" onchange="checkmt_all(this);"/></td>
                                            <td> <input type="checkbox" name="Add1"    id="Add1"    onchange="checkmt_add();"    value="1" <?php if(isset($saveper[0]->loanofficerlist)){if($saveper[0]->loanofficerlist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Edit1"   id="Edit1"   onchange="checkmt_edit();"   value="1" <?php if(isset($editper[0]->loanofficerlist)){if($editper[0]->loanofficerlist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Delete1" id="Delete1" onchange="checkmt_del();"    value="1" <?php if(isset($deleteper[0]->loanofficerlist)){if($deleteper[0]->loanofficerlist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="View1"   id="View1"   onchange="checkmt_vw();"     value="1" <?php if(isset($viewper[0]->loanofficerlist)){if($viewper[0]->loanofficerlist>0){echo "checked"; }} ?>/></td> 


                                        </tr>
                                        <tr>
                                            <td> Guarantor List</td>
                                            <td> <input type="checkbox" name="All2"    id="All2"     value="All2" onchange="checkmt_all(this);"/></td>
                                            <td> <input type="checkbox" name="Add2"    id="Add2"    onchange="checkmt_add();"    value="1"  <?php if(isset($saveper[0]->guaranterlist)){if($saveper[0]->guaranterlist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Edit2"   id="Edit2"   onchange="checkmt_edit();"   value="1"  <?php if(isset($editper[0]->guaranterlist)){if($editper[0]->guaranterlist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Delete2" id="Delete2" onchange="checkmt_del();"    value="1"  <?php if(isset($deleteper[0]->guaranterlist)){if($deleteper[0]->guaranterlist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="View2"   id="View2"   onchange="checkmt_vw();"     value="1"  <?php if(isset($viewper[0]->guaranterlist)){if($viewper[0]->guaranterlist>0){echo "checked"; }} ?>/></td> 
                                        </tr>
                                        <tr>
                                            <td> Collateral Type List</td>
                                            <td> <input type="checkbox" name="All3"     id="All3"     value="All3" onchange="checkmt_all(this);"/></td>
                                            <td> <input type="checkbox" name="Add3"     id="Add3"    onchange="checkmt_add();"     value="1" <?php if(isset($saveper[0]->collateraltypelist)){if($saveper[0]->collateraltypelist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Edit3"    id="Edit3"   onchange="checkmt_edit();"    value="1" <?php if(isset($editper[0]->collateraltypelist)){if($editper[0]->collateraltypelist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Delete3"  id="Delete3" onchange="checkmt_del();"     value="1" <?php if(isset($deleteper[0]->collateraltypelist)){if($deleteper[0]->collateraltypelist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="View3"    id="View3"   onchange="checkmt_vw();"      value="1" <?php if(isset($viewper[0]->collateraltypelist)){if($viewper[0]->collateraltypelist>0){echo "checked"; }} ?>/></td> 

                                        </tr>
                                        <tr>
                                            <td> Loan Product List</td>
                                            <td> <input type="checkbox" name="All4"    id="All4"     value="All4" onchange="checkmt_all(this);"/></td>
                                            <td> <input type="checkbox" name="Add4"    id="Add4"    onchange="checkmt_add();"    value="1"  <?php if(isset($saveper[0]->loanproductlist)){if($saveper[0]->loanproductlist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Edit4"   id="Edit4"   onchange="checkmt_edit();"   value="1"  <?php if(isset($editper[0]->loanproductlist)){if($editper[0]->loanproductlist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Delete4" id="Delete4" onchange="checkmt_del();"     value="1"  <?php if(isset($deleteper[0]->loanproductlist)){if($deleteper[0]->loanproductlist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="View4"   id="View4"   onchange="checkmt_vw();"     value="1"  <?php if(isset($viewper[0]->loanproductlist)){if($viewper[0]->loanproductlist>0){echo "checked"; }} ?>/></td> 
                                        </tr>
                                        <tr>
                                            <td>  Area List</td>
                                            <td> <input type="checkbox" name="All5"    id="All5"    value="All5" onchange="checkmt_all(this);"/></td>
                                            <td> <input type="checkbox" name="Add5"    id="Add5"    onchange="checkmt_add();"    value="1" <?php if(isset($saveper[0]->arealist)){if($saveper[0]->arealist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Edit5"   id="Edit5"   onchange="checkmt_edit();"   value="1" <?php if(isset($editper[0]->arealist)){if($editper[0]->arealist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Delete5" id="Delete5" onchange="checkmt_del();"    value="1" <?php if(isset($deleteper[0]->arealist)){if($deleteper[0]->arealist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="View5"   id="View5"   onchange="checkmt_vw();"      value="1" <?php if(isset($viewper[0]->arealist)){if($viewper[0]->arealist>0){echo "checked"; }} ?>/></td> 
                                        </tr>
                                        <tr>
                                            <td> Loan Collateral List</td>
                                            <td> <input type="checkbox" name="All6"    id="All6"     value="All6" onchange="checkmt_all(this);"/></td>
                                            <td> <input type="checkbox" name="Add6"    id="Add6"    onchange="checkmt_add();"    value="1" <?php if(isset($saveper[0]->loancollaterallist)){if($saveper[0]->loancollaterallist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Edit6"   id="Edit6"   onchange="checkmt_edit();"   value="1" <?php if(isset($editper[0]->loancollaterallist)){if($editper[0]->loancollaterallist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="Delete6" id="Delete6" onchange="checkmt_del();"     value="1" <?php if(isset($deleteper[0]->loancollaterallist)){if($deleteper[0]->loancollaterallist>0){echo "checked"; }} ?>/></td>
                                            <td> <input type="checkbox" name="View6"   id="View6"   onchange="checkmt_vw();"      value="1" <?php if(isset($viewper[0]->loancollaterallist)){if($viewper[0]->loancollaterallist>0){echo "checked"; }} ?>/></td> 
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>                             
                        </div>
                        <div class="col-sm-6 btn-toolbar pull-right "  >
                                    <input type="hidden"   class="form-control"  name="rowCount" id="rowCount" >   
                                    <input type="hidden" value=""  class="form-control"  name="tblRWcount" id="tblRWcount" >   
                                    <button type="reset" value="reset" name="reset" onclick="delrow();" class="btn btn-warning  pull-right "><i class="fa fa-eraser"></i> Reset</button>&nbsp;
                                    <button type="submit" value="save_new" name="save_new" class="btn btn-info  pull-right "><i class="fa fa-arrow-circle-up"></i> Save & new</button>&nbsp;
                                    <button type="submit" value="submit" name="submit" class="btn btn-success pull-right"><i class="fa fa-arrow-circle-up"></i> Save & Close</button>&nbsp;
                                </div>
                     </form>
                            </div>
                            </div>
                          </div>
                        <script>
                         
 function pwModel(){
    $('#changePwModel').modal('show');
}    

function savePwPopup(btnType) {
                    var username = document.getElementById("un").value;// this is txtSite textbox value. 
                    var prepassword1 = document.getElementById("prepassword1").value;// this is txtSite textbox value. 
                    var password1 = document.getElementById("password1").value;//  
                    var cpassword1 = document.getElementById("cpassword1").value;// . 
                    
                        $.ajax({
                            url: "<?php echo base_url("Setup_user_control/savePwPopup"); ?>",
                            type: 'POST',
                            data: {
                                "username": username,
                                "prepassword1": prepassword1,
                                "password1": password1,
                                "cpassword1": cpassword1,
                            },
                            success: function (data) {
                                if (data == 'notexist') {
                                    document.getElementById('lblsiteDetails').innerHTML = '<span class="errorMsg">Previous Password Not Mached!</span>';
                                    document.getElementById('lblsiteDetails').style.color = "Red";
                                    $(".errorMsg").fadeOut(3000);

                                }else if(data == 'notmach'){
                                    document.getElementById('lblsiteDetails').innerHTML = '<span class="errorMsg"> Password Not Mached!</span>';
                                    document.getElementById('lblsiteDetails').style.color = "Red";
                                    $(".errorMsg").fadeOut(3000);
                                }
                                else {
                                    if (data == 'TRUE') {
                                        document.getElementById('lblsiteDetails').innerHTML = '<span class="errorMsg">Password Updated Successfully!</span>';
                                        document.getElementById('lblsiteDetails').style.color = "Green";
                                        $(".errorMsg").fadeOut(7000);
                                        document.getElementById("pwModal_form").reset();
                                        if (btnType === 'save&Close') {
                                            setTimeout(function(){ $('#changePwModel').modal('hide'); }, 1000);
                                            
                                        }
                                        
                                        //                                    var a = document.getElementById("lblErr");
                                        //                                    a.innerHTML = "This Account Name Allready Exist";
                                    } else {

                                    }

                                }
                                return;
                            }
                        });
                    
                }
                
        function AllPermission(){
        var x = document.getElementsByTagName("input");
        for(i=0;i<x.length;i++){
            if(x[i].type=="checkbox"){
                if(x[i].checked==true){
                   x[i].checked=true;
                }else{
                    x[i].checked=true;
                }
            }
            }
        }
        function NoPermission(){
            
        var x = document.getElementsByTagName("input");
//        alert(x.length);

        for(i=0;i<x.length;i++){
            if(x[i].type=="checkbox"){
                if(x[i].checked==true){
                   x[i].checked=false;
                }else{
                    x[i].checked=false;
                }
            }
            }
        }
         function checkmtall(){ 
           if(document.getElementById("mtall").checked === true)
            { 
                checkmtall_checked();
            }
            else
            {
                 uncheckmtall();
            }
            
        }
         function checkmtall_checked()
        {   
            document.getElementById("mtadd").checked =true;
            document.getElementById("mtedit").checked =true;
            document.getElementById("mtdel").checked =true;
            document.getElementById("mtvw").checked =true; 
            checkmt_all_col();
            checkmt_add_col();
            checkmt_edit_col();
            checkmt_del_col();
            checkmt_vw_col();             
        }
        function uncheckmtall()
        {           
            document.getElementById("mtadd").checked  = false;
            document.getElementById("mtedit").checked =false;
            document.getElementById("mtdel").checked  =false;
            document.getElementById("mtvw").checked   =false; 
            uncheckmt_all_col();                
            uncheckmt_add_col();
            uncheckmt_edit_col();
            uncheckmt_del_col();
            uncheckmt_vw_col();
            
        }
        function checkmt_all_col()
        {
         for($i=0;$i<7;$i++)
         {
             document.getElementById("All"+$i).checked = true;
         }
        }
         function uncheckmt_all_col()
        {
           for($i=0;$i<7;$i++)
         {
             document.getElementById("All"+$i).checked = false;
         } 
        }
        
         function checkmt_add_col()
        {
         for($i=0;$i<7;$i++)
         {
             document.getElementById("Add"+$i).checked = true;
         }
        }
         function uncheckmt_add_col()
        {
           for($i=0;$i<7;$i++)
         {
             document.getElementById("Add"+$i).checked = false;
         } 
        }
        function checkmt_edit_col()
        {
         for($i=0;$i<7;$i++)
         {
             document.getElementById("Edit"+$i).checked = true;
         }
        }
        function uncheckmt_edit_col()
        {
           for($i=0;$i<7;$i++)
         {
             document.getElementById("Edit"+$i).checked = false;
         } 
        }
         function checkmt_del_col()
        {
         for($i=0;$i<7;$i++)
         {
             document.getElementById("Delete"+$i).checked = true;
         }
        }
         function uncheckmt_del_col()
        {
           for($i=0;$i<7;$i++)
         {
             document.getElementById("Delete"+$i).checked = false;
         } 
        }
         function checkmt_vw_col()
        {
         for($i=0;$i<7;$i++)
         {
             document.getElementById("View"+$i).checked = true;
         }
        }
         function uncheckmt_vw_col()
        {
           for($i=0;$i<7;$i++)
         {
             document.getElementById("View"+$i).checked = false;
         } 
        }
        function checkmtadd(){ 
           if(document.getElementById("mtadd").checked === true)
            {
                checkmt_add_col();
            }
            else
            {
                uncheckmt_add_col();
            } 
            checkmt_add();
        }
        function checkmtedit(){ 
           if(document.getElementById("mtedit").checked === true)
            {
                checkmt_edit_col();
            }
            else
            {
                uncheckmt_edit_col();
            } 
            checkmt_edit();
        }
        
        function checkmtdel(){ 
           if(document.getElementById("mtdel").checked === true)
            {
                checkmt_del_col();
            }
            else
            {
                uncheckmt_del_col();
            } 
            checkmt_del();
        }
        
        function checkmtvw(){ 
           if(document.getElementById("mtvw").checked === true)
            {
                 checkmt_vw_col();
            }
            else
            {
                uncheckmt_vw_col();
            } 
            checkmt_vw(); 
        }
        function checkmt_all(this_element)
        {
             
            var id = document.getElementById(this_element.id).value; 
            var len = id.length;
//          
                var no = id.substring(len-1, len);  
               
            
            if(document.getElementById("All"+no).checked === true)
                {
                   document.getElementById("Add"+no).checked = true;
                   document.getElementById("Edit"+no).checked = true;
                   document.getElementById("Delete"+no).checked = true;
                   document.getElementById("View"+no).checked = true; 
                }
                else
                {
                    document.getElementById("Add"+no).checked    = false;
                    document.getElementById("Edit"+no).checked   = false;
                    document.getElementById("Delete"+no).checked = false;
                    document.getElementById("View"+no).checked   = false; 
                    document.getElementById("all").checked  = false;
                    document.getElementById("add").checked  = false;
                    document.getElementById("edit").checked = false;
                    document.getElementById("del").checked  = false;
                    document.getElementById("vw").checked   = false; 
                } 
            
           
        }
</script>


                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-0 btn-toolbar"></div>
                        <div class="col-sm-6 btn-toolbar">


                        </div>
                    </div><!-- /.box-footer -->









                </div><!-- /.box-body -->
                <div class="apnel-footer">
                    <!--Footer-->
                </div><!-- /.box-footer-->
            </div><!-- /.box -->

    </section><!-- /.content -->
</div> <!-- /.content-wrapper -->
<!--======================model Change Password============================-->
        <form id="pwModal_form" class="form-horizontal">
            <div class="modal fade changePwModel " tabindex="-1" data-backdrop="static" data-keyboard="false"
                 id="changePwModel" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content center ">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Change Password</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="modSite" class="col-sm-3 control-label">Previous Password &nbsp;</label>
                                <div class="col-sm-8">
                                    <input type="password"  class="form-control" name="prepassword1" id="prepassword1"
                                           placeholder="Previous Password">
                                    <span id="errorMsg"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="telophone" class="col-sm-3 control-label">New Password &nbsp;

                                </label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password1" id="password1"
                                           placeholder="New Password">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="telophone" class="col-sm-3 control-label">Confirm Password &nbsp;

                                </label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="cpassword1" id="cpassword1"
                                           placeholder="Confirm Password">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="k" id="f" class="col-sm-3 control-label">&nbsp;</label>
                                <div class="col-sm-8 ">
                                    <label for="lblsiteDetails" id="lblsiteDetails" class="col-sm- control-label">
                                        &nbsp;</label>
                                </div>
                            </div>

                        </div>

                        <div class="flex-columns">
                            <div class=" modal-footer">
                                <!--<div class="navbar-header">-->
                                <div class="col-sm-11">
                                    <button type="button" id="btnSavesite" class="btn btn-success "
                                            onclick="savePwPopup('save&Close')"><i class="fa fa-arrow-circle-up"></i>
                                        Save & Close
                                    </button>
                                    <!--                                </div>-->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
