<?php 
    include "dbh.inc.php";
    
    function displayActivity($conn) 
    {     
        $sql = "SELECT * FROM activity WHERE(CURDATE() < DATE(activityDate))";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_execute($stmt);
        
        echo "<table>";
        
        $results = mysqli_stmt_get_result($stmt);
       
        while($row = mysqli_fetch_assoc($results))
        {
            echo "<tr><td><strong> Dato: </strong><br>" . $row['activityDate'] . "</td><td><strong> Aktivitet: </strong><br>" . $row['activityDesc'] . "</td><td><strong> Ansvarlig: </strong><br>" . $row['activityAnsvarlig'] . "</td><td><strong> Starter: </strong><br>" . $row['activityStarttid'] . "</td><td><strong> Slutter: </strong><br>" . $row['activitySlutttid'] . "</td><td><strong> Sted: </strong><br>" . $row['activitySted'] . "</td><td><form method='post'> <button type='submit' name='book' value='$row[activityId]'> Meld deg på </button> </form></td></tr>";  
        }
        
    } if (isset($_GET['book'])) {
        echo "Du har meldt deg på!";
    }

    function checkActivity($conn, $actID) 
    {
        $userID = $_SESSION["userid"];

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

    function bookActivity($conn, $actID) 
    {
        if(checkActivity($conn, $actID) == 1) 
        {
            header("location: ../prosjekt-is115/aktivitet.php");
        }
        else {
            $userID = $_SESSION["userid"];
            
            $sql = "INSERT INTO booking (booking_userId, booking_activityId) VALUES(?, ?)";

            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            
            $stmt = mysqli_stmt_init($conn);

            mysqli_stmt_prepare($stmt, $sql);

            mysqli_stmt_bind_param($stmt, "ii", $userID, $actID);

            mysqli_stmt_execute($stmt);



        }
    }
    function addActivity($conn, $activityDesc, $activityDate, $activityPerson, $activityStart, $activityEnd, $activityPlace) 
    {
        $sql = "INSERT INTO activity(activityDesc, activityDate, activityAnsvarlig, activityStarttid, activitySlutttid, activitySted) VALUES(?, ?, ?, ?, ?, ?)";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            
        $stmt = mysqli_stmt_init($conn);

        mysqli_stmt_prepare($stmt, $sql);

        mysqli_stmt_bind_param($stmt, "ssssss", $activityDesc, $activityDate, $activityPerson, $activityStart, $activityEnd, $activityPlace);

        mysqli_stmt_execute($stmt);

        mysqli_close($conn);
    }
?>