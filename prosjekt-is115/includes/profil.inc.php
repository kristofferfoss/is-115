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
            echo "<tr><td><strong> Foravn: </strong><br>" . $row['usersFirstname'] . "</td><td><strong> Etternavn: </strong><br>" . $row['usersLastname'] . "</td><td><strong> Epost: </strong><br>" . $row['usersEmail'] . "</td><td><strong> Mobilnummer: </strong><br>" . $row['usersPhone'] . "</td></tr>"; 
            echo "<tr><td><strong> Adresse: </strong><br>" . $row['usersAddress'] . "</td><td><strong> Postnummer: </strong><br>" . $row['usersPostno'] . "</td><td><strong> Poststed: </strong><br>" . $row['usersPostplace'] . "</td><td><strong> Medlem siden: </strong><br>" . $row['usersRegdate'] . "</td></tr>"; 
            echo "<tr><td><strong> Klubb ID: </strong><br>" . $row['usersId'] . "</td><td><strong> Kjønn: </strong><br>" . $row['usersKjonn'] . "</td><td><strong> Fødselsdato: </strong><br>" . $row['usersDob'] . "</td><td><strong> Brukernavn: </strong><br>" . $row['usersUid'] . "</td></tr>"; 
        }
        echo "</table";
        mysqli_close($conn); 
    }
?>