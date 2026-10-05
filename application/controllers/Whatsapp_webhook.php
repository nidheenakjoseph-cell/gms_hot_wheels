<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp_webhook extends MY_Controller
{
    public function index()
    {
        $mode = isset($_GET['hub_mode']) ? $_GET['hub_mode'] : '';
        $token = isset($_GET['hub_verify_token']) ? $_GET['hub_verify_token'] : '';
        $challenge = isset($_GET['hub_challenge']) ? $_GET['hub_challenge'] : '';

        if ($mode === 'subscribe' && $token === 'GMS_WEBHOOK_TOKEN')
        {
            echo $challenge;
            exit;
        }

        show_error('Invalid webhook verification request');
    }
}

