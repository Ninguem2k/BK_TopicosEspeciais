<?php

class EmailProvider implements IEmailProvider {
    private $transporter;
    private $email;

    public function __construct($email, $password) {
        $this->email = $email;

        // Configuração do transporte do Nodemailer
        $this->transporter = nodemailer::createTransport([
            'service' => 'gmail',
            'auth' => [
                'user' => $email,
                'pass' => $password
            ]
        ]);

        echo $this->transporter->verify;
    }

    public function sendEmail($to, $subject, $body) {
        $mailOptions = [
            'from' => $this->email,
            'to' => $to,
            'subject' => $subject,
            'html' => $body
        ];

        // Enviando email
        $this->transporter->sendMail($mailOptions, function($error, $info) {
            // Tratando erro durante envio
            if ($error) {
                throw new AppError("Error sending email!", 400);
            }
        });
    }
}

?>
