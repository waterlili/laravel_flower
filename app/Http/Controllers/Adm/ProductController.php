<?php

namespace App\Http\Controllers\Adm;


use App\DB\Cnt;
use App\DB\FlowerComposit;
use App\DB\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }

  public function getAdd() {
    return view('admin.page.product.add');
  }

  public function getList() {
    return view('admin.page.product.list');
  }


  public function postList(Request $request) {
    $record = Product::select([
      '*',
      Product::$SELECT_STS_STR,
      Product::$SELECT_IS_ACTIVE_STR,
      Product::$SELECT_PACK_TYPE_STR,
      Product::$selectCJ,
      Product::$selectUJ,
    ])->with('users');
    return $this->tableEngine($record, $request->all());
  }

  public function postAdd(Request $request) {
    $input = $request->all();
    $input['uid'] = Auth::user()->id;
    $input['sts'] = 1;
    $p = Product::create($input);
    if (isset($input['composit']) && is_array($input['composit'])) {
      foreach ($input['composit'] as $item) {
        FlowerComposit::create([
          'title' => $item['flower']['value'],
          'flower' => $item['flower']['id'],
          'total' => $item['total'],
          'product' => $p->id
        ]);
      }
    }
    return response()->json(['result' => TRUE]);
  }


  public function postGetFlowers(Request $request) {
    $input = $request->all();
    $record = Cnt::where('title', 'LIKE', '%' . $input['textSearch'] . '%')
      ->select(['id', 'title as value'])
      ->get();
    return response()->json($record);
  }


}
