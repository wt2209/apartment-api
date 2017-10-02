<?php

namespace App\Http\Middleware;

use Closure;

class RBACPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = $request->user();
        if ($this->isSuperAdmin($user)) {
            return $next($request);
        }

        try {
            if ($user->can($permission)) {
                return $next($request);
            }
        } catch(\Exception $e) {
            return response()->json(['error'=>'未定义权限'], 401);
        }

        return response()->json(['error'=>'没有权限'], 401);
    }

    private function isSuperAdmin($user)
    {
        return $user->id == 1;
    }
}
