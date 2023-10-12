<div class="flex bg-primary gap-8 h-full">
<div>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection error");
session_start();
include 'include/nav.php';
include 'rolecheck.php';

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:messages.php');
}

?>
</div>

<div class=" mx-20">

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   

<section class="messages">

   <h1 class="text-[#a34a38] mb-2"> Messages </h1>

   <div >
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
      
   ?>
   <div class="bg-white mt-2 border-2 p-3 px-5 rounded-lg text-xl">
      <p> user id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
      <p> name : <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> number : <span><?php echo $fetch_message['number']; ?></span> </p>
      <p> email : <span><?php echo $fetch_message['email']; ?></span> </p>
      <p class="mb-2"> message : <span><?php echo $fetch_message['message']; ?></span> </p>
      <a href="messages.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class=" border-2 mt-3 mx-5 p-1 text-white text-xl bg-blue-500 rounded-lg">delete message</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">you have no messages!</p>';
   }
   ?>
   </div>

</section>
</div>
</div>

</body>
</html>