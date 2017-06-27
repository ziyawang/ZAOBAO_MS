<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{

    /**
     * @return mixed
     */
    public function index(){
        $datas=Message::leftJoin("T_P_PROJECT","T_P_PROJECT.projectId","=","T_P_MESSAGE.projectId")
                        ->select("T_P_PROJECT.title","T_P_MESSAGE.*","T_P_PROJECT.projectId")
                        ->where("T_P_PROJECT.deleteLabel",0)
                        ->orderBy("created_at","desc")
                        ->paginate(20);
        return view("message.index",compact("datas"));
    }

    /**留言详情
     * @param $messageId
     * @return mixed
     */
    public  function detail($messageId){
        session(["message_url"=>$_SERVER["HTTP_REFERER"]]);
        $datas=Message::leftJoin("T_P_PROJECT","T_P_PROJECT.projectId","=","T_P_MESSAGE.projectId")
            ->select("T_P_PROJECT.title","T_P_MESSAGE.phone","T_P_MESSAGE.content as contents","T_P_PROJECT.content","T_P_PROJECT.describe","T_P_MESSAGE.reply","T_P_MESSAGE.messageId")
            ->where("T_P_MESSAGE.messageId",$messageId)
            ->get();
         return view("message.detail",compact("datas"));
    }

    /**
     * 保存
     *
     * @return mixed
     */
    public  function  save(){
        $result=Message::where("messageId",$_POST['messageId'])->update([
            "reply"=>!empty($_POST['reply'])?$_POST['reply']:"",
            "updated_at"=>date("Y-m-d H:i:s",time()),
        ]);
        if($result){
            echo "<script>location.href='".session('message_url')."';</script>";
        }else{
            return redirect()->back()->withInput()->with("msg","保存失败");
        }
    }

}
