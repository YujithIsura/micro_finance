<!DOCTYPE html><html class=''>
<head>

    <style>

        html,
body {
  min-height: 100%;
  font-family: Oxygen;
  font-weight: 300;
  font-size: 1em;
  color: #fff;
}
body {
  background: #0d1a00;
  background-image: -webkit-radial-gradient(top, circle cover, #73e600, #0d1a00 80%);
  background-image: -moz-radial-gradient(top, circle cover, #79ff4d, #0d1a00 80%); /*backgroud clour #69caff*/ 
  background-image: -o-radial-gradient(top, circle cover, #39e600, #0d1a00 80%);
  background-image: radial-gradient(top, circle cover, #39e600, #0d1a00 80%);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
/*body {
  background: #2e3441;
  background-image: -webkit-radial-gradient(top, circle cover, #4e7a89, #2e3441 80%);
  background-image: -moz-radial-gradient(top, circle cover, #69caff, #2e3441 80%); backgroud clour #69caff 
  background-image: -o-radial-gradient(top, circle cover, #4e7a89, #2e3441 80%);
  background-image: radial-gradient(top, circle cover, #4e7a89, #2e3441 80%);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}*/
.signin {
  display: block;
  position: relative;
  width: 250px;
  margin: 25% auto;
  padding: 20px;
  background-color: rgba(0,0,0,0.1);
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-box-shadow: inset 1px 1px 0 0 rgba(255,255,255,0.2), inset -1px -1px 0 0 rgba(0,0,0,0.2);
  -moz-box-shadow: inset 1px 1px 0 0 rgba(255,255,255,0.2), inset -1px -1px 0 0 rgba(0,0,0,0.2);
  box-shadow: inset 1px 1px 0 0 rgba(255,255,255,0.2), inset -1px -1px 0 0 rgba(0,0,0,0.2);
}
.signin .avatar {
  width: 100px;
  height: 100px;
  margin: 0 auto 35px auto;
  border: 5px solid #fff;
  -webkit-border-radius: 100%;
  -moz-border-radius: 100%;
  border-radius: 100%;
  -webkit-pointer-events: none;
  -moz-pointer-events: none;
  pointer-events: none;
}
.signin .avatar:before {
  content: "\f272";
  text-align: center;
  font-family: Ionicons;
  display: block;
  height: 100%;
  line-height: 100px;
  font-size: 5em;
}
.signin .inputrow {
  position: relative;
}
.signin .inputrow label {
  position: absolute;
  top: 12px;
  left: 10px;
}
.signin .inputrow label:before {
  color: #538a9a;
  opacity: 0.4;
  -webkit-transition: opacity 300ms 0 ease;
  -moz-transition: opacity 300ms 0 ease;
  transition: opacity 300ms 0 ease;
}
.signin input[type="text"],
.signin input[type="password"] {
  padding: 10px 12px 10px 32px;
  display: block;
  width: 100%;
  margin-bottom: 10px;
  border: 1px solid rgba(255,255,255,0.5);
  background-color: #fff;
  color: #333;
  font-size: 1em;
  font-weight: 300;
  outline: none;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-transition: border-color 300ms 0 ease;
  -moz-transition: border-color 300ms 0 ease;
  transition: border-color 300ms 0 ease;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.signin input[type="text"]:focus + label:before,
.signin input[type="password"]:focus + label:before {
  opacity: 1;
}
.signin input[type="submit"] {
  -webkit-appearance: none;
  height: 40px;
  padding: 10px 12px;
  margin-bottom: 10px;
  background-color: #538a9a;
  text-transform: uppercase;
  color: #fff;
  border: 0px;
  float: right;
  margin: 0;
  outline: none;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
}
.signin input[type="submit"]:hover {
  background-color: #5e98a8;
}
.signin input[type="submit"]:active {
  background-color: #4a7b89;
}
input[type="checkbox"] {
  display: none;
}
input[type="checkbox"] + label {
  position: relative;
  padding-left: 36px;
  font-size: 0.6em;
  font-weight: normal;
  line-height: 16px;
  opacity: 0.8;
  text-transform: uppercase;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}
input[type="checkbox"] + label:before,
input[type="checkbox"] + label:after {
  content: "";
  position: absolute;
  display: block;
  height: 16px;
  -webkit-border-radius: 30px;
  -moz-border-radius: 30px;
  border-radius: 30px;
}
input[type="checkbox"] + label:before {
  left: 0;
  top: -2px;
  width: 30px;
  background: rgba(0,0,0,0.3);
  -webkit-box-shadow: inset 1px 1px 1px 1px rgba(0,0,0,0.3);
  -moz-box-shadow: inset 1px 1px 1px 1px rgba(0,0,0,0.3);
  box-shadow: inset 1px 1px 1px 1px rgba(0,0,0,0.3);
}
input[type="checkbox"] + label:after {
  opacity: 0.3;
  background: #fff;
  top: 0px;
  left: 2px;
  height: 12px;
  width: 12px;
  -webkit-transition: all 200ms 0 ease;
  -moz-transition: all 200ms 0 ease;
  transition: all 200ms 0 ease;
}
input[type="checkbox"]:checked + label {
  opacity: 1;
}
input[type="checkbox"]:checked + label:after {
  opacity: 1;
  left: 16px;
}
.cf:before,
.cf:after {
  content: " ";
  display: table;
}
.cf:after {
  clear: both;
}
.cf {
    *zoom: 1;
}
        .error_message{
            font-size:12px;
        }
</style></head><body>

<link href="https://fonts.googleapis.com/css?family=Oxygen:400,300,700" rel="stylesheet" type="text/css"/>
<link href="https://code.ionicframework.com/ionicons/1.4.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
<div class="signin cf" style="margin-top: 200px;">
  <div class="">
      <img src="<?php echo base_url('assets/img/logo/prasath3.jpg');?>" style="width:250px;"/>
  </div>
    <form action="<?php echo site_url('Welcome/login'); ?>" method="post"id="girisyap" id="sidebar-user-login" class="form-signin">
    <div class="inputrow">
      <input type="text" id="name"  name="username" placeholder="Username"/>
      <label class="ion-person" for="name"></label>
    </div>
    <div class="inputrow">
      <input type="password" id="pass"  name="password" placeholder="Password"/>
      <label class="ion-locked" for="pass"></label>
    </div>


        <?php
        if ($this->session->flashdata('message')) {
            if ($this->session->flashdata('message') == 'error') {
                $this->session->set_flashdata('message', '');
                ?>
                <div class="col-md-1"></div>
                <div class="label label-danger col-md-12 error_message" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding: 10px; color: rgb(92, 81, 81);" >
                    Error occurred.
                </div>
                <?php
            }
        }
        ?>
        <?php
        if ($this->session->flashdata('message')) {
            if ($this->session->flashdata('message') == 'invalied_user') {
                $this->session->set_flashdata('message', '');
                ?>
                <div class="col-md-1"></div>
                <div class="label label-danger col-md-12 error_message" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding: 10px; color: rgb(92, 81, 81);">
                    Incorrect Username or Password..
                </div>
                <br>
                <?php
            }

            if ($this->session->flashdata('message') == 'user_already_logged') {
                $this->session->set_flashdata('message', '');
                ?>
                <div class="col-md-1"></div>
                <div class="label label-danger col-md-12 error_message" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding: 10px; color: rgb(92, 81, 81);">
                    Username already logged in please log out from other devices to login.
                </div>
                <br>
                <?php
            }
        }
        ?>
    <input type="submit" value="Login"/>
  </form>
</div>

</body></html>