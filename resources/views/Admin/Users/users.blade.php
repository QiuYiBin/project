@extends("Admin.AdminPublic.public")
@section("main")
<html>
 <head> 
  <style type="text/css" media="screen">
        td{
            vertical-align: middle !important;
        }
    </style> 
 </head> 
  <script type="text/javascript" src="/Admin/js/jquery-1.8.3.min.js"></script> 
 <body> 
  <div class="wrapper" style="margin-top: 30px"> 
   <div class="row"> 
    <div class="col-sm-12"> 
     <section class="panel"> 
      <header class="panel-heading">
        用户列表 
       <span class="tools pull-right"> <a class="fa fa-chevron-down" href="javascript:;"></a> <a class="fa fa-times" href="javascript:;"></a> </span> 
      </header> 
      <div class="panel-body"> 
       <div class="adv-table"> 
        <div class="dataTables_wrapper form-inline" id="dynamic-table_wrapper" role="grid"> 
         <div class="row-fluid"> 
          <div class="span6"> 
           <form action="/adminuser" method="get">
            <div class="dataTables_filter" id="dynamic-table_filter"> 
             <input class="form-control" aria-controls="dynamic-table"  type="text" name="keywords" value="" placeholder="请输入用户名"/> 
             <input type="submit" value="搜索" class="btn btn-danger" /> 
            </div> 
           </form> 
          </div> 
         </div>
         <div id="uid">
         <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info"> 
          <thead> 
           <tr role="row"> 
            <th tabindex="0" class="sorting" role="columnheader" aria-controls="dynamic-table"  aria-label="Rendering engine: activate to sort column ascending" rowspan="1" colspan="1">ID</th> 
            <th tabindex="0" class="sorting" role="columnheader" aria-controls="dynamic-table"  aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">用户名</th> 
            <th tabindex="0" class="sorting" role="columnheader" aria-controls="dynamic-table" aria-label="Platform(s): activate to sort column ascending" rowspan="1" colspan="1">邮箱</th> 
            <th tabindex="0" class="hidden-phone sorting" role="columnheader" aria-controls="dynamic-table" aria-label="Engine version: activate to sort column ascending" rowspan="1" colspan="1">状态</th> 
             <th tabindex="0" class="hidden-phone sorting" role="columnheader" aria-controls="dynamic-table" aria-label="Engine version: activate to sort column ascending" rowspan="1" colspan="1">电话</th> 
            <th tabindex="0" class="hidden-phone sorting_desc" role="columnheader" aria-controls="dynamic-table" aria-label="CSS grade: activate to sort column ascending" aria-sort="descending" rowspan="1" colspan="1">操作</th> 
           </tr> 
          </thead> 
          <tbody class=".table-striped">
            @foreach($data as $row)
           <tr class="odd"> 
            <td class="">{{$row->id}}</td> 
            <td class="">{{$row->username}}</td> 
            <td class="">{{$row->email}}</td> 
            <td class="">{{$row->status}}</td> 
            <td class="">{{$row->phone}}</td> 
            <td class="">
              <a href="/adminuser/{{$row->id}}/edit" class="btn btn-warning">修改</a>
                <a href="/adminusersaddres/{{$row->id}}" class="btn btn-success">收货地址</a>
                <a href="/adminuser/{{$row->id}}" class="btn btn-info">用户详情</a>
           </td>
           </tr> 
            @endforeach
          </tbody> 
         </table>
         </div>
         @if($k == '')
         <div style="float: right">
          
        @foreach($pp as $v)
          <a href="javascript:void(0)" class="btn btn-success" onclick="page({{$v}})">{{$v}}</a>
        @endforeach
        @endif
         </div>
         <div class="dataTables_info" id="editable-sample_info">共{{$tot}}条数据</div> 
        </div> 
       </div> 
      </div> 
     </section> 
    </div> 
   </div> 
  </div>   
 </body>
 <script type="text/javascript">
 //alert($);	
 function page(page){	
 	//alert(page);
 	//ajax
 	$.get("/adminuser",{page:page},function(data){	
 		//alert(data);
 		//赋值给id为uid的<h1>标签
 		$("#uid").html(data);
 	});
 }


 </script>
</html>
@endsection
@section('title','用户列表')