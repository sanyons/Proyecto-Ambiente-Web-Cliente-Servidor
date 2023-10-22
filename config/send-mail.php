<?php 


function EnviarCorreo($destinatario, $token, $Asunto){

    require 'PHPMailer/PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();
    $mail -> CharSet = 'UTF-8';
    $mail -> IsSMTP();
    $mail -> Host = 'smtp.office365.com'; //o gmail
    $mail -> SMTPSecure = 'tls';
    $mail -> Port = 587; // o 25
    $mail -> SMTPAuth = true;
    $mail -> Username = 'jacuna20934@ufide.ac.cr';
    $mail -> Password = 'T058_YBLA';
    $mail -> SetFrom('jacuna20934@ufide.ac.cr', "Servicio Al Cliente");
    $mail -> Subject = $Asunto;
    $mail -> MsgHTML(emailTemplate($destinatario,$token));
    $mail->AddAddress($destinatario, 'Cliente');
    $mail->send();

}


function emailTemplate($destinatario, $token){
    $body = "<div class='card text-center'>
             <div class='card-header'>
                Reestablecimiento de contraseña
             </div>
             <div class='card-body'>
             <h5 class='card-title'>Hola $destinatario</h5>
             <p class='card-text'> Utilice la siguiente contraseña temporal para iniciar sesión: </p>
             <p><strong>$token</strong></p>
             <a href='http://localhost:8080/WellnessExpert/login.php' class='btn btn-primary'>Ir al sitio</a>
            </div>
            <div class='card-footer text-muted'>
            Equipo de Wellness Expert
            </div>
            </div>";
    return $body;
  
}





?>