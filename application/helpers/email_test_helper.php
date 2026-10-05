<?php

use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Mailtrap\Mime\MailtrapEmail;
use Symfony\Component\Mime\Address;

require __DIR__ . '/vendor/autoload.php';

$apiKey = '2b807e75e61445764a4748e7d4c95635';
$mailtrap = MailtrapClient::initSendingEmails(
    apiKey: $apiKey,
);

$email = (new MailtrapEmail())
    ->from(new Address('hello@demomailtrap.co', 'Mailtrap Test'))
    ->to(new Address("nidheenakjoseph@gmail.com"))
    ->subject('You are awesome!')
    ->text('Congrats for sending test email with Mailtrap!')
    ->category('Integration Test')
;

$response = $mailtrap->send($email);

var_dump(ResponseHelper::toArray($response));
?>