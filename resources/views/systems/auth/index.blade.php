@extends('layouts.master')
@section('content')
    <div id="content">
    <div id="breadcrumb" style="position: relative">
        <a href="{{asset("auth/index")}}" title="权限管理" class="tip-bottom"><i class="icon-home"></i>权限管理</a>
        <a href="#" class="current">角色列表</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>角色名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td style="text-align: center">{{$data->RoleName}}</td>
                        <td style="text-align: center">
                            <a href="{{url('auth/assign/'.$data->id)}}">分配权限</a>&nbsp&nbsp&nbsp
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate" >
            {!! $datas->render() !!}
        </div>
    </div>
    </div>
    @endsection