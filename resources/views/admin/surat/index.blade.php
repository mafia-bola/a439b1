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
                            <a href="{{route('surat.create')}}" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-sign-in"></i> Tambah Surat</a>
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
                                  @php
                                      $tipe = 'Masuk';
                                      if(request()->has('tipe')){
                                          $tipe = request('tipe');
                                      }
                                  @endphp
                                <li class="{{$tipe == 'Masuk' ? 'active' : ''}}"><a href="{{route('surat.index')}}?tipe=Masuk"><i class="fa fa-inbox"></i> Surat Masuk
                                  <span class="label label-primary pull-right">12</span></a></li>
                                <li class="{{$tipe == 'Keluar' ? 'active' : ''}}"><a href="{{route('surat.index')}}?tipe=Keluar"><i class="fa fa-envelope-o"></i> Surat Keluar</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-9">
                          <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    
                                </h3>
                            </div>
                            <div class="box-body">
                                <table class="table" id="datatables">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            @foreach ($form as $item)
                                                @if (array_key_exists('view_index',$item) && $item['view_index'])
                                                    @if(array_key_exists('format',$item) && $item['format'] == 'rupiah')
                                                        <td>{{$item['label']}} (Rp)</td>
                                                    @else
                                                        <td>{{$item['label']}}</td>
                                                    @endif
                                                @endif
                                            @endforeach
                                            <td>Opsi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $key => $row)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                @foreach ($form as $item)
                                                    @if (array_key_exists('view_index',$item) && $item['view_index'])
                                                        <td @if(array_key_exists('format',$item) && $item['format'] == 'rupiah') style="text-align:right" @endif>
                                                            @if (array_key_exists('view_relation',$item))
                                                            {{ AppHelper::viewRelation($row,$item['view_relation']) }}
                                                            @else
                                                                @if(array_key_exists('format',$item) && $item['format'] == 'rupiah')
                                                                    {{number_format($row->{$item['name']},2,',','.')}}
                                                                @else
                                                                {{ $row->{$item['name']} }}
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endforeach
                                                <td>
                                                    <a href="{{route("$template->route".'.edit',[$row->id])}}" class="btn btn-success btn-sm {{AppHelper::config($config,'index.edit.is_show') ? '' : 'hidden'}}">Ubah</a>
                                                    <a href="{{route("$template->route".'.show',[$row->id])}}" class="btn btn-info btn-sm {{AppHelper::config($config,'index.show.is_show') ? '' : 'hidden'}}">Lihat</a>
                                                    <a href="#" class="btn btn-danger btn-sm {{AppHelper::config($config,'index.delete.is_show') ? '' : 'hidden'}}" onclick="confirm('Lanjutkan ?') ? $('#frmDelete{{$row->id}}').submit() : ''">Hapus</a>
                                                    <form action="{{route("$template->route".'.destroy',[$row->id])}}" method="POST" id="frmDelete{{$row->id}}">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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