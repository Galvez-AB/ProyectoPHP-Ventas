<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    class Correo{
        private $mail;
        public function __construct(){
            require $_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/vendor/PHPMailer/Exception.php';
            require $_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/vendor/PHPMailer/PHPMailer.php';
            require $_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/vendor/PHPMailer/SMTP.php';
            $this->mail = new PHPMailer(true);//Crea una instancia, al pasar 'true' se habilitan excepciones
        }
        public function enviarCorreoVerificacion($txtNombre,$txtCorreo,$codigo){
            try{
                //Server settings
                $this->mail->SMTPDebug=0; 
                $this->mail->isSMTP(); 
                $this->mail->Host='smtp.gmail.com';
                $this->mail->SMTPAuth=true;                   
                $this->mail->Username='burgerfisi@gmail.com'; 
                $this->mail->Password='osjn kmwm wcna klut'; 
                $this->mail->SMTPSecure='ssl';
                $this->mail->Port=465; 


                //Recipients
                $this->mail->setFrom('burgerfisi@gmail.com', 'BurgerFisi');
                $this->mail->addAddress($txtCorreo); 


                //Content
                $this->mail->isHTML(true);                                  //Set email format to HTML
                $this->mail->Subject = $codigo.' es tu codigo de verificacion';
                $this->mail->Body    = '<style>
                                    p {
                                        font-size: 18px;
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
                                <p>Este código es válido por [número de minutos] minutos.</p>
                                <p>¡Gracias por utilizar Burgerfisi!</p>';
                
                
                $this->mail->send();
                echo 'Message has been sent';
            }   catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            }
        }
    }
?>