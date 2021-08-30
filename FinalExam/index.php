<?php 
include ("db.php");
$query = "SELECT * FROM news";
$result = mysqli_query($db,$query);
  

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator Page</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
<header>
<section class="navbar">
        <div class ="container">
            <div class="logo">
                <img src="images/fpt_logo.jpg" alt="Logo" class="img-responsive">
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Events</a>
                    </li>
                    <li>
                        <a href="#">Contacts</a>
                    </li> 
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <div class="container">  
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome, <strong><?php echo $_SESSION['username']; ?></strong>!</p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
    <p>
  	  <a href="create.php">Create post</a>
  	</p>
    </div>
	<div class="container">
          <h2>Info</h2>
      <table class="table">
          <head>
              <tr>
                  <th scope="col">NewsID</th>
                  <th scope="col">userID</th>
                  <th scope="col">Title</th>
                  <th scope="col">Content</th>
                  <th scope="col">Created Time</th>
              </tr>
          </head>
          <tbody>
              <?php 
                  if($result->num_rows>0){
                      while($row = $result->fetch_assoc()){
              ?> 
              
                        <tr>
                            <td><?php echo $row['news_id']; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['news_name']; ?></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $row['created_date']; ?></td>
                            <td><a class="btn btn-info" href="update.php?news_id=<?php echo $row['news_id']; ?>">
                            Edit</a>&nbsp;<a class="btn btn-danger" href="db.php?del=<?php echo $row['news_id']; ?>">
                            Delete</a></td>
                        </tr>
                        <?php  }
                  }
                  ?>        
          </tbody>
      </table>    
      </div>	
</body>
</html>
