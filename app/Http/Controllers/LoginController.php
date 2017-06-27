<?php

namespace App\Http\Controllers;

use App\AdminUser;
use App\Auth;
use App\RoleAuth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view("login.index");
        
    }

    /**
     * @return array
     */
    public function handle()
    {
       $email = $_POST['user'];
        $password = $_POST['password'];
        $str = array();
        $users = AdminUser::where("Email", $email)->count();
        if ($users) {
            $counts = AdminUser::where("Email", $email)->where("PassWord", md5($password))->count();
            if ($counts) {
                $data = AdminUser::where("Email", $email)->where("PassWord", md5($password))->get();
                foreach ($data as $value) {
                        $userId = $value->id;
                        $roleId = $value->RoleID;
                        $pAuths = RoleAuth::leftJoin("T_AS_AUTH", "T_AS_AUTH.Auth_ID", "=", "T_AS_ROLEAUTH.AuthID")
                                            ->where(["Level" => 1, "RoleID" => $roleId])
                                            ->get();
                        $Auths =RoleAuth::leftJoin("T_AS_AUTH", "T_AS_AUTH.Auth_ID", "=", "T_AS_ROLEAUTH.AuthID")
                                            ->where(["Level" => 2, "RoleID" => $roleId])
                                            ->get();
                        $lds_pId=RoleAuth::leftJoin("T_AS_AUTH", "T_AS_AUTH.Auth_ID", "=", "T_AS_ROLEAUTH.AuthID")
                                        ->where(["Level" => 1, "RoleID" => $roleId])
                                        ->take(1)
                                        ->pluck("Auth_ID");
                        $lds_Id=RoleAuth::leftJoin("T_AS_AUTH", "T_AS_AUTH.Auth_ID", "=", "T_AS_ROLEAUTH.AuthID")
                                        ->where("PID",$lds_pId)
                                        ->where(["Level" => 2, "RoleID" => $roleId])
                                        ->take(1)
                                        ->pluck("Auth_ID");
                    $lds_url=RoleAuth::leftJoin("T_AS_AUTH", "T_AS_AUTH.Auth_ID", "=", "T_AS_ROLEAUTH.AuthID")
                                        ->where("PID",$lds_pId)
                                        ->where(["Level" => 2, "RoleID" => $roleId])
                                        ->take(1)
                                        ->pluck("Path");
                    }
                foreach ($pAuths as $pAuth) {
                        $id = $pAuth->Auth_ID;
                        $count = RoleAuth::leftJoin("T_AS_AUTH", "T_AS_AUTH.Auth_ID", "=", "T_AS_ROLEAUTH.AuthID")
                                            ->where(["Level" => 2, "RoleID" => $roleId, "PID" => $id])
                                            ->count();
                        $pAuth->count = $count;
                    }
                session([ 'pAuths' => $pAuths, 'Auths' => $Auths, "userId" => $userId,"lds_pId"=>$lds_pId,"lds_Id"=>$lds_Id]);
                $str['code']="success";
                $str['lds_url']=$lds_url;
                return $str;
            } else {
                    $str['code'] = "pwd";
                    $str['msg'] = "密码错误";
                    return $str;
                }
            } else {
                $str['code'] = "user";
                $str['msg'] = "用户名错误";
                return $str;
            }
        }
    /**请求菜单中的路由数据
     * @return mixed
     */
    protected  function getPath(){
        $ldsId=$_POST['authId'];
        $result=Auth::select("Auth_ID","Path","PID")->where("Auth_ID",$ldsId)->get();
        $arr=array();
        foreach($result as $value){
            $arr["lds_path"]=$value->Path;
            $arr["lds_pId"]=$value->PID;
            $arr["lds_Id"]=$value->Auth_ID;
        }
        session(["lds_pId"=>$arr["lds_pId"],"lds_Id"=>$arr["lds_Id"]]);
        return json_encode($arr);

    }

    //修改密码首页
    public function wordEdit(){
        $id=Session::get("userId");
        $datas=AdminUser::where("id",$id)->get();
        return view("login/wordEdit",compact("datas"));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function wordUpdate(Request $request){
        $pwd=$_POST['pwd'];
        $pwd2=$_POST['pwd2'];
        if(empty($pwd)){
            return back()->with("msg","*请您输入新的密码!");
            return view("login/wordEdit");
        }
        if(empty($pwd2)){
            return back()->with("msg1","*请您输入确认密码!");
            return view("login/wordEdit");
        }elseif($pwd!=$pwd2){
            return back()->with("msg2","*确认密码与新密码不一致!");
            return view("login/wordEdit");
        }

        $db=AdminUser::where("id",$_POST['userId'])
            ->update([
                "PassWord"=>md5($pwd),
                'updated_at'=>date("Y-m-d H:i:s", time())

            ]);
        if($db){
            $request->session()->flush();
            return Redirect::to("/");
        }else{
            return view("login/wordEdit");

        }
    }

    /**
     * 退出
     * @param Request $request
     */
    public  function  quit( Request $request){
        $request->session()->flush();
        return Redirect::to("/");
    }


}
