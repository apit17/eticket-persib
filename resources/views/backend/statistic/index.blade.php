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
                    <div>
                        <h3>Search Option :</h3>
                    </div>
                </div>
                <div class="module-body">
                    <div class="form-inline" style="text-align: center">
                        <div class="form-group">
                            <select id="type">
                                <option value="graphic">Graphic</option>
                                <option value="table">Table</option>
                            </select>
                            <input type="text" name="first_date" id="first_date" class="date-picker form-control" placeholder="From">
                            <b>to</b>
                            <input type="text" name="end_date" id="end_date" class="date-picker form-control" placeholder="Until">
                            <button type="button" id="filter_button" class="btn btn-primary">Search <i class="icon-search"></i></button>
                        </div>
                    </div><br/>
                    <div class="form-inline" style="text-align: left; margin-left: 34px">
                        <div class="form-group">
                            <button type="button" class="btn btn-inverse btn-xs">Tips :</button><small>  If you don't use the search option, statistic will load data of current month.</small>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="module">
                <div class="module-head">
                    <div>
                        <h3>Statistic - Income</h3>
                    </div>
                </div>
                <div class="module-body">
                    <div class="chart">
                        <div id="income" class="graph">
                            <center><span>No result.</span></center>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.module-->
            <br />
            <!-- <div class="module">
                <div class="module-head">
                    <h3>
                        Statistic - Outcome</h3>
                </div>
                <div class="module-body">
                    <div class="chart inline-legend grid">
                        <div id="outcome" class="graph">
                            <center><span>No result.</span></center>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <!--/.content-->
    </div>
    <!--/.span9-->
@stop

@section('script')
    @include('backend.statistic.js.index_js')
@stop