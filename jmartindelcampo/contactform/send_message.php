<?php

// Fetching Values from URL.
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing E-mail.

// After sanitization Validation is performed
if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
{
  $subject = $name;

  // To send HTML mail, the Content-type header must be set.
  $headers = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
  $headers .= 'From:' . $email. "\r\n"; // Sender's Email
  $headers .= 'Cc:' . $email. "\r\n"; // Carbon copy to Sender
  $template = '<div style="padding:50px; color:white;">Buen día! ' . $name . ',<br/>'

  . '<br/>Gracias por contactarme!<br/><br/>'
  . 'Nombre: ' . $name . '<br/>'
  . 'Correo: ' . $email . '<br/>'
  . 'Mensaje: ' . $message . '<br/><br/>'
  . 'Éste es un correo de confirmación.'
  . '<br/>'
  . 'Leeré su correo para ponernos en contacto.</div>';

  $sendmessage = "<div style=\"background-color:#7E7E7E; color:white;\">" . $template . "</div>";

  // Message lines should not exceed 70 characters (PHP rule), so wrap it.
  $sendmessage = wordwrap($sendmessage, 70);

  // Send mail by PHP Mail Function.
  if(mail("mcvjf.maz@gmail.com", $subject, $sendmessage, $headers))
  {
    echo "OK";
  }
  else
  {
    echo "Por favor, verifique los datos e inténtelo de nuevo";
  }
} 
else 
{
  echo "<span>* Correo inválido *</span>";
}

return '';
?>