
<script src="funksjoner.js"> </script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onSubmit="return bekreft()">
  Klasse
  <select name="klassekode" id="klassekode">
    <option value="">Vel klasse</option>
   
   
   <?php
      include("db-tilkobling.php");
      $sqlSetning="SELECT * FROM klasse;";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kan ikke hente data fra databasen");
      $antallRader=mysqli_num_rows($sqlResultat);

      for ($r=1;$r<=$antallRader;$r++)
        {
          $rad=mysqli_fetch_array($sqlResultat);
          $klassekode=$rad["klassekode"];
          print ("<option value='$klassekode'>$klassekode</option>");
        }
    ?>
  </select>  <br />
  <input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" />
</form>

<?php
  if (isset($_POST ["slettKlasseKnapp"]))
    {
      $klassekode=$_POST ["klassekode"];

      if (!$klassekode)
        {
          print ("Klasse er ikke valgt");
        }
      else
        {
          include("db-tilkobling.php");

          $sqlSetning="DELETE FROM klasse WHERE klassekode='$klassekode';";
          mysqli_query($db,$sqlSetning);
          print ("Klassen $klassekode er slettet");
        }
      
    }
?>