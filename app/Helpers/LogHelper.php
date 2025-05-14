<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Telescope\Telescope;

class LogHelper
{
    /**
     * Log a database operation with consistent format
     *
     * @param string $operation The type of operation (create, update, delete, etc.)
     * @param string $entity The entity being operated on (User, Role, Permission, etc.)
     * @param mixed $data Additional data to log
     * @param bool $isSuccess Whether the operation was successful
     * @param string|null $errorMessage Error message if operation failed
     * @return void
     */
    public static function logDbOperation(
        string $operation,
        string $entity,
        $identifier,
        ?array $additionalInfo = null,
        bool $isSuccess = true,
        ?string $errorMessage = null
    ) {
        $userId = Auth::id() ?? 'system';
        $userEmail = Auth::user() ? Auth::user()->email : 'system';

        // Build the log message
        $message = "User #{$userId} ({$userEmail}) {$operation}d {$entity}";
        
        // Add identifier information
        if (is_array($identifier)) {
            foreach ($identifier as $key => $value) {
                $message .= ". {$key}: {$value}";
            }
        } else {
            $message .= ". ID: {$identifier}";
        }

        // Add additional information if provided
        if ($additionalInfo) {
            foreach ($additionalInfo as $key => $value) {
                if (!is_array($value)) {
                    $message .= ". {$key}: {$value}";
                }
            }
        }

        // Tag critical operations for Telescope monitoring
        $shouldTag = in_array($operation, ['delete', 'create', 'update']) ||
                     in_array($entity, ['User', 'Role', 'Permission', 'Telescope']) ||
                     $isSuccess === false;

        if ($shouldTag && class_exists('Laravel\Telescope\Telescope')) {
            Telescope::tag(function () use ($entity, $operation) {
                return ['activity-log', $entity, $operation];
            });
        }

        if ($isSuccess) {
            Log::channel('activity')->info($message);
        } else {
            $message .= ". Error: {$errorMessage}";
            Log::channel('activity')->error($message);
        }
    }

    /**
     * Log a user authentication event
     *
     * @param string $event The event type (login, logout, etc.)
     * @param \Illuminate\Http\Request $request The request object
     * @param mixed $user The user object or ID
     * @return void
     */    public static function logAuthEvent(string $event, Request $request, $user = null)
    {
        $userId = $user ? ($user->id ?? $user) : (Auth::id() ?? null);
        $userEmail = $user && isset($user->email) ? $user->email : (Auth::user() ? Auth::user()->email : null);

        $message = "User #{$userId}" . ($userEmail ? " ({$userEmail})" : "") . " {$event}";
        $message .= ". IP: {$request->ip()}";

        // Tag auth events for Telescope monitoring
        if (class_exists('Laravel\Telescope\Telescope')) {
            Telescope::tag(function () use ($event) {
                return ['auth', $event, 'activity-log'];
            });
        }

        Log::channel('activity')->info($message);
    }
}
