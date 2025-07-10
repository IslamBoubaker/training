<?php
require 'vendor/autoload.php';

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

$dsn = 'smtp://USERNAME:PASSWORD@smtp.mailtrap.io:2525'; // Remplace USERNAME et PASSWORD

$transport = Transport::fromDsn($dsn);
$mailer = new Mailer($transport);

$email = (new Email())
    ->from('test@example.com')        // Adresse expéditeur
    ->to('test@example.com')          // Adresse destinataire
    ->subject('Test Mailtrap SMTP')
    ->text('Test d’envoi de mail via Mailtrap.');

try {
    $mailer->send($email);
    echo "Mail envoyé avec succès\n";
} catch (Exception $e) {
    echo "Erreur lors de l’envoi : " . $e->getMessage() . "\n";
}
