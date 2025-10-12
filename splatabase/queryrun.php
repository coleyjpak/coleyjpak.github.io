<!-- QUERY RUN -->

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

            if(array_key_exists("query", $_GET)) {
                $query = $_GET['query'];
                if($query == "") {
                    die("<p>Please enter a query.</p><p><a href='javascript:history.back()'>Go back home</a></p>");
                }
                echo "<p>Query to run: " . $query . "</p>";
            } else {
                die("<p>How did you get here?</p><p><a href='javascript:history.back()'>Go back</a> or <a href='index'>return home</a></p>");
            }

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn)
                die("<p>Connection failed: " . mysqli_connect_error() . "</p><p><a href='javascript:history.back()'>Go back</a> or <a href='index'>return home</a></p>");
            echo "<p>Connected to database</p>";

            if ($result = mysqli_query($conn, $query)) {
                echo "<p>Query executed successfully</p>";

                if(strtolower(strtok($query, ' ')) == "select") {
            
                    if(mysqli_num_rows($result) > 0) {
        
                        echo "<div class='wrapper'>
                              <table>";
                        $needPrintTH = true;
                        
                        while($row = mysqli_fetch_assoc($result)) { // fetches next row as an array, and assigns it to a var
                            if($needPrintTH) {
                                echo "<tr>";
                                foreach(array_keys($row) as $colname) {
                                    echo "<th>";
                                    echo $colname;
                                    echo "</th>";
                                }
                                echo "</tr>";
                                $needPrintTH = false;
                            }
                            
                            echo "<tr>";
                            foreach ($row as $data) {
                                echo "<td>";
                                // Display table data as image if it begins with the start of an image link
                                if (str_starts_with($data, "https://cdn.wikimg.net/en/splatoonwiki/images/")) {
                                    echo "<img class='img-query' src='" . $data . "'>";
                                } else {
                                    echo $data;
                                }
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
        
                        echo "</table>
                              </div>";
                    } else {
                        echo "<p>(This query returns an empty table.)</p>";
                    }
                    mysqli_free_result($result);
                }
                    
            } else {
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }

            mysqli_close($conn);
            
            echo "<p><a href='javascript:history.back()'>Go back home</a></p>";

            ?>

    </div>
    </body>
</html>