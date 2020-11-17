<?php 
    
    function displayInfo($conn) 
    {
        $ID = 1;
        
        $sql = "SELECT * FROM users WHERE usersId = ?;";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_bind_param($stmt, "i", $ID);
        
        mysqli_stmt_execute($stmt);
        
        $results = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($results))
        {
            $name = $row["usersName"];
            $email = $row["usersEmail"];
            $ID = $row["usersId"];
        }
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $ID;
    }
?>