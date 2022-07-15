<?php require 'partials/_dbconnect.php' ?>
<?php require 'partials/_session.php' ?>
<?php 
  $name = $_SESSION['username'];
  $sql = "select * from notes where username = $name;";
  $result = mysqli_query($conn, $sql);
    $sql = "SELECT * FROM `notes` where username = '$name'; ";
  $result = mysqli_query($conn, $sql);
  $tn = 0;
  while($row = mysqli_fetch_assoc($result)){
    $tn = $tn + 1;
  }
  
 
//   echo "$notes = mysqli_num_rows ( $result );"
// $notes = mysql_fetch_array($result);
// $notes = mysqli_num_rows($result);

// echo "$notes";





?>
<aside class="sidebar">
       
        <div class="side-inner">

            <div class="profile">
                <img src="images/person_profile.jpg" alt="Image" class="img-fluid">
                <h3 class="name"><?php echo"$name" ?></h3>
                <span class="country"></span>
            </div>

            <div class="counter d-flex justify-content-center">
                <!-- <div class="row justify-content-center"> -->
                <div class="col">
                    <strong class="number"><?php echo $tn ?></strong>
                    <span class="number-label"> notes</span>
                </div>
                <div class="col">
                    <strong class="number">22.5k</strong>
                    <span class="number-label">Followers</span>
                </div>
                <div class="col">
                    <strong class="number">150</strong>
                    <span class="number-label">Following</span>
                </div>
                <!-- </div> -->
            </div>

            <div class="nav-menu">
                <ul>
                    <li class="active"><a href="#"><span class="icon-home mr-3"></span>Feed</a></li>
                    <li><a href="#"><span class="icon-search2 mr-3"></span>Explore</a></li>
                    <li><a href="#"><span class="icon-notifications mr-3"></span>Notifications</a></li>
                    <li><a href="partials/_edit_profile.php"><span class="icon-location-arrow mr-3"></span>edit profile</a></li>
                    <li><a href="#"><span class="icon-pie-chart mr-3"></span>Stats</a></li>
                    <li><a href="/mynotes/signout.php"><span class="icon-sign-out mr-3"></span>Sign out</a></li>
                </ul>
            </div>
        </div>

    </aside>
    