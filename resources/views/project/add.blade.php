@extends('layouts.master')
@section('content')
    <style>
        .newsType .checker span .checker span{background-position: -76px -240px;}
    </style>
    <div id="content">
        <div id="breadcrumb">
            <a href="{{asset('project/publish')}}" title="项目列表" class="tip-bottom"><i class="icon-home"></i></a>
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
                        <h5>添加项目</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{asset('project/saveAdd')}}" />
                        <div class="control-group">
                                <label class="control-label">标题</label>
                                <div class="controls">
                                    <input type="text" name="title" id="title" value="{{old('title')}}"  />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label checkState">项目类型</label>
                                <div class="controls selectBox" >
                                    <select  name="type" id="type"/>
                                 {{--   <option value="1" @if($data->type==1) selected="selected" @endif>资讯</option>--}}
                                        <option value="3" >资产包</option>
                                        <option value="1">资讯</option>
                                        <option value="2">找项目</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">标签</label>
                                <div class="controls newsType">

                                   {{-- <input type="checkbox" name="type['package']" value="{{$type->id}}"/>{{$type->TypeName}}--}}
                                    <input type="checkbox" name="label[package]" value="1"/>资产包
                                    <input type="checkbox" name="label[legal]" value="2"/>法拍资产
                                    <input type="checkbox" name="label[land]" value="3"/>土地
                                    <input type="checkbox" name="label[house]" value="4"/>房产
                                    <input type="checkbox" name="label[office]" value="5"/>写字楼

                                   {{-- <input type="checkbox" name="type[]" value="{{$type->id}}" @if(in_array($type->id,$count)) checked="checked" @endif />{{$type->TypeName}}--}}

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">项目描述</label>
                                <div class="controls">
                                    <textarea name="content"  >{{old('content')}}</textarea>
                                </div>
                            </div>
                           {{-- <div class="control-group">
                                <label class="control-label">项目内容</label>
                                <div class="controls">
                                    <textarea name="content" id="content"  >{{old('content')}}</textarea>

                                </div>
                            </div>--}}
                        <script src="{{asset('./FileUpload/js/vendor/jquery.ui.widget.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.fileupload.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.iframe-transport.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.fileupload-process.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.fileupload-validate.js')}}"></script>
                        <style>
                            .pictures{float: left;margin-right: 20px;display: none;position: relative;margin-bottom: 28px;}
                            .pictures img{width: 150px;height: 150px;border: 1px solid #ccc;}
                            .deleteImg{position: absolute;width: 22px; height: 22px; background: #b8b8b8 url(/img/zhifu.png) no-repeat -147px -46px;cursor: pointer;right: 0;top: 0;}
                        </style>
                        <div class="control-group">
                            <label class="control-label">项目详情</label>
                            <div class="controls ec_right upload">
                                {{-- <div class="ec_right upload">--}}
                                <div class="fileinput-button">
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="fileupload" type="file" name="files[]" data-url="{{asset('public/upload')}}" multiple accept="image/png, image/gif, image/jpg, image/jpeg">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <p id="nopz" style="margin-left:170px;" class="error"></p>
                            <div class="clearfix img_box" style="margin-left:200px;">
                                <div class="pictures"><img class="preview" id="PictureDes1" src=""  picname=''><span class="deleteBtn1 deleteImg" title="删除" style="display: none"></span></div>
                            </div>
                            <p><input type="hidden" name="PictureDes1" value=""></p>
                        </div>
                        <script>
                            $(function(){
                                $('#fileupload').fileupload({
                                    dataType: 'json',
                                    formAcceptCharset :'utf-8',
                                    maxNumberOfFiles : 5,
                                    done: function (e, data) {
                                        $.each(data.result.files, function (index, file) {
                                            // console.log(file.name);
                                            $('input[name=PictureDes]').val(data);
                                            var name = $(".preview[src='']:first").attr('id');
                                            $("input[name='" + name + "']").val('/user/' + file.name);
                                            $(".preview[src='']:first").next().hide();
                                            $(".preview[src='']:first").attr({'src':encodeURI('http://images.ziyawang.com/user/'+file.name), 'picname':file.name}).parent().show();
                                            $('#nopz').html('');
                                        });
                                    }
                                });
                                $('.pictures').hover(function(){
                                    $(this).children('.deleteImg').toggle();
                                })
                                $('.deleteImg').click(function(){
                                    var _this = $(this);
                                    $(_this).parent().hide();
                                    $(_this).hide();
                                    var typeId=  $(_this).prev().attr("id");
                                    $("input[name='"+typeId+"']").val("");
                                    $(_this).prev().attr('src','');
                                    var url = "http://admin.ziyawang.com/public/upload?file=" + $(this).prev().attr('picname');
                                    $.ajax({
                                        'url':url,
                                        'type': 'DELETE',
                                        'success':function(msg){
                                        }
                                    })

                                })
                            });
                        </script>
                            <div class="control-group">
                                <label class="control-label">联系电话</label>
                                <div class="controls">
                                    <input type="text" name="phoneNumber" id="phoneNumber" value="{{old('phoneNumber')}}"  />
                                </div>
                            </div>
                            <div class="form-actions">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection