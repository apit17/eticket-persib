@extends('backend.index')
@section('style')
<style type="text/css">

</style>
@stop
@section('content_menu')
    <!--/.span3-->
    <div class="span9">
        <div class="content">
            <div class="module">
                <div class="module-head">
                    <h3>
                        Statistic - Income</h3>
                </div>
                <div class="module-body">
                    <div class="chart">
                        <div id="placeholder" class="graph">
                        </div>
                    </div>
                </div>
            </div>
            <!--/.module-->
            <br />
            <div class="module">
                <div class="module-head">
                    <h3>
                        Statistic - Outcome</h3>
                </div>
                <div class="module-body">
                    <div class="chart inline-legend grid">
                        <div id="placeholder2" class="graph">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.content-->
    </div>
    <!--/.span9-->
@stop

@section('script')
    @include('backend.statistic.js.index_js')
@stop