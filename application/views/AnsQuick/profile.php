<?php include('header.php'); ?>
<style>
#one{
  background-color: blue;
}
#two{
  background-color: green;
}
</style>

<div class="container" style="margin-top:20%">
    <div class="row">


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="http://placehold.it/380x400" alt="" class="img-rounded img-responsive" />
                        <h4>UserName</h4>
                        <h4  id = "emaiID2">Patel@gmail.com</h4>
                    </div>
                    <div class="col-sm-6 col-md-8" style="padding-left:15%">

                      <form>
                          <div class="form-group">
                                <label for="firstName2">First Name: </label>
                              <h4  id = "firstname2">Bhaumik </h4>
                          </div>

                          <div class="form-group">
                            <ul class="list-inline">
                              <li>
                                <label for="lastName2">Last Name: </label>

                              <h4  id = "lstName2">Patel</h4>
                              </li>
                            </ul>
                          </div>
                          <div class="form-group">
                            <ul class="list-inline">
                              <li>
                                <label for="title2">Title: </label>

                              <h4  id = "title2">I am god</h4>
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
