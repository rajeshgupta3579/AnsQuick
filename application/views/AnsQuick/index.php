 <!DOCTYPE html>
<html lang="en">
<head>
  <title>AnsQuick</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <style>
  #searchBox{
    /*width: 100%;*/
  }
  #searchButton{
    /*margin-left: 0px;*/
  }
  #post{
    /*margin-left: 10px;*/
  }
  #navbar{
    /*margin-left: 200px;
    margin-right: 200px;
    */
  }
  </style>
</head>
<body>
<nav class="navbar navbar-default "  role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">AnsQuick</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">

      <li class="Category">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#" class="active">Business</a></li>
          <li class="divider"></li>
          <li><a href="#">Sports</a></li>
          <li class="divider"></li>
          <li><a href="#">Entertainment</a></li>
          <li class="divider"></li>
          <li><a href="#">Education</a></li>
        </ul>
      </li>
    </ul>
    <div class="col-sm-6 col-md-6">
        <form class="navbar-form navbar-right" role="search" >
        <div class="input-group">
            <input type="text" class="form-control col-xs-10 searchBox"  onfocus="expand()" placeholder="Search or Post Question" name="q">
            <div class="input-group-btn">
                <button class="btn btn-success " type="submit"  ><i class="glyphicon glyphicon-search"></i></button>

            </div>
        </div>
        </form>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#postQuestion" data-toggle="modal">Post Question!!</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#logIn" data-toggle="modal">Log In/Sign Up</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>







<div class="modal fade" id="postQuestion" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Post a Question!!</h4>
      </div>
        <div class="modal-body">
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="question">Question:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="qeustion" name="question" placeholder="Enter Question" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="tags">Tags:</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="tags" placeholder="Enter ',' seperated tags " required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-2" for="tags">Category</label>
                          <div class="col-sm-10">
                            <select id="category" name="category">
                            <option value="Sports">Sports</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Business">Business</option>
                            <option value="Education">Education</option>
                          </select>
                          </div>
                        </div>


                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </div>    
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


















<div class="modal fade" id="logIn" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">

              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#login">Login</a></li>
                <li><a data-toggle="tab" href="#signup">SignUp</a></li>

              </ul>

              <div class="tab-content">
                <div id="login" class="tab-pane fade in active">
                        </br>
                        <?php
                          $attributes = array("class" => "form-horizontal", "id" => "loginForm", "name" => "loginForm","role"=>"form");
                          echo form_open("Login/index", $attributes);?>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="username">Username:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="userNameLogin" name="userName" placeholder="Enter Username or Email" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="pwd">Password:</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="passwordLogin" name="password" placeholder="Enter password" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                              <label><input type="checkbox"> Remember me</label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button  class="btn btn-success">Forgot Password</button>
                          </div>
                        </div>
                      <?php echo form_close(); ?>




                </div>
                <div id="signup" class="tab-pane fade">

                      </br>
                      <?php
                        $attributes = array("class" => "form-horizontal", "id" => "signUpForm", "name" => "signUpForm","role"=>"form");
                        echo form_open("Signup/index", $attributes);?>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="firstName">First Name:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="firstName" placeholder="First Name" name="firstName">
                              <div class="alert alert-danger" role="alert" id="firstNameError" hidden="true">
                                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                  <span class="sr-only">Error:</span>
                              </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="lastName">Last Name:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lastName">
                            <div class="alert alert-danger" role="alert" id="lastNameError" hidden="true">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="userName">Username:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="userName" name="userName"  placeholder="Enter Username">
                            <div class="alert alert-danger" role="alert" id="userNameError" hidden="true">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="emailID">Email ID:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="emailID" name="emailID"  placeholder="Enter Email">
                            <div class="alert alert-danger" role="alert" id="emailIDError" hidden="true">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="pwd">Password:</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                            <div class="alert alert-danger" role="alert" id="passwordError" hidden="true">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="confirmpwd">Confirm Password:</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm password">
                            <div class="alert alert-danger" role="alert" id="cpasswordError" hidden="true">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button id="signUpSubmit" type="submit" class="btn btn-success" >Submit</button>
                          </div>
                        </div>
                      <?php echo form_close(); ?>


                </div>

              </div>



        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

</body>
<script>
function expand(){
  alert("expanded");
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('js/index.js'); ?>"></script>
</html>
