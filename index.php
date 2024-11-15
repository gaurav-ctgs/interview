<?php
session_start();

// Reset the game

if(isset($_GET["reset"])){

    unset($_SESSION["type_of_bet"]);
    $_SESSION["amount"]=100;
    header("Location: index.php"); // Redirect to clear the reset query
    exit();
}

// Check if the form is submitted
if(isset($_POST["submit"])){

        $typeOfBet=$_POST["type_of_bet"];
    // Initialize session variables if not already set
        if(!isset($_SESSION["type_of_bet"])){

             $_SESSION["type_of_bet"]=$typeOfBet;
             $_SESSION["amount"]=100;

        }


        $amountTaken=10;

        $dice1=rand(1,6);
        $dice2=rand(1,6);

        $total=$dice1+$dice2;
        $winAmount=0;
    // Determine the win amount based on the bet type

        if($typeOfBet==="below7" && $total<7)
        {
            $winAmount=20;

        }elseif($typeOfBet==="above7" && $total>7){
            $winAmount=20;

        }elseif($typeOfBet==="equal7" && $total==7){
            $winAmount=30;
        }

        if ($_SESSION["amount"]>=10) {
            echo "pre balance". $_SESSION["amount"];
            echo "Amount==".$_SESSION["amount"];
            echo "amountTaken==".$amountTaken;
            echo "winAmount==".$winAmount;


            $newTotal=(($_SESSION["amount"]-$amountTaken)+$winAmount);
            unset($_SESSION["amount"]);
            $_SESSION["amount"]=$newTotal;

        }else{
            exit("Cant play the game");
        }

        
    echo "welcome to lucky 7 Game"."</br>";

   echo "place your Rs 10:"."</br>";

   echo "game results </br> Dice 1 :".$dice1 ." </br> dice 2: ".$dice2."</br>"."Total is :".$total;

   echo "</br>Congratulationa You win ! Your Balance is now  " .$_SESSION["amount"];
       // Unset all temporary variables at the end

   unset($typeOfBet, $amountTaken, $dice1, $dice2, $total, $winAmount,$newTotal);

}




?>

<html>
    <body>
        <form action="" method="POST">

        <select name="type_of_bet" >
            <option value="below7">below7</option>
            <option value="equal7">7</option>
            <option value="above7">above7</option>
        </select>

<input type="submit" name="submit" value="continue playing" />

</form>
<a href="index.php?reset=1">reset</a>
    </body>
</html>