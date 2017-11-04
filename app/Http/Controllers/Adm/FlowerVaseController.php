<?php

namespace App\Http\Controllers\Adm;

use App\DB\FlowerVase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class FlowerVaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdd()
    {
        return view('admin.page.flower_vase.add');
    }

    public function postAdd(Request $request)
    {
        $input = $request->all();
        $file = $request->file('file');
        dd($input);
//        return file_get_contents('php://input');
//          $files=$request->files;
//        foreach($files as $file)
//        {
//            dd($file[0]['name']);
//        }
//        $flowerVase = FlowerVase::create($input);
//        dd($input);
//        if (isset($input['composit']) && is_array($input['composit'])) {
//            foreach ($input['composit'] as $item) {
//                FlowerVariation::create([
//                    'flower_id' => $flower->id,
//                    'color' => $item['flower'],
//                    'image' => $item['image'],
//                ]);
//            }
//        }
        return response()->json(['result' => TRUE]);
    }
}
