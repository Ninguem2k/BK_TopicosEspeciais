<?php
interface IEmailProvider {
    public function sendEmail($to, $subject, $body);
}
?>
