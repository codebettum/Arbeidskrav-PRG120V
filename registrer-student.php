    
    <h3>Registrer student</h3>

    <form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
    Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br />
    Fornavn <input type="text" id="fornavn" name="fornavn" required /> <br />
    Etternavn <input type="text" id="etternavn" name="etternavn" required /> <br />
    
    Klasse
    <select name="klassekode" id="klassekode">
        <option value="">Velg klasse</option>
        <?php
        include("db-tilkobling.php");
        $sqlSetning="SELECT * FROM klasse;";
        $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kan ikke hente data.");
        $antallRader=mysqli_num_rows($sqlResultat);

        for ($r=1;$r<=$antallRader;$r++)
            {
            $rad=mysqli_fetch_array($sqlResultat);
            $klassekode=$rad["klassekode"];
            print ("<option value='$klassekode'>$klassekode</option>");
            }
        ?>
    </select> <br />
    <input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" />
    <input type="reset" value="Nullstill" name="nullstill" id="nullstill" /> <br />
    </form>

    <?php
    include("db-tilkobling.php");
    if (isset($_POST ["registrerStudentKnapp"]))
        {
        $brukernavn=$_POST ["brukernavn"];
        $fornavn=$_POST ["fornavn"];
        $etternavn=$_POST ["etternavn"];
        $klassekode=$_POST ["klassekode"];

        if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode)
            {
            print ("Alle felt må fylles ut");
            }
         else
        {
          include("db-tilkobling.php");

          $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Får ikke hentet data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat);

          if ($antallRader!=0)
            {
              print ("Studenten $brukernavn er allerede registrert <br />");
            }
          else
            {
              $sqlSetning="INSERT INTO student VALUES ('$brukernavn','$fornavn','$etternavn','$klassekode');";
              mysqli_query($db,$sqlSetning) or die ("Klarer ikke hente data fra databsen");
              print ("Studenten $fornavn $etternavn er registrert <br />");
            }
        }
    }
?>
