<?php

namespace App\Traits;

trait AlertTrait
{
    protected function successAlert($message)
    {
        return ['alert' => ['type' => 'success', 'msg' => $message]];
    }

    protected function errorAlert($message)
    {
        return ['alert' => ['type' => 'error', 'msg' => $message]];
    }

    protected function infoAlert($message)
    {
        return ['alert' => ['type' => 'info', 'msg' => $message]];
    }

    protected function warningAlert($message)
    {
        return ['alert' => ['type' => 'warning', 'msg' => $message]];
    }
}
