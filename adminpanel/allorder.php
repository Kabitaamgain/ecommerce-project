<div class="flex bg-primary gap-8 h-full">
<div>
<?php
session_start();
include 'include/nav.php';
include 'rolecheck.php';


$Limit=5;
if(isset($_REQUEST['page'])){
    $page=$_REQUEST['page'];
}else{
    $page=1;
}
$offset=ceil($page-1)*$Limit;

$sql = "SELECT * FROM orders limit $offset,$Limit";
$result = mysqli_query($conn, $sql);
?>
  </div>
  <div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../css/tailwindcss.css"></script>
  <link rel="stylesheet" type="text/css"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <script>

    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: "mintcream",
            secondary: "#a34a38",
            tertiory: "orangered",
            light:"#b0ada8",
            golden:"#efc66b",
            dimlight:"rgb(0, 0, 0, 0.3)",
            btncolor:"#DFC98A"

          },
          container: {
            center: true,
            padding: {
              DEFAULT: '1rem',
              sm: '2rem',
              lg: '4rem',
              xl: '5rem',
              '2xl': '6rem',
            },
          },
        }
      }
    }
  </script>
  <style type="text/tailwindcss">
    h1{
          @apply text-5xl font-semibold;
         }
    div.discription{
            @apply text-center mt-3
    }       
    input.inputitem{
      @apply m-2 p-3 rounded-lg text-center
    }
    h2{
      @apply text-2xl font-semibold text-secondary m-2
    }
    input[type="text"],
input[type="Number"],

table,tr,th,td{
        @apply border-2 px-2 mt-2
        }
        </style>
</head>
<body>

<section class="orders">

   <h1 class="title text-2xl font-bold text-center uppercase">placed orders</h1>

   <div class="box-container mx-auto">
    <form action="" method="post">
       <span class="font-semibold textxl">Search: <input type="search" placeholder="Search Your Item" name="search" id="" onchange="this.form.submit()" class="border-2 rounded-lg text-center p-2"></span>
    </form>
    <?php


$sql ="SELECT * FROM orders";
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST['search']); // This escapes special characters in a string for use in an SQL statement
    $sql = "SELECT * FROM orders WHERE created_at LIKE '%$searchTerm%' OR payment LIKE '%$searchTerm%'";
}
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){



    // if (isset($_GET['search'])) {
    //     $search = $_GET['search']; 
    //     $search_query = 
    //     $select_orders = mysqli_query($conn, $search_query) or die('query failed');
    // } else {
    //     $select_orders = mysqli_query($conn, "") or die('query failed');
    // }

    // if (mysqli_num_rows($select_orders) > 0) {
        $id=0;
    ?>
   <table class="mt-10 mr-10">
    <tr>
      <th rowspan="2">product_id</th>
      <th rowspan="2">quantity</th>
      <th rowspan="2">price</th>
      <th rowspan="2">payment</th>
      <th rowspan="2">created_at</th>
      <th rowspan="2">invoice_no</th>
      <th colspan="4">customer</th>
      <th colspan="2">Action</th> <!-- Action Column with 2 sub-columns -->
    </tr>
    <tr>
      <th>Name</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Email</th>
      <th>Approve</th> <!-- Sub-columns under Action -->
      <th>Reject</th> <!-- Sub-columns under Action -->
    </tr>
    <?php
    while($row = mysqli_fetch_assoc($result)) {
    ?>
      <?php
     if($row['payment']=="completed"){
      $class="cursor-not-allowed";
      $href="#";
     }else{
    $href="reject.php?inv=".$row['invoice_no'];
    $class="cursor-pointer";
     }
      ?>
        <tr>
        <td><?php echo $row['product_id'];?></td>
        <td><?php echo $row['quantity'];?></td>
        <td><?php echo $row['price'];?></td>
        <td><?php echo $row['payment'];?></td>
        <td><?php echo $row['created_at'];?></td>
        <td><?php echo $row['invoice_no'];?></td>
        <td><?php echo $row['cname'];?></td>
        <td><?php echo $row['cphone'];?></td>
        <td><?php echo $row['caddress'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><a href="approve.php?inv=<?php echo $row['invoice_no'];?>& cid=<?php echo $row['customer_id'];?>" title="Approve">Approve</a></td>
        <td><a href="<?php echo $href; ?>& cid=<?php echo $row['customer_id'];?>" title="Reject" class="<?php echo $class; ?>">Reject</a></td>
        </tr>
    <?php
    }
  }
    ?>
</table>

<div class="flex justify-center">
                    
                    <ul class="flex gap-2 text-center">
                       <?php 
                       $sql1="SELECT * FROM orders";
                       $result1=mysqli_query($conn,$sql1);
                       if(mysqli_num_rows($result1)>0){
                           $total_records=mysqli_num_rows($result1);
                           $Total_page=ceil($total_records / $Limit);
                       }
                       if($page>1){
                           echo '<li class="text-white text-[14px] transition-all duration-500 mt-1 h-6 w-8 rounded rounded-[4PX] gap-10 bg-blue-600 hover:bg-black"><a href="allorder.php?page='.($page-1).'" title="Previous">Prev</a></li>';
                       }
                       for($i=1;$i<=$Total_page;$i++){
                           if($i==$page){
                               $active='bg-blue-800';
                           }else{
                               $active='';
                           }
                       echo '<li class="'.$active.' text-white transition-all duration-500 mt-1 h-6 w-8 rounded rounded-[4PX] bg-blue-700 hover:bg-black"><a href="allorder.php?page='.$i.'" title="Page">'.$i.'</a></li>';
                       }
                       if($Total_page>$page){
                           echo '<li class="text-white text-[14px] transition-all duration-500 mt-1 h-6 w-8 rounded rounded-[4PX] gap-10 bg-blue-700 hover:bg-black"><a href="allorder.php?page='.($page+1).'" title="Next">Next</a></li>';
                       }
                        ?>
                   </ul>
               </div>


</div>
  </div>
</body>
</html>
