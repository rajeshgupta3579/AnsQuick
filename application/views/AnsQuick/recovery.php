<?php include('header.php'); ?>
  <div id="forgotPassword" class="tab-pane fade in active">
        </br></br></br></br></br>
        <?php
          $attributes = array("class" => "form-horizontal", "id" => "forgotPasswordForm", "name" => "forgotPasswordForm","role"=>"form");
          echo form_open("ForgotPassword/success", $attributes);?>
        <div class="form-group">
          <label class="control-label col-sm-2" for="username">Username / Email-ID:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" style="width:25%" id="userNameForgotPassword" name="userName" placeholder="Enter Username or Email">
            <div class="alert alert-danger" role="alert" id="userNameForgotPasswordError" hidden="true"> </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button id="forgotPasswordSubmit" type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      <?php echo form_close(); ?>
</div>
<?php include('footer.php'); ?>
