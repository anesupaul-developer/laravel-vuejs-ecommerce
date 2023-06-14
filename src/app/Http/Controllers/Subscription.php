<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Subscription as Model;

class Subscription extends Controller
{
    private PaymentGatewayInterface $paymentGateway;

    public function __invoke(PaymentGatewayInterface $paymentGateway): void
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function store(Request $request, SubscriptionRequest $subscriptionRequest): RedirectResponse
    {
        $subscription = Model::query()->where('id', $subscriptionRequest->get('subscription_id'))->first();

        $creditCard = $subscriptionRequest->validated();
        $creditCard = [
            "cc_number"  => $creditCard['cc_number'],
            "cc_cvc" => $creditCard['cc_cvc'],
            "cc_expiry_month" => $creditCard['cc_expiry_month'],
            "cc_expiry_year" => $creditCard['cc_expiry_year'],
            "charge" => $subscription->getAttribute('price')
        ];

        // $this->paymentGateway->charge($creditCard);

        $request->user()->customer()->update(['subscription_id' => $subscriptionRequest->get('subscription_id')]);

        return Redirect::route('customer.store-account.index');
    }
}