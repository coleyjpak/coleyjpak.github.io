<!-- INDEX -->
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>The Splatabase</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <div class="titlediv">
            <h1>The Splatabase</h1>
            <p><i>A database of all weapons in Splatoon</i></p>
            <p>By <b>Cole, Mikyas, Eunsang</b></p>
        </div>

        <div class="container-lg cont-main">
            <div class="row">
                
                <div class="col-lg-6">
                    <h2>Tables</h2>
                    <p><i>View every table in a vacuum for more context.</i></p>

                    <ol>
                        <li><a href="queryrun.php?query=select+*+from+Kit">Kit</a> - Kits</li>
                        <li><a href="https://css1.seattleu.edu/~cpak2/splatabase/queryrun.php?query=select+*+from+MainWpn">MainWpn</a> - Main Weapons</li>
                        <ol style="list-style-type:lower-roman"> 
                            <li><a href="queryrun.php?query=select+*+from+Shooter">Shooter</a> - Stats for weapons in Shooter Weapon Class</li>
                            <li><a href="queryrun.php?query=select+*+from+Blaster">Blaster</a> - Stats for weapons in Charger Weapon Class</li>
                            <li><a href="queryrun.php?query=select+*+from+Roller">Roller</a> - Stats for weapons in Roller Weapon Class</li>
                            <li><a href="queryrun.php?query=select+*+from+Brush">Brush</a> - Stats for weapons in Brush Weapon Class</li>
                            <li><a href="queryrun.php?query=select+*+from+Charger">Charger</a> - Stats for weapons in Charger Weapon Class</li>
                            <li><a href="queryrun.php?query=select+*+from+Splatling">Splatling</a> - Stats for weapons in Splatling Weapon Class</li>
                            <li><a href="queryrun.php?query=select+*+from+Slosher">Slosher</a> - Stats for weapons in Slosher Weapon Class</li>
                        </ol>
                        <li><a href="queryrun.php?query=select+*+from+SubWpn">SubWpn</a> - Sub Weapons</li>
                        <ol style="list-style-type:lower-roman">
                            <li><a href="queryrun.php?query=select+*+from+Bomb">Bomb</a> - Data for Bomb-type Sub Weapons</li>
                            <li><a href="queryrun.php?query=select+*+from+Placed">Placed</a> - Data for Placed Sub Weapons</li>
                            <li><a href="queryrun.php?query=select+*+from+Debuff">Debuff</a> - Data for Sub Weapons which Debuff opponents</li>
                        </ol>
                        <li><a href="queryrun.php?query=select+*+from+SpecialWpn">SpecialWpn</a> - Special Weapons</li>
                        <ol style="list-style-type:lower-roman">
                            <li><a href="queryrun.php?query=select+*+from+AreaEffect">AreaEffect</a> - Data for Area-of-Effect Special Weapons</li>
                            <li><a href="queryrun.php?query=select+*+from+Offense">Offense</a> - Data for Offensive Special Weapons</li>
                        </ol>
                        <li><a href="queryrun.php?query=select+*+from+SpecDep">SpecDep</a> - Special Depletion</li>
                        <li><a href="queryrun.php?query=select+*+from+Favorite">Favorite</a> - Favorited Kits</li>
                    </ol>
                </div>

                
                <div class="col-lg-6">
                    <h2>Relations</h2>
                    <p><i>All connections between tables, including views of weapons and their subtype tables.</i></p>

                    <ol>
                        <li><a href="queryrun.php?query=select+*+from+Favorite+natural+join+Kit+order+by+Username">Users and Favorited Kits</a> - join of tables Favorite, Kit</li>
                        <li><a href="queryrun.php?query=select+*+from+Kit+natural+join+MainWpn+natural+join+SubWpn+natural+join+SpecialWpn+natural+join+SpecDep+order+by+KitID">All Kits</a> - join of Kit, MainWpn, SubWpn, SpecialWpn, SpecDep</li>
                        <li><a href="queryrun.php?query=select+*+from+MainStats">All Main Weapon Stats</a> - join of MainWpn, Shooter, Blaster, Roller, Brush, Charger, Splatling, Slosher</li>
                        <li><a href="queryrun.php?query=select+*+from+SubStats">All Sub Weapon Stats</a> - join of SubWpn, Bomb, Placed, Debuff</li>
                        <li><a href="queryrun.php?query=select+*+from+SpecialStats">All Special Weapon Stats</a> - join of SpecialWpn, AreaEffect, Offense</li>
                    </ol>
                </div>
            
            </div>

            <hr>

            <h2>Queries</h2>
            <p><i>Sample queries to demonstrate the use of the database.</i></p>
            <ol>
                <li><b><a href="https://css1.seattleu.edu/~cpak2/splatabase/queryrun.php?query=select+SpecName+as+Special%2C+count%28SpecialID%29+as+%22Times+Favorited%22+from+Favorite+natural+join+Kit+natural+join+SpecialWpn+group+by+SpecialID+order+by+count%28SpecialID%29+DESC%3B">
                    Favorite Specials Leaderboard</a>: specials sorted by how many times they're in kits marked as favorites</b><br>
                    select SpecName as Special, count(SpecialID) as "Times Favorited" from Favorite natural join Kit natural join SpecialWpn group by SpecialID order by count(SpecialID) DESC;</li>
                    <br>
                <li><b><a href="https://css1.seattleu.edu/~cpak2/splatabase/queryrun.php?query=select+KitName%2C+count%28Kit.KitID%29+as+%22Times+Favorited%22+from+Favorite+left+outer+join+Kit+on+Favorite.KitID+%3D+Kit.KitID+group+by+KitName+having+count%28Favorite.KitID%29+%3E%3D+3+order+by+count%28KitID%29+DESC%3B">
                    All-Time Favorites</a>: Kits marked as favorite by at least three users</b><br>
                    select KitName, count(Kit.KitID) as "Times Favorited" from Favorite left outer join Kit on Favorite.KitID = Kit.KitID group by KitName having count(Favorite.KitID) >= 3 order by count(KitID) DESC;</li>
                    <br>
                <li><b><a href="https://css1.seattleu.edu/~cpak2/splatabase/queryrun.php?query=select+KitID%2C+KitName+from+%09%28select+KitID+from+Favorite+%09where+Username+%3D+%22Buhlooey%22%29+as+BuhlooFaves+%09natural+join+Kit%3B">
                    Developer's Choice</a>: Kits marked as favorite by user "Buhlooey" (Cole's username)</b><br>
                    select KitID, KitName from (select KitID from Favorite where Username = "Buhlooey") as BuhlooFaves natural join Kit;</li>
                    <br>
                <li><b><a href="https://css1.seattleu.edu/~cpak2/splatabase/queryrun.php?query=select+MainWpn.MainID%2C+MainName%2C+Weight%2C+RangeStat%2C+Damage%2C+FireRate+from+MainWpn+right+outer+join+Shooter+on+MainWpn.MainID+%3D+Shooter.MainID%3B">
                    All Shooters</a>: All Main Weapons that are shooters, accompanied by their stats</b><br>
                    select MainWpn.MainID, MainName, Weight, RangeStat, Damage, FireRate from MainWpn right outer join Shooter on MainWpn.MainID = Shooter.MainID;</li>
                    <br>
                <li><b><a href="https://css1.seattleu.edu/~cpak2/splatabase/queryrun.php?query=select+Kit.KitName+as+%22Kit+Name%22%2C+Image%2C+SubName+as+%22Sub+Weapon%22%2C+SpecName+as+%22Special+Weapon%22%2C+SDName+as+%22Special+Depletion%22+from+Kit+natural+join+MainWpn+natural+join+SubWpn+natural+join+SpecialWpn+natural+join+SpecDep+order+by+KitID%3B">
                    All Kits</a>: Every Kit as it appears in-game (Kit name, Sub Weapon name, Special Weapon name, and Special Depletion stat)</b><br>
                    select Kit.KitName as "Kit Name", Image, SubName as "Sub Weapon", SpecName as "Special Weapon", SDName as "Special Depletion" from Kit natural join MainWpn natural join SubWpn natural join SpecialWpn natural join SpecDep order by KitID;</li>
            </ol>

            <hr>

            <div class="row">
                <div class="col-lg-6">
                    <h2>Ad-hoc Query</h2>
                    <p><i>Provide any query of your own to be run by the server.</i></p>
                    <p><b>Please enter your query here:</b></p>
                    <form method="GET" action="queryrun.php">
                        <input size="30" name="query" type="text">
                        <input value="Submit" type="submit">
                    </form>
                </div>

                <div class="col-lg-6">
                    <h2>Kit Page Search</h2>
                    <p><i>Search for the name of a kit, or leave blank to search all kits. Select a kit from your search to see a profile page for that kit, where you can mark it as a favorite.</i></p>
                    <form method="GET" action="kitsearch.php">
                        <input size="30" name="searchterm" type="text">
                        <input value="Submit" type="submit">
                    </form>
                </div>
            </div>

            <hr>

            <div>
                <h2>Extra Functionalities</h2>
                <p><i>A quick list of extra stuff this site does beyond the main criteria. Grant extra credit as you see fit.</i></p>
                <ul>
                    <li>Images in tables</li>
                    <ul>
                        <li>Checks if the data is an image, and displays as an image element if so</li>
                    </ul>
                    <li>Section for queries for individual tables</li>
                    <li>Kit pages</li>
                    <ul>
                        <li>Pulls information about the kit and main weapon, and displays it neatly to the user</li>
                    </ul>
                    <li>Kit search function</li>
                    <li>Favorite Weapons function</li>
                    <ul>
                        <li>Extra PHP on Kit pages; runs a SQL query if a username is present in HTML GET parameters</li>
                    </ul>
                    <li>Extra CSS styling</li>
                    <ul>
                        <li>Banner header on home page</li>
                        <li>Use of Bootstrap CSS library for home page layout</li>
                        <li>Stat bars on Kit pages</li>
                        <li>Generally looks good</li>
                    </ul>

                </ul>
            </div>
            
            <div>
                <h2>Credits</h2>
                <p>Site by Cole Pak. Database design and SQL programming by Cole Pak, Mikyas Mezgebu, Eunsang Yu.</p>
                <p>The <i>Splatoon</i> game and IP are properties of Nintendo.</p>
                <p>Game data and images courtesy of <a href="https://splatoonwiki.org/wiki/Main_Page">Inkipedia, the Splatoon Wiki</a>.</p>
            </div>

        </div>
    </body>
</html>