<!DOCTYPE html>
<html>
 <head>
   <link rel="stylesheet" type="text/css" href="delstyle.css"> 
 </head>
<body>
<?php
// Enter your Host, username, password, database below.
session_start();
$username="";

$errors=array();

$db = mysqli_connect('localhost','root','','database');
// Check connection

//registration
   
   if(isset($_POST['register'])){
  
    $username = mysqli_real_escape_string($db, $_POST['username']);
  
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']); 
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    $password = md5($password_1);
  
    if(empty($username)) {
      array_push($errors,"username is required");
    }
    if(empty($password_1)) {
      array_push($errors,"Password is required");
    }
    if($password_1 != $password_2) {
      array_push($errors,"passwords do not match");
    }
  
   if(empty($errors)) {
    $sql = "INSERT INTO users (username,password) VALUES ('$username','$password')";
    mysqli_query($db,$sql);
    ?>
    <p style="color:green;">Registered Successfully</p>
  <?php
    }
  }
  
//delete notes
if(isset($_POST['delnote'])) {

  
    $note1 = mysqli_real_escape_string($db, $_POST['del']);

   if($note1) {
    $sql = "DELETE FROM notes WHERE id='$note1'";
    mysqli_query($db,$sql);
    }
}


//login
if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(empty($username)) {
      array_push($errors,"username is required");
    }
   
  if (count($errors)==0) {
    $password=md5($password);
    $query="SELECT * FROM users WHERE username='$username' AND password='$password'";
      $result=mysqli_query($db,$query);
      $row = $result->fetch_assoc();
      //echo $row["id"];
     if(mysqli_num_rows($result)==1){
      $_SESSION['username']=$username;
      $_SESSION['success']="You are logged in";
      header('location:delindex.php');
      $_SESSION['post']= $row["type"];
    }else{
      array_push($errors,"wrong combination");
    } 

  }

}

//add notes
if(isset($_POST['addnote'])) {
  
   if(isset($_POST['fname']))
   {$filename=$_POST['fname'];
   }
   else
   {$filename="unknown";
   }

  $textcontent= htmlspecialchars($_POST['note']);
  $filename=$filename.".txt";
  $newfile=fopen($filename,"w");
  $content=fwrite($newfile,$textcontent. "\n");
  fclose($newfile); 

 if(!get_magic_quotes_gpc())
   {
    $filename=addslashes($filename);
    $textcontent=addslashes($textcontent);
   }


$user=$_SESSION['username'];
$query="SELECT * FROM users WHERE username='$user' LIMIT 1";
$result=mysqli_query($db,$query);
$row=mysqli_fetch_row($result);
$userid="$row[0]";

$query2 ="INSERT INTO message (texts,userid,msgname) VALUES ('$textcontent','$userid','$filename') ";
mysqli_query($db,$query2);
}

//delete note
if(isset($_POST['delnote'])) {
 
 $fileno=mysqli_real_escape_string($db, $_POST['del']);
 if($fileno)
  {$sql = "DELETE FROM message WHERE id='$fileno'";
   mysqli_query($db,$sql);
  }
}
 
/*
if(isset($_GET['msgid'])){
   $userid=intval($_GET['msgid']);
   $query="SELECT * FROM message WHERE userid='$userid'";
   $result=mysqli_query($db,$query);
   $row=mysqli_fetch_row($result);
   $msg="$row[1]";
}  
*/
//logout
 if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location:dellogin.php');

 }

?>
 
 </body>
</html>