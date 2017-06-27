@extends("layouts.master")
@section("content")
    <style>
        .newsAbstract div{
            height:40px;
            width:100%;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;text-overflow:ellipsis;}
    </style>
    <div id="content">
        <div id="breadcrumb">
            <a href="{{asset('project/check')}}" title="项目审核" class="tip-bottom"><i class="icon-home"></i>项目审核</a>
            <a href="#" class="current">列表</a>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>联系人</th>
                                    <th>手机号</th>
                                    <th class="newsAbstract">项目描述</th>
                                    <th>项目类型</th>
                                    <th>时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td style="width:5%;text-align: center;">{{$data->publishId}}</td>
                                        <td style="width:10%;text-align: center;">{{$data->connecter}}</td>
                                        <td style="width:10%;text-align: center;">{{$data->phone}}</td>
                                        <td style="width:40%;text-align: left;" class="newsAbstract"><div>{{$data->describe}}</div></td>
                                        @if($data->type==1)
                                            <td style="width: 10%;text-align: center;">出售资产</td>
                                        @else
                                            <td style="width: 10%;text-align: center;">求购需求</td>
                                        @endif
                                        <td style="width:15%;text-align: center;">{{$data->created_at}}</td>

                                        @if($data->status==0)
                                            <td style="width: 10%;text-align: center;color:#5897fb">未读</td>
                                            {{--  <a class="btn btn-primary"id="handled_{{$data->noteId}}" >详情</a>--}}
                                        @elseif($data->status==1)
                                            <td style="width: 10%;text-align: center;color: #5897fb">已读</td>
                                        @else
                                            <td style="width: 10%;text-align: center;color: #5897fb">已联系</td>
                                        @endif
                                        <td style="width: 5%;text-align: center;"><a href="{{asset('project/detail/'.$data->publishId)}}" >详情</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pagination">
                        {!! $datas->render() !!}
                    </div>
                </div>
            </div>
            <script>
                $(".btn-danger").on("click",function(){
                    var noteId=$(this).attr("id");
                    $.ajax({
                        url:"{{asset('note/changeStatus')}}",
                        data:{"noteId":noteId},
                        dataType:"json",
                        type:"POST",
                        success:function(res){
                            if(res['status_code']==200){
                                window.location.reload("{{asset('note/index')}}");
                            }
                        }
                    })

                })
            </script>

@endsection

