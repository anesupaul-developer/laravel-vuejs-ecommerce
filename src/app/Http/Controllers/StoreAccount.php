<?php

namespace App\Http\Controllers;

use App\Definitions\BaseDefinition;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\StoreAccount as Model;

class StoreAccount extends Controller
{
    public function index(): Response
    {
        return Inertia::render('StoreAccount', []);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->only('name'), [
            'name' => 'required|max:255'
        ]);


        Model::query()->updateOrCreate(['user_id' => $request->user()->id], [
            'user_id' => $request->user()->id,
            'name' => $validator->validated()['name']
        ]);

        return Redirect::route('customer.store-account.store')
            ->with($this->getInertiaSuccess('Account created'));
    }

    public function apply(Request $request): RedirectResponse
    {
        $request->user()->update(['is_admin_panel_user' => BaseDefinition::IS_NOT_ADMIN]);

        return Redirect::route('dashboard');
    }
}