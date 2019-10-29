<?php

namespace App\Http\Controllers;

use App\KodeSurat;
use App\Surat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    private $template = [
        'title' => 'Surat Menyurat',
        'route' => 'surat',
        'menu' => 'surat',
        'icon' => 'fa fa-enevelope',
        'theme' => 'skin-blue',
    ];

    private function form()
    {
        $kodeSurat = KodeSurat::all();
        $kode = [];
        foreach($kodeSurat as $value){
            $kode[] = [
                'value' => $value->id,
                'name' => $value->kode_surat.' ('.$value->keterangan.')'
            ];
        }
        $kategori = [
            [
                'value' => 'Masuk',
                'name' => 'Masuk'
            ],
            [
                'value' => 'Keluar',
                'name' => 'Keluar'
            ]
        ];
        $user = User::whereNotIn('id',[Auth::user()->id])
            ->get();
        $users = [];
        foreach($user as $value){
            $users[] = [
                'value' => $value->id,
                'name' => $value->nama." ({$value->bidang->nama_bidang}, {$value->jabatan->nama_jabatan})"
            ];
        }
        return [
            [
                'label' => 'Nomor Surat', 
                'name' => 'no_surat',
                'view_index' => true
            ],
            [
                'label' => 'Kode Surat',
                'name' => 'kode_surat',
                'type' => 'select',
                'option' => $kode,
                'view_index' => true,
                'view_relation' => 'kode->kode_surat'
            ],
            [
                'label' => 'Kategori',
                'name' => 'kategori',
                'type' => 'select',
                'option' => $kategori,
                'view_index' => true
            ],
            [
                'label' => 'File Surat',
                'name' => 'file_surat',
                'type' => 'file'
            ],
            [
                'label' => 'Keterangan Surat',
                'name' => 'keterangan',
                'view_index' => true
            ],
            [
                'label' => 'Disposisikan Ke',
                'name' => 'ke_user',
                'type' => 'select',
                'option' => $users
            ],
            [
                'label' => 'Keterangan Disposisi',
                'name' => 'keterangan_disposisi',
                'type' => 'ckeditor'
            ]
        ];
    }

    public function index(Request $request)
    {
        $template = (object) $this->template;
        $form = $this->form();
        $tipe = 'Masuk';
        if($request->has('tipe')){
            $tipe = $request->tipe;
        }
        $data = Surat::where('kategori',$tipe)
            ->get();
        return view('admin.surat.index', compact('template','form','data'));
    }

    public function create(Request $request)
    {
        $template = (object) $this->template;
        $form = $this->form();
        $tipe = 'masuk';
        if($request->has('tipe')){
            $tipe = $request->tipe;
        }
        return view('admin.surat.create',compact('template','form'));
    }

    public function store(Request $request)
    {
        
    }
}
