<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    class Correo{
        private $mail;
        public function __construct(){
            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/correoInfo.php');
            require $_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/vendor/PHPMailer/Exception.php';
            require $_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/vendor/PHPMailer/PHPMailer.php';
            require $_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/vendor/PHPMailer/SMTP.php';
            $this->mail = new PHPMailer(true);
        }
        public function enviarCorreoVerificacion($txtNombre,$txtCorreo,$codigo){
            try{
                //Server settings
                $this->mail->SMTPDebug=0; 
                $this->mail->isSMTP(); 
                $this->mail->Host='smtp.gmail.com';
                $this->mail->SMTPAuth=true;                   
                $this->mail->Username=getUsuario(); 
                $this->mail->Password=getContrasenia(); 
                $this->mail->SMTPSecure='ssl';
                $this->mail->Port=465; 


                //Recipients
                $this->mail->setFrom(getUsuario(), 'BurgerFisi');
                $this->mail->addAddress($txtCorreo); 


                //Content
                $this->mail->isHTML(true);                                  
                $this->mail->Subject = $codigo.' es tu codigo de verificacion';
                $this->mail->Body    = '<style>
                                    p {
                                        font-size: 22px;
                                        color: #333;
                                        font-family: "Helvetica Neue", Arial, sans-serif;
                                    }
                            
                                    strong {
                                        font-weight: bold;
                                        color: #f00;
                                        font-family: "Verdana", sans-serif;
                                    }
                                </style>
                                <p>Hola '.$txtNombre.'</p>
                                <p>Este es tu código de verificación:</p>
                                <p style="font-size: 20px;"><strong>'.$codigo.'</strong></p>
                                <p>Por favor, introduce este código en la página para completar el proceso de verificación.</p>
                                <p>¡Gracias por utilizar Burgerfisi!</p>';
                
                
                $this->mail->send();
                return true;
            }   catch (Exception $e) {
                return false;
            }
        }
    }
?>