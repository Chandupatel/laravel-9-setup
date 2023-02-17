<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if ($this->auth->guard($guard)->check()) {
            $this->auth->shouldUse($guard);
            return $next($request);
        } else {
            return redirect(route('admin.login'));
        }
    }
}