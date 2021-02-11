
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// Definisco le variabili e le rendo vuote
$nomeErr = $emailErr = $websiteErr = "";
$nome = $email = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["nome"])) {
    $nomeErr = "Il nome è richiesto";
  } 
   $nome = ($_POST["nome"]);
   // Verifico se i caratteri immessi nel campo nome sono solamente lettere e spazi
   if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) {
    $nomeErr = "Solo lettere e spazi consentiti";
  }
  else {
    $nome = "nome = ".test_input($_POST["nome"]);
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "L'email è richiesta";
  } 
  $email = ($_POST["email"]);
  // Verifico se la stringa immessa nel campo email è valida
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Formato email non valido";
  }
  else {
    $email = "email = ".test_input($_POST["email"]);
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } 
  $website = ($_POST["website"]);
  // Verifico se l'indirizzo URL è valido
  if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
    $websiteErr = "URL non valido";
  }  
  else {
    $website = "Website = ".test_input($_POST["website"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Verifica di esempio</h2>
<p><span class="error">* campi obbligatori</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Nome: <input type="text" name="nome">
  <span class="error">* <?php echo $nomeErr;?></span>
  <br><br>
  Email: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Gli input:</h2>";
echo $nome;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
?>

</body>
</html>
