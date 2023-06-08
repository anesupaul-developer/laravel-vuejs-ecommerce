<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasApproval
{
    public static function bootHasApproval(): void
    {
        /**
         * @param Model $model
         *
         **/
        static::updating(function (Model $model) {
            if ($model->getAttribute('is_approved') === true) {
                $model->setAttribute('approved_by', auth()->user()->id);
            }

            if ($model->getAttribute('is_approved') === false) {
                $model->setAttribute('approved_by', null);
            }
        });
    }
}