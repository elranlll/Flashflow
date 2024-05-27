<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Account</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<style>
body {
  font-family: Arial, sans-serif;
  margin: 0; /* Remove default margin from body */
   }
   
nav {
  background-color: #333; /* Navigation bar background color */
  color: white; /* Text color for links */
  overflow: hidden; /* This is needed for responsive behavior */
  padding: 10px;
  width: 100%;
   /* Padding for navigation items */
  }
  
.logo{
  height: 60px;
  width: 75px;
  left: 3px;
  }

.name{
  font-size: 30px;
  color: black;
  cursor: pointer; 
  top: 1px;
  font-family: "Playfair Display", serif;
  }




ul {
  list-style: none; /* Remove default styling for list items */
  padding: 0; /* Remove default padding for list items */
  margin: 0; 
 /* Remove default margin for list items */
  }
   
li {
  display: inline-block; /* Display list items inline */
  margin-right: 20px; /* Add space between list items */
  }

  a {
  text-decoration: none; /* Remove underline from links */
  color: inherit; /* Inherit color from parent element (nav) */
  font-weight: bold; /* Make link text bold */
  }
   
  a:hover {
  color: #ccc; /* Change link color on hover */
  }
   


</style>
<body>

<nav><table><tr>
<td> <div class = logo style="float:left"><a href="homepage.php"><img class="logo" src="images/Flashflow.png" alt="Logo"></a> </div> </td>

<td><td><div class = "name" style="float:left"></div><h1>FlashFlow</h1>  </div></td></td>
</table>
 <ul>
 <li style="float:right"><a href="useracc.php">My Account</a></li>
 <li style="float:right"><a href="aboutus.php">About</a></li>
  <li style="float:right"><a href="homepage.php">Home</a></li>
 </ul>
  </nav>
</body>
</html>