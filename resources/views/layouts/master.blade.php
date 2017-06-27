<!DOCTYPE html>
<html lang="en">
<!-- container-fluid -->
<head>
    <title>资芽早报</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css ')}}"/>
    <link rel="stylesheet" href="{{asset('css/bootstrap-responsive.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/select2.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/unicorn.main.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/unicorn.grey.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/uploadifive.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/uniform.css')}}" class="skin-color"/>
    <link rel="stylesheet" href="{{asset('css/fullcalendar.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}"/>


    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/unicorn.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/unicorn.form_validation.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('js/jquery.uploadifive.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/unicorn.tables.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.zh-CN.js')}}"></script>
<body>
<div id="header">
    <h1><a href="javascript:;">资芽早报</a></h1>
</div>
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav btn-group">
        <li class="btn btn-inverse"><a title="" href="{{asset('login/quit')}}"><i class="icon icon-share-alt"></i> <span class="text" style="font-size: 14px;">退出</span></a></li>
    </ul>
</div>
<div id="sidebar">
    <ul>
        <?php $pAuths = Session::get('pAuths');
                $Auths =Session::get('Auths');
                $lds_pId = Session::get('lds_pId');
                $lds_Id = Session::get('lds_Id');
        ?>
        @foreach($pAuths as $pAuth)
                @if($pAuth->Auth_ID==$lds_pId)
                    <li class="submenu open active">
                        <a href="#"><i class="{{$pAuth->Class}}"></i> <span>{{$pAuth->AuthName}}</span></a>
                        <ul>
                            @else
                                <li class="submenu ">
                                    <a href="#"><i class="{{$pAuth->Class}}"></i> <span>{{$pAuth->AuthName}}</span></a>
                                    <ul>
                                        @endif
                                        @foreach($Auths as $Auth)
                                            @if($Auth->PID==$pAuth->Auth_ID)
                                                @if($Auth->Auth_ID==$lds_Id)
                                                    <li class="active" onclick='rePath(this)' id="{{$Auth->Auth_ID}}"><a
                                                                href="#">{{$Auth->AuthName}}</a></li>
                                                @else

                                                    <li onclick="rePath(this)" id="{{$Auth->Auth_ID}}"><a
                                                                href="#">{{$Auth->AuthName}}</a></li>
                                                @endif
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                        </ul>
</div>
@yield("content")
<div class="row-fluid">
    <div id="footer" class="span12">
        2017 &copy; 资芽早报.
    </div>
</div>
</div>
</div>
<script>
    function rePath(e) {
        var authID = $(e).attr("id");
        $.ajax({
            url: "{{asset('login/getPath')}}",
            data: {authId: authID},
            dataType: "Json",
            type: "POST",
            success: function (res) {
                var path = res['lds_path'];
                location.href = "http://paper.com/" + path;
            }
        })
    }

</script>
</body>
</html>