<div class="hamburgerMenuContainer">
  <div class="hamburger line1"></div>
  <div class="hamburger line2"></div>
  <div class="hamburger line3"></div>
</div>
<a class="logo" href="index.php">
  <img src="images/DISPELS.jpg" alt="DISPEL Logo">
</a>
<nav class="navibar">
  <ul>
    <?php if (isset($_SESSION['userRoleId']) && $_SESSION['userRoleId'] == 1) {
    ?>
      <li><a href="index.php" class="<?php echo $currentPage === 'admin' ? 'active' : ''; ?>">Dashboard</a></li>
    <?php
    } ?>

    <li><a href="newsletter.php" class="<?php echo $currentPage === 'newsletter' ? 'active' : ''; ?>">Newsletter</a></li>
    <li><a href="playerreg.php" class="<?php echo $currentPage === 'playerreg' ? 'active' : ''; ?>">Players</a></li>
    <li><a href="teamreg.php" class="<?php echo $currentPage === 'teamreg' ? 'active' : ''; ?>">Teams</a></li>
    <li><a href="tournament.php" class="<?php echo $currentPage === 'tournament' ? 'active' : ''; ?>">Tournaments</a></li>
    <li><a href="match.php" class="<?php echo $currentPage === 'match' ? 'active' : ''; ?>">Matches</a></li>
  </ul>
</nav>
<div class="loginModule">
  <?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : 'Not Logged in'; ?><br>
  <?php if (!isset($_SESSION['userId'])) { ?>
    <a href="login.php"><i class="fa-solid fa-user btn"></i></a>
  <?php } elseif (isset($_SESSION['userId']) && $_SESSION['userRoleId'] == 0) { ?>
    <div class="logInOut">
      <a href="profile.php?id=<?php echo $_SESSION['userId'] ?>"><i class="fa-solid fa-user btn"></i></a>
      <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket btn"></i></a>
    </div>
  <?php } else { ?>
    <div class="logInOut">
      <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket btn"></i></a>
    </div>
  <?php } ?>
</div>
<script>
  // humburger menu
  const hamburgerMenuContainerTag = document.querySelector(
    ".hamburgerMenuContainer"
  );
  console.log(hamburgerMenuContainerTag);
  const naviBarTag = document.querySelector(".navibar");
  const hamburgerLine1Tag = document.querySelector(".line1");
  const hamburgerLine2Tag = document.querySelector(".line2");
  const hamburgerLine3Tag = document.querySelector(".line3");

  hamburgerMenuContainerTag.addEventListener("click", () => {
    if (hamburgerMenuContainerTag.classList.contains("isOpened")) {
      naviBarTag.style.display = "none";
      hamburgerLine2Tag.classList.remove("hideLine2");
      hamburgerLine1Tag.classList.remove("rotatePlus45Deg");
      hamburgerLine3Tag.classList.remove("rotateMinus45Deg");
      hamburgerMenuContainerTag.classList.remove("isOpened");
    } else {
      hamburgerLine2Tag.classList.add("hideLine2");
      hamburgerLine1Tag.classList.add("rotatePlus45Deg");
      hamburgerLine3Tag.classList.add("rotateMinus45Deg");
      hamburgerMenuContainerTag.classList.add("isOpened");
      naviBarTag.style.display = "flex";
    }
  });
</script>