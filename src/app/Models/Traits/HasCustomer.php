<?php

namespace App\Models\Traits;

use App\Definitions\BaseDefinition;
use App\Models\Customer;
use Faker\Provider\Base;
use Illuminate\Support\Str;

trait HasCustomer
{
    public static function bootHasCustomer(): void
    {
        static::creating(function ($model) {
            $isAdmin = Str::of($model->getAttribute('email'))->endsWith(env('SYSTEM_EMAIL_DOMAIN'));

            $model->setAttribute('is_admin_panel_user', $isAdmin ? BaseDefinition::IS_ADMIN : BaseDefinition::IS_NOT_ADMIN);
        });

        static::created(function ($model) {
            if (!Str::of($model->getAttribute('email'))->endsWith(env('SYSTEM_EMAIL_DOMAIN'))) {
                Customer::query()->create(
                    [
                        'user_id' => $model->getAttribute('id')
                    ]
                );
            }
        });
    }
}