@extends('admin.block.editDialogMaster')
@section('title' , 'ویرایش اطلاعات گل')
@section('content')
    <div>
        @include('admin.page.flower.add' , ['edt'=>true])
    </div>
@endsection
