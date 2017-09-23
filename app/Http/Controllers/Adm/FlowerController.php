<?php

namespace App\Http\Controllers\Adm;


use App\DB\Cnt;
use App\DB\Flower;
use App\DB\FlowerVariation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FlowerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdd()
    {
        return view('admin.page.flower.add');
    }

    public function getEdit()
    {
        return view('admin.page.flower.edit');
    }

    public function getList()
    {
        return view('admin.page.flower.list');
    }


    public function postList(Request $request)
    {
        $records = Flower::select([
            '*',
            Flower::$SELECT_VAHED_STR,
            Flower::$SELECT_SAGHE_STR,
            Flower::$SELECT_MANDEGARI_STR,
            Flower::$SELECT_RADE_STR,
        ]);

        $input = $request->all();

        $this->tableFilter($records, $input);
        $this->tableBtnFilter($records, $input);

        if (isset($input['excelExport'])) {
            return $this->tableExcel($records, $input);
        }


        if (isset($input['exportPrint'])) {
            return $this->tablePrint($records, $input);
        }

        $count = $records->count();
        $this->tablePaginate($records, $input);


        return response()->json([
            'rows' => $records->with('variations')->get()->toArray(),
            'total' => $count
        ]);

//        return $this->tableEngine($record, $request->all());
    }

    public function postAdd(Request $request)
    {
        $input = $request->all();
        $flower = Flower::create($input);
        if (isset($input['composit']) && is_array($input['composit'])) {
            foreach ($input['composit'] as $item) {
                FlowerVariation::create([
                    'flower_id' => $flower->id,
                    'color' => $item['flower'],
                    'image' => $item['image'],
                ]);
            }
        }
        return response()->json(['result' => TRUE]);
    }

    public function getData(Request $request)
    {
        return view('admin.page.flower.block.showDialog');
    }

    public function postData(Request $request)
    {
        $input = $request->all();
        $record = Flower::find($input['id'])
            ->get();

        Log::info($record);
        return response()->json($record);
    }

    public function postGetFlowers(Request $request)
    {
        $input = $request->all();
        $record = Cnt::where('title', 'LIKE', '%' . $input['textSearch'] . '%')
            ->select(['id', 'title as value'])
            ->get();

        return response()->json($record);
    }

    public function postGetEditFlowerData(Request $request)
    {
        $response = Flower::whereId($request->id)->first();

        return $response;
    }

}
