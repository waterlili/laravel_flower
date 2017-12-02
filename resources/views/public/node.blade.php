@extends('public.master')
@section('header')
    @include('public.header')
@endsection
@section('footer')
    @include('public.footer')
@endsection

@section('content')
    <main id="main-node" class="pt-xxl" ng-controller="PublicCtrl">
        <section class="cn-md p-md" style="min-height: 450px;max-width: 960px">
            <h1>
                EXPOSED: THE HIDDEN COST OF TRANSFERING £2,000 TO EUROS
            </h1>
            <div class="content">
                <div class="col-sm-12">
                    <p>Independent price comparison by PCM Research has shown the extent of hidden bank charges for international business transfers.</p>

                    <p>All of the banks surveyed had charges hidden in an inflated exchange rate, on top of their upfront international transfer fee.</p>

                    <p>We don't think that's fair.</p>

                    <p style=" font-size: 12px!important;">


                        Data was obtained independently by market research company PCM Research. It shows quoted upfront fee and exchange rate charge of sending £2,000 to Euros in Germany through online business banking. Taken between the 25/04/16 and 29/04/16, HSBC data had to be retaken on the 17/05/2016, as anomalies in original information provided indicated it was incorrect.

                        <a href="https://transferwise.com/help/article/2460864/other/the-cost-of-sending-gbp-to-eur-for-small-businesses" role="button">Read the research</a>

                    </p>

                    <div class="tac"><img style="max-width: 100%" src="<% url('img/576811bb5cbbd-Business-Comparison-Chart-Vertical2.svg') %>" alt=""></div>


                </div>
                <h1 class="mt-md">UP TO 7X CHEAPER THAN BANKS</h1>
                <div class="col-sm-12">
                    <p>TransferWise for Business is up to 7x cheaper than banks because we only ever use the REAL exchange rate (the one you find on XE or Google).</p>

                    <p>Unlike the old world banking systems, TransferWise is built using local pay-ins and local pay-outs, which means we can keep our upfront transfer fee to a minimum. For example, on a transfer from GBP to EUR, we only charge 0.5%. <br><br>
                        <a href="https://transferwise.com/help/article/2444485/other/why-is-transferwise-up-to-7x-cheaper-for-businesses">See how we're 7x cheaper</a><br>
                        <a href="https://transferwise.com/pricing#?from=GBP&amp;to=EUR&amp;utm_source=business&amp;utm_medium=lienzo&amp;utm_campaign=landing_page">See our global pricing and coverage</a></p>
                    <p><md-button class="md-raised md-primary">Get started</md-button></p>
                </div>

            </div>
        </section>
    </main>
@endsection