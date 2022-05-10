<?php 
    session_start();
?>
<ul class="navBarUl">
    <img class="navBarIcon" src="images/navMenuIcon.PNG">
    <img class="navBarGif"  src="images/navMenuGif.gif">
    <li class="navBarLi"><a href="index.php">Home</a></li>
    <li class="navBarLi"><a href="teams.php">Teams</a></li>
    <li class="navBarLi"><a href="Substitute.php">Substitutes</a></li>

    <?php 
    if (isset($_SESSION["userID"])){
        echo'   
        <li class="navBarLi"><a href="contact.asp">Submit Scores</a></li>
        <li class="navBarLi"><a href="contact.asp">Schedule Game</a></li>
        <li class="navBarLi"><a href="createTeam.php">Create A Team</a></li>
        
        <li class="navBarLi" style="float: right;"><a href="profilePage.php">'.$_SESSION["username"].'</a></li>';
        
    }else{
        echo'<li class="navBarLi" style="float: right;"><a href="signup.php">Register</a></li>';  
        echo' <li class="navBarLi" style="float: right;"><a href="login.php">Log In</a></li>';
    }
    ?>
</ul>


