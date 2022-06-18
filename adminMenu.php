<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="styleSheet.css">
<body style="margin:0%;"> 
    <?php
 include "includes/header.php";?> <!-- creates the Naviation Bar-->
</body>

<?php 
if(isset($_SESSION["username"]) != False){
    if($_SESSION['isAdmin'] == 0){
        header('Location: index.php');
        exit;  
    }
}else{
   header('Location: index.php');
    exit; 
}


?>

<body>
<div style="margin: 10%; margin-top: 50px;">
    <div>
        <h1 class="center">Admin Menu</h1>
        <br>
    </div>

    <button class="collapsible">Team/User Actions</button>
    <div class ="content">
        <form method="POST" action="includes/adminDeleteTeam.php" onsubmit="return confirm('Confirm');">
            <lable>Delete Team: </lable>
            <input type="text" placeholder="TeamID" name='TeamID'>
            <input type="submit" value="Delete Team" >
        </form>
        <form method="POST" action="includes/adminDeleteUser.php" onsubmit="return confirm('Confirm');">
            <lable>Delete User: </lable>
            <input type="text" placeholder="UserID" id='uid' name='UserID'>
            <input type="submit" value="Delete User" >
        </form>
    </div>

    <button class="collapsible">Match Generation</button>
    <div class ="content">
        <div style="width: 50%; margin: 0; float: left;">
            <h1 class='center'>Current Ougoing Matches</h1>
            <table style="width: 30%; margin-left: 25%;" >
            <tr>
                <th >Team 1</th>
                <th > </th>
                <th >Vs</th>
                <th > </th>
                <th >Team 2</th>
                <th >Time</th>
                <th >Match Page</th>
            </tr>
            <?php   
                $sql = "SELECT * FROM matches"; 

                if ($result = mysqli_query($conn, $sql)) {
                    while ($row = mysqli_fetch_array($result)) {
                        if($row[8] == 0){
                            $team1Info = getTeamInfo($conn, $row[1]);
                            $team2Info = getTeamInfo($conn, $row[2]);
                            echo '<tr> <td>';
                            echo "<a  class='center' style='color: black; text-decoration: none;' href='teamPage.php?id=".$row[1]."'>  " .$team1Info['teamName'].'  </a>';
                            echo '</td> <td>';
                            echo  '<img  class="center" src="teamLogos/'.$team1Info["teamLogo"].'" alt="Team Logo" width=40>';
                            echo '</td> <td>';
                            echo "<a class='center' style='color: black; text-decoration: none;' href='matchPage.php?id=".$row[0]."'>VS</a>" ;
                            echo '</td> <td >';
                            echo  '<img class="center" src="teamLogos/'.$team2Info["teamLogo"].'" alt="Team Logo" width=40>';
                            echo '</td> <td >';
                            echo "<a class='center' style='color: black; text-decoration: none;' href='teamPage.php?id=".$row[2]."'>  " .$team2Info['teamName'].'  </a>';
                            echo '</td> <td>';
                            if ($row[3] != null){
                                echo '<a class="center">'.date("M d Y H:i",$row[3] +( 3600*8)).'</a>';
                            }else{
                                echo'<a class="center">N/A </a>';
                            }
                                echo '</td> <td >';     
                                echo  '<a href="matchPage.php?id='.$row[0].'"><img class="center" src="images/matchLink.png" alt="Match Link" width=40 style="margin-left: 40%;"></a>';
                                echo '</td>  </tr>';
                        }
                    }
                }
            ?>
            </table>
        </div>
        <div style="float: right; width: 50%;">
            <form method="POST"  onsubmit="return confirm('Doing This Will Forefit any current outgoing matches');">
                <h1 class='center'>Generate Matches </h1>
                <input style='margin-left: 40%;' type="submit" value="Generate Matches" >
            </form>
        </div>
    </div>

</div>
    
</body>
<script>
var collapseElement = document.getElementsByClassName("collapsible"); //node List (list of elements)
var i;

for (i = 0; i < collapseElement.length; i++) { //for all elements
    collapseElement[i].addEventListener("click", function() { //listen for clicks
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>
</html>