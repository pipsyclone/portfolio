<?php

namespace App;

trait LogActivityTrait
{
    protected function logActivity(string $action, string $desc): void {
        auth()->user()->createLog(
            request(),
            $action,
            $desc
        );
    }
}
