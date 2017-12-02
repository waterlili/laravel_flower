@extends('admin.block.editDialogMaster')
@section('title' , 'ویرایش اطلاعات مشتری')
@section('content')
    <div>
        @include('admin.page.customer.add' , ['edt'=>true])
    </div>
@endsection
