<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function getInertiaError(string $message): array
    {
        return [
            'toast_notification' => [
                'message' => $message,
                'bgColor' => 'blue'
            ]
        ];
    }

    protected function getInertiaSuccess(string $message): array
    {
        return [
            'toast_notification' => [
                'message' => $message,
                'bgColor' => 'green'
            ]
        ];
    }


}
