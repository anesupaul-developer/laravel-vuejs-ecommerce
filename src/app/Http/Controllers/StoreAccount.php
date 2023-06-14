<?php

namespace App\Http\Controllers;

use App\Definitions\BaseDefinition;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class StoreAccount extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('StoreAccount', []);
    }

    public function apply(Request $request): RedirectResponse
    {
        $request->user()->update(['is_admin_panel_user' => BaseDefinition::IS_NOT_ADMIN]);

        return Redirect::route('dashboard');
    }
}