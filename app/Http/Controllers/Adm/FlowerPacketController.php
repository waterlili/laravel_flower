<?php

namespace App\Http\Controllers\Adm;


use App\DB\Cnt;
use App\DB\Flower;
use App\DB\FlowerPackage;
use App\DB\FlowerPacket;
use App\DB\PacketType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FlowerPacketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdd()
    {
        return view('admin.page.flower_packet.add');
    }

    public function getEdit()
    {
        return view('admin.page.flower_packet.edit');
    }

    public function getList()
    {
        return view('admin.page.flower_packet.list');
    }


    public function postList(Request $request)
    {
        $record = FlowerPacket::select([
            '*',

        ]);

        return $this->tableEngine($record, $request->all());
    }

    public function postAdd(Request $request)
    {
        $input = $request->all();
        $flower_packet = FlowerPacket::find($request->type);
        $packet_packages = [];
        foreach ($input['composit'] as $packages) {
            //TODO should distinc them
            $packet_packages[] = $packages['package'];
        }
        $flower_packet->packages()->attach($packet_packages);

        return response()->json(['result' => TRUE]);
    }

    public function getData(Request $request)
    {
        return view('admin.page.flower_packet.block.showDialog');
    }

    public function postData(Request $request)
    {
        $input = $request->all();
        $record = FlowerPacket::find($input['id'])
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

    public function postPackagesList()
    {
        return FlowerPackage::get();
    }

    private function setName($package){
        $flowers = $package->flower()->get();
        $flower_array = [];
        foreach ($flowers as $flower) {
            $flower_array[] = $flower->nemad . $flower->pivot->count;
        }
        return implode(' - ', $flower_array);
    }
}
