<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-bars"></i>
            Loan Application Approval
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
<!--<i class="fa  fa-map-marker fa-fw"></i> Area List-->
                    <br>
                </h5>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>

            <div class="box-body well">

                <div class="box box-primary col-sm-12 animated zoomIn">
                    <!--                    <div class="box-header with-border">
                                            <h3 class="box-title"><i class="fa fa-table fa-fw"></i>Table</h3>
                                        </div> /.box-header -->

                    <br>
                    <div class="panel panel-body ">
                        <form class="form-horizontal " action="<?php echo base_url('Loan/Loan_con/submitApproveLoan'); ?>" method="post" >
                            <!--</form>-->                   
                            <div class="col-sm-12 table-responsive">                            
                                <table id="my_data_table" name="my_data_table" class="table table-bordered table-striped table-hover  ">

                                    <thead style="background-color: white;">
                                        <tr>
                                            <th style="text-align: center">Loan Serial</th>
                                            <th style="text-align: center">Borrower</th>
                                            <th style="text-align:center ">Release Date</th>
                                            <th style="text-align: center">Principal Amount</th>
                                            <th style="text-align: center">Loan Product</th>
                                            <th style="text-align: center">Approval  &nbsp;&nbsp; <input hidden="" id="allcheckok" name="allcheckok" onclick="AllCheck();" type="checkbox" ></th>
                                            <th hidden="" style="text-align: center">Serial_NO </th>
                                            <th  style="text-align: center">View </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($loadLoans)) {
                                            $rowID = 0;
//                                            $count = 0;
                                            foreach ($loadLoans as $list) {
                                                ?>
                                                <tr>
                                                    <td style="text-align: center"> <?php echo $list->serialNo; ?></td>
                                                    <td style="text-align: center"> <?php echo $list->name; ?></td>
                                                    <td style="text-align: left"> <?php echo $list->release_date; ?></td>
                                                    <td style="text-align: right"> <?php echo number_format($list->principle_ammount,2); ?></td>
                                                    <td style="text-align: left"> <?php echo $list->loan_product_name; ?></td>
                                                    <td onclick="setSchedule2(<?php echo $list->loan_id; ?>);" style="text-align: center"><input value="<?php echo $rowID ?>" id="checkbox<?php echo $rowID ?>" name="checkbox<?php echo $rowID ?>" type="checkbox">&nbsp;&nbsp;</td>
                                                    <td hidden=""><input type="hidden" name="serial<?php echo $rowID ?>" value="<?php echo $list->loan_id; ?>" id="serial<?php echo $rowID ?>"> </td>
                                                    <td style="text-align: center"><a href="<?php echo base_url();?>Loan/Loan_con/updateView/<?php echo $list->loan_id;?>"  target="_blank"><button type="button" id="application<?php echo $rowID ?>" class="btn btn-flat btn-info">Application</button></a><button type="button" onclick="setSchedule(<?php echo $list->loan_id; ?>);" id="schedule<?php echo $rowID ?>" class="btn btn-flat btn-success">Schedule</button></td>
                                                </tr>
                                                <?php
                                                $rowID++;
//                                                $count++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <button type="submit" value="app" name="submit" style="margin-left: 5px;" class="btn btn-success pull-right "><i class="fa fa-arrow-circle-up"></i> Approve</button>
                                <button type="submit" value="rej" name="submit" style="width: 88px;" class="btn btn-danger pull-right "><i class="fa fa-arrow-circle-up"></i> Reject</button>
                            </div>
                            <input type="hidden" value="<?php echo count($loadLoans);?>" id="table_size" name="table_size" >
                            <div class="modal fade" id="myModal" >
                              <div class="modal-dialog" style="width: 1000px;">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Loan Schedule</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="box-body table-responsive no-padding">
                                            <table id="loan_shedule" class="table table-bordered table-condensed table-hover">
                                                <thead>
                                                    <tr style="background-color: #F2F8FF">
                                                        <th style="width: 10px">
                                                          <b>#</b>
                                                        </th>
                                                        <th>
                                                            <b>Date</b>
                                                        </th>
                                                        <th>
                                                            <b>Description</b>
                                                        </th>
                                                        <th style="text-align:right;">
                                                            <b>Principal</b>
                                                        </th>
                                                        <th style="text-align:right;">
                                                            <b>Interest</b>
                                                        </th>
                                                        <th style="text-align:right;">
                                                            <b>Fees</b>
                                                        </th>
                                                        <th style="text-align:right;">
                                                            <b>Penalty</b>
                                                        </th>
                                                        <th style="text-align:right;">
                                                            <b>Due</b>
                                                        </th>
                                                        <th style="text-align:right;">
                                                            Paid
                                                        </th>
                                                        <th style="text-align:right;">
                                                            Pending Due
                                                        </th>
                                                        <th style="text-align:right;">
                                                            Total Due
                                                        </th>
                                                        <th style="text-align:right;">
                                                            Principal Balance
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="shedule">

                                                </tbody>
                                                <input type="hidden" name="sheduleCount" id="sheduleCount">
                                            </table>          
                                            </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-primary hide">Save changes</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                             <input type="hidden" id="release_date" name="release_date">
                            <input type="hidden" id="no_of_repayment" name="no_of_repayment">
                            <input type="hidden" id="repayment_cycle" name="repayment_cycle">
                            <input type="hidden" id="principal_amount" name="principal_amount">
                            <input type="hidden" id="interest_period" name="interest_period">
                            <input type="hidden" id="loan_interest" name="loan_interest">
                        </form>  
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
//                        var tableSize = $('#my_data_table tbody tr').length;
//                        document.getElementById('table_size').value = tableSize;
//                           alert(tableSize);
                    });

                    function set_Approval() {
                    }

                    function load_this_area(this_element) {
//                    var id_areaList = $(this_element).closest('tr').find("td:first").html();
                        var id_areaList = $(this_element).closest('tr').find(':nth-child(1)').html();
                        var name = $(this_element).closest('tr').find(':nth-child(2)').html();
                        var description = $(this_element).closest('tr').find(':nth-child(3)').html();
                        var status = $(this_element).closest('tr').find(':nth-child(4)').html();
//                    alert (id_areaList +' - '+ name+' - '+description +' - '+status );

                        $('#id_areaList').val(id_areaList);
                        $('#name').val(name);
                        $('#description').val(description);
                    }
					
						function AllCheck(){
						  var tableSize = $('#my_data_table tbody tr').length;
						  if(document.getElementById("allcheckok").checked==true){
							   for(i=0;i<tableSize;i++){
							  document.getElementById("checkbox"+i).checked=true;
						  }
						
						  }else{
							   for(i=0;i<tableSize;i++){
							  document.getElementById("checkbox"+i).checked=false;
						  }
						
							  
						  }
						 
					}
                                        
                                        
                       function setSchedule(loan_id){
                         var loan_id = loan_id;
                         var loan_serial=''; 
                         var release_date='';
                         var no_of_repayment='';
                         var repayment_cycle='';
                         var principal_amount='';
                         var interest_period='';
                         var loan_interest='';
                         var interest = 0;
                         var due = 0;
                         var pending_due = 0;
                         var principal_bal = 0;
                         var principal_due = 0;
                         var  last_bal = 0;
                         var  pri = 0;
                         var  pri_bal = 0;
                         var rowCount = $('#my_data_table tr').length;
                         for(var i=0;i<rowCount-1;i++){
                         if($('#checkbox'+i).is(':checked')){
                            $.ajax({
                               url:'<?php echo base_url("Loan/Loan_con/getLoanData");?>',
                               type:'POST',
                               data:{
                                   loan_id:loan_id
                               },
                               success: function(data){
                                  var json_value = JSON.parse(data);
                                  for (var j = 0; j < json_value.length; j++) {
                                    loan_serial = json_value[j]['serialNo'];
                                    release_date = json_value[j]['release_date'];
                                    no_of_repayment = json_value[j]['no_of_repayment'];
                                    repayment_cycle = json_value[j]['repayment_cycle'];
                                    principal_amount = json_value[j]['principle_ammount'];
                                    interest_period = json_value[j]['interest_period'];
                                    loan_interest = json_value[j]['loan_interest'];
                                 }
                                 $('#release_date').val(release_date);
                                 $('#no_of_repayment').val(no_of_repayment);
                                  $('#repayment_cycle').val(repayment_cycle);
                                  $('#principal_amount').val(principal_amount);
                                  $('#interest_period').val(interest_period);
                                  $('#loan_interest').val(loan_interest);
                                   var principal =  accounting.toFixed(principal_amount/no_of_repayment, 2, ",");
                               if(interest_period == 'Year'){
                                  interest = accounting.toFixed((principal_amount/100*loan_interest)/no_of_repayment, 2, ",");
                               }
                               due = accounting.toFixed(Number(interest)+Number(principal), 2, ",");
                                last_bal = principal_amount-(Number(principal)*no_of_repayment);
                        //       console.log(no_of_repayment);
                                if(repayment_cycle == 'Monthly'){
                                    var str = "<tr><td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td>"+accounting.toFixed(principal_amount, 2, ",")+"</td></tr>";
                                    for(var i=1;i<Number(no_of_repayment)+1;i++){
                                    var tomorrow = moment(release_date).add(i-1, 'months');
                                   var dateOnly = moment(tomorrow).format('YYYY-MM-DD');
                                   pending_due+=Number(due);
                                   principal_due+=Number(principal);
                                  if(i==no_of_repayment){ pri = Number(principal)+Number(last_bal)}else{ pri = principal}
                                  if(i==no_of_repayment){ pri_bal = Number(pri_bal)-Number(pri)}else{ pri_bal = Number(principal_amount)-Number(principal_due)}
                                   principal_bal=Number(principal_amount)-Number(principal_due);

                                    str +=  "<tr><td>"+i+"</td>"+
                                            "<td>"+dateOnly+"</td>"+
                                            "<td>Repayment</td>"+
                                            "<td>"+accounting.toFixed(pri, 2, ",")+"</td>"+
                                            "<td>"+interest+"</td>"+
                                            "<td>0</td>"+
                                            "<td>0</td>"+
                                            "<td>"+due+"</td>"+
                                            "<td></td>"+
                                            "<td>"+accounting.toFixed(pending_due, 2, ",")+"</td>"+
                                            "<td>"+accounting.toFixed(pending_due, 2, ",")+"</td>"+
                                            "<td>"+accounting.toFixed(pri_bal, 2, ",")+"</td></tr>";
                                }
                                $('#sheduleCount').val(i);
                                $('#shedule').html(str);
                                
                                $('#myModal').modal('show');
                                }
                               }
                               
                            });
                         }
                         }
                         }
                         
                       function setSchedule2(loan_id){
                         var loan_id = loan_id;
                         var loan_serial=''; 
                         var release_date='';
                         var no_of_repayment='';
                         var repayment_cycle='';
                         var principal_amount='';
                         var interest_period='';
                         var loan_interest='';
                         var interest = 0;
                         var due = 0;
                         var pending_due = 0;
                         var principal_bal = 0;
                         var principal_due = 0;
                         var  last_bal = 0;
                         var  pri = 0;
                         var  pri_bal = 0;
                         var rowCount = $('#my_data_table tr').length;
                         for(var i=0;i<rowCount-1;i++){
                         if($('#checkbox'+i).is(':checked')){
                            $.ajax({
                               url:'<?php echo base_url("Loan/Loan_con/getLoanData");?>',
                               type:'POST',
                               data:{
                                   loan_id:loan_id
                               },
                               success: function(data){
                                  var json_value = JSON.parse(data);
                                  for (var j = 0; j < json_value.length; j++) {
                                   loan_serial = json_value[j]['serialNo'];
                                    release_date = json_value[j]['release_date'];
                                    no_of_repayment = json_value[j]['no_of_repayment'];
                                    repayment_cycle = json_value[j]['repayment_cycle'];
                                    principal_amount = json_value[j]['principle_ammount'];
                                    interest_period = json_value[j]['interest_period'];
                                    loan_interest = json_value[j]['loan_interest'];
                                 }
                                  $('#release_date').val(release_date);
                                  $('#no_of_repayment').val(no_of_repayment);
                                  $('#repayment_cycle').val(repayment_cycle);
                                  $('#principal_amount').val(principal_amount);
                                  $('#interest_period').val(interest_period);
                                  $('#loan_interest').val(loan_interest);
                                   var principal =  accounting.toFixed(principal_amount/no_of_repayment, 2, ",");
                               if(interest_period == 'Year'){
                                  interest = accounting.toFixed((principal_amount/100*loan_interest)/no_of_repayment, 2, ",");
                               }
                               due = accounting.toFixed(Number(interest)+Number(principal), 2, ",");
                                last_bal = principal_amount-(Number(principal)*no_of_repayment);
                        //       console.log(no_of_repayment);
                                if(repayment_cycle == 'Monthly'){
                                    var str = "<tr><td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td></td>"+
                                            "<td>"+accounting.toFixed(principal_amount, 2, ",")+"</td></tr>";
                                    for(var i=1;i<Number(no_of_repayment)+1;i++){
                                    var tomorrow = moment(release_date).add(i-1, 'months');
                                   var dateOnly = moment(tomorrow).format('YYYY-MM-DD');
                                   pending_due+=Number(due);
                                   principal_due+=Number(principal);
                                  if(i==no_of_repayment){ pri = Number(principal)+Number(last_bal)}else{ pri = principal}
                                  if(i==no_of_repayment){ pri_bal = Number(pri_bal)-Number(pri)}else{ pri_bal = Number(principal_amount)-Number(principal_due)}
                                   principal_bal=Number(principal_amount)-Number(principal_due);

                                    str +=  "<tr><td>"+i+"</td>"+
                                            "<td>"+dateOnly+"</td>"+
                                            "<td>Repayment</td>"+
                                            "<td>"+accounting.toFixed(pri, 2, ",")+"</td>"+
                                            "<td>"+interest+"</td>"+
                                            "<td>0</td>"+
                                            "<td>0</td>"+
                                            "<td>"+due+"</td>"+
                                            "<td></td>"+
                                            "<td>"+accounting.toFixed(pending_due, 2, ",")+"</td>"+
                                            "<td>"+accounting.toFixed(pending_due, 2, ",")+"</td>"+
                                            "<td>"+accounting.toFixed(pri_bal, 2, ",")+"</td></tr>";
                                }
                                $('#sheduleCount').val(i);
                                $('#shedule').html(str);
                                
                               
                                }
                               }
                               
                            });
                         }
                         }
                         }
                         
                          $('input[type=checkbox]').change(function(){
                            if($(this).is(':checked')){
                        $('input[type=checkbox]').attr('disabled',true);
                            $(this).attr('disabled',false);
                            var value = $(this).val();
                            var rowCount = $('#my_data_table tr').length;
                            for(var i=0;i<rowCount-1;i++){
                                if(i==value){
                            $("#schedule"+value).prop("disabled",false);
                            $("#application"+value).prop("disabled",false);
                                }else{
                                 $("#schedule"+i).prop("disabled",true);   
                                 $("#application"+i).prop("disabled",true);   
                                }
                            }
                        }
                        else{
                        $('input[type=checkbox]').attr('disabled',false);
                        var rowCount = $('#my_data_table tr').length;
                        $("#schedule"+value).prop("disabled",true);
                         for(var i=0;i<rowCount-1;i++){
                               
                            $("#schedule"+i).prop("disabled",false);
                            $("#application"+i).prop("disabled",false);
                                
                            }
                        }
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