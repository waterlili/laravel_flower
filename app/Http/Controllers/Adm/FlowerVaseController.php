<?php

namespace App\Http\Controllers\Adm;

use App\DB\FlowerVase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Input;
use Validator;
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
        $info = $request->dt;
        $destination = 'uploads/vase/';
        $files = $request->files;


        $names = array();

        if (!empty($info)) {

            foreach ($files as $file) {
                foreach ($file as $key => $result) {

                    $ext = $result->getClientOriginalExtension();
                    $name = $info['title'] . $key . '.' . $ext;
                    $names[] = $name;
                    $result->move($destination, $info['title'] . $key . '.' . $ext);

                }
                $flower_vase = new FlowerVase();
                $flower_vase->title = $info['title'];
                $flower_vase->material = (!empty($info['material']) ? $info['material'] : null);
                $flower_vase->weight = (!empty($info['weight']) ? $info['weight'] : null);
                $flower_vase->size = (!empty($info['size']) ? $info['size'] : null);
                $flower_vase->quality = (!empty($info['quality']) ? $info['quality'] : null);
                $flower_vase->capacity = (!empty($info['capacity']) ? $info['capacity'] : null);
                $flower_vase->color_id = (!empty($info['color']) ? $info['color'] : null);
                $flower_vase->images = serialize($names);
                $flower_vase->price = $info['price'];
                $flower_vase->save();
            }
        } else {

            $info = $request->all();
            $flower_vase = new FlowerVase($info);
            $flower_vase->save();

        }






        return response()->json(['result' => TRUE]);
    }
}
