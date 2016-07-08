<?php include('header.php'); ?>
<style>
#one{
  background-color: blue;
}
#two{
  background-color: green;
}
</style>
<!-- Check if Edit Access is allowed -->
<?php if($this->session->userdata('userName')==$userInfo['userName'])
        $editAccess = true;
      else
        $editAccess = false;
?>
<div class="container" style="margin-top:6%">
    <div class="row">


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">

                        <img src="<?php echo base_url("Uploads/Profile/".$userInfo['profilePic']);?>" alt="" class="img-rounded img-responsive" /><br>
                        <?php
                        if($editAccess){
                              $attributes = array("class" => "form-horizontal", "id" => "profilePicForm", "name" => "profilePicForm","role"=>"form");
                              echo form_open_multipart("AnsQuick/editProfilePic", $attributes);?>
                                <label class="btn btn-default btn-file">
                                    <span class="glyphicon glyphicon-upload"></span> Upload Image <input name="profilePicFile" id="profilePicFile" type="file" style="display: none;" accept="image/*"><span id="imagePath"></span>
                                </label>
                                <button type="submit" class="btn btn-success pull-right" id="profilePicSubmit" >Submit</button>
                                <div class="alert alert-danger" role="alert" id="profilePicError" hidden="true"> </div>
                        <?php echo form_close(); }?>
                        <h4><?php echo $userInfo['userName']; ?></h4>
                        <h4  id = "emaiID2"><?php echo $userInfo['emailID'] ?></h4>
                        <h4  id = "tags"><b>Tags Followed</b> : <ul class="list-inline"> <?php if(count($userTags)){foreach($userTags as $tag) {?> <li> <a href="<?php echo base_url("index.php/tag/recent/".$tag['tagName']) ; ?>"><?php echo $tag['tagName'] ; ?></a> </li> <?php }}else{ echo "<li>No Tags Followed Yet</li>";}?> </ul></h4>
                    </div>
                    <div class="col-sm-6 col-md-8" style="padding-left:15%">



                        <?php if($editAccess||isset($userInfo['firstName'])){?>
                          <div class="form-group">
                            <ul class="list-inline">
                              <li>
                                <label for="profileFirstName">First Name<?php $num = 18;while($num--) echo "&nbsp;";?>: &nbsp;&nbsp;</label>
                                <?php if($editAccess) { ?>
                              <a href="#" id="profileFirstName"><?php echo $userInfo['firstName']; ?></a>
                            <?php } else { ?>
                              <?php echo $userInfo['firstName']; ?>
                              <?php } ?>
                            </li>
                          </ul>
                          </div>
                          <?php }?>

                          <?php if($editAccess||isset($userInfo['lastName'])){?>
                          <div class="form-group">
                            <ul class="list-inline">
                              <li>
                                <label for="profileLastName">Last Name <?php $num = 17;while($num--) echo "&nbsp;";?>: &nbsp;&nbsp; </label>
                                <?php if($editAccess) { ?>
                              <a href="#" id="profileLastName"><?php echo $userInfo['lastName']; ?></a>
                            <?php } else { ?>
                              <?php echo $userInfo['lastName']; ?>
                              <?php } ?>
                              </li>
                            </ul>
                          </div>
                          <?php }?>

                          <?php if($editAccess||isset($userInfo['title'])){?>
                          <div class="form-group">
                            <ul class="list-inline">
                              <li>
                                <label for="profileTitle">Title<?php $num = 29;while($num--) echo "&nbsp;";?>: &nbsp;&nbsp; </label>
                                <?php if($editAccess) { ?>
                              <a href="#" id="profileTitle"><?php echo $userInfo['title']; ?></a>
                            <?php } else { ?>
                              <?php echo $userInfo['title']; ?>
                              <?php } ?>
                            </li>
                            </ul>
                          </div>
                          <?php }?>

                          <?php if($editAccess||isset($userInfo['aboutMe'])){?>
                          <div class="form-group">
                            <ul class="list-inline">
                              <li>
                                <label for="profileAboutMe">About Me<?php $num = 20;while($num--) echo "&nbsp;";?>: &nbsp;&nbsp; </label>
                                <?php if($editAccess) { ?>
                              <a href="#" id="profileAboutMe"><?php echo $userInfo['aboutMe']; ?></a>
                            <?php } else { ?>
                              <?php echo $userInfo['aboutMe']; ?>
                              <?php } ?>
                            </li>
                            </ul>
                          </div>
                          <?php }?>

                          <?php if($editAccess||isset($userInfo['mobileNo'])){?>
                          <div class="form-group">
                            <ul class="list-inline">
                              <li>
                                <label for="profileMobileNo">Contact <?php $num = 22;while($num--) echo "&nbsp;";?>: &nbsp;&nbsp; </label>
                                <?php if($editAccess) { ?>
                              <a href="#" id="profileMobileNo"><?php echo $userInfo['mobileNo']; ?></a>
                            <?php } else { ?>
                              <?php echo $userInfo['mobileNo']; ?>
                              <?php } ?>
                            </li>
                            </ul>
                          </div>
                          <?php }?>

                          <?php if($editAccess||isset($userInfo['gender'])){?>
                          <div class="form-group">
                          <label for="profileGender">Sex <?php $num = 29;while($num--) echo "&nbsp;";?>: &nbsp;&nbsp;</label>
                              <?php if($editAccess) { ?>
                            <a href="#" id="profileGender"><?php echo $userInfo['gender']; ?></a>
                          <?php } else { ?>
                            <?php echo $userInfo['gender']; ?>
                            <?php } ?>
                        </div>
                        <?php }?>




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
