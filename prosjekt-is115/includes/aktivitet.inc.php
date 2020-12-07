<?php 
    //Establish database connection
    include "dbh.inc.php";
    
    function displayActivity($conn) 
    {     
        //Selects every future activity
        $sql = "SELECT * FROM activity WHERE(CURDATE() < DATE(activityDate))";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_execute($stmt);
        
        echo "<table>";
        
        $results = mysqli_stmt_get_result($stmt);
       //Prints every value into a table
        while($row = mysqli_fetch_assoc($results))
        {
            echo "<tr><td><strong> Dato: </strong><br>" . $row['activityDate'] . "</td><td><strong> Aktivitet: </strong><br>" . $row['activityDesc'] . "</td><td><strong> Ansvarlig: </strong><br>" . $row['activityOrganizer'] . "</td><td><strong> Starter: </strong><br>" . $row['activityStarttime'] . "</td><td><strong> Slutter: </strong><br>" . $row['activityEndtime'] . "</td><td><strong> Sted: </strong><br>" . $row['activityPlace'] . "</td><td><form method='post'> <button type='submit' name='book' value='$row[activityId]'> Meld deg på </button> </form></td></tr>";  
        }
        
    } if (isset($_GET['book'])) {
        //Confirmation message
        echo "Du har meldt deg på!";
    }

    //function to check if a booking already exists, function used in aktivitet.php
    function checkActivity($conn, $actID) 
    {
        //Gets the current User ID (Primary key)
        $userID = $_SESSION["userid"];
        //Gets one instance of the current combination if it exists
        $sql = "SELECT 1 FROM booking WHERE booking_userId = ? AND booking_activityId = ?";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);

        mysqli_stmt_bind_param($stmt, "ii", $userID, $actID);
        
        mysqli_stmt_execute($stmt);

        $results = mysqli_stmt_get_result($stmt);
       
        while($row = mysqli_fetch_assoc($results))
        {
            return $results;
        }
    }

    //books activity, used in aktivitet.php
    function bookActivity($conn, $actID) 
    {
        if(checkActivity($conn, $actID) == 1) 
        {
            //checks if already booked and redirects if so
            header("location: ../prosjekt-is115/aktivitet.php");
        }
        else {
            //books a new value into booking if not a duplicate
            $userID = $_SESSION["userid"];
            
            $sql = "INSERT INTO booking (booking_userId, booking_activityId) VALUES(?, ?)";

            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            
            $stmt = mysqli_stmt_init($conn);

            mysqli_stmt_prepare($stmt, $sql);

            mysqli_stmt_bind_param($stmt, "ii", $userID, $actID);

            mysqli_stmt_execute($stmt);

        }
    }

    //admin function - adds activity
    function addActivity($conn, $activityDesc, $activityDate, $activityPerson, $activityStart, $activityEnd, $activityPlace) 
    {
        //collects values from form in admin.php
        $sql = "INSERT INTO activity(activityDesc, activityDate, activityOrganizer, activityStarttime, activityEndtime, activityPlace) VALUES(?, ?, ?, ?, ?, ?)";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            
        $stmt = mysqli_stmt_init($conn);

        mysqli_stmt_prepare($stmt, $sql);

        mysqli_stmt_bind_param($stmt, "ssssss", $activityDesc, $activityDate, $activityPerson, $activityStart, $activityEnd, $activityPlace);

        mysqli_stmt_execute($stmt);

        mysqli_close($conn);
    }
?>