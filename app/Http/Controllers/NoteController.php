<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{

    /**
     * @return mixed
     */
    public function index(){
        $datas=Note::orderBy("created_at","desc")->paginate(20);
        return view("note.index",compact("datas"));

    }

    /**
     * 处理反馈的信息
     * @return array
     */
    public  function  changeStatus(){
        $noteId=$_POST['noteId'];
        $result=Note::where("noteId",$noteId)->update([
            "status"=>1,
            "updated_at"=>date("Y-m-d H:i:s",time())
        ]);
        if($result){
            return array("status_code"=>200);
        }else{
            return array("status_code"=>400);
        }
    }


}
