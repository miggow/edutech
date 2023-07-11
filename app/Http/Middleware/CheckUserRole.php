<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUserRole
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
        // Kiểm tra vai trò của người dùng
        $userRole = Auth::user()->role; // Giả sử trường role được lưu trong bảng users
        
        // Kiểm tra vai trò và chuyển tiếp hoặc từ chối truy cập
        if ($userRole == 2 || $userRole == 1) {
            return $next($request);
        }
        
        // Không cho phép truy cập nếu vai trò không phải là 2
        abort(403, 'Unauthorized');
    }
}
