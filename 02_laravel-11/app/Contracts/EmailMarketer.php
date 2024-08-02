<?php

namespace App\Contracts;

interface EmailMarketer
{
    public function subscribeToNewsletter(string $email);
}
