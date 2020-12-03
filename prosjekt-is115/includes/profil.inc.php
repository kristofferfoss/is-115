<?php 
    
    function displayInfo($conn) 
    {    
        $ID = $_SESSION["userid"]; 

        $sql = "SELECT * FROM users WHERE usersId = ?;";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_bind_param($stmt, "i", $ID);
        
        mysqli_stmt_execute($stmt);
        
        echo "<table>";
        
        $results = mysqli_stmt_get_result($stmt);
       
        while($row = mysqli_fetch_assoc($results))
        {
            echo "<tr><td><strong> Foravn: </strong><br>" . $row['usersFirstname'] . "</td><td><strong> Etternavn: </strong><br>" . $row['usersLastname'] . "</td><td><strong> Epost: </strong><br>" . $row['usersEmail'] . "</td><td><strong> Fødselsdato: </strong><br>" . $row['usersDob'] . "</td><td><strong> Kjønn: </strong><br>" . $row['usersKjonn'] . "</td><td><strong> Personlig ID: </strong><br>" . $row['usersId'] . "</td></tr>";  
        }
        echo "</table";
        mysqli_close($conn); 
    }
?>