<?php

namespace App\Http\Middleware;

use App\Models\RequestLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class RequestLogger
{
    protected string $globalRouteName = 'global';

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(): void
    {
        $requestLogs = $this->getRequestLogs();

        if (count($requestLogs) !== 2) {
            $requestLogs = $this->createRequestLogs();
        }

        $requestLogIds = $requestLogs->map(static function ($item) {
            return $item->id;
        });

        RequestLog::whereIn('id', $requestLogIds)->increment('count');
    }

    /**
     * @return mixed
     */
    protected function getRequestLogs()
    {
        $globalRouteName = $this->globalRouteName;

        return RequestLog::whereDate('recording_at', today())
            ->where(static function ($query) use ($globalRouteName) {
                return $query->where('route', Route::currentRouteName())
                    ->orWhere('route', $globalRouteName);
            })
            ->get();
    }

    /**
     * @return Collection
     */
    protected function createRequestLogs(): Collection
    {
        $requestLogs = collect([]);

        $requestLogs->push(RequestLog::firstOrCreate([
            'recording_at' => today(),
            'route'        => Route::currentRouteName()
        ]));

        $requestLogs->push(RequestLog::firstOrCreate([
            'recording_at' => today(),
            'route'        => $this->globalRouteName
        ]));

        return $requestLogs;
    }
}
