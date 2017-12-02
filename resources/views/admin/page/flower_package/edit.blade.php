@extends('admin.block.editDialogMaster')
@section('title' , 'ویرایش اطلاعات گل')
@section('content')
    <div>
        @include('admin.page.flower_package.add' , ['edt'=>true])
    </div>
@endsection
