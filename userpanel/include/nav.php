 <?php
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection failed: " . mysqli_connect_error());
if(isset($_SESSION['Email'])){
  $user_id = $_SESSION['Id'];
} 
else{
  $user_id="";
}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
 </head>
 <body>
  <!-- navbar -->
 <div class="sticky top-0 bg-primary">
  <nav class="flex  justify-between shadow-md  text-[17px]">
    <ul class="flex gap-10 py-5 font-semibold container">
      <li class="hover:text-secondary"><a href="home.php">Home</a></li>
      <li class="hover:text-secondary"><a href="../home/aboutus.php">About</a></li>
      <li class="hover:text-secondary"><a href="contact.php">Contact</a></li>
      <li class="hover:text-secondary"><a href="myorder.php">Orders</a></li>
      <form action="../userpanel/categories.php" method="POST">
        <?php $sql="select * from categories" ;
        $result=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
        ?>
        <select name="category" id="1" class="bg-primary" onchange="this.form.submit();">
          <option value="" disabled selected>Categories</option>
          <?php 
          while($rows=mysqli_fetch_assoc($result)){

          ?>
          <option value="<?php echo $rows['category_id'] ;?>"><?php echo $rows['category'];?></option>
       <?php } ?>
        </select>
       <?php } ?>
      <!-- <li class="">Categories<i class="fas fa-caret-down mx-1" onclick="dropdown()"ondblclick="drphide()"></i></a>
        <ul class="dropdown absolute block bg-light p-5 hidden" id="drp">
        <li class="hover:bg-secondary my-3 border px-2" ><button name="men">Men Shoes</button></li>
        <li class="hover:bg-secondary my-3 border px-2 " ><button name="women">women</button></li>
        <li class="hover:bg-secondary my-3  border px-2" ><button name="kids">kids</button></li>
        </ul>
      </li> -->
      </form>
      <li class="flex">
      <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
        <a href="../userpanel/cart.php"  class="flex">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
</svg> <span>(<?php echo $cart_rows_number; ?>)</span>
</a>

  </li>


    <form action="search.php" method="GET" class="flex mr-4 py-1 px-3 rounded-2xl border border-black bg-white">
  <input type="search" placeholder="Search" name="search" class="focus:outline-none w-32" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"> 
  <button type="submit"><i class="fa-solid fa-magnifying-glass py-1"></i></button>
</form>

    <ul class=" ml-44 font-semibold flex gap-5 pt-1">
    <ul class="flex">
      <li class="hover:text-secondary flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-1">
  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
</svg>

 <?php if(isset($_SESSION['Email'])){

 echo $_SESSION['uname']; ?></li>
      </ul>
      <li class="hover:text-secondary"><a href="../userpanel/logout.php">Logout</a></li>

    </ul>
    <?php } ?>
  </nav>
</div>



</body>
 </html>