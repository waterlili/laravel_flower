@extends('admin.block.editDialogMaster')
@section('title' , 'ویرایش سفارش')
@section('content')
    <div>
        @include('admin.page.order.add' , ['edt'=>true])
    </div>
@endsection
