<?php

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function charge(array $creditCard): void;
}