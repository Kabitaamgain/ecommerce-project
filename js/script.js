var a=document.getElementById('lgn');
var b=document.getElementById('rgst');
var c=document.getElementById('frm');
var d=document.getElementById('icn');
var e=document.getElementById('drp');
var search=document.getElementById('srch');
function display(){
    c.style.display='block';
}
function hide() {
    c.style.display='none';
}
function login() {
    b.style.display='none';
    a.style.display='block';
}
function register(){
    b.style.display='block';
    a.style.display='none';
}
function dropdown(){
    e.style.display='block';
}
function drphide(){
    e.style.display='none';
}
function srchshow(){
  search.style.display='block';
}
function srchhide(){
  search.style.display='none';
}

function rating(){
   let r= document.getElementsByClassName("fa fa-star");

}
    
// function registerformvalidation() {
//     // Get the form inputs
//     var username = document.getElementById("uname").value;
//     var email = document.getElementById("eml").value;
//     var phone = document.getElementById("phn").value;
//     var password = document.getElementById("pass").value;
//     var confirmPassword = document.getElementById("cpass").value;
  
//     // Check if all required fields are filled
//     if (!username || !email || !phone || !password || !confirmPassword) {
//       alert("Please fill in all required fields.");
//       return false;
//     }
  
//   //name contains leeters only
//     var nameRegex = /^[A-Za-z]+$/;
//     if (!nameRegex.test(username)) {
//       alert("Name should only contain letters.");
//       return false;
//     }
//       // Name should contain at least 3 letters
//       if (username.length < 3) {
//         alert("Name should have at least 3 letters.");
//         return false;
//       }

//     // Validate email format
//     var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
//     if (!emailRegex.test(email)) {
//         alert("Please enter a valid email address.");
//         return false;
//     }
    
//     if (phone.length !== 10) {
//       alert("Please enter a valid phone number.");
//       return false;
//     }
  
//     //validate password length
//     if (password.length < 6) {
//       alert("Password should have a minimum length of 6 characters.");
//       return false;
//     }

//     // Confirm password match
//     if (password !== confirmPassword) {
//       alert("Passwords do not match.");
//       return false;
//     }
  
//     return true;
//   }
    

// function adduservalidation(){
//   var username = document.getElementById("uname").value;
//   var email = document.getElementById("eml").value;
//   var phone = document.getElementById("phn").value;
//   var password = document.getElementById("pass").value;

//   var nameRegex = /^[A-Za-z]+$/;
//     if (!nameRegex.test(username)) {
//       alert("Name should only contain letters.");
//       return false;
//     }
//       // Name should contain at least 3 letters
//       if (username.length < 3) {
//         alert("Name should have at least 3 letters.");
//         return false;
//       }

//     var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     if (!emailRegex.test(email)) {
//       alert("Please enter a valid email address.");
//       return false;
//     }
    
//     if (phone.length !== 10) {
//       alert("Please enter a valid phone number.");
//       return false;
//     }
//     if (password.length < 6) {
//       alert("Password should have a minimum length of 6 characters.");
//       return false;
//     }


// }





   
//    function formvalidation() {
//     var username = document.getElementById("uname").value;
//     var email = document.getElementById("eml").value;
//     var phone = document.getElementById("phn").value;

//     // Name should only contain letters
//     var nameRegex = /^[A-Za-z]+$/;
//     if (!nameRegex.test(username)) {
//       alert("Name should only contain letters.");
//       return false;
//     }
//       // Name should contain at least 3 letters
//     if (username.length < 3) {
//       alert("Name should have at least 3 letters.");
//       return false;
//     }

//     // Validate email format
//     var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     if (!emailRegex.test(email)) {
//       alert("Please enter a valid email address.");
//       return false;
//     }

//     // Validate phone number length
//     if (phone.length !== 10) {
//       alert("Please enter a valid 10-digit phone number.");
//       return false;
//     }
//   }