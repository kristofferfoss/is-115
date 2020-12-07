<?php 
    include "dbh.inc.php";

    //displays all info of user
    function displayInfo($conn) 
    {    
        //collects user ID from session after login
        $ID = $_SESSION["userid"]; 

        $sql = "SELECT * FROM users WHERE usersId = ?;";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_bind_param($stmt, "i", $ID);
        
        mysqli_stmt_execute($stmt);
        
        echo "<table>";
        
        $results = mysqli_stmt_get_result($stmt);
       //prints all information in table
        while($row = mysqli_fetch_assoc($results))
        {
            echo "<tr><td><strong> Foravn: </strong><br>" . $row['usersFirstname'] . "</td><td><strong> Etternavn: </strong><br>" . $row['usersLastname'] . "</td><td><strong> Epost: </strong><br>" . $row['usersEmail'] . "</td><td><strong> Mobilnummer: </strong><br>" . $row['usersPhone'] . "</td></tr>"; 
            echo "<tr><td><strong> Adresse: </strong><br>" . $row['usersAddress'] . "</td><td><strong> Postnummer: </strong><br>" . $row['usersPostno'] . "</td><td><strong> Poststed: </strong><br>" . $row['usersPostplace'] . "</td><td><strong> Medlem siden: </strong><br>" . $row['usersRegdate'] . "</td></tr>"; 
            echo "<tr><td><strong> Klubb ID: </strong><br>" . $row['usersId'] . "</td><td><strong> Kjønn: </strong><br>" . $row['usersKjonn'] . "</td><td><strong> Fødselsdato: </strong><br>" . $row['usersDob'] . "</td><td><strong> Brukernavn: </strong><br>" . $row['usersUid'] . "</td></tr>"; 
        }
        echo "</table";
    }

    //displays different non-essential information
    function displayMoreInfo($conn) 
    {    
        $ID = $_SESSION["userid"]; 

        //collects two values from database
        $sql = "SELECT userInterests, userKontigent FROM users WHERE usersId = ?;";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_bind_param($stmt, "i", $ID);
        
        mysqli_stmt_execute($stmt);
        
        $results = mysqli_stmt_get_result($stmt);
       
        while($row = mysqli_fetch_assoc($results))
        {
            //Checks if values have been filled in yet
            if(empty($row['userInterests'])) 
            {
                //option to fill in interests in database
                echo "<p><center>Du har ikke lagt til noen interesser. </center></p><br>";
                echo "<p><center>Legg til dine interresser: <p><center>";
                echo "<form action='includes/profil.inc.php' method='post'> <input type='text' name='interesser' placeholder='Interesser'> <button type='submit' name='editInteresser' value='editInteresser'>Legg til Interesser</button>";
            }
            else 
            {
                //alternative view if interests are filled out and want to be changed
                echo "<p><center><strong> Interesser:  </strong><p><center>" . $row['userInterests'];
                echo "<form action='includes/profil.inc.php' method='post'> Endre Interesser: <input type='text' name='interesser' placeholder='Interesser'> <button type='submit' name='editInteresser' value='editInteresser'>Endre Interesser</button>";
            }
            
            //checks if kontigent has been paid
            if (empty($row['userKontigent'])) 
            {
                echo "<br><p><center>Kontigent er ikke betalt.<p><center>";
            }
            else 
            {
                echo "<br><p><center>Kontigent er betalt.<p><center>";
            }
        }
    }

    //Displays all activities that have been booked by user
    function displayActivityHistory($conn) 
    {
        $ID = $_SESSION["userid"]; 

        //collects two values that tells them what activites and when
        $sql = "SELECT activity.activityDesc, activity.activityDate FROM booking INNER JOIN activity ON booking.booking_activityId = activity.activityId INNER JOIN users ON booking.booking_userId = users.usersId WHERE users.usersId = ?;";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_bind_param($stmt, "i", $ID);
        
        mysqli_stmt_execute($stmt);
        
        echo "<table>";

        $results = mysqli_stmt_get_result($stmt);
       
        //prints activities into table
        while($row = mysqli_fetch_assoc($results))
        {
            echo "<tr><td><strong> Dato: </strong><br>" . $row['activityDate'] . "</td><td><strong> Aktivitet: </strong><br>" . $row['activityDesc'] . "</td></tr>";
        }
        echo "</table>";
        mysqli_close($conn); 
    }

    //edit firstname handler
    if (isset($_POST["editFirstname"])) 
    {
        $firstname = ucfirst($_POST["firstname"]);

        session_start();

        $ID = $_SESSION["userid"];

        include "dbh.inc.php";

        editFirstname($conn, $firstname, $ID);
        
        header("location: ../endreProfil.php");
    }

    //edit lastname handler
    if (isset($_POST["editLastname"])) 
    {
        $lastname = ucfirst($_POST["lastname"]);

        session_start();

        $ID = $_SESSION["userid"];

        include "dbh.inc.php";

        editLastname($conn, $lastname, $ID);
        
        header("location: ../endreProfil.php");
    }

    //edit email handler
    if (isset($_POST["editEmail"])) 
    {
        $email = $_POST["email"];

        session_start();

        $ID = $_SESSION["userid"];

        include "dbh.inc.php";

        editEmail($conn, $email, $ID);
        
        header("location: ../endreProfil.php");
    }

    //edit phonenumber handler
    if (isset($_POST["editPhone"])) 
    {
        $mobilnummer = $_POST["phone"];

        session_start();

        $ID = $_SESSION["userid"];

        include "dbh.inc.php";

        editPhone($conn, $mobilnummer, $ID);
        
        header("location: ../endreProfil.php");
    }

    //edit address handler
    if (isset($_POST["editAddress"])) 
    {
        $adresse = $_POST["address"];

        session_start();

        $ID = $_SESSION["userid"];

        include "dbh.inc.php";

        editAddress($conn, $adresse, $ID);
        
        header("location: ../endreProfil.php");
    }

    //edit postagenumber handler
    if (isset($_POST["editPostno"])) 
    {
        $postno = $_POST["postno"];

        session_start();

        $ID = $_SESSION["userid"];

        include "dbh.inc.php";

        editPostno($conn, $postno, $ID);
        
        header("location: ../endreProfil.php");
    }

    //edit postageplace handler
    if (isset($_POST["editPostplace"])) 
    {
        $poststed = ucfirst($_POST["postplace"]);

        session_start();

        $ID = $_SESSION["userid"];

        include "dbh.inc.php";

        editPostplace($conn, $poststed, $ID);
        
        header("location: ../endreProfil.php");
    }

    //edit gender handler
    if (isset($_POST["editKjonn"])) 
    {
        $kjonn = ucfirst($_POST["kjonn"]);

        session_start();

        $ID = $_SESSION["userid"];

        include "dbh.inc.php";

        editKjonn($conn, $kjonn, $ID);
        
        header("location: ../endreProfil.php");
    }

    //edit interests handler
    if (isset($_POST["editInteresser"])) 
    {
        $interesser = ucfirst($_POST["interesser"]);

        session_start();

        $ID = $_SESSION["userid"];

        include "dbh.inc.php";

        editInteresser($conn, $interesser, $ID);
        
        header("location: ../profil.php");
    }

    //edit firstname function
   function editFirstname($conn, $firstname, $ID)
    {
        $sql = "UPDATE users SET usersFirstname = '$firstname' WHERE usersId = $ID";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_execute($stmt);

        mysqli_close($conn); 
    }

    //edit lastname function
    function editLastname($conn, $lastname, $ID)
    {
        $sql = "UPDATE users SET usersLastname = '$lastname' WHERE usersId = $ID";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_execute($stmt);

        mysqli_close($conn); 
    }

    //edit email function
    function editEmail($conn, $email, $ID)
    {
        $sql = "UPDATE users SET usersEmail = '$email' WHERE usersId = $ID";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_execute($stmt);

        mysqli_close($conn); 
    }

    //edit phonenumber function
    function editPhone($conn, $mobilnummer, $ID)
    {
        $sql = "UPDATE users SET usersPhone = '$mobilnummer' WHERE usersId = $ID";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_execute($stmt);

        mysqli_close($conn); 
    }

    //edit address function
    function editAddress($conn, $adresse, $ID)
    {
        $sql = "UPDATE users SET usersAddress = '$adresse' WHERE usersId = $ID";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_execute($stmt);

        mysqli_close($conn); 
    }

    //edit postagenumber function
    function editPostno($conn, $postno, $ID)
    {
        $sql = "UPDATE users SET usersPostno = '$postno' WHERE usersId = $ID";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_execute($stmt);

        mysqli_close($conn); 
    }

    //edit postageplace function
    function editPostplace($conn, $poststed, $ID)
    {
        $sql = "UPDATE users SET usersPostplace = '$poststed' WHERE usersId = $ID";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_execute($stmt);

        mysqli_close($conn); 
    }

    //edit gender function
    function editKjonn($conn, $kjonn, $ID)
    {
        $sql = "UPDATE users SET usersKjonn = '$kjonn' WHERE usersId = $ID";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_execute($stmt);

        mysqli_close($conn); 
    }

    //edit interests function
    function editInteresser($conn, $interesser, $ID)
    {
        $sql = "UPDATE users SET userInterests = '$interesser' WHERE usersId = $ID";
        
        $stmt = mysqli_stmt_init($conn);
        
        mysqli_stmt_prepare($stmt, $sql);
        
        mysqli_stmt_execute($stmt);

        mysqli_close($conn); 
    }
?>