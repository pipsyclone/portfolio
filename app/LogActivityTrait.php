<?php

namespace App;

trait LogActivityTrait
{
    protected function logActivity(string $action, string $desc, ?string $who = null): void {
        if (auth()->check()) {
            auth()->user()->createLog(
                request(),
                $action,
                $desc
            );
        } else {
            \App\Models\ActivityLogs::create([
                // No authenticated user in this context (e.g. a scheduled/CLI
                // command) — user_id is a foreign key to users.id and must stay
                // null/int, never a free-text label like "System".
                'user_id' => null,
                'activity' => $action,
                'ip_address' => request()->ip() ?? '127.0.0.1',
                'user_agent' => request()->userAgent() ?? ($who ? "System: {$who}" : 'System/CLI'),
                'description' => $desc,
            ]);
        }
    }
}
