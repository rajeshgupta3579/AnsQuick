<?php include('header.php'); ?>
  <div id="forgotPassword" class="tab-pane fade in active">
        </br></br></br></br></br>
        <?php
          $attributes = array("class" => "form-horizontal", "id" => "changePasswordForm", "name" => "changePasswordForm","role"=>"form");
          echo form_open("ForgotPassword/setPassword", $attributes); $_POST['userName']=$userName; ?>

        <div class="form-group">
          <label class="control-label col-sm-2" for="password">New password:</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" style="width:25%" id="newPassword" name="newPassword" placeholder="Enter New Password">
            <div class="alert alert-danger" style="width:25%;"role="alert" id="newPasswordError" hidden="true"> </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="password">Confirm password:</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" style="width:25%" id="cnewPassword" name="cnewPassword" placeholder="Confirm Password">
            <div class="alert alert-danger" style="width:25%;"role="alert" id="cnewPasswordError" hidden="true"> </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button id="changePasswordSubmit" type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      <?php echo form_close(); ?>
</div>
<?php include('footer.php'); ?>
