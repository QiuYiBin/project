<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 表单验证
use App\Http\Requests\Goods;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->input('name');
        $data = DB::table('bro_goods')->select('bro_goods.*','bro_cates.name as catesname')->where('bro_goods.name','like','%'.$name.'%')->join('bro_cates','bro_goods.cates_id','=','bro_cates.id')->paginate(1);

        return view('Admin.AdminGoods.index')->with('data',$data)->with('request',$request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = DB::table('bro_cates')->get();
        foreach ($cate as $key => $value) {
            // 转换为数组
            $arr = explode(',',$value->path);
            // 获取逗号结构
            $len = count($arr) - 1;
            // 重复字符串函数
            $cate[$key]->name = str_repeat('--|',$len).$value->name;
        }
        return view('Admin.AdminGoods.add',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Goods $request)
    {
        // 获取多图
        $imgs = $request->input('picdouble');
        
        // 移除不需要的字段
        $data = $request->except('_token','picdouble');
        // dd($data);
        if($data['cates_id'] == '0'){
            return back()->with('error','请选择分类');
        }
        // var_dump($imgs);
        $arr = explode(',',$imgs);
        // 创新新数组存储小图片
        $array = array();    
        if($gid = DB::table('bro_goods')->insertGetId($data)){
            foreach ($arr as $key => $value) {
               $array['pic'] = $value;
               $array['gid'] = $gid;
               \DB::table('bro_goodsimg')->insert($array);
            }
            return redirect('/admingoods')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查询出所有值
        $data = DB::table('bro_goods')->where('id','=',$id)->first();
        if($data == null){
            return redirect('/admingoods')->with('error','不要瞎改');
        }
        // 查询分类
        $cate = DB::table('bro_cates')->get();
        foreach ($cate as $key => $value) {
            // 转换为数组
            $arr = explode(',',$value->path);
            // 获取逗号结构
            $len = count($arr) - 1;
            // 重复字符串函数
            $cate[$key]->name = str_repeat('--|',$len).$value->name;
        }
        return view('Admin.AdminGoods.edit')->with('cate',$cate)->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','_method');
        if($data['pic'] == null){
            unset($data['pic']);
        }
        if($data['picdouble'] == null){
            unset($data['picdouble']);
        }
        if(DB::table('bro_goods')->where('id','=',$id)->update($data)) {
            return redirect('/admingoods')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败','id',$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 获取要删除的图片名
        $pic = DB::table('bro_goods')->select('bro_goods.pic')->where('id','=',$id)->first();
        // 获取要删除的小图片
        $imgs = DB::table('bro_goodsimg')->where('gid','=',$id)->get();
        if(DB::table('bro_goods')->where('id','=',$id)->delete()){
            unlink('./Uploads/Goods/'.$pic->pic);
            foreach ($imgs as $value) {
                unlink('./Uploads/Goods/'.$value->pic);     
            }
            DB::table('bro_goodsimg')->where('gid','=',$id)->delete();
            return redirect('/admingoods')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }

    // 图片上传方法
    public function upload(Request $request)
    {
        $file = $request->file('Filedata');
        // 判断目录是否存在
        $dir = $request->input('file');
        if (!file_exists('./Uploads/'.$dir.'')) {
            mkdir('./Uploads/'.$dir.'');
        }
        // 判断上传的文件是否有效
        if ($file->isValid()) {
            // 获取后缀
            $ext = $file->getClientOriginalExtension();
            // 生成新的文件名
            $newFile = time().rand().'.'.$ext;
            // 移动到指定目录
            $request->file('Filedata')->move('./Uploads/Goods/',$newFile);
            echo $newFile;
        }
    }
}
