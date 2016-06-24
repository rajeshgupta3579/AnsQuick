
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href=""<?php echo base_url('css/normalize.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
  </head>

  <body>

    <div class="form">

      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>

      <div class="tab-content">
        <div id="signup">
          <h1>Sign Up for Free</h1>

          <?php $attributes = array("name" => "registrationform");
                echo form_open("Signup", $attributes);?>

          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" name="firstName" value="<?php echo set_value('firstName'); ?>" required autocomplete="off" />
            </div>

            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text" name="lastName" value="<?php echo set_value('lastName'); ?>" required autocomplete="off"/>
            </div>
          </div>
          <div class="field-wrap">
            <label>
              User Name<span class="req">*</span>
            </label>
            <input type="text" name="userName" value="<?php echo set_value('userName'); ?>"required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name="emailID" value="<?php echo set_value('emailID'); ?>" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
          </div>

          <button type="submit" class="button button-block"/>Get Started</button>

          <?php echo form_close(); ?>

        </div>

        <div id="login">
          <h1>Welcome Back!</h1>

          <?php
            $attributes = array("class" => "form-horizontal", "id" => "loginform", "name" => "loginform");
            echo form_open("Login/index", $attributes);?>

            <div class="field-wrap">
            <label>
              User Name<span class="req">*</span>
            </label>
            <input type="text" name="userName" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
          </div>

          <p class="forgot"><a href="#">Forgot Password?</a></p>

          <button type="submit" name="btn_login" class="button button-block"/>Log In</button>

          <?php echo form_close(); ?>

        </div>

      </div><!-- tab-content -->

</div> <!-- /form -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="<?php echo base_url('js/index.js'); ?>"></script>




  </body>
</html>
