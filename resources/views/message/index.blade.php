@extends("layouts.master")
@section("content")
    <div id="content">
        <div id="breadcrumb">
            <a href="{{asset('message/index')}}" title="项目留言" class="tip-bottom"><i class="icon-home"></i>项目留言</a>
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
                                    <th>项目序号</th>
                                    <th>项目标题</th>
                                    <th>留言人</th>
                                    <th>时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td style="text-align: center;">{{$data->messageId}}</td>
                                        <td style="text-align: center;">{{$data->projectId}}</td>
                                        <td style="text-align: center;">{{$data->title}}</td>
                                        <td style="text-align: center;">{{$data->phone}}</td>
                                        <td style="text-align: center;">{{$data->created_at}}</td>
                                        @if(!empty($data->reply))
                                            <td style="text-align: center;color:#5897fb">已回复</td>
                                        @else
                                            <td style="text-align: center;color:#5897fb">未回复</td>
                                        @endif
                                        <td style="text-align: center;">
                                            <a href="{{asset('message/detail/'.$data->messageId)}}" >详情</a>
                                           {{-- <a href="{{asset('project/delete/'.$data->projectId)}}" onclick="return confirm('您确定要删除吗!')">删除</a>--}}
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
