<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next ,...$types): Response
    {
        $user=Auth::user();
        if(!$user)
        {
            return redirect()->route('login');
        }
        if(!in_array($user->type,$types))
        {
            abort(403);
        }
        return $next($request);
    }
}