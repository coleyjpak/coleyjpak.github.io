<!-- KIT VIEW -->

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>View Kit - The Splatabase</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    
    <body>
        <div class="container-lg cont-main">
            
            <?php
            // excluded for.. obvious reasons. Replace with info for an actual database in order to make site function.
            $servername = "";
            $username = "";
            $password = "";
            $dbname = "";

            if(array_key_exists("kit", $_GET)) {
                $kit = $_GET['kit'];
                if($kit == "") {
                    die("<p>How did you get here?</p><p><a href='javascript:history.back()'>Go back</a> or <a href='index'>return home</a></p>");
                }
            } else {
                die("<p>How did you get here?</p><p><a href='javascript:history.back()'>Go back</a> or <a href='index'>return home</a></p>");
            }

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn)
                die("<p>Connection failed: " . mysqli_connect_error() . "</p><p><a href='javascript:history.back()'>Go back</a> or <a href='index'>return home</a></p>");

            if(array_key_exists("user", $_GET)) {
                if (mysqli_query($conn, "insert into Favorite (Username, KitID) values ('" . $_GET["user"] . "', " . $kit . ")"))
                    echo "<p>Success! This kit was marked as a favorite for " . $_GET["user"] . ".</p>";
                else
                    echo "<p>Error marking kit as favorite: " . mysqli_error($conn) . "</p>";
            }


            if ($result = mysqli_query($conn, "select KitName, Image, MainName, MainID, Class, Weight, SubName, SpecName, Kit.SDName, Percent from Kit natural join MainWpn natural join SubWpn natural join SpecialWpn natural join SpecDep where KitID = " . $kit)) {
                
                if($row = mysqli_fetch_assoc($result)) {
                    $name = $row['KitName'];
                    echo "<h1>" . $name . "</h1>";
                    echo "<img src='" . $row['Image'] . "'>";
                    echo "<p>The <b>" . $name . "</b> is a <b>" . $row['Class'] . "</b>-class, <b>" . $row['Weight'] . "</b>-speed type weapon. ";
                    if ($row['Weight'] == "Slow") {
                        echo "<i>(Using a weapon with a slow speed type decreases your swimming speed by 10%.)</i>";
                    }
                    echo "</p>";
                    echo "<p>It has a <b>" . $row['SDName'] . "</b> special depletion rate, losing <b>" . $row['Percent'] . "%</b> of progress towards special upon being splatted.</p>";
                    echo "<p>The kit consists of the <b>" . $row['MainName'] . "</b> main weapon, <b>" . $row['SubName'] . "</b> sub weapon and <b>" . $row['SpecName'] . "</b> special weapon.</p>";
                    
                    $stat1 = 'Range';
                    switch ($row['Class']) {
                        case 'Shooter':
                            $stat2 = 'Damage';
                            $stat3 = 'Fire Rate';
                            $stats = mysqli_query($conn, "select ShotRange, ShotDamage, ShotFireRate from MainStats where MainID = " . $row['MainID']);
                            break;
                        case 'Blaster':
                            $stat2 = 'Impact';
                            $stat3 = 'Fire Rate';
                            $stats = mysqli_query($conn, "select BlstRange, Impact, BlstFireRate from MainStats where MainID = " . $row['MainID']);
                            break;
                        case 'Roller':
                            $stat2 = 'Ink Speed';
                            $stat3 = 'Handling';
                            $stats = mysqli_query($conn, "select RollRange, RollInkSpeed, RollHandling from MainStats where MainID = " . $row['MainID']);
                            break;
                        case 'Brush':
                            $stat2 = 'Ink Speed';
                            $stat3 = 'Handling';
                            $stats = mysqli_query($conn, "select BrshRange, BrshInkSpeed, BrshHandling from MainStats where MainID = " . $row['MainID']);
                            break;
                        case 'Charger':
                            $stat2 = 'Charge Speed';
                            $stat3 = 'Mobility';
                            $stats = mysqli_query($conn, "select ChgrRange, ChgrChargeSpeed, ChgrMobility from MainStats where MainID = " . $row['MainID']);
                            break;
                        case 'Splatling':
                            $stat2 = 'Charge Speed';
                            $stat3 = 'Mobility';
                            $stats = mysqli_query($conn, "select SplgRange, SplgChargeSpeed, SplgMobility from MainStats where MainID = " . $row['MainID']);
                            break;
                        case 'Slosher':
                            $stat2 = 'Damage';
                            $stat3 = 'Handling';
                            $stats = mysqli_query($conn, "select SlshRange, SlshDamage, SlshHandling from MainStats where MainID = " . $row['MainID']);
                            break;
                    }

                    $statsrow = array_values(mysqli_fetch_assoc($stats));
                    echo "<h2>Main Weapon Stats</h2>
                        <p>The " . $row['MainName'] . " main weapon has the following displayed stats in-game:</p>
                        <p>" . $stat1 . "</p>
                        <div class='statbar'>
                            <div class='statbar-text'>" . $statsrow[0]. " / 100</div>
                            <div class='statbar-fill' style='width:" . $statsrow[0] . "%'></div>
                        </div>
                        <p>" . $stat2 . "</p>
                        <div class='statbar'>
                            <div class='statbar-text'>" . $statsrow[1]. " / 100</div>
                            <div class='statbar-fill' style='width:" . $statsrow[1] . "%'></div>
                        </div>
                        <p>" . $stat3 . "</p>
                        <div class='statbar'>
                            <div class='statbar-text'>" . $statsrow[2]. " / 100</div>
                            <div class='statbar-fill' style='width:" . $statsrow[2] . "%'></div>
                        </div>";
                    
                    
                    ?>
                    <h2>Add as Favorite</h2>
                    <p><i>Was this a main of yours back in the day? Enter your username in the left input field to mark this kit as a favorite. (Ignore the right field - it just passes in the kit's ID.)</i></p>
                    <form method="GET" action="kit.php?kit=0">
                        <input size="30" name="user" type="text"placeholder="Your username...">
                        <input size="10" name="kit" type="text" value=<?php echo $kit?> readonly>
                        <input value="Submit" type="submit">
                    </form>
                    <?php

                } else {
                    echo "<p>Weapon with this ID not found - were you trying to guess?</p>";
                }

                mysqli_free_result($result);
                    
            } else {
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }

            mysqli_close($conn);
            
            echo "<hr><p><a href='javascript:history.back()'>Go back</a> or <a href='index'>return home</a></p>";

            ?>
        </div>
    </body>
</html>