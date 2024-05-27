
<!DOCTYPE html>
<html>
<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

  <title>Welcome</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      min-height: 100vh; /* Full height of the viewport */
      display: flex;
      flex-direction: column;
      justify-content: center; /* Center the content vertically */
      align-items: center; /* Center the content horizontally */
      background-color: lightgreen;
      background-image: url(Images/back1.jpg);
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      margin: 0; /* Remove default margin */
      color: white;
    }

    .flashflow {
      font-size: 60px;
      color: whitesmoke;
      font-family: "Playfair Display", serif;
      margin-bottom: 20px;
    }

    .content {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .columns {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      width: 80%;
      max-width: 1200px;
      margin: 0 auto;
      font-family: "Kalam", cursive;
    }

    .column {
      flex: 1;
      padding: 20px;
      box-sizing: border-box;
      font-size: 18px;
      text-align: left;
    }

    .button-container {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%; /* Full width of the parent */
      margin-top: 40px;
    }

    .animated-button {
      position: relative;
      display: flex;
      align-items: center;
      gap: 4px;
      padding: 16px 36px;
      border: 4px solid transparent;
      font-size: 16px;
      background-color: inherit;
      border-radius: 100px;
      font-weight: 600;
      color: greenyellow;
      box-shadow: 0 0 0 2px greenyellow;
      cursor: pointer;
      overflow: hidden;
      transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
      text-decoration: none; /* Remove underline from the link */
    }

    .animated-button svg {
      position: absolute;
      width: 24px;
      fill: greenyellow;
      z-index: 9;
      transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .animated-button .arr-1 {
      right: 16px;
    }

    .animated-button .arr-2 {
      left: -25%;
    }

    .animated-button .circle {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 20px;
      height: 20px;
      background-color: greenyellow;
      border-radius: 50%;
      opacity: 0;
      transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .animated-button .text {
      position: relative;
      z-index: 1;
      transform: translateX(-12px);
      transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .animated-button:hover {
      box-shadow: 0 0 0 12px transparent;
      color: #212121;
      border-radius: 12px;
    }

    .animated-button:hover .arr-1 {
      right: -25%;
    }

    .animated-button:hover .arr-2 {
      left: 16px;
    }

    .animated-button:hover .text {
      transform: translateX(12px);
    }

    .animated-button:hover svg {
      fill: #212121;
    }

    .animated-button:active {
      scale: 0.95;
      box-shadow: 0 0 0 4px greenyellow;
    }

    .animated-button:hover .circle {
      width: 220px;
      height: 220px;
      opacity: 1;
    }
  </style>
</head>
<body>
  <div class="content">
    <h1 class="flashflow">FlashFlow</h1>
    <div class="columns">
      <div class="column">
        <p>**Comprehensive Learning Platform:** Effortlessly create, organize, and review flashcards across a variety of subjects. Flashflow streamlines your learning process with ease.</p>
        <p>**Tailored Review Modes:** Choose from multiple review modes like flipcard, identification, and multiple-choice to match your unique learning style.</p>
        <p>**Advanced Search & Tagging:** Navigate through your flashcards effortlessly with robust search and tagging capabilities.</p>
      </div>
      <div class="column">
        <p>**Customizable Management Features:** Personalize your study experience by managing flashcard sets, adding hints, and modifying card details to suit your needs.</p>
        <p>**Insightful Progress Tracking:** Track your learning progress with our scoring system, view your performance history, and pinpoint areas for improvement.</p>
        <p>**Intuitive User Interface:** Enjoy a seamless experience when inputting and organizing your flashcard data, including text, images, and other file formats.</p>
      </div>
    </div>
    <div class="button-container">
      <a href="login_register.php" class="animated-button">
        <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
          <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
        </svg>
        <span class="text">Get Started</span>
        <span class="circle"></span>
        <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
          <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
        </svg>
      </a>
    </div>
  </div>
</body>
</html>
