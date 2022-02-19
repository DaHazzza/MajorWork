<div class=" title">
      <h1>REGISTER AS SUB</h1>
      <?php 
      if(isset($_GET["state"])){
        $state = $_GET["state"];
          if ($state == "confirmReg"){
              echo"<a class='success'> Successfully Became A Sub</a>";
          } elseif($state == "loginerr"){
            echo"<a class='error'> Login Error</a>";
          } elseif($state == "confirmRes"){
            echo"<a class='success'> Successfully Resigned</a>";}
      }
      ?>
  </div>

  <div class="container">
    <div class="center">
    <a href="includes/registerSub.php" style="color:white;">
      <button class="subBut">Become a Sub</button>
    </a>
    <a href="includes/resignSub.php" style="color:white;">
      <button class="subBut" type="submit" href='registerSub.php'>Leave Sub</button>
    </a>
    </div>
  </div>

