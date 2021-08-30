
<?php
 session_start();

 // initializing variables
 $news_name = "";
 $content    = "";
 $errors = array(); 
 
 // connect to the database
 $db = mysqli_connect('localhost', 'root', '12345678', 'finalexam');
 //CREATE POST
 if (isset($_POST['create'])) {
    // receive all input values from the form
    $news_name = mysqli_real_escape_string($db, $_POST['news_name']);
    $content = mysqli_real_escape_string($db, $_POST['content']);

    if (empty($news_name)) { array_push($errors, "Title is required"); }
    if (empty($content)) { array_push($errors, "Content is required"); }   
 }
 $post_check_query = "SELECT * FROM news WHERE news_name='$news_name' OR content='$content' LIMIT 1";
 $result = mysqli_query($db, $post_check_query);
 $news = mysqli_fetch_assoc($result);

 if ($news) { 
    if ($news['news_name'] === $news_name) {
      array_push($errors, "Title already exists");
    }

    if ($news['content'] === $content) {
      array_push($errors, "content already exists");
    }
  }

 if (count($errors) == 0) {
    $query = "INSERT INTO news (news_name, content) 
    VALUES('$news_name', '$content')";
    mysqli_query($db, $query);
    
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Create Page</title>
</head>
<body>
  <div class="header">
  	<h2>Create Post</h2>
  </div>
	
  <form method="post" action="create.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Title</label>
  	  <input type="text" name="news_name" value="<?php echo $news_name; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Content</label>
  	  <input type="text" name="Content" value="<?php echo $content; ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="create">Create</button>
  	</div>
  	
  </form>
</body>
</html>