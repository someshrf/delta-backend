<?php include('delserver.php'); ?>
<?php include('delerrors.php'); ?>
              
<?
if(empty($_SESSION['username'])) {
  header('location: dellogin.php');
  } 
?>
<!DOCTYPE html>
<html>
<head>
  <title>user</title>
  <link rel="stylesheet" type="text/css" href="delstyle1.css">
</head>
<body>
    <div class="header">
        <h2>Home</h2>
    </div>

  <form method="post" action="delindex.php">
   
   <div class="refer">
    <p style="display:inline-block"><br>&nbsp &nbsp<a href="delindex.php" style="text-decoration: none; color:white">Add file</a><br></p>
    
    <p style="display:inline-block"><br>&nbsp &nbsp <a href="delindex1.php" style="text-decoration: none; color:white">Home</a><br></p>
  
   </div>
  
    <div class="content">
      <?php if (isset($_SESSION['success'])): ?>
        <div class="success">
         <h3>
            <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
             ?>
          </h3>
         </div>
        <?php endif ?>  
      
        <!--for ad notes -->  
           <div class="first">
             <div class="input-group2">
             
                <?php
                if(isset($_GET["msgid"])){
                  $userid=($_GET["msgid"]);
                  $query="SELECT * FROM message WHERE id='$userid'";
                  $result=mysqli_query($db,$query);
                  $row=mysqli_fetch_row($result);
                  $msg=htmlspecialchars($row[1]);
                                        
             ?>
             <textarea name="note" cols="70" rows="10" placeholder="enter note"><?php echo $msg; ?></textarea>
              <?php } ?>
           
               </div>
           </div>  
            
            <!-- notes --> 
            <div class="prof">
             <?php
             //to get present user id            
            
             $query1="SELECT * FROM message";
             $result1=mysqli_query($db,$query1);
              
               echo "<table border='1'>
                 <tr>
                 <th>Id</th>
                <th>Notice</th>
                 </tr>";
                 while($row1 = mysqli_fetch_array($result1))
                 {$no=$row1[0];
                  echo "<tr>";
                  echo "<td width='30'>" . $row1[0] . "</td>";
                  echo '<td width="670"><a href="delindex1.php?msgid='.$no.'" style="text-decoration:none;color:black;">' . $row1['msgname'].'</a></td>';
                  echo "</tr>";
                 }
                 echo "</table>";
               ?>          
                         
             </div>
          

       </div>               
     
      <?php if (isset($_SESSION['username'])): ?>
          <div class="body">
         
           <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
           
           <p><a href="delindex.php?logout='1'" style="color:red;">Logout</a></p>
          
          </div>
        <?php endif ?>    

  </form> 

</body>
</html>