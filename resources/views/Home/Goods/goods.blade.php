@extends('Home.Indexpublic.public')
@section('main')
<html>
 <head>
   <style type="text/css">
        #pull_right{
            text-align:center;
        }
        .pull-right {
            /*float: left!important;*/
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > a,
        .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #428bca;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination > li:first-child > a,
        .pagination > li:first-child > span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .pagination > li:last-child > a,
        .pagination > li:last-child > span {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .pagination > li > a:focus,
        .pagination > li > span:focus {
            color: #2a6496;
            background-color: #eee;
            border-color: #ddd;
        }
        .pagination > .active > a,
        .pagination > .active > span,
        .pagination > .active > a:hover,
        .pagination > .active > span:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > span:hover,
        .pagination > .disabled > span:focus,
        .pagination > .disabled > a,
        .pagination > .disabled > a:hover,
        .pagination > .disabled > a:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .clear{
            clear: both;
        }
    </style>
 </head>
  <script src="/Home/js/jquery-1.8.3.min.js"></script>
  <script>
   
     
    
 </script>
 <body>
  <div class="offcanvas-wrapper"> 
   <!-- Start Page Title --> 
   <div class="page-title"> 
    <div class="container"> 
     <div class="column"> 
      <h1>商品列表</h1> 
     </div> 
     <div class="column"> 
      <ul class="breadcrumbs"> 
       <li><a href="/">首页</a></li> 
       <li class="separator">&nbsp;</li>
       <li>商品列表</li> 
      </ul> 
     </div> 
    </div> 
   </div> 
   <!-- End Page Title --> 
   <!-- Start Page Content --> 
   <div class="container padding-top-1x padding-bottom-3x"> 
    <!-- Start Toolbar -->  
    <div class="shop-toolbar mb-30">
     <div class="column"> 
      <div class="shop-sorting"> 
       <label for="sorting">排序方式:</label> 
       <select class="form-control" id="sorting" onchange="window.location=this.value;">
          <option>请选择</option>
          <option value="/goods/0/edit" class="sales">热门商品</option>
          <option value="/goods/1/edit" class="asc">低-高价</option>
          <option value="/goods/2/edit" class="desc">高-低价</option>
       </select>
       <span class="text-muted">显示: </span>
       <span> 1 - 4项</span> 
      </div> 
     </div>
    </div>
    <!-- End Toolbar --> 
    <!-- Start Products Grid --> 

    <div class="isotope-grid cols-4" id="uid">   
     <div class="gutter-sizer"></div> 
     <div class="grid-sizer"></div> 
     <!-- Start Product #1 -->
     @if(count($data))
     @foreach($data as $row)
     <div class="grid-item"> 
      <div class="product-card">
       <a class="product-thumb" href="/shopsingle/{{$row->id}}"><img src="/Uploads/Goods/{{$row->pic}}" style="width:200px;height:150px" alt="Product" /> </a> 
       <h3 class="product-title"><a href="#">{{$row->name}}</a></h3> 
       <h4 class="product-price"> 
        <del>
         {{($row->price)+100}}
        </del>{{$row->price}}</h4> 
       <div class="product-buttons">
        <a  class="btn btn-outline-secondary btn-sm " data-toggle="tooltip" title="我喜欢" href="/homewish/{{$row->id}}">
        <i class="icon-heart"></i></a>
        <form  method="post" action="/homecart" style="display:inline-block;">
        <button class="btn btn-outline-primary btn-sm " data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!" style="margin-top: 8px">添加到购物车</button>
        
        <input type="hidden" name="id" value="{{$row->id}}">
        {{csrf_field()}}
        </form> 
       </div>
      </div> 
     </div>
    @endforeach
    @else
    <div class="product-card" style="height:200px;padding-top:100px">
    <center><h1>暂无数据</h1></center>
    </div>
    @endif
     <!-- End Product #1 --> 
     <!-- Start Product #2 --> 
     <!-- End Product #12 --> 
      </div>

    <!-- End Products Grid --> 
    <!-- Start Pagination --> 
    <!-- <nav class="pagination">  -->
    <div id="pull_right">
       <div class="pull-right">
          {{ $data->links() }}
       </div>
    </div>
    <!-- </nav>  -->
    <!-- End Pagination --> 
   </div>
  </div>
 </body>
</html>

@endsection
@section('title','商品列表')