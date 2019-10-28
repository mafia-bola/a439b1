@extends('admin.layouts.app',[$template])
@push('css')

@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$template->title}}
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Home</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <template id="template">
        <div class="chart-responsive"> 
            <h4 style="text-align:center">@{{data.nama_satker}}</h4>
            <canvas ref="canva"></canvas>
        </div>
    </template>
@endsection

@push('js')
    <script src="{{asset('admin-lte')}}/bower_components/chart.js/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
@endpush