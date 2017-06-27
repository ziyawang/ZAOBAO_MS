@extends("layouts.master")
@section("content")
    <div id="content">
        <div id="breadcrumb">
            <a href="{{asset('note/index')}}" title="反馈列表" class="tip-bottom"><i class="icon-home"></i>反馈列表</a>
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
                                    <th>姓名</th>
                                    <th>手机号</th>
                                    <th>问题</th>
                                    <th>时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td style="width:5%;text-align: center;">{{$data->noteId}}</td>
                                        <td style="width:10%;text-align: center;">{{$data->connecter}}</td>
                                        <td style="width:10%;text-align: center;">{{$data->Phone}}</td>
                                        <td style="width:50%;text-align: center;">{{$data->content}}</td>
                                        <td style="width: 15%;text-align: center;">{{$data->created_at}}</td>
                                        <td style="width: 10%;text-align: center;">
                                            @if($data->status==1)
                                                <a class="btn btn-primary"id="{{$data->noteId}}" >已处理</a>
                                              {{--  <a class="btn btn-primary"id="handled_{{$data->noteId}}" >详情</a>--}}
                                            @else
                                                <a class="btn btn-danger" id="{{$data->noteId}}" style="text-align: center">处理</a>
                                               {{-- <a class="btn btn-primary"id="handled_{{$data->noteId}}" >详情</a>--}}
                                            @endif
                                        </td>
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

