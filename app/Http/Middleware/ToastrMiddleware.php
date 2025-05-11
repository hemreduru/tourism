<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Illuminate\Support\Facades\View;

class ToastrMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): SymfonyResponse
    {
        // Process the request
        $response = $next($request);

        // Only modify HTML responses
        if ($this->isHtmlResponse($response)) {
            $content = $response->getContent();

            // Check if the response has a closing body tag
            if (is_string($content) && str_contains($content, '</body>')) {
                // Render the toastr component
                $toastrHtml = View::make('components.toastr')->render();

                // Insert before the closing body tag
                $content = str_replace('</body>', $toastrHtml . '</body>', $content);
                $response->setContent($content);
            }
        }

        return $response;
    }

    /**
     * Determine if the response is an HTML response.
     */
    protected function isHtmlResponse($response): bool
    {
        if (!$response instanceof SymfonyResponse) {
            return false;
        }

        $contentType = $response->headers->get('Content-Type');

        return $contentType && (
            str_contains($contentType, 'text/html') ||
            str_contains($contentType, 'application/xhtml+xml')
        );
    }
}
