<?php

use PHPMailer\PHPMailer\PHPMailer;

include __DIR__ . "../../PHPMailer-6.3.0/src/Exception.php";
include __DIR__ . "../../PHPMailer-6.3.0/src/SMTP.php";
include __DIR__ . "../../PHPMailer-6.3.0/src/PHPMailer.php";
include __DIR__ . "../../php/Config.php";

class Model
{
    private $name;
    private $firstname;
    private $address;
    private $phone;
    private $email;
    private $course;

    public function __construct(string $name, string $firstname, string $address, string $phone, string $email, string $course)
    {
        $this->name = $name;
        $this->firstname = $firstname;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->course = $course;
    }

    public function send_mail()
    {
        // Set subject and body
        $subject = "bienconduire.ch - votre inscription au cours";
        $message = "Bonjour,<br/>
        Nous vous confirmons la réception de votre enregistrement sur le site Web de <a href='https://bienconduire.ch'>bienconduire.ch</a>.<br/>
        <br/>
        Le cours choisi est : <strong>$this->course</strong><br/>
        ---------------<br/>
        Cet e-mail est généré automatiquement, merci de ne pas y répondre.<br/>
        En cas de problème, merci de contacter <a href='https://bienconduire.ch/moniteurs'>un des moniteurs de bienconduire.ch</a>.";

        // Create new PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Define server settings
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = Config::MAIL_SERVER;
            $mail->SMTPAuth = true;
            $mail->Username = Config::MAIL_USERNAME;
            $mail->Password = Config::MAIL_PASSWORD;
            $mail->SMTPSecure = 'tls';
            $mail->Port = Config::MAIL_PORT;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Define sender and recipients settings
            $mail->setFrom("notifications.storagehost@gmail.com", 'STORAGEHOST - Hosting Services');
            $mail->addAddress($this->email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            //$mail->send();

            try {
                // Send email to bienconduire.ch
                // Set subject and body
                $subject = "bienconduire.ch - nouvelle inscription";
                $message = "Bonjour,<br/>
        Un élève vient de s'inscrire pour le cours de préparation à l'examen moto. Voici ses données personnelles :<br/>
        <br/>
        Nom : <strong>$this->name</strong><br/>
        Prénom : <strong></strong><br/>
        Adresse : <strong></strong><br/>
        Téléphone : <strong></strong><br/>
        Email : <strong></strong><br/>
        Cours choisi : <strong>$this->course</strong><br/>
        ---------------<br/>
        Cet e-mail est généré automatiquement, merci de ne pas y répondre.<br/>
        En cas de problème, merci de contacter <a href='https://bienconduire.ch/moniteurs'>un des moniteurs de bienconduire.ch</a>.";

                // Create new PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Define server settings
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host = Config::MAIL_SERVER;
                    $mail->SMTPAuth = true;
                    $mail->Username = Config::MAIL_USERNAME;
                    $mail->Password = Config::MAIL_PASSWORD;
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = Config::MAIL_PORT;
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );

                    // Define sender and recipients settings
                    $mail->setFrom("notifications.storagehost@gmail.com", 'STORAGEHOST - Hosting Services');
                    $mail->addAddress('buchs@bienconduire.ch');

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body = $message;
                    //$mail->send();

                    return true;
                } catch (Exception $e) {
                    return array(
                        'status' => false,
                        'message' => $mail->ErrorInfo
                    );
                }
            } catch (Exception $e) {
                return array(
                    'status' => false,
                    'message' => $mail->ErrorInfo
                );
            }
        } catch (Exception $e) {
            return array(
                'status' => false,
                'message' => $mail->ErrorInfo
            );
        }
    }
}