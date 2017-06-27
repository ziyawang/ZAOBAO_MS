@extends('layouts.master')
@section('content')
    <style>
        .newsType .checker span .checker span{background-position: -76px -240px;}
    </style>
    <div id="content">
        <div id="breadcrumb">
            <a href="{{url('project/check')}}" title="项目列表" class="tip-bottom"><i class="icon-home"></i></a>
            <a href="#" class="current">项目列表</a>
        </div>
        @if(session("msg"))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>{{session("msg")}}</strong>
            </div>
        @endif
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                    <span class="icon">
                        <i class="icon-align-justify"></i>
                    </span>
                        <h5>项目详情</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{asset('project/save')}}" />
                        @foreach($datas as $data)
                            <input type="hidden" name="publishId" value="{{ $data->publishId }}">
                            <div class="control-group">
                                <label class="control-label">联系人</label>
                                <div class="controls">
                                    <input type="text" name="connecter" id="connecter" value="{{$data->connecter}}" readonly  />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">联系电话</label>
                                <div class="controls">
                                    <input type="text" name="phone" id="phone" value="{{$data->phone}}" readonly  />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">公司名称</label>
                                <div class="controls">
                                    <input type="text" name="company" id="company" value="{{$data->company}}" readonly  />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label checkState">项目类型</label>
                                <div class="controls selectBox" >
                                    <select  name="type" id="type"/>
                                    <option value="1" @if($data->type==1) selected="selected" @endif>出售资产</option>
                                    <option value="2" @if($data->type==2) selected="selected" @endif>求购需求</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">项目描述</label>
                                <div class="controls">
                                    <textarea name="describe" id="describe" readonly >{{$data->describe}}</textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label checkState">状态</label>
                                <div class="controls selectBox" >
                                    <select  name="status" id="status"/>
                                    <option value="0" @if($data->status=="0") selected="selected" @endif>未读 </option>
                                    <option value="1" @if($data->status=="1") selected="selected" @endif>已读 </option>
                                    <option value="2" @if($data->status=="2") selected="selected" @endif>已联系</option>
                                    </select>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">保存</button>
                            <button type="button" class="btn btn-primary" onclick="javascript:history.back(-1);">返回</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection