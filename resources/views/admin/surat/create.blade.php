@extends('admin.layouts.app')
@push('css')
    <style>
        /* #datatables th,#datatables td, #datatables thead{
            border : 1px solid #b9b9b9;
            border-bottom: 1px solid #b9b9b9 !important;
        }
        #datatables th{
            text-align: center;
        } */
    </style>
@endpush
@section('content')
    @php
        @$config = $template->config == null ? [] : $template->config;
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$template->title}}                
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{$template->title}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
           <div class="row">
               <div class="col-md-12">
                    {!!Alert::showBox()!!}
                    <div class="row">
                        <div class="col-md-3">
                                <a href="{{route('surat.index')}}" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-sign-out"></i> Kembali</a>
                
                          <div class="box box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title">Folders</h3>
                
                              <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="box-body no-padding">
                              <ul class="nav nav-pills nav-stacked">
                                <li class="active"><a href="#"><i class="fa fa-inbox"></i> Surat Masuk
                                  <span class="label label-primary pull-right">12</span></a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i> Surat Keluar</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Tambah Surat</h3>
                                </div>
                                <form action="{{route("$template->route".".store")}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="box-body">                            
                                        @foreach($form as $value)
                                            {!!Render::form($value)!!}
                                        @endforeach
                                    </div>
                                    <div class="box-footer">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Tambah & Disposisikan</button>
                                        </div>
                                        <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                      </div>
                </div>
           </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('js')
    <script src="{{asset('admin-lte/bower_components/ckeditor/ckeditor.js')}}"></script>
    <!-- page script -->
    <script>
    $(function () {
        $('#datatables').DataTable()
        $('#full-datatables').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
        })
    })
    </script>
@endpush