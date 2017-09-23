@extends('admin.block.editDialogMaster')
@section('content')
    @include('admin.page.manage.user.user_form' , ['edt'=>true])
@endsection
