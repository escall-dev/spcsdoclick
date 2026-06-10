<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDO CLICK PORTAL</title>
  <link rel="icon" href="sdoclickassets/SDO Sanpedro Logo.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">
  <style>
  
    /* Import Hammersmith One */
    @import url('https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap');
    
    :root {
      --primary-blue: #1b4a9a;
      --card-radius: 30px;
      --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
      margin: 0;
      padding: 0;
      background: #ffffff;
      font-family: 'Outfit', sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      overflow-x: hidden;
    }

    header {
      padding: 40px 60px;
      display: flex;
      align-items: flex-start;
    }

    .back-btn {
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      display: flex;
      align-items: center;
      transition: transform 0.2s ease;
      margin-bottom: 25px;
    }

    .back-btn:hover {
      transform: scale(1.02);
    }

    .back-btn img {
      height: 120px; /* Adjust based on original png size */
      width: auto;
    }

    main {
      flex: 1;
      padding: 30px 50px 0px 50px;
      display: flex;
      gap: 20px;
      justify-content: center;
      align-items: stretch;
    }

    /* Side Column */
    .sidebar {
      width: 200px;
      display: flex;
      flex-direction: column;
    }

    /* Main Grid */
    .apps-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-auto-rows: 1fr;
      gap: 15px;
      flex: 1;
      max-width: 900px;
    }

    /* Unified Card Style */
    .app-card {
      background: var(--primary-blue);
      border-radius: var(--card-radius);
      color: white;
      text-decoration: none;
      display: flex;
      flex-direction: column;
      align-items: bottom;
      justify-content: flex-end;
      padding: 30px;
      text-align: left;
      transition: var(--transition);
      cursor: pointer;
      border: none;
      min-height: 180px;
      position: relative; /* IMPORTANT */
    }

    .app-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px rgba(27, 78, 160, 0.3);
      filter: brightness(1.1);
    }
    /* Tooltip */
    .app-card:hover::after {
      content: attr(data-name);
      position: absolute;
      bottom: 10px;
      left: 50%;
      transform: translateX(-50%);
      background: white;
      color:black;
      padding: 2px 6px;
      border-radius: 8px;
      box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
      font-size: 12px;
      white-space: nowrap;
      opacity: 80%;
      pointer-events: none;
    }

    /* ICT Helpdesk Sidebar Card (Tall) */
    .sidebar .app-card {
      height: 100%;
      min-height: 380px;
      justify-content: flex-end; /* Labels at bottom like image */
      padding: 30px;
    }

    .app-card img {
      width: clamp(40px, 7.5vw, 60px);
      height: clamp(40px, 7.5vw, 60px);
      margin-bottom: 30px;
      transition: var(--transition);
    }

    /* Larger icon for sidebar */
    .sidebar .app-card img {
      width: 70px;
      margin-bottom: 10px;
    }

    .app-card .label {
      font-family: 'Hammersmith One', sans-serif;
      font-size: 1.4rem;
      font-weight: 700;
      line-height: 1.2;
    }

    /* Sidebar Label Styling */
    .sidebar .label {
      font-family: 'Hammersmith One', sans-serif;
      text-align: left;
      width: 100%;
      padding-left: 0px;
      font-size: 1.6rem;
    }

    footer {
      text-align: center;
      padding: 10px 0;
      color: #333;
      font-size: 0.9rem;
      font-weight: 500;
    }

    footer p {
      margin: 4px 0;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
      .apps-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      header, main {
        padding-left: 30px;
        padding-right: 30px;
      }
    }

    @media (max-width: 800px) {
      main {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
      }
      .sidebar .app-card {
        min-height: 100px;
        flex-direction: row;
        gap: 10px;
        justify-content: center;
        padding-bottom: 30px;
      }
      .app-card {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
      text-align: center;
      min-height: 100px;
    }
      
    .app-card img {
      width: clamp(40px, 7.5vw, 60px);
      height: clamp(40px, 7.5vw, 60px);
      margin-bottom: 10px;
      margin-right:20px;
    }
      .sidebar .label {
        text-align: center;
        padding-left: 0;
      }
      .apps-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 480px) {
      .apps-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <main>
    <div class="sidebar">
      <button class="back-btn" onclick="goBack()" aria-label="Back to SDO Click page">
        <img src="sdoclickassets/sdoclickportal.png" alt="SDO Click Portal Logo">
      </button>
      <!-- Side Column -->
      <button class="app-card" onclick="openApp('https://wfh-sdospc.com/ICTHelpdesk-Online/login.php')" data-name="ICT Helpdesk">
        <img src="sdoclickassets/ict_helpdesk.png" alt="ICT Helpdesk">
        <div class="label">ICT<br>Helpdesk</div>
      </button>
    </div>

    <!-- Main Grid -->
    <div class="apps-grid">
      <!-- Row 1 -->
      <button class="app-card" onclick="openApp('https://spcsdoclick.com/comingSoon.php')" data-name="Electronic Leave Application (Form 6)">
        <img src="sdoclickassets/ELEAVE.png" alt="E-Leave">
        <div class="label">E-Leave</div>
      </button>

      <button class="app-card" onclick="openApp('https://spcsdoclick.com/comingSoon.php')" data-name="Authority to Travel, Locator & Pass slip Approval System">
        <img src="sdoclickassets/ALPAS.png" alt="ALPAS" Style="width: 50px;">
        <div class="label">ALPAS</div>
      </button>

      <button class="app-card" onclick="openApp('https://spcsdoclick.com/comingSoon.php')" data-name="Recruitment Selection and Placement">
        <img src="sdoclickassets/RSP.png" alt="RSP">
        <div class="label">RSP</div>
      </button>

      <button class="app-card" onclick="openApp('https://spcsdoclick.com/comingSoon.php')" data-name="Learning and Development Tracking System">
        <img src="sdoclickassets/L&D_PASSBOOK.png" alt="L&D">
        <div class="label">L&D</div>
      </button>

      <!-- Row 2 -->
      <button class="app-card" onclick="openApp('https://wfh-sdospc.com/csm-online/csm.php')" data-name="Client Satisfaction Measurement">
        <img src="sdoclickassets/csm.png" alt="CSM" Style="height: 50px;">
        <div class="label">CSM</div>
      </button>

      <button class="app-card" onclick="openApp('https://spcsdoclick.com/CTS/index')" data-name="Complaint Tracking System">
        <img src="sdoclickassets/CTS.png" alt="CTS">
        <div class="label">CTS</div>
      </button>

      <button class="app-card" onclick="openApp('https://depedsanpedrocitydts.com/')" data-name="Document Tracking System">
        <img src="sdoclickassets/dts.png" alt="DTS" Style="width: 50px;">
        <div class="label">DTS</div>
      </button>
      
      <button class="app-card" onclick="openApp('https://spcsdoclick.com/BACTrack/admin/landing.php')" data-name="Procurement Tracking">
        <img src="sdoclickassets/BACtrack.png" alt="BACTrack" Style="width: 50px;">
        <div class="label">BACTrack</div>
      </button>

      <button class="app-card" onclick="openApp('https://spcsdoclick.com/comingSoon.php')" data-name="Daily Time Record Checking">
        <img src="sdoclickassets/dtr.png" alt="DTR Checking" Style="margin-bottom: 10px;">
        <div class="label">DTR<br>Checking</div>
      </button>
      
    </div>
  </main>

  <footer>
    <p><strong>© Schools Division Office of San Pedro City - ICT Unit 2026</strong></p>
  </footer>
  
  <script>
    // Preload & Play Sound
    const clickSound = new Audio("sdoclickassets/click_sound.m4a");
    function playClick() {
      clickSound.currentTime = 0;
      clickSound.play();
    }

    function goBack() {
      playClick();
      setTimeout(() => {
        window.location.href = "index.php";
      }, 150);
    }

    function openApp(url) {
      playClick();
      setTimeout(() => {
        window.open(url, "_blank");
      }, 100);
    }

    // Security measures
    document.addEventListener("contextmenu", e => e.preventDefault());
    document.addEventListener("keydown", e => {
      if (e.ctrlKey && ["u","s","U","S"].includes(e.key)) e.preventDefault();
      if (e.key === "F12" || (e.ctrlKey && e.shiftKey && e.key === "I")) e.preventDefault();
    });
  </script>
</body>
</html>
