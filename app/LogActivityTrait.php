<?php

namespace App;

trait LogActivityTrait
{
    protected function logActivity(string $action, string $desc, string $who = null): void {
        if (auth()->check()) {
            auth()->user()->createLog(
                request(),
                $action,
                $desc
            );
        } else {
            \App\Models\ActivityLogs::create([
                'user_id' => $who,
                'activity' => $action,
                'ip_address' => request()->ip() ?? '127.0.0.1',
                'user_agent' => request()->userAgent() ?? 'System/CLI',
                'description' => $desc,
            ]);
        }
    }
}
