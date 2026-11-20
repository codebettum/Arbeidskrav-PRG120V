
<script src="funksjoner.js"> </script>

<h3>Slett student</h3>

<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema" onSubmit="return bekreft()">
  Student
  <select name="brukernavn" id="brukernavn">
    <option value="">Velg student</option>
    <?php
      include("db-tilkobling.php");
      $sqlSetning="SELECT * FROM student;";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kan ikke hente data fra databasen");
      $antallRader=mysqli_num_rows($sqlResultat);

      for ($r=1;$r<=$antallRader;$r++)
        {
          $rad=mysqli_fetch_array($sqlResultat);
          $brukernavn=$rad["brukernavn"];
          print ("<option value='$brukernavn'>$brukernavn</option>");
        }
    ?>
  </select>
  <input type="submit" value="Slett student" name="slettStudentKnapp" id="slettStudentKnapp" />
</form>

<?php
  if (isset($_POST ["slettStudentKnapp"]))
    {
      $brukernavn=$_POST ["brukernavn"];

      if (!$brukernavn)
        {
          print ("Studenten ikke valgt");
        }
      else
        {
          include("db-tilkobling.php");

          $sqlSetning="DELETE FROM student WHERE brukernavn='$brukernavn';";
          mysqli_query($db,$sqlSetning) or die ("Kan ikke slette data i databasen");
          print ("Studenten $brukernavn er slettet");
        }
    }
?>
