<?php

namespace App\Http\Controllers\Adm;


use App\DB\Cnt;
use App\DB\Flower;
use App\DB\FlowerPackage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FlowerPackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdd()
    {
        return view('admin.page.flower_package.add');
    }

    public function getEdit()
    {
        return view('admin.page.flower_package.edit');
    }

    public function getList()
    {
        return view('admin.page.flower_package.list');
    }


    public function postList(Request $request)
    {
        $record = FlowerPackage::select([
            '*',
            FlowerPackage::$SELECT_LEAF_STR
        ])->with('flower');

        return $this->tableEngine($record, $request->all());
    }

    public function postAdd(Request $request)
    {
        $input = $request->all();
        $input['combination_flowers'] = serialize($input['checkedCombines']);
        $input['name'] = '';
        $flower_packege = FlowerPackage::create($input);
        $package_flowers = [];
        foreach ($input['composit'] as $flowers) {
            $package_flowers[$flowers['flower']] = ['count' => $flowers['count']];
        }
        $flower_packege->flower()->sync($package_flowers);
        $name = $this->setName($flower_packege);
        $flower_packege->name = $name;
        $flower_packege->save();
        return response()->json(['result' => TRUE]);
    }

    public function getData(Request $request)
    {
        return view('admin.page.flower_package.block.showDialog');
    }

    public function postData(Request $request)
    {
        $input = $request->all();
        $record = FlowerPackage::find($input['id'])
            ->get();

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

    public function postFlowersList()
    {
        return Flower::with('variations')->get();
    }

    private function setName($package){
        $flowers = $package->flower()->get();
        $flower_array = [];
        foreach ($flowers as $flower) {
            //sign of each flowers combine with each others
            $flower_array[] = $flower->nemad . $flower->pivot->count;
        }
        return implode(' - ', $flower_array);
    }
}
