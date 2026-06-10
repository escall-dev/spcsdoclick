<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SDO CLICK</title>
  <link rel="icon" href="sdoclickassets/SDO Sanpedro Logo.png" type="image/png" />
  <link href="https://fonts.googleapis.com/css?family=Hammersmith+One" rel="stylesheet">

  <style>
    /* Basic reset */
    * { box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
    html, body { height: 100%; }

    /* Typography & base sizing */
    :root{
      --bg: #ffffff;
      --muted: #555;
      --max-width: 980px;
      --page-padding: 1rem;
    }

    body {
      margin: 0;
      padding: 0;
      background: var(--bg);
      font-family: 'Hammersmith One', Arial, Helvetica, sans-serif;
      color: #111;
      text-align: center;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      /* responsive base font size */
      font-size: clamp(14px, 1.6vw, 18px);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 1.5rem;
      padding: clamp(1rem, 3vw, 3rem);
      width: 100%;
      max-width: var(--max-width);
      margin: 0 auto;
      flex: 1 0 auto; /* keep footer at bottom */
    }

    /* Logo and image handling */
    .logo-container {
      background: white;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
    }
    .logo-container img {
      width: 80%;
      max-width: 520px;
      height: auto;
      object-fit: contain;
      /* limit height on tall screens */
      max-height: 40vh;
    }

    /* Welcome text */
    .welcome {
      margin: 0;
      padding: 0;
      font-weight: bold;
      line-height: 1;
      /* responsive font-size */
      font-size: clamp(20px, 6vw, 40px);
      letter-spacing: 1px;
    }

    /* Button area */
    .button-container {
      background: white;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
    }

    .next-btn {
      background: none;
      border: none;
      cursor: pointer;
      padding: 0.5rem; /* increases tap target on mobile */
      border-radius: 12px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: transform 160ms ease, box-shadow 160ms ease;
    }
    .next-btn:active { transform: scale(0.98); }
    .next-btn:focus {
      outline: 3px solid rgba(0,0,0,0.12);
      outline-offset: 3px;
    }

    .next-btn img {
      display: block;
      width: clamp(64px, 18vw, 120px);
      max-width: 160px;
      height: auto;
      object-fit: contain;
      pointer-events: none; /* ensures the click is on the button */
    }

    footer {
      text-align: center;
      margin: 0;
      padding: 0.8rem 1rem;
      font-size: 0.9rem;
      color: var(--muted);
      flex-shrink: 0;
      background: transparent;
    }

    /* Layout tweaks for small devices */
    @media (max-width: 520px) {
      main { gap: 1rem; padding: 1rem; }
      .logo-container img { max-height: 28vh; width: 86%; }
      .welcome { font-size: clamp(18px, 8vw, 28px); }
      .next-btn { padding: 0.6rem; }
    }

    /* Landscape phones and small tablets */
    @media (min-width: 521px) and (max-width: 900px) {
      .logo-container img { max-height: 36vh; width: 78%; }
      .next-btn img { width: clamp(72px, 16vw, 140px); }
    }

    /* Reduce motion preference */
    @media (prefers-reduced-motion: reduce) {
      .next-btn { transition: none; }
    }
  </style>
<script>
  // Preload sounds
  const clickSound = new Audio("sdoclickassets/click_sound.m4a");
  const transitionSound = new Audio("sdoclickassets/transition_sound.m4a");

  function playClick() {
    clickSound.currentTime = 0;
    clickSound.play();
  }

  function goNext() {
    // Play click sound immediately
    playClick();

    // Then play transition sound
    setTimeout(() => {
      transitionSound.currentTime = 0;
      transitionSound.play();
    }, 120); // slight delay after click sound

    // Navigate to home.php after transition sound
    setTimeout(() => {
      window.location.href = "home.php";
    }, 120 + 600); 
    // adjust 600ms depending on the length of your transition sound
  }
</script>


</head>

<body>
  <main>
    <div class="logo-container" aria-hidden="false">
      <img src="sdoclickassets/sdoClicku.png" alt="SDO Click Logo" onclick="playClick()">
    </div>

    <p class="welcome">WELCOME</p>

    <div class="button-container">
      <button class="next-btn" onclick="goNext()" aria-label="Go to home page">
        <img src="sdoclickassets/next.png" alt="Next">
      </button>
    </div>
  </main>

  <footer>
    <p>© 2025 Schools Division Office – San Pedro City (ICT Unit)</p>
  </footer>
</body>
</html>
