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
                                    <th>收藏人</th>
                                    <th>联系电话</th>
                                    <th>收藏时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td style="text-align: center;">{{$data->userName}}</td>
                                        <td style="text-align: center;">{{$data->phoneNumber}}</td>
                                        <td style="text-align: center;">{{$data->updated_at}}</td>
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

