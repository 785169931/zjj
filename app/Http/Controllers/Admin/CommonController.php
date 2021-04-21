<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommonController extends  Controller
{
    public function post(Request $request)
    {
        $file = $_FILES;
        $data = $request->post('type');

        $prefix = public_path().DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR;

        $ret = [
            'code' => 1,
            'msg'  => '上传失败',
            'data' => [
                'name' => '',
                'src'  => '',
            ]
        ];

        foreach ($file as $value){
            $extenison = explode('.',$value['name']);
            $name = strtolower($data).DIRECTORY_SEPARATOR.md5($data.time().mt_rand(1,99999)).'.'.$extenison[1];
            $res = move_uploaded_file($value['tmp_name'],$prefix.$name);
            if ($res){
                $ret['code'] = 0;
                $ret['msg'] = '上传成功';
                $ret['data']['name'] = $value['name'];
                $ret['data']['src'] = $name;
            }
        }

        return json_encode($ret);
    }
}
