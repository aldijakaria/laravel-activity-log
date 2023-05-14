<?php

namespace Aldijakaria\LaravelActivityLog\Middleware;

use Aldijakaria\LaravelActivityLog\Models\LogActivity;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TrackUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $desc = ''): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        if (config('laravel-activity-log.track') && (!$request->ajax()) && (auth()->user() != null) ){
            $log['param'] =  json_encode($request->query(), true);
            $log['url'] = $request->path();
            $log['method'] = $request->method();
            $log['ip'] = $request->ip();
            $log['agent'] = $request->header('user-agent');
            $log['description'] = $desc;
            $log['user_id'] = auth()->user()->id;

            $last = Cache::remember('activity-'.auth()->user()->id, 8*60, function (){
                return LogActivity::query()->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
            });

            if ($last != null && $last->param == $log['param'] && $last->url == $log['url'] && $last->method == $log['method']){
                return $next($request);
            }
            LogActivity::create($log);
            Cache::put('activity-'.auth()->user()->id,LogActivity::query()->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first(),8*60);
        }

        return $next($request);
    }
}
