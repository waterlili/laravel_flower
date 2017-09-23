
@extends('admin.block.editDialogMaster' , ['noBtn'=>true])
@section('title' , trans('subject.view_iban'))
@section('content')
    <md-content style="min-width: 500px">
        <div ng-init="init(<% $id %>)"></div>
        <div ng-repeat="item in ibans">
            <div layout-gt-md="row" class="input-cnt p-md">
                <div>
                    <i class="md-fg md-primary">{{item.lname}} , {{item.fname}}</i>
                    <div></div>
                    <span class="md-fg md-warn">{{item.iban}}</span>
                </div>
            </div>
        </div>
        <div class="input-cnt w-box red p-md" ng-if="ibans.length == 0">
            No Data
        </div>
        <div layout="row" layout-fill="" layout-align="center center" ng-show="!ibans">
            <md-progress-circular>

            </md-progress-circular>
        </div>
    </md-content>
@endsection
