<?php

namespace App\Http\Middleware;

use App\RoleAuth;
use App\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $public_url=array("/","login/handle","login/quit","login/getPath","publidc/upload");
        $userId=session("userId");
        $allAuthRole=array("1");
        $roleId=UserRole::where("UserId",$userId)->pluck("RoleID");
        $url_paths=RoleAuth::leftJoin("T_AS_AUTH","T_AS_AUTH.Auth_ID","=","T_AS_ROLEAUTH.AuthID")->where("RoleId",$roleId)->where("Level",2)->get();
        $url_path=array();
        foreach ($url_paths as $val){
            $url_path[]=$val->Path;
        }
        $current_path=$path = $request->path();
        if(!in_array($roleId,$allAuthRole)){
             if(in_array($current_path,$public_url) || in_array($current_path,$url_path)){
                 return $next($request);
             }else{
                 return Redirect::to("/");
             }
        }else{
            return $next($request);
        }
    }
}
