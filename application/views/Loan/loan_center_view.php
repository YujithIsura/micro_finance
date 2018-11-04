<style>
    .nav-tabs > li > a{
        background-color: #25a1aa;
        color: white;
    }
</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    View All Loans
    <small>it all manages here</small>
  </h1>
<!--      <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Examples</a></li>
    <li class="active">Blank page</li>
  </ol>-->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
<!--      <h3 class="box-title">Loan Details</h3>-->

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>

      </div>
      <div class="form-group-sm" style="margin-left: 185px;width: 58%;">
          <div class="row">
             <div class="col-sm-2">
                 <img id="img"  name="img" src="<?php echo $loan[0]->borrower_photo; ?>"  style="width:66%;height:auto;margin-left: -174px;" />
        </div>                                  
             <div class="col-sm-4">
                 <span class="borrower_name" style="font-size: 16px;margin-left: -225px;" ><?php echo $loan[0]->name ?></span></br>
                 <span class="contact_no" style="font-size: 16px;margin-left: -225px;" ><?php echo $loan[0]->contact_no ?></span>
        </div>                                  
           </div> 
          </div>
    </div>
    <div class="box-body well">
        <div class="col-md-12" hidden="" style="background-color: aliceblue;width: 100%">
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="loan_serial">Loan Serial </label>
                                    <input class="form-control" readonly="" value="<?php echo $loan[0]->serialNo?>" required id="loan_serial" name="loan_serial" placeholder="" type="text" >
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="loan_type_name">Loan Product </label>
                                    <input class="form-control" readonly="" value="<?php echo $loan[0]->loan_product_name?>" required id="loan_type_name" name="loan_type_name" placeholder="" type="text">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="mName">Released Date</label>
                                    <input class="form-control" readonly="" value="<?php echo $loan[0]->release_date?>" id="release_date" name="release_date" placeholder="" type="text" >
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="borrower_name">Borrower Name </label>
                                    <input class="form-control" readonly="" value="<?php echo $loan[0]->name?>"  required id="fName" name="borrower_name" placeholder="" type="text"  >
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="principal_amount">Principle Amount</label>
                                    <input class="form-control" readonly="" value="<?php echo $loan[0]->principle_ammount?>"  id="principal_amount" name="principal_amount" placeholder="" type="text" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="status">Status</label>
                                    <input class="form-control"  id="status" name="status" placeholder="" type="text"  required>
                                    <input class="form-control" value="<?php echo $loan[0]->no_of_repayment?>"  id="no_of_repayment" name="no_of_repayment" placeholder="" type="hidden"  required>
                                    <input class="form-control" value="<?php echo $loan[0]->repayment_cycle?>"  id="repayment_cycle" name="repayment_cycle" placeholder="" type="hidden"  required>
                                    <input class="form-control" value="<?php echo $loan[0]->principle_ammount?>"  id="principal_amount" name="principal_amount" placeholder="" type="hidden"  required>
                                    <input class="form-control" value="<?php echo $loan[0]->interest_period?>"  id="interest_period" name="interest_period" placeholder="" type="hidden"  required>
                                    <input class="form-control" value="<?php echo $loan[0]->loan_interest?>"  id="loan_interest" name="loan_interest" placeholder="" type="hidden"  required>
                                </div>
                            </div>
                        </div>
      <div class="col-md-12" style="background-color: aliceblue;width: 100%">
                            <div class="row">
                                <div class="box box-success">
                    <div class="box-body table-responsive no-padding">
                        <table id="loan_detail" class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr style="background-color: #F2F8FF">
                                    <th>
                                      <b>Loan Serial</b>
                                    </th>
                                    <th>
                                        <b>Loan Product</b>
                                    </th>
                                    <th>
                                        <b>Released Date</b>
                                    </th>
                                    <th style="text-align:right;">
                                        <b>Principle Amount</b>
                                    </th>
                                    <th style="text-align:right;">
                                        <b>Status</b>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <td><?php echo $loan[0]->serialNo?></td>
                            <td><?php echo $loan[0]->loan_product_name?></td>
                            <td><?php echo $loan[0]->release_date?></td>
                            <td><?php echo number_format($loan[0]->principle_ammount)?></td>
                            <td></td>
                            </tbody>
                        </table>          
                        </div>            
                       </div>
                            </div>
                        </div>
        <ul class="nav nav-tabs" style="width: 100%;background-color: #e3e7ea;">
                                <li style="width: 10%;" class="active"><a data-toggle="tab" href="#home">Repayments</a></li>
                                <li style="width: 10%;"><a data-toggle="tab" href="#menu1">Loan Terms</a></li>
                                <li onclick="daysInMonth();" style="width: 11%;"><a data-toggle="tab" href="#menu2">Loan Schedule</a></li>
                                <li style="width: 11%;"><a data-toggle="tab" href="#menu3">Pending Dues</a></li>
                                <li style="width: 12%;"><a data-toggle="tab" href="#menu4">Loan Collateral</a></li>
                                <li style="width: 12%;"><a data-toggle="tab" href="#menu5">Loan Guarantor</a></li>
                                <li style="width: 9%;"><a data-toggle="tab" href="#menu6">Loan Files</a></li>
                                <li style="width: 12%;"><a data-toggle="tab" href="#menu7">Loan Comments</a></li> 
                            </ul>
    </div>
      <div class="tab-content">
      <div id="home" class="tab-pane active">
          <div>
              <a style="margin-left: 12px;" type="button" class="btn bg-blue-gradient" href="<?php echo base_url('Loan/Loan_center_con/addRepayment/'.$loan[0]->loan_id);?>">Add Repayment</a>
              </div></br>
          <div class="box box-success">
                    <div class="box-body table-responsive no-padding">
                        <table id="loan_repayment" class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr style="background-color: #F2F8FF">
                                    <th style="width: 10px">
                                      <b>#</b>
                                    </th>
                                    <th>
                                        <b>Collection Date</b>
                                    </th>
                                    <th>
                                        <b>Collected By</b>
                                    </th>
                                    <th style="text-align:right;">
                                        <b>Disbursed By</b>
                                    </th>
                                    <th style="text-align:right;">
                                        <b>Ammount</b>
                                    </th>
                                    <th style="text-align:right;">
                                        <b>Action</b>
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
                                </tr>
                            </thead>
                            <tbody id="repayment">
                                
                            </tbody>
                        </table>          
                        </div>            
                       </div>            

      </div>
      <div id="menu2" class="tab-pane fade">
          <div class="box box-success">
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
                        </table>          
                        </div>            
                       </div>            

      </div>
      
    <!-- /.box-body -->
    
    <!-- /.box-footer-->
  <div id="menu4" class="tab-pane fade">
          <div class="box box-success">
                    <div class="box-body table-responsive no-padding">
                        <div class="btn-group-horizontal">
                            <a class="btn bg-blue-gradient margin" type="button" href="<?php echo base_url()?>Collateral_con/index2/<?php echo $loan[0]->loan_id ?>">Add Collateral</a>
                        </div>
                        </div>            
                       </div> 
                       <?php 
                       $totVal=0;
                       $prinsipal = $loan[0]->principle_ammount;
                       foreach ($loanCollateral as $loan){
                           $totVal+=$loan->value;
                       }
                       ?>
      
      <div class="box-body"><p>Total Collateral Value: <b> &#8360;<?php echo number_format($totVal,2)?></b><br>Total Loan to Value (LTV) Ratio: <b><?php $res = ($totVal/$prinsipal)*100; echo $res?>%</b>
                        <?php $i=0; foreach($loanCollateral as $loan){?>
                        <!--<hr class="hrcolor">-->
                        <div class="row margin-bottom">
                            <!-- /.col -->
                            <form id="form_collateral<?php echo $i?>" action="<?php echo base_url('Collateral_con/updateView'); ?>"   method="post">
                                <input type="hidden" id="loan_collateral_id" name="loan_collateral_id" value="<?php echo $loan->id;?>">
                                <input type="hidden" id="fromLoanCenter" name="fromLoanCenter" value="1">
                            <div class="col-sm-12">
                              <h3 class="no-margin text-bold text-green"><?php echo $loan->product_name;?></h3>
                              <div class="row">
                                <div class="col-sm-4">
                                  <b>Current Status:</b> <span class="pull-right"><?php echo $loan->current_status;?></span><br>
                                  <b>Value:</b> <span class="pull-right">&#8360;<?php echo number_format($loan->value,2);?></span>
                                    <br><b>Condition:</b> <span class="pull-right"><?php echo $loan->condition;?></span><br>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                  <b>Type:</b> <span class="pull-right"><?php echo $loan->assetName;?></span>
                                  <br><b>Model Name:</b> <span class="pull-right"><?php echo $loan->model_name;?></span>.
                                  <br><b>Serial Number:</b> <span class="pull-right"><?php echo $loan->serial_no;?></span>
                                  <br><b>Colour:</b> <span class="pull-right"><?php echo $loan->colour;?></span>
                                  
                                  
                                  
                                  
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                  <b>Register Date:</b> <span class="pull-right"><?php echo $loan->register_date;?></span>
                                  
                                  
                                </div>
                                <!-- /.col -->
                              </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="text-bold text-red">History:</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                        <tr>
                                            <td><?php echo $loan->current_status;?></td>
                                            <td><?php echo $loan->current_status_date;?></td>
                                        </tr>
                                    </table>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12 margin-top" style="text-align:center">
            <div class="btn-group-horizontal">
                <button type="submit" name="collateral_update" value="collateral_update" style="color: blueviolet;" id="collateral_update" class="btn bg-white btn-xs text-bold" >Edit</button><button type="submit" name="collateral_delete" value="collateral_delete" style="color: red;" id="collateral_delete" class="btn bg-white btn-xs text-bold" >Delete</button>
            </div>
                                
                                </div>
                              </div>
                              <!-- /.row -->
                            </div>
                            <!-- /.col -->
                             </form>
                          </div>
                        <hr class="hrcolor">
                        <?php $i++; }?>
                       </div>
         
                    </div>        
              </div>
                            

  <!-- /.box -->

</section>
<!-- /.content -->
</div>
<script>
//window.onload = function(){
//$('.sidebar-toggle').trigger('click');
//}
 $(document).ready(function () {
     $('.sidebar-toggle').trigger('click');
 });

function daysInMonth() {
        var release_date = $('#release_date').val();
        var no_of_repayment = $('#no_of_repayment').val();
        var repayment_cycle = $('#repayment_cycle').val();
        var principal_amount = $('#principal_amount').val();
        var interest_period = $('#interest_period').val();
        var loan_interest = $('#loan_interest').val();
        var interest = 0;
        var due = 0;
        var pending_due = 0;
        var principal_bal = 0;
        var principal_due = 0;
        var  last_bal = 0;
        var  pri = 0;
        var  pri_bal = 0;
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
          
        $('#shedule').html(str);
        } 

    }
</script>

<!-- /.content-wrapper -->
