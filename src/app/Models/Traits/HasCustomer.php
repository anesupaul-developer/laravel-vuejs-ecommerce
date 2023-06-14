<?php

namespace App\Models\Traits;

use App\Definitions\BaseDefinition;
use App\Models\Customer;
use Faker\Provider\Base;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait HasCustomer
{
    public static function bootHasCustomer(): void
    {
        static::creating(function ($model) {
            $isAdmin = Str::of($model->getAttribute('email'))->endsWith(env('SYSTEM_EMAIL_DOMAIN'));

            $model->setAttribute('is_admin_panel_user', $isAdmin ? BaseDefinition::IS_ADMIN : BaseDefinition::UNASSIGNED_USER);
        });

        static::updated(function ($model) {
            Log::info($model->email);
            if (!$model->customer()->exists()) {
                if (!Str::of($model->getAttribute('email'))->endsWith(env('SYSTEM_EMAIL_DOMAIN'))
                    && $model->getOriginal('is_admin_panel_user') === BaseDefinition::UNASSIGNED_USER
                    && $model->getAttribute('is_admin_panel_user') === BaseDefinition::IS_NOT_ADMIN) {
                    Customer::query()->create(
                        [
                            'user_id' => $model->getAttribute('id')
                        ]
                    );
                }
            }
        });
    }
}