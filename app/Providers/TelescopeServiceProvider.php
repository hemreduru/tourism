<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Telescope::night();

        $this->hideSensitiveRequestDetails();

        $isLocal = $this->app->environment('local');

        Telescope::filter(function (IncomingEntry $entry) use ($isLocal) {
            // For queries, only record non-select queries (inserts, updates, deletes)
            if ($entry->type === 'query') {
                $query = strtolower($entry->content['sql'] ?? '');
                return !str_starts_with(trim($query), 'select');
            }

            // For requests, don't record normal GET requests (page views)
            if ($entry->type === 'request') {
                return $entry->content['method'] !== 'GET' ||
                       $entry->isFailedRequest() ||
                       str_contains($entry->content['uri'] ?? '', '/api/');
            }

            // Always record exceptions, jobs, scheduled tasks, and monitored events
            return $entry->isReportableException() ||
                   $entry->isFailedJob() ||
                   $entry->isScheduledTask() ||
                   $entry->hasMonitoredTag() ||
                   in_array($entry->type, [
                       'command',
                       'job',
                       'log',
                       'model',
                       'notification',
                       'redis',
                       'exception',
                   ]);
        });
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     */
    protected function hideSensitiveRequestDetails(): void
    {
        if ($this->app->environment('local')) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewTelescope', function ($user) {
            // Allow access to users with admin role
            return $user->hasRole('admin');
        });
    }
}
