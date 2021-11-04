
@extends('layouts.admin')

@section('title', 'Users managed page')



@section('content')

            <div class="panel-body">
                <br>
                <div id="user-line-chart"></div>
                <br>
                <div id="post-line-chart"></div>
                <br>
                <div id="pie-chart"></div>
                <br>

                <br>
                <div id="pie-chart-delete"></div>
                <br>
            </div>

@endsection


@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="{{asset('js/pie_chart.js') }}"> </script>
    

@endsection