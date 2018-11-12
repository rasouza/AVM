<?
$mailTo = $_POST["TO"];
unset($_POST["TO"]);

$mailSubject = $_POST["SUBJECT"];
unset($_POST["SUBJECT"]);

$redirect = $_POST["REDIRECT"];
unset($_POST["REDIRECT"]);

$mailFrom = $_POST["email"];

unset($_POST["submit"]);
unset($_POST["Submit"]);

$mailMsg = "Data: " . date("d/m/Y H:i:s") . "\n\n";
$mailMsg .= "---------------------------------\n\n";

reset($_POST);
while (list($fname, $fval) = each($_POST)) {
 $mailMsg .= $fname . " : " . $fval . "\n";
}

$mailMsg .= "\n---------------------------------\n\n";
$mailMsg .= "IP do Cliente: " . $_SERVER["REMOTE_ADDR"]  . "\n";

$header = $mailFrom ?  "From: $mailFrom" : '';

$mailToList = split(',', $mailTo);

for ($i=0; $i<sizeof($mailToList); $i++)  {
    $dst = trim($mailToList[$i]);
    if ($dst != "")  {
        if (!mail($dst, $mailSubject, $mailMsg, $header)) $err = '?c=1';
    }    
}

$redirect ? header("Location: " . $redirect . $err) : '';
echo "Sua mensagem foi enviada com sucesso !\n Obrigado."; 
exit;
?>
