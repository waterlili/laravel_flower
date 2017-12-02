@extends('admin.block.editDialogMaster')
@section('title' , 'ویرایش اطلاعات بسته')
@section('content')
    <div>
        @include('admin.page.flower_packet.add' , ['edt'=>true])
    </div>
@endsection
