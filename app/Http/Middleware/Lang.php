<?php

namespace App\Http\Middleware;

use Closure;

class Lang
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    // if (session()->has('lang')) {
    // 	app()->setLocale(lang());
    // } else {
    // 	app()->setLocale('ar');
    // }
    app()->setLocale(lang());
    return $next($request);
  }
}
