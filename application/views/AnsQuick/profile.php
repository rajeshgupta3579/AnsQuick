<?php include('header.php'); ?>
<style>
#one{
  background-color: blue;
}
#two{
  background-color: green;
}
</style>

<div class="container" style="margin-top:6%">
    <div class="row">


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="<?php echo base_url("Uploads/Profile/".$userInfo['profilePic']);?>" alt="" class="img-rounded img-responsive" />
                        <h4><?php echo $userInfo['userName']; ?></h4>
                        <h4  id = "emaiID2"><?php echo $userInfo['emailID'] ?></h4>
                        <h4  id = "tags">Tags Followed : <ul class="list-inline"> <?php if(count($userTags)){foreach($userTags as $tag) {?> <li> <a href="<?php echo base_url("index.php/tag/recent/".$tag['tagID']) ; ?>"><?php echo $tag['tagName'] ; ?></a> </li> <?php }}else{ echo "<li>No Tags Followed Yet</li>";}?> </ul></h4>
                    </div>
                    <div class="col-sm-6 col-md-8" style="padding-left:15%">

                      <form>
                          <div class="form-group">
                                <label for="profileFirstName">First Name: </label>
                              <a href="#" id="profileFirstName" data-type="text" data-placement="right" data-title="Enter First Name"><?php echo $userInfo['firstName']; ?></a>

                          </div>

                          <div class="form-group">
                            <ul class="list-inline">
                              <li>
                                <label for="profileLastName">Last Name: </label>
                              <a href="#" id="profileLastName" data-type="text" data-placement="right" data-title="Enter Last Name"><?php echo $userInfo['lastName']; ?></a>
                              </li>
                            </ul>
                          </div>
                          <div class="form-group">
                            <ul class="list-inline">
                              <li>
                                <label for="profileTitle">Title: </label>
                                  <a href="#" id="profileTitle" data-type="text" data-placement="right" data-title="Enter Last Name"><?php echo $userInfo['title']; ?></a>
                            </li>
                            </ul>
                          </div>

                          <div class="form-group">
                            <ul class="list-inline">
                              <li>
                                <label for="aboutMe2">About Me: </label>

                              <h4  id = "aboutMe2">I am god</h4>
                            </li>
                            </ul>
                          </div>
                          <div class="form-group">
                            <ul class="list-inline">
                              <li>
                                <label for="phone2">Contact Number: </label>

                              <h4  id = "phone2">9809809809</h4>
                            </li>
                            </ul>
                          </div>
                          <div class="form-group">
                          <label for="sex">Sex:&emsp;</label>
                          <select class="selectpicker" id="sex" name="category">
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                        </div>
                        <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date"  id="birthday">
                      </div>

                          <div class="form-group">
                            <ul class="list-inline">
                            <li>
                              <button class="btn btn-primary"  id="edit">Edit</button>
                            </li>

                            <li>
                              <button class="btn btn-default"  id="save">Save</button>
                            </li>
                            </ul>
                          </div>

                          </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
