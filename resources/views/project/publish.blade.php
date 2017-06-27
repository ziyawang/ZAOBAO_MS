@extends("layouts.master")
@section("content")
    <div id="content">
        <div id="breadcrumb">
            <a href="{{asset('note/index')}}" title="项目列表" class="tip-bottom"><i class="icon-home"></i>项目列表</a>
            <a href="#" class="current">列表</a>
            <a href="{{url('project/add')}}" class="pull-right"> <button class="btn btn-primary">添加项目</button></a>
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
                                    <th>标题</th>
                                    <th>类型</th>
                                    <th>时间</th>
                                    <th>浏览量</th>
                                    <th>收藏量</th>
                                    <th>发布状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td style="text-align: center;">{{$data->projectId}}</td>
                                        <td style="text-align: center;">{{$data->title}}</td>
                                        @if($data->type==1)
                                            <td style="text-align: center;">咨询</td>
                                        @elseif($data->type==2)
                                            <td style="text-align: center;">找项目</td>
                                        @else
                                            <td style="text-align: center;">资产包</td>
                                        @endif
                                        <td style="text-align: center;">{{$data->created_at}}</td>
                                        <td style="text-align: center;">{{$data->viewCount}}</td>
                                        <td style="text-align: center;"><a href="{{asset('project/getCollect/'.$data->projectId)}}">{{$data->collect}}</a></td>
                                        @if($data->publishStatus==1)
                                            <td style="text-align: center;color: #5897fb">未发布</td>
                                        @else
                                            <td style="text-align: center;color: #5897fb">已发布</td>
                                        @endif
                                        <td style="text-align: center;">
                                            <a href="{{asset('project/getDetail/'.$data->projectId)}}" >详情</a>
                                            <a href="{{asset('project/delete/'.$data->projectId)}}" onclick="return confirm('您确定要删除吗!')">删除</a>
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

@endsection

