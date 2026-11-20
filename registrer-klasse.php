  <h3>Registrer klasse</h3>  
    
  <form method="post" action="" id="registrerklasse" name="registrerklasse">
    Klassekode <input type="text" id="klassekode" name="klassekode" required /> <br />
    Klassenavn <input type="text" id="klassenavn" name="klassenavn" required /> <br />
    Studiumkode <input type="text" id="studiumkode" name="studiumkode" required /> <br />
    <input type="submit" value="Registrer" id="registrer" name="registrer" />
    <input type="reset" value="Nullstill" name="nullstill" id="nullstill" />
  </form>

<?php 
  include("db-tilkobling.php");

  if (isset ($_POST["registrer"]))
  {
  $klassekode=$_POST ["klassekode"];
  $klassenavn=$_POST ["klassenavn"];
  $studiumkode=$_POST ["studiumkode"];
    
  if (!$klassekode || !$klassenavn || !$studiumkode)
    {
      print ("Alle felt må fylles ut");
    }
  else
    {
      $sqlSetning="SELECT * FROM klasse WHERE klassekode = '$klassekode';";
      $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente informasjon fra databasen");
      $antallRader=mysqli_num_rows($sqlResultat);

      if($antallRader!=0)
        {
          print ("Klasse er allerede registrert");
        }
    
        
      else
        {
      $sqlSetning="INSERT INTO klasse VALUES ('$klassekode','$klassenavn','$studiumkode');";
      mysqli_query($db,$sqlSetning) or die ("får ikke registrert data i databasen");

      print ("Klassen $klassekode er registrert");
        }
    }  
  }  
?>
