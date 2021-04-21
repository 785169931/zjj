<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApplyController extends Controller
{
    public function index()
    {
        $type = Apply::TYPE;
        return view('admin.apply.index',compact('type'));
    }

    #数据表格
    public function data(Request $request)
    {
        $apply = new Apply();
        $search = $request->only(['author','type','name']);

        if (!empty($search)){
            if (isset($search['author']) && strlen( $search['author'] ) > 0){
                $apply = $apply->where('author','like','%'.trim($search['author']).'%');
            }

            if (isset($search['type']) && strlen($search['type']) > 0 || in_array($search['type'],array_keys(Apply::TYPE))){
                $apply = $apply->where('type',trim($search['type']));
            }

            if (isset($search['name']) && strlen($search['name']) > 0){
                $apply = $apply->where('name','like','%'.trim($search['name']).'%');
            }
        }
        $res = $apply->orderBy('id','desc')->paginate($request->get('limit'))->toArray();

        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
        return response()->json($data);
    }

    public function create()
    {
        $type = Apply::TYPE;
        return view('admin.apply.create',compact('type'));
    }

    #添加数据
    public function store(Request $request)
    {
        $this->validate($request,[
           'image_url' =>  'required|string',
           'script_url' =>  'required|string',
        ]);

        $res = $request->only([
            'name','image_url','price','sale_price','benefits','url_ks','url_dy','type','script_url']);

        $res['created_at'] = time();
        $res['price'] = $res['price'] * 100;
        $res['sale_price'] = $res['sale_price'] * 100;
        $res['author'] = Auth::user()->name;//获取当前登录人的姓名

        $res = Apply::query()->insert($res);
        if ($res){
            return redirect(route('admin.apply'))->with(['status'=>'添加完成']);
        }
        return redirect(route('admin.apply'))->with(['status'=>'系统错误']);
    }

    #删除数据
    public function destory(Request $request)
    {
        $req  = $request->only('ids');
        $ids  = is_array($req) ? $req['ids'] : $req;

        if (empty($ids)){
            return response()->json(['code' =>1,'msg' => '请选择删除项']);
        }
        if (Apply::destroy($ids)){
            return response()->json(['code' => 0,'msg' => '删除成功']);
        }
        return response()->json(['code' => 1,'msg' => '删除失败']);
    }

    #下载脚本
    public function download(Request $request)
    {
        $id = $request->only('id');
        $data = Apply::query()->where('id',$id)->select('script_url')->first();
        if (empty($data)){
            return response()->json(['code' =>1,'数据不存在']);
        }

        $url = $data->toArray();
        $real_path = public_path().DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.$url['script_url'];
        $extension = explode('\\',$url['script_url']);

        $file  =  fopen($real_path, "rb");
        Header( "Content-type:  application/octet-stream ");
        Header( "Accept-Ranges:  bytes ");
        Header( "Content-Disposition:  attachment;  filename= $extension[1]");
        while (!feof($file)) {
            echo fread($file, 8192);
            ob_flush();
            flush();
        }
        fclose($file);
    }
}