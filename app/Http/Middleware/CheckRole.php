<?php
namespace App\Http\Middleware;
use Closure;
 
class CheckRole
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
        $role = $this->CekRoute($request->route());
        
        if($request->user()->hasRole($role) || !$role)
        {
            return $next($request);
        }
        return abort(503, 'Anda tidak memiliki hak akses');
    }
 
    private function CekRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['role']) ? $actions['role'] : null;
    }
}