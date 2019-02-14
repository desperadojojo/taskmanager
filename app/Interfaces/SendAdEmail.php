<?php

namespace App\Interfaces;

interface SendWelcomeEmail
{
    public function collectEmailAddress();
    public function sendWelcomeEmail();

    
}
