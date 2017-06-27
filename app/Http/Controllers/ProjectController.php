<?php

namespace App\Http\Controllers;

use App\Collect;
use App\Project;
use App\Publish;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;

class ProjectController extends Controller
{

    /**
     * 客户发布的信息
     * @return mixed
     */
    public function check(){
        $datas=Publish::orderBy("created_at","desc")->paginate(20);
        return view("project.check",compact("datas"));
    }

    /**
     * 发布项目
     * @return mixed
     */
    public function  publish(){
        $datas=Project::where("deletelabel",0)->orderBy("created_at","desc")->paginate(20);
        foreach ($datas as $data){
            $projectId=$data->projectId;
            $collects=Collect::where("projectId",$projectId)->where("status",1)->count();
            $data->collect=$collects;
        }
        return view("project.publish",compact("datas"));
    }

    /**
     * @param $publishId
     * @return mixed
     */
    public  function  detail($publishId){
        session(["url"=>$_SERVER["HTTP_REFERER"]]);
        $datas=Publish::where("publishId",$publishId)->get();
        return view("project.detail",compact("datas"));
    }

    /**发布详情保存
     * @return mixed
     */
    public  function  save(){
        $publishId=$_POST['publishId'];
        $datas=Publish::where("publishId",$publishId)->update([
                "type"=>$_POST['type'],
                "status"=>$_POST['status'],
                "updated_at"=>date("Y-m-d H:i:s",time()),
        ]);
        if($datas){
            echo "<script>location.href='".session('url')."';</script>";
        }else{
            return redirect()->back()->withInput()->with("msg","编辑失败");
        }
    }


    /**
     * 保存项目的详情
     * @param $projectId
     * @return mixed
     */
    public  function  getDetail($projectId){
        session(["publish_url"=>$_SERVER["HTTP_REFERER"]]);
        $datas=Project::where("projectId",$projectId)->get();
        return view("project.getDetail",compact("datas"));
    }

    /**
     * 添加项目
     * @return mixed
     */
    public  function  add(){
        return view("project.add");
    }

    /**
     * 保存添加的项目
     * @return mixed
     */
    public function  saveAdd(){
        //dd($_POST);
        foreach($_POST as $key=> $val){
            if($key!="PictureDes1" &&$key!="files"){
                if(empty($val)){
                    return redirect()->back()->withInput()->with("msg",$key."请您将信息填写完整");
                }
            }
        }
        $datas=Project::insert([
            "title"=>$_POST['title'],
            "content"=>$_POST['content'],
            "type"=>$_POST['type'],
            "describe"=>!empty($_POST['PictureDes1'])?$_POST['PictureDes1']:"",
            "package"=>isset($_POST['label']['package'])?$_POST['label']['package']:0,
            "legal"=>isset($_POST['label']['legal'])?$_POST['label']['legal']:0,
            "land"=>isset($_POST['label']['land'])?$_POST['label']['land']:0,
            "house"=>isset($_POST['label']['house'])?$_POST['label']['house']:0,
            "office"=>isset($_POST['label']['office'])?$_POST['label']['office']:0,
            "phoneNumber"=>$_POST['phoneNumber'],
            "deleteLabel"=>0,
            "publishStatus"=>1,
            "created_at"=>date("Y-m-d H:i:s",time()),
            "updated_at"=>date("Y-m-d H:i:s",time()),

        ]);
        if($datas){
            return redirect("project/publish");
        }else{
            return redirect()->back()->withInput()->with("msg","添加失败");
        }
    }

    /**
     * @param $projectId
     */
    public function  delete($projectId){
        session(["publish_url"=>$_SERVER["HTTP_REFERER"]]);
        try{
            $result=Project::where("projectId",$projectId)->update([
                "deleteLabel"=>1,
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
        }catch(Exception $e){
            throw $e;
        }
        if(isset($e)){
            echo "<script>location.href='".session('publish_url')."';</script>";
        }else{
            echo "<script>location.href='".session('publish_url')."';</script>";
        }


    }

    /**
     * @return mixed
     */
    public function  getSave(){
        foreach($_POST as $key=> $val){
            if($key!="PictureDes1" &&$key!="files"){
                if(empty($val)){
                    return redirect()->back()->withInput()->with("msg",$key."请您将信息填写完整");
                }
            }
        }
        $datas=Project::where("projectId",$_POST['projectId'])->update([
            "title"=>$_POST['title'],
            "content"=>$_POST['content'],
            "type"=>$_POST['type'],
            "describe"=>!empty($_POST['PictureDes1'])?$_POST['PictureDes1']:"",
            "package"=>isset($_POST['label']['package'])?$_POST['label']['package']:0,
            "legal"=>isset($_POST['label']['legal'])?$_POST['label']['legal']:0,
            "land"=>isset($_POST['label']['land'])?$_POST['label']['land']:0,
            "house"=>isset($_POST['label']['house'])?$_POST['label']['house']:0,
            "office"=>isset($_POST['label']['office'])?$_POST['label']['office']:0,
            "phoneNumber"=>$_POST['phoneNumber'],
            "publishStatus"=>$_POST['publishStatus'],
            "updated_at"=>date("Y-m-d H:i:s",time()),

        ]);
        if($datas){
            echo "<script>location.href='".session('publish_url')."';</script>";
        }else{
            return redirect()->back()->withInput()->with("msg","保存失败");
        }
    }

    /**收藏详情
     * @param $projectId
     * @return mixed
     */
    public  function  getCollect($projectId){
        $datas=Collect::where("projectId",$projectId)->where("status",1)->paginate(20);
        foreach($datas as $data){
            $userId=$data->userId;
            $results=User::select("username","phonenumber")->where("userid",$userId)->get();
            foreach ($results as $result){
                $data->userName=$result->username;
                $data->phoneNumber=$result->phonenumber;
            }
        }
        return view("project.getCollect",compact("datas"));

    }






}
