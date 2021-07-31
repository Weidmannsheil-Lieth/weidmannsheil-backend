<?php

namespace App\Http\Controllers\Internal\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\AuthResource;
use App\Models\RequestLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    protected array $routeTranslations = [
        'global'         => 'Alle',
        'administration' => 'Leitung',
        'rout'           => 'Gespann',
        'rout-history'   => 'Verlauf Gespanne',
        'notice'         => 'Wichtige Hinweise',
        'news'           => 'Aktuelles',
        'gallery'        => 'Galerie',
        'redirect'       => 'Weiterleitung',
        'result'         => 'Ergebnisse'
    ];

    /**
     * @return array
     */
    public function requestsToday(): array
    {
        $requestLogs = RequestLog::whereDate('recording_at', today())->get();
        $first = $requestLogs->where('route', '=', 'global')->first();

        if (!$first) {
            return [];
        }

        $items = [
            $this->routeTranslations['global'] => $requestLogs->where('route', '=', 'global')->first()->count
        ];

        foreach ($requestLogs->where('route', '<>', 'global') as $requestLog) {
            $items[$this->routeTranslations[$requestLog->route]] = $requestLog->count;
        }

        return $items;
    }

    /**
     * @return array
     */
    public function requestsMonth(): array
    {
        $items = [];
        $requestLogs = RequestLog::whereMonth('recording_at', today())->orderBy('recording_at')->get();

        $globalEntries = $requestLogs->where('route', '=', 'global');
        $entries = $requestLogs->where('route', '<>', 'global');

        $this->mapEntryInItems($items, $globalEntries);
        $this->mapEntryInItems($items, $entries);

        $returnItems = [];
        foreach (array_keys($items) as $key) {
            $returnItems [] = [
                'name' => $key,
                'data' => $items[$key]
            ];
        }

        return $returnItems;
    }

    /**
     * @param $items
     * @param $entries
     */
    protected function mapEntryInItems(&$items, $entries)
    {
        foreach ($entries as $entry) {
            $routTranslation = $this->routeTranslations[$entry->route];

            if (!Arr::exists($items, $routTranslation)) {
                $items[$routTranslation] = [];
            }

            $carbonDate = Carbon::parse($entry->recording_at)->format('d.m.Y');
            $items[$routTranslation][$carbonDate] = $entry->count;
        }
    }
}
