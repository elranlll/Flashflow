<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
body {
  font-family: Arial, sans-serif;
  margin: 0; 
  background-color: #CAF4FF;
   }
   
   nav {
  background-color: #3559E0;
  color: white;
  overflow: hidden;
  padding: 10px;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 100px; /* Fixed height for the navbar */
}

.logo {
  height: 150px;
  width: 150px; /* Auto width to maintain aspect ratio */
}

.name{
  font-size: 30px;
  color: black;
  cursor: pointer; 
  top: 1px;
  font-family: "Playfair Display", serif;
  }

.search{
    display: flex;
    height: 35px;
    margin: auto 0;
    line-height: 35px;
}
.search input{
    border: none;
    outline: none;
    background: white;
    height: 100%;
    padding: 0 5px;
    font-size: 35px;
    width: 500px;
    margin-left: 20px;
}


ul {
  list-style: none; 
  padding: 0; 
  margin: 0; 
 
  }
   
li {
  display: inline-block; 
  margin-right: 20px; 
  font-family: "Playfair Display", serif;
  font-size: 20px;
  }

  a {
  text-decoration: none; 
  color: inherit; 
  font-weight: bold; 
  }
   
  a:hover {
  color: #ccc; 
  }
  .about{
    text-align: center;
    margin-bottom: 30px;
    left: 1000px;
}
.about h1{
  text-align: center;
  color: black;
  font-family: "Playfair Display", serif;
  font-size: 45px;
}
.container{
  width: 90%;
  margin: 0 auto;
  padding: 20px 40px;
  }

  .abt{
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  }

  .abt-img{
  flex: 1;
  margin-right: 40px;
  overflow: hidden;
  border-radius: 10%;
  border: 1px solid black;
  width: 300px;
  }

  img{
    height: 50%;
 }

 .abt-img img{
  max-width: 100%;
  height: auto;
  display: block;
  transition: .5s ease;
  }
  

  .content{
    flex: 1;
    }   
  .content h2{
    font-size: 25px;
    margin-bottom: 20px;
    text-align: center;
    font-family: "Playfair Display", serif;
    }

  .about h1{
        font-size: 50px;
        margin-bottom: 25px;
        height: 10vh;
        justify-content: center;
        align-items: center;
        text-align: center;
        display: flex;
        
        
    }
  .content p{
  font-size: 20px;
  line-height: 1.5;
  margin: auto;
  border: 2px solid black;
  border-radius: 20px;
  background-color: #A0DEFF;
  text-align: center;
  padding: 10px;
  font-family: "Playfair Display", serif;
  font-weight: bold;
    }

  .content .socmed{
    display: inline-block;
    padding: 10px 20px;
    font-size: 23px;
    border-radius: 25px;
    margin-top: 15px;
    transition: 0.3s ease;
    font-family: "Playfair Display", serif;
        
     }
  .content .socmed:hover{
    background-color: #5AB2FF;
    color: #FFF9D0;
    font-family: "Playfair Display", serif;
     }
     .f11{
      font-family: "Playfair Display", serif;
     }
  </style>
<body>
    <header>
    <nav><table><tr>
<td> 
  <div class = logo style="float:left">
  <a href="homepage.php">
  <img class="logo" src="images/Flash.png" alt="Logo"></a>
 </div> 
</td>

<td>
<div class = "name" style="float:left">
</div><h1 class="f11">FlashFlow</h1>  
</div></td>

</table>
 <ul>
  <li style="float:right"><a href="homepage.php">Home</a></li>
 </ul>
  </nav>
    </header>
    <div class="about">
        <h1>About the Developers</h1>
        <br>
    </div>
    <div class="container">
        <section class="abt">
          <div class="abt-img">
            <img src="images/elranchito.jpg">
          </div>
          <div class="content">
            <h2>Elranchito P. De Leon III</h2>
            <p>Hello, I'm Elranchito P. De Leon III. I was born at March 23, 2004. I am a hardworking individual with patience and strength. I like video editing and playing games. I'm a well-rounded, hardworking, passionate, and a critical thinker person.</p>
            <a href="https://www.facebook.com/elranchitodeleon23" class="socmed">Visit Profile</a>
          </div>
        </section>
        <br>
        <section class="abt">
          <div class="abt-img">
            <img src="images/louie.jpg">
          </div>
          <div class="content">
            <h2>Louie John Andrie N. Gaurana</h2>
            <p>Hello, I'm Louie John Andrie N. Gaurana, I was born at October 10, 2004. I am a student that is still enhancing his skill especially when it comes to school works. I like reading detective and mystery stories. My favorite sport are badminton and cycling. I like listening to music and making one too. I really like to read books that is fictional and self-helf books. I also like to play games like Honkai Star Rail and Mobile Legends.</p>
            <a href="https://www.facebook.com/lennoxvincenzo" class="socmed">Visit Profile</a>
          </div>
        </section>
    </div>
</body>
</html>