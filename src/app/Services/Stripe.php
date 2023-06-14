<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use Exception;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe as StripeMain;
use Stripe\Charge;
use Stripe\StripeClient;

class Stripe implements PaymentGatewayInterface
{
    /**
     * @throws Exception
     */
    public function charge(array $creditCard): void
    {
        try {
            StripeMain::setApiKey(config('services.stripe.unique_id'));

            Charge::create ([
                "amount" => $creditCard['charge'],
                "currency" => "usd",
                "source" => $this->getToken($creditCard),
                "description" => "Subscription for " . auth()->user()->name
            ]);
        } catch(\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @throws ApiErrorException
     */
    private function getToken(array $creditCard): string
    {
        $stripe = new StripeClient(config('services.stripe.publisher_key'));

        $result = $stripe->tokens->create([
            'card' => [
                'number' => $creditCard['cc_number'],
                'exp_year' => $creditCard['cc_expiry_year'],
                'exp_month' => $creditCard['cc_expiry_month'],
                'cvc' => $creditCard['cc_cvc']
            ]
        ]);

        return $result->id;
    }
}