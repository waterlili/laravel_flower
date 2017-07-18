@extends('public.master')
@section('header')
    @include('public.header')
@endsection
@section('footer')
    @include('public.footer')
@endsection

@section('content')
    <main id="main" ng-controller="PublicCtrl">
        <div class="cn-md p-md" style="min-height: 450px;max-width: 1280px">
            <div style="max-width: 450px;min-width:450px;float: right" class="mt-md" id="changer-front-slider">
                <form name="FrontFrom">
                    <div class="_titler">
                        <h5 class="p-sm" style="background-color: rgba(0, 0, 0, 0.33)">Exchange rate guaranteed:
                            1.2424</h5>
                        <h1 class="p-md mt-xxl">Send Money Eny Where</h1>
                    </div>
                    <div class="ph-md pt-md" layout-gt-md="row" layout-align="center center">
                        <md-input-container flex-gt-md="50" class="mb-n">
                            <label>You're sending exactly</label>
                            <input ng-model="send" format-as-currency style="font-size: 2em">
                        </md-input-container>

                        <div flex-gt-md="50" class="ml-md">
                            <div style="margin-top: -10px;">@include('MD.input.currency' , ['model'=>"currency_from"])</div>
                        </div>

                    </div>

                    <div class="ph-md" layout-gt-md="row" layout-align="center center">
                        <md-input-container flex-gt-md="50" class="mb-n">
                            <label>Recipient gets approximately</label>
                            <input ng-model="get" format-as-currency style="font-size: 2em">
                        </md-input-container>

                        <div flex-gt-md="50" class="ml-md">
                            <div style="margin-top: -10px;">@include('MD.input.currency' , ['model'=>"currency_from"])</div>
                        </div>

                    </div>

                    <div class="tac">Exchange rate: 1.4776 (9 mins ago)</div>
                    <md-divider></md-divider>
                    <md-button class="md-primary md-raised">lets go</md-button>
                </form>
            </div>
            <div class="clear"></div>
            <div style="max-width: 450px" class="mt-md text-front-slider">
                <h2 class="front-slider-title">
                    Send money with the real exchange rate
                </h2>
                <p class="front-slider-subtitle">
                    Banks hide huge charges when you send money abroad. With TransferWise you save up to 90%. Problem
                    solved, money saved.
                </p>
            </div>
        </div>
        <section id="front-page-welcome">
            <div class="cn-md" style="max-width: 1280px">
                <div class="row-6-md pv-md pv-xxl-md" style="color: #008492;">
                    <h2 style="font-size: 35px">Welcome to Imperial FX</h2>
                    <p style="font-size: 20px">Imperial FX help businesses and individuals transfer money anywhere in
                        the world and in any
                        volume –
                        quickly, easily and inexpensively. Our professional and service-oriented approach is backed up
                        by
                        decades of industry experience and highly-trained staff, ready to help you. We offer impeccable
                        services ensuring safest and fastest transactions to all of our clients. Imperial FX boasts a
                        wide
                        network of partners all over the world offering the highest level of privacy.</p>
                    <md-button class="md-primary md-raised"> learn more</md-button>
                </div>
                <div class="row-6-md tac p-md">
                    <div><span>As of 9 min ago ,1 GPB </span>
                        <i class="material-icons">&#xE5C8;</i>
                        <span style="color: #6FB502;">1.2365 EUR</span>
                    </div>
                    <div><img src="<% url('img/amar.jpg') %>" style="max-width: 100%" alt=""></div>
                    <div>past 30 days</div>
                    <md-button class="md-primary">see more ...</md-button>
                </div>
            </div>
        </section>

        <section id="front-page-hamkar">
            <div class="cn-md" style="max-width: 1280px">
                <div class="row-4-md pv-xxl">
                    <div class="tac"><img src="<% url('img/flogo/001.png') %>" style="max-width: 100%" alt=""></div>
                    <div><h4 class="tac" style="color: lightgrey;width: 75%;margin: auto">Smart tech and sharp thinking
                            are disrupting
                            high-street banks</h4></div>
                </div>
                <div class="row-4-md pv-xxl">
                    <div class="tac"><img src="<% url('img/flogo/002.png') %>" style="max-width: 100%" alt=""></div>
                    <div><h4 class="tac" style="color: lightgrey;width: 75%;margin: auto">Smart tech and sharp thinking
                            are disrupting
                            high-street banks</h4></div>
                </div>
                <div class="row-4-md pv-xxl">
                    <div class="tac"><img src="<% url('img/flogo/003.png') %>" style="max-width: 100%" alt=""></div>
                    <div>
                        <h4 class="tac" style="color: lightgrey;width: 75%;margin: auto">Smart tech and sharp thinking
                            are disrupting
                            high-street banks</h4>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection