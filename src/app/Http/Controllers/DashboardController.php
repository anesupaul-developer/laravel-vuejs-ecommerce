<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $user = $request->user()->where('id', $request->user()->id)->with('customer')->first();

        return Inertia::render('Dashboard', [
            'customer' => $user->customer,
            'approval_status' => $user->customer()->isApproved() ? 'complete' : 'pending'
        ]);
    }
}