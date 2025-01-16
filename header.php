
  <a class="logo" href="index.php">
    <img src="images/DISPEL.jpg" alt="DISPEL Logo">
  </a>
  <nav class="navibar">
    <ul>
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

