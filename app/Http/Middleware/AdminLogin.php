<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        $result = $request->session()->has('u_id');
        // dd($result);
        if($result!=null){
            echo "";
        }else{
            echo ("<script>alert('请先登录');location='/admin/login'</script>");
        }
        return $next($request);
    }
}
