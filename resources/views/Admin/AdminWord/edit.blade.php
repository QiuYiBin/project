@extends('Admin.AdminPublic.public')
@section('main')
<html>
  <head>
      <script type="text/javascript" charset="utf-8" src="/Admin/baidu/ueditor.config.js"></script>

    <script type="text/javascript" charset="utf-8" src="/Admin/baidu/ueditor.all.min.js"> </script>

    <script type="text/javascript" charset="utf-8" src="/Admin/baidu/lang/zh-cn/zh-cn.js"></script>
  </head>
  <body>
    <div class="col-lg-12">
    <section class="panel" style="margin-top: 45px;"> 
      <header class="panel-heading">
        文章管理
      </header> 
      <div class="panel-body"> 
        <form class="form-horizontal" role="form" action="/word/{{$data1->id}}" method="post" enctype="multipart/form-data"> 
          <div class="form-group" style="margin-top: 40px"> 
            <label class="col-lg-2 col-sm-2 control-label" for="inputEmail1">标题:</label> 
              <div class="col-md-3 col-xs-9"> 
                <input class="form-control" name="title" id="inputEmail1" type="text" value="{{$data1->title}}" /> 
              </div> 
          </div>
          <div class="form-group" style="margin-top: 40px">
            <label class="col-lg-2 col-sm-2 control-label" for="inputPassword1">请选择状态</label> 
              <div class="col-md-3 col-xs-9">  
                <select class="form-control m-bot15" name="status">
                  <option value="0" @if($data1->status == 0) selected @endif>有效</option>
                  <option value="1" @if($data1->status == 1) selected @endif>无效</option>
                </select> 
              </div> 
          </div> 
          <div class="form-group" style="margin-top: 40px">
            <label class="col-lg-2 col-sm-2 control-label" for="inputEmail1">内容</label> 
              <div class="col-md-3 col-xs-9">
                <script id="editor" type="text/plain" name="content" style="width:800px;height:400px" >{!!$data1->content!!}</script>
              </div>
          </div> 
          <div class="form-group" style="margin-top: 40px"> 
            <div class="col-lg-offset-2 col-lg-10"> 
              <button class="btn btn-primary" type="submit">提交</button> 
            </div> 
          </div>
          {{method_field('PUT')}}
          {{csrf_field()}} 
        </form>
      </div> 
    </section>
  </div>
 </body>
 <script>
   var ue = UE.getEditor('editor');
 </script>
</html>
@endsection
@section('title','文章管理')