<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $user = $request->user()->where('id', $request->user()->id)->with('customer')->first();

        $subscriptions = Subscription::all();

        return Inertia::render('Dashboard', [
            'customer' => $user->customer,
            'subscriptions' => $subscriptions,
            'approval_status' => $user->customer()->isApproved() ? 'complete' : 'pending'
        ]);
    }
}