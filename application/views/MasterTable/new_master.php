<style>
    .bg-darkblue{
        background-color:#34495e !important;
        color:white;
    }

    .bg-neworange{
        background-color:#d35400 !important;
        color:white;
    }
    .bg-newgreen{
        background-color:#01b169 !important;
        color:white;
    }
    .bg-newpurple{
        background-color:#8e44ad !important;
        color:white;
    }
    .bg-newpink{
        background-color:#fa6374 !important;
        color:white;
    }
    .bg-newblue1{
        background-color:#6ab1b8 !important;
        color:white;
    }
    .bg-newgray{
        background-color:#5f5e61 !important;
        color:white;
    }

    .wht{

        color:white;
        -webkit-transition: opacity 1s ease-in-out;
        -moz-transition: opacity 1s ease-in-out;
        -ms-transition: opacity 1s ease-in-out;
        -o-transition: opacity 1s ease-in-out;
        transition: opacity 1s ease-in-out;
        border-radius:0px;
    }
    .wht:hover{
        color:white;
    }
    .wht:active{
        color:white;
        opacity:0.7;

    }
    .banner {
        /*background-image: url(<?php echo base_url()?>/assets/img/spectacular-gray-suede.jpg);*/
/*background-repeat: no-repeat;
background-position: center center;
background-attachment: fixed;
height: auto;
width: 100%;*/
}
 
</style>

<div class="content-wrapper">

    <section class="content-header banner2" >
        <h1>
            <i class="fa fa-bars"></i>
            Master Table

        </h1>
    </section>

    <section class="content banner" style="min-height:1076px;">


        <!-- NEW MASTER FILE -->
<br/><br/>
<div class="row">
        <div class="col-md-4">
            <!--small box-->
            <div class="small-box bg-green-active" >
                <div  class="inner">
                    <h3><i class="fa fa-building"></i></h3>
                    <p>My Company</p>
                </div>
                <div class="icon">
                    <i class="fa fa-building"></i>
                </div>
                <a href="<?php echo base_url('Mycompany_controll'); ?>" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="small-box bg-green-active">
              <div class="inner">
                <h3>
                    <i class="fa  fa-users fa-fw"></i> 
                </h3>
                <p>Borrowers</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-monitor-outline"></i>
              </div>
              <a href="<?php echo base_url('Borrower'); ?>" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-4">
            <div class="small-box bg-green-active">
              <div class="inner">
                <h3>
                    <i class="fa  fa-user fa-fw"></i> 
                </h3>
                <p>Loan Officer</p>
              </div>
              <div class="icon">
                <i class="fa fa-id-card"></i>
              </div>
              <a href="<?php echo base_url('marketingOfficer'); ?>" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
</div>
<div class="row">
          <div class="col-md-4">
            <div class="small-box bg-purple-gradient">
              <div class="inner">
                <h3>
                    <i class="fa  fa-map-marker fa-fw"></i> 
                </h3>
                <p>Area List</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-monitor-outline"></i>
              </div>
              <a href="<?php echo base_url('areaList'); ?>" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-4">
            <div class="small-box bg-purple-gradient">
              <div class="inner">
                <h3>
                    <i class="fa  fa-tags fa-fw"></i> 
                </h3>
                <p>Collateral Types</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-monitor-outline"></i>
              </div>
              <a href="<?php echo base_url('assetsList'); ?>" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-4">
            <div class="small-box bg-purple-gradient">
              <div class="inner">
                <h3>
                    <i class="fa  fa-home fa-fw"></i> 
                </h3>
                <p>Assets Detail</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-monitor-outline"></i> 
              </div>
              <a href="<?php echo base_url('assetsList/assest_detail'); ?>" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
</div>
<div class="row">
          <div class="col-md-4">
            <div class="small-box bg-maroon-gradient">
              <div class="inner">
                <h3>
                    <i class="fa  fa-tags fa-fw"></i> 
                </h3>
                <p>Loan Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-monitor-outline"></i>
              </div>
              <a href="<?php echo base_url('LoanProduct'); ?>" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-4">
            <div class="small-box bg-maroon-gradient">
              <div class="inner">
                <h3>
                    <i class="fa  fa-tags fa-fw"></i> 
                </h3>
                <p>Guarantors</p>
              </div>
              <div class="icon">
                <i class="fa  fa-user fa-fw"></i>
              </div>
              <a href="<?php echo base_url('Guarantor_con'); ?>" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-4">
            <div class="small-box bg-maroon-gradient">
              <div class="inner">
                <h3>
                    <i class="fa  fa-tags fa-fw"></i> 
                </h3>
                <p>Loan Collateral</p>
              </div>
              <div class="icon">
                <i class="glyphicon glyphicon-phone"></i>
              </div>
              <a href="<?php echo base_url('Collateral_con'); ?>" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
</div>
    </section>


</div>