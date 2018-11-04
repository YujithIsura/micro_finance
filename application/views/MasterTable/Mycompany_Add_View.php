<!-- /*
 * Developer : Thiwanka Sandaruwan.
 * Date : 2016-02-18  
 */ -->
<style type="text/css">
div#img{
width:200px;
height:200px
}
#imageupload{
width:150px;
height:150px
}
#deleteimg{
cursor:pointer;
float:right;
margin-top:-175px;
margin-right:10px
}
#preview{
height:100px;
width:100px;
text-align:center;
display:none
}

#previewimg{
height:143px;
width:150px;
float:left;
}
#message{
width:100%;
font-size:14px;
color:#123456;
float:left;
}
#message span{
color:red;
font-size:15px
}
#detail{
line-height:20px;
float:left;
width:270px;
font-size:14px
}

</style>
</style><!-- Content Wrapper. Contains page content -->


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa  fa-map-marker fa-fw"></i>
            My Company
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
                    <form class="form-horizontal" action="<?php echo base_url('Mycompany_controll/submitForm'); ?>" method="post" onsubmit="return checkEmptyFiel();" enctype="multipart/form-data">


                        <div class="modal-body">
                            <!-- Start=============================  -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#addressInfo">Basic Details</a></li>
                                <li><a data-toggle="tab" href="#additionalInfo">Statutory Details</a></li>

                            </ul>
                            <br>
                            <div class="box-body tab-content">
                                <div id="addressInfo" class="col-sm-12 tab-pane fade in active">
                                    <div class="col-sm-5">
                                        <div class="form-group-sm">
                                            <label for="company_md_txt" class="control-label">Company Name&nbsp;<span style="color:red;" >*</span></label>
                                            <input type="text" class="form-control" name="company_md_txt" id="company_md_txt" onblur="isCustomerExist()" placeholder="Company Name" onchange="setCompanyName()">
                                            <?php echo form_error('company_md_txt'); ?>                                            
                                        </div>

                                        <div class="form-group-sm">
                                            <label for="legal_md_txt" class="control-label">Legal Name &nbsp;  </label>                                            
                                            <input type="text"  class="form-control" name="legal_md_txt" id="legal_md_txt" placeholder="Legal Name">
                                            <?php echo form_error('legal_md_txt'); ?>                                           
                                        </div>

                                        <div class="form-group-sm">
                                            <label for="address_md_txt" class="control-label">Address&nbsp;</label>                                            
                                            <textarea id="address_md_txt" name="address_md_txt" class="form-control" placeholder="address"  ></textarea>
                                            <?php echo form_error('address'); ?>                                                                                    
                                        </div>

                                        <div class="form-group-sm">
                                            <label for="country_md_txt" class="control-label">Country&nbsp;</label>                                            
                                            <input type="text" class="form-control" name="country_md_txt" id="country_md_txt" placeholder="Country">
                                            <?php echo form_error('country_md_txt'); ?>                                          
                                        </div>

                                         <div class="form-group-sm">
                                            <label for="phone_md_txt" class="control-label">Phone&nbsp;</label>                                            
                                            <input type="text" class="form-control" name="phone_md_txt" id="phone_md_txt" placeholder="Phone">
                                            <?php echo form_error('phone_md_txt'); ?>                                          
                                        </div>

                                        <div class="form-group-sm">
                                            <label for="fax_md_txt" class="control-label">Fax&nbsp;</label>                                            
                                            <input type="text" class="form-control" name="fax_md_txt" id="fax_md_txt" placeholder="Fax">
                                            <?php echo form_error('fax_md_txt'); ?>                                          
                                        </div>

                                          <div class="form-group-sm">
                                            <label for="email_md_txt" class="control-label">Email&nbsp;</label>                                            
                                            <input type="text" class="form-control" name="email_md_txt" id="email_md_txt" placeholder="Email">
                                            <?php echo form_error('companyName_md_txt'); ?>                                          
                                        </div>                                        

                                    </div><!--Ene one solumn display-->

                                    <div class="col-sm-5 col-sm-offset-1">
                                      
                                        <div class="form-group-sm">
                                            <label for="web_md_txt" class="control-label">Web Site&nbsp;</label>                                            
                                            <input type="text" class="form-control" name="web_md_txt" id="web_md_txt" placeholder="Web Site">
                                            <?php echo form_error('web_md_txt'); ?>                                          
                                        </div> 

                                        <div class="form-group-sm">
                                            <label for="currency_md_txt" class="control-label">Currency &nbsp;</label>                                                                                           
                                                <select name="currency_md_txt"  id="currency_md_txt" class="form-control" onchange="addCurrency()">
                                                    <option></option> 
                                                    <option>Add New</option>  
                                                    <?php
                                                    foreach ($currency as $row) {
                                                        ?>

                                                        <option value="<?php echo $row->curanSymble; ?>"<?php if ('LKR' == $row->curanSymble){echo 'selected';}?>><?php echo $row->curanSymble; ?></option>                                            

                                                        <?php
                                                    }
                                                    ?> 
                                                </select>                                            
                                        </div>
                                            
                                                                           

                                        <div class="form-group-sm">
                                            <label for="financial_md_txt" class="control-label">Financial Year From&nbsp;</label>                                            
                                            <select name="financial_md_txt"  id="financial_md_txt" class="form-control">
                                                    <option value="January">January</option> 
                                                    <option value="February">February</option> 
                                                    <option value="March">March</option> 
                                                    <option value="April">April</option> 
                                                    <option value="May">May</option> 
                                                    <option value="June">June</option> 
                                                    <option value="July">July</option> 
                                                    <option value="August">August</option> 
                                                    <option value="September">September</option> 
                                                    <option value="Octomber">Octomber</option> 
                                                    <option value="November">November</option> 
                                                    <option value="December">December</option>  
                                                    
                                                </select>  

                                            <?php echo form_error('financial_md_txt'); ?>                                          
                                        </div>

                                        <div class="form-group-sm">
                                            <label for="logo" class="control-label">Company Logo&nbsp;</label> <br>                                                                 
                                               <div id="upload">
                                                  <input id="file" name="filename" type="file" accept="image/jpeg">
                                                  <input type="hidden" name="logo" id="logo"></input>
                                                </div>
                                                <div id="message">
                                                   
                                                </div>            
                                                                          
                                        </div>
                                      
                                        <div class="col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1" style="border:1px solid #E0E0E0;min-height: 145px;"> 
                                         <div id="clear"></div>
                                          <div id="preview" class="col-sm-offset-3 col-xs-offset-3">
                                            <img id="previewimg" src="">
                                          </div>

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
                                <div id="additionalInfo" class="tab-pane fade in">
                                    <div class="col-sm-12">
                                          <div class="col-sm-5">

                                             <div class="form-group-sm">
                                                <label for="tin_no" class="control-label">TIN No &nbsp;  </label>
                                                
                                                    <input type="text" class="form-control" style="text-align: right" name="tin_no" id="tin_no" placeholder="TIN No">
                                                    <?php echo form_error('code'); ?>
                                                
                                            </div>

                                            <div class="form-group-sm">
                                                <label for="vat_no" class="control-label">VAT No &nbsp;  </label>
                                                
                                                    <input type="text" class="form-control" style="text-align: right" name="vat_no" id="vat_no" placeholder="VAT No">
                                                    <?php echo form_error('code'); ?>
                                                
                                            </div>
                                     </div>       

                                    <div class="col-sm-5 col-sm-offset-1">

                                            <div class="form-group-sm">
                                                <label for="svat_no" class="control-label">SVAT No&nbsp;</label>
                                                
                                                    <input type="text" class="form-control" style="text-align: right" name="svat_no" id="svat_no" placeholder="SVAT No">
                                                    <?php echo form_error('sat_no'); ?>
                                                
                                            </div>

                                            <div class="form-group-sm">
                                                <label for="br_no" class="control-label">BR No &nbsp;</label>                                          
                                                    <input type="text" class="form-control" style="text-align: right" name="br_no" id="br_no" placeholder="BR No" onblur="convertDecimalPoint()">
                                                    <?php echo form_error('crid_lim'); ?>
                                               
                                            </div>

                                        </div>
                                    </div>
                                </div>
                           &nbsp;
                        <div class="box-footer ">
                            <div class="col-sm-11 btn-toolbar right">
                                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                
                                <button type="submit" value="sv_c" name="save_close" class="btn btn-success pull-right "><i class="fa fa-arrow-circle-up"></i> Save & Close</button>
                                
                            </div>
                        </div>

                            </div>

                        </div>
                       
                        <!--//==============================================================================================Models-->
                        
                        <!--======================model Currency============================-->
                        <div class="modal fade currencyModal " tabindex="-1"   data-backdrop="static" data-keyboard="false" id="currencyModal" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content center ">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Currency List</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="form-group-sm">
                                                <label for="curr_" class="control-label">Name &nbsp; <span style="color:red;" >*</span></label>
                                                
                                                    <input type="text" class="form-control" name="curr_name" id="curr_name" placeholder=" currency name">
                                                    <?php echo form_error('name'); ?>
                                                
                                            </div>


                                            <div class="form-group-sm">
                                                <label for="curr_Symbols" class="control-label">Symbols &nbsp; <span style="color:red;" >*</span></label>
                                                
                                                    <input type="text" class="form-control" maxlength="3" name="curr_symbols" id="curr_Symbols" placeholder=" symbols">
                                                    <?php echo form_error('curr_Symbols'); ?>
                                                
                                            </div>

                                            <div class="form-group-sm">
                                                <label for="curr_rate" class="control-label">Rate &nbsp; <span style="color:red;" >*</span></label>
                                                
                                                    <input type="number"   class="form-control" name="curr_rate" id="curr_rate" placeholder=" rate">
                                                    <?php echo form_error('rate'); ?>
                                               
                                            </div>




                                            <div class="form-group-sm">
                                                <label for="desc" class="control-label">
                                                    Description &nbsp;
                                                </label>
                                                
                                                    <textarea id="curr_description" name="curr_description" class="form-control" placeholder="description"  ></textarea>
                                                    <?php echo form_error('curr_description'); ?>
                                                    <label for="currDetails" id="currDetails" class="col-sm- control-label">&nbsp;</label>
                                               
                                            </div>
                                        </div>

                                        <div class="flex-columns" >
                                            <div class=" modal-footer">
                                                <!--<div class="navbar-header">-->
                                                <div class="col-sm-11">
                                                    <button type="button"  id="btnSaveClass" name="btnSaveClass" class="btn btn-info oredrBy "  onclick="saveAddCurrencyPopup()" ><i class="fa fa-arrow-circle-up"></i> Save & New</button>
                                                    <button type="button"  id="btnSaveClass" class="btn btn-success " data-dismiss="modal"  onclick="saveAddCurrencyPopup()"><i class="fa fa-arrow-circle-up"></i> Save & Close</button>
                                                    <!--                                </div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--//==============================================================================================Models-->
                    </form>
    
    <!-- load bootstrap css file -->


                   <script type="text/javascript">
                        $(document).ready(function() {
                                // Function for Preview Image.
                            $(function() {
                            $(":file").change(function() {
                            if (this.files && this.files[0]) {
                            var reader = new FileReader();
                            reader.onload = imageIsLoaded;
                            reader.readAsDataURL(this.files[0]);
                            var logo = document.getElementById("file").value;
                            document.getElementById("logo").value=logo; 
                            document.getElementById("clear").innerHTML='';                            
                            
                            
                            }
                            });
                            });
                            function imageIsLoaded(e) {
                            //$('#message').css("display", "none");
                            $('#preview').css("display", "block");
                            $('#previewimg').attr('src', e.target.result);
                            var name=document.getElementById("file").value;
                            var ext= name.split('.').pop();
                            if(ext=="jpg" || ext=="jpeg"){
                            $('#message').css("display", "none");                                                
                             }
                            else{
                             document.getElementById("message").innerHTML="<span class='text-danger'>Invalid Image Format</span>";
                             }                             
                            };
                            // Function for Deleting Preview Image.
                            $("#deleteimg").click(function() {
                            $('#preview').css("display", "none");
                            $('#file').val("");
                            });
                            // Function for Displaying Details of Uploaded Image.
                            $("#submit").click(function() {
                            $('#preview').css("display", "none");
                            $('#message').css("display", "block");
                            });
                            });



                        $(document).ready(function () {
                            $("input, textarea, select").click(
                                    function () {
                                        //                                alert("hi");
                                        //                               alert ($(this).siblings('.validation_errors').html());
                                        $(this).siblings('.validation_errors').remove('');
                                        $(this).parent().siblings('.validation_errors').remove('');
                                    }
                            );
                        });
                        var status = '';// this status variable use to checkEmptyFielss function when submit button click
                        function isCustomerExist() {

                            var customer = document.getElementById("company_md_txt").value;
//                            alert(customer);
                            if (customer != '') {
                                $.ajax({
                                    url: "<?php echo base_url("Mycompany_controll/isCustomerExist"); ?>",
                                    type: 'POST',
                                    data: {
                                        "customer": customer,
                                    },
                                    success: function (data) {
                                        if (data == 'exist') {
                                            alert('customer already Exist Plsase Enter Another Name');
                                            status = 'exist';
                                        } else {

                                        }
                                        return;
                                    }
                                });
                            }
//                            alert('please Enter Customer');
                        }
                        function setCompanyName(){
                        var company = document.getElementById("company_md_txt").value;
                        document.getElementById("legal_md_txt").value=company;
                        }

                        
                        function addCurrency() {
                            if ($("#currency_md_txt :selected").text() == 'Add New') {
                                document.getElementById('currDetails').innerHTML = '';
                                $('#currencyModal').modal('show');
                            }
                        }
                        function saveAddCurrencyPopup() {
                            var curr_name = document.getElementById("curr_name").value;
                            var curr_symbols = document.getElementById("curr_Symbols").value;
                            var curr_rate = document.getElementById("curr_rate").value;
                            var curr_description = document.getElementById("curr_description").value;
                            if (curr_name !== '') {
                                if (curr_symbols !== '') {
                                    if (curr_rate !=='') {
                                        
                                    $.ajax({
                                        url: "<?php echo base_url("Mycompany_controll/saveAddCurrencyPopup"); ?>",
                                        type: 'POST',
                                        data: {
                                            "curr_name": curr_name,
                                            "curr_symbols": curr_symbols,
                                            "curr_rate": curr_rate,
                                            "curr_description": curr_description,
                                        },
                                        success: function (data) {
                                            //                                alert(data);
                                            if (data == 'TRUE') {
                                                document.getElementById('currDetails').innerHTML = 'Data has been submitted!';
                                                document.getElementById('currDetails').style.color = "Lime";
                                                //                                    document.getElementById('termsDetails').innerHtml = 'Successfully Insert.';
                                                var mySelect = document.getElementById('currency_md_txt'),
                                                        newOption = document.createElement('option');

                                                if (typeof newOption.innerText === 'undefined')
                                                {
                                                    newOption.textContent = curr_name;
                                                } else
                                                {
                                                    newOption.innerText = curr_name;
                                                }
                                                mySelect.appendChild(newOption);
                                                document.getElementById("curr_name").value = '';
                                                document.getElementById("curr_Symbols").value = '';
                                                document.getElementById("curr_rate").value = '';
                                                document.getElementById("curr_description").value = '';
                                                document.getElementById("currency_md_txt").value = curr_name;

                                                //                                    var a = document.getElementById("lblErr");
                                                //                                    a.innerHTML = "This Account Name Allready Exist";
                                            } else {

                                            }
                                            return;
                                        }
                                    });

                                    } else {
                                    document.getElementById('currDetails').innerHTML = 'Please Enter Rate.';
                                    document.getElementById('currDetails').style.color = "Red";

                                    }

                                } else {
                                    document.getElementById('currDetails').innerHTML = 'Please Enter Symbol.';
                                    document.getElementById('currDetails').style.color = "Red";

                                }

                            } else {
                                //                        alert('name Requird...');
                                document.getElementById('currDetails').innerHTML = 'Please Enter Currency Name.';
                                document.getElementById('currDetails').style.color = "Red";
                            }
                        }
                        
                      
                      
                    </script>           

                </div><!-- /.box-body -->
                <div class="apnel-footer">
                    <!--Footer-->
                </div><!-- /.box-footer-->
            </div><!-- /.box -->

    </section><!-- /.content -->
</div> <!-- /.content-wrapper -->


