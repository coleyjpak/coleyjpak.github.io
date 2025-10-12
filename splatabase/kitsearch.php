<!-- KIT SEARCH -->

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Run a query - The Splatabase</title>
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

            if(array_key_exists("searchterm", $_GET)) {
                $term = $_GET['searchterm'];
            } else {
                die("<p>How did you get here?</p><p><a href='javascript:history.back()'>Go back</a> or <a href='index'>return home</a></p>");
            }

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn)
                die("<p>Connection failed: " . mysqli_connect_error() . "</p><p><a href='javascript:history.back()'>Go back</a> or <a href='index'>return home</a></p>");
            echo "<p>Connected to database</p>";

            if ($result = mysqli_query($conn, "select KitName, KitID, Image from Kit where KitName like '%" . $term . "%'")) {
                echo "<p>Query executed successfully</p>
                      <h1>Search results for \"" . $term . "\"</h1>";
                    if(mysqli_num_rows($result) > 0) {
                        
                    while($row = mysqli_fetch_assoc($result)) { // fetches next row as an array, and assigns it to a var
                        echo "<a href='kit.php?kit=" . $row['KitID'] . "'><img class='img-query' src='" . $row['Image']. "'>
                              <p>" . $row['KitName'] . "</p></a>";
                    }
                } else {
                    echo "<p>(No results were found.)</p>";
                }
                mysqli_free_result($result);
                    
            } else {
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }

            mysqli_close($conn);
            
            echo "<a href='index'><p><a href='javascript:history.back()'>Go back home</a></p>";

            ?>

    </div>
    </body>
</html>