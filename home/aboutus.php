<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
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
</head>
<body class="bg-primary">
<div class="sticky top-0 bg-primary">
  <nav class="flex justify-between shadow-md  text-lg">
    <ul class="flex gap-16 py-5 font-semibold container">
      <li class="hover:text-secondary"><a href="index.php">Home</a></li>
      <li class="hover:text-secondary"><a href="aboutus.php">About</a></li>
      <li class="hover:text-secondary"><a href="#">Contact</a></li>
      <!-- <li class="hover:text-secondary" onclick="display()"><a href="#">Account</a></li> -->
      <li class="flex">
        <a href="../userpanel/cart.php">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
</svg>
</a>

  </li>

    </ul>

   
    <form action="../userpanel/search.php" method="GET" class="flex my-5 mr-4 py-1 px-3 rounded-2xl border border-black bg-white">
  <input type="search" placeholder="Search" name="search" class="focus:outline-none" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"> 
  <button type="submit"><i class="fa-solid fa-magnifying-glass py-1"></i></button>
</form>

  </nav>
</div>
<section id="aboutus" >
      <div class="mx-auto container flex gap-10  justify-center pt-10">
        <div class="w-1/2  pt-10">
          <h class="text-4xl fond-bold pt-6 mb-5 ">About Us</h>
          <p class="text-xl pt-4 ">Our shoe store, establisded in 2023, provides the best shoe products  to satisfy the customers.Our store becomes 
            the benchmark for trust and best quality design shoes inside chitawan.We can provide the best quality, brands,sizes according to
            your needs in reasonable price.
            Our collection includes all catagories shoe brands for men,women and kids. 
            We continuously work to enhance our services and offer an even better shopping experience for you.
            Your feedback is essential to us. We appreciate hearing about your shopping experience, suggestions for improvement, and any other 
            comments you may have.
            feel free to email us and message us,we will provide our best to satisfy you.
          </p>
      </div>

      <div class="w-1/2  mt-20">
        <img src="../image/Banner.jpg" class="h-[350px]">
      </div>


      </div>
    </section>

    <!-- footer section -->
<footer class="bg-light text-center p-5 mt-10">
  <i class="fa-brands fa-facebook p-4"></i>
	<i class="fa-brands fa-instagram p-4"></i>
	<i class="fa-brands fa-twitter p-4"></i>
	<p class="text-white text-xl">copyright &copy2023 Kabita Amgain</p>
</body>
</html>

