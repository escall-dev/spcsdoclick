<?php
// coming-soon.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coming Soon</title>
    <link rel="icon" href="sdoclickassets/SDO Sanpedro Logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {margin: 0;padding: 0;box-sizing: border-box;}
        body {height: 100vh;background: url('sdoclickassets/Coming Soon.png') no-repeat center center;background-size: cover;
            display: flex;align-items: flex-end;justify-content: center;padding-bottom: 40px;font-family: Arial, sans-serif;}
        .overlay {text-align: center;}
        .back-btn {display: inline-block;width: 220px;height: 70px;background: url('sdoclickassets/sdoClicku.png') no-repeat center center; margin-top:20px;
            background-size: contain;text-decoration: none;cursor: pointer;transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius:10px;}
        .back-btn:hover {transform: scale(1.08);box-shadow: 0 6px 15px rgba(0,0,0,0.35);}
    </style>
  <script>
  // Preload the sound
  const clickSound = new Audio("sdoclickassets/click_sound.m4a");

  function playClick() {
    clickSound.currentTime = 0; // restart sound for fast clicks
    clickSound.play();
  }
    function goBack() {
    playClick(); // play sound first
    setTimeout(() => {
      window.location.href = "https://spcsdoclick.com/home.php";
    }, 150); // delay so sound plays
    }
  </script>
</head>
<body>
    <div class="overlay" >
        <a class="back-btn"
           aria-label="Go Back"  onclick="goBack()" ></a>
    </div>
</body>
</html>
