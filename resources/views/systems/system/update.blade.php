@extends('layouts.master')
@section('content')
    <div id="content">
    <div id="breadcrumb" style="position:relative">
        <a href="{{url("system/index")}}" title="人员管理" class="tip-bottom"><i class="icon-home"></i>人员管理</a>
        <a href="#" class="current">编辑用户</a>
    </div>

        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                        <h5>编辑用户</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{asset('systems/system/update')}}"  />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{$datas['id']}}">
                        <div class="control-group">
                            <label class="control-label">姓名</label>
                            <div class="controls">
                                <input type="text" name="name" id="required" value="{{$datas['Name']}}" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">邮箱</label>
                            <div class="controls">
                                <input type="text" name="email" id="email" value="{{$datas['Email']}}"/>
                                @if(session(("msg0")))
                                    <span class="help-inline"  id= "remark" for="pwd" generated="true" style=" color: red">{{session("msg0")}}</span>
                                @endif
                                @if(session(("msg2")))
                                    <span class="help-inline"  id= "remark" for="pwd" generated="true" style="color: red">{{session("msg2")}}</span>
                                @endif
                                @if(session(("msg5")))
                                    <span class="help-inline"  id= "remark" for="pwd" generated="true" style="color: red">{{session("msg5")}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">手机号</label>
                            <div class="controls">
                                <input type="text" name="number" id="date" value="{{$datas['PhoneNumber']}}"/>
                                @if(session(("msg3")))
                                    <span class="help-inline"  id= "remark" for="pwd" generated="true" style=" color: red">{{session("msg3")}}</span>
                                @endif
                                @if(session(("msg4")))
                                    <span class="help-inline"  id= "remark" for="pwd" generated="true" style="color: red">{{session("msg4")}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">部门</label>
                            <div class="controls">
                                <select  name="department" id="url" />
                                    <option value="CEO"   @if($datas['Department']=='CEO') selected="selected" @endif>CEO</option>
                                    <option value="技术部"   @if($datas['Department']=='技术部') selected="selected" @endif>技术部</option>
                                    <option value="产品部"  @if($datas['Department']=='产品部')selected="selected" @endif>产品部</option>
                                    <option value="投资事业部"  @if($datas['Department']=='投资事业部') selected="selected" @endif>投资事业部</option>
                                    <option value="人事部"  @if($datas['Department']=='人事部') selected="selected" @endif>人事部</option>
                                    <option value="渠道开发部" @if($datas['Department']=='渠道开发部') selected="selected" @endif>渠道开发部</option>
                                    <option value="信息开发部" @if($datas['Department']=='信息开发部') selected="selected" @endif>信息开发部</option>
                                    <option value="视频部" @if($datas['Department']=='视频部') selected="selected" @endif>视频部</option>
                                    <option value="财务部" @if($datas['Department']=='财务部') selected="selected" @endif>财务部</option>
                                    <option value="副总" @if($datas['Department']=='副总') selected="selected" @endif>副总</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">角色</label>
                            <div class="controls">
                                <select  name="roleName" id="url" />
                                @foreach($results as $result)
                                    <option value="{{$result->id}}" @if($result->id==$datas['RoleID'])selected="selected" @endif >{{$result->RoleName}}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" value="编辑" class="btn btn-primary" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection