<?php

namespace App\Http\Controllers;

use App\Models\Ci;
use App\Models\Idiom;
use App\Models\Poetry;
use App\Models\Word;
use App\Models\Xiehouyu;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Get
     * 获取列表
     *
     * @param Request $request
     * @param $class
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function list(Request $request, $class)
    {

        $this->validate($request, [
            'page' => 'required|integer',
            'word' => 'nullable|string'
        ]);

        switch ($class) {
            case 'poetry':
                $model = new Poetry();
                break;
            case 'ci':
                $model = new Ci();
                break;
            case 'idiom':
                $model = new Idiom();
                break;
            case 'xiehouyu':
                $model = new Xiehouyu();
                break;
            default:
                return $this->fail();
        }

        $list = $model->paginate(14);

        return $this->success(['list' => $list]);
    }

    /**
     * GET
     * 获取详情
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request, $class, $id)
    {
        switch ($class) {
            case 'poetry':
                $model = new Poetry();
                break;
            case 'ci':
                $model = new Ci();
                break;
            case 'idiom':
                $model = new Idiom();
                break;
            case 'xiehouyu':
                $model = new Xiehouyu();
                break;
            default:
                return $this->fail();
        }
        $data = $model::find($id)->toArray();
        $arr = [];

        $wordWhere = [];
        foreach ($data as $k => $v) {
            $trans = $this->mbStrSplit($v);
            $arr[$k] = $trans;
            $wordWhere = array_merge($wordWhere, $trans);
        }
        return $this->success([
            'detail' => $arr,
        ]);
    }

    /**
     * GET
     * 获取文字详情
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function wordDetail(Request $request)
    {
        $this->validate($request, [
            'word' => 'required|string'
        ]);

        $data = Word::where('word', $request['word'])->first();
        return $this->success($data);
    }

    /**
     * 中英文拆分数组
     *
     * @param $string
     * @param int $len
     * @return array
     */
    public function mbStrSplit($string, $len = 1)
    {
        $start = 0;
        $strlen = mb_strlen($string);
        while ($strlen) {
            $array[] = mb_substr($string, $start, $len, "utf8");
            $string = mb_substr($string, $len, $strlen, "utf8");
            $strlen = mb_strlen($string);
        }
        return $array;
    }
}
