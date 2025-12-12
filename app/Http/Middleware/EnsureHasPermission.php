<?php


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureHasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $aPermission): Response
    {

        if (!auth()->check()){
            return redirect(route('login'));
        }

        if (!auth()->user()->hasPermission($aPermission)){
            abort(403);
        }

        return $next($request);

    }
}
