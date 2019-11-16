<?php

namespace App\Http\Controllers;

use App\Disposisi;
use App\Helpers\AppHelper;
use App\Helpers\ControllerTrait;
use App\KodeSurat;
use App\Surat;
use App\UserSurat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{
    use ControllerTrait;

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
        $tipe = [
            [
                'value' => 'Masuk',
                'name' => 'Masuk'
            ],
            [
                'value' => 'Keluar',
                'name' => 'Keluar'
            ]
        ];
        $kategori = [
            [
                'value' => 'Biasa',
                'name' => 'Biasa',
            ],
            [
                'value' => 'Penting',
                'name' => 'Penting'
            ],
            [
                'value' => 'Rahasia',
                'name' => 'Rahasia'
            ],
            [
                'value' => 'Sangat Rahasia',
                'name' => 'Sangat Rahasia'
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
                'label' => 'Tipe',
                'name' => 'tipe',
                'type' => 'select',
                'option' => $tipe,
                'view_index' => true
            ],
            [
                'label' => 'Nomor Surat', 
                'name' => 'no_surat',
                'view_index' => true
            ],
            [
                'label' => 'Judul Surat', 
                'name' => 'judul',
                'view_index' => true
            ],  
            [
                'label' => 'Kode Surat',
                'name' => 'kode_surat',
                'type' => 'select',
                'option' => $kode,
                'view_index' => true,
                'view_relation' => 'kodeSurat->kode_surat'
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
                'label' => 'Kirim Ke',
                'name' => 'user_id',
                'type' => 'select2m',
                'option' => $users,
                'attr' => 'multiple'
            ],
            [
                'label' => 'Keterangan Surat',
                'name' => 'keterangan',
                'type' => 'textarea',
                'view_index' => true
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
        $data = Surat::where('tipe',$tipe)
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
        $this->formValidation($request,[
            'file_surat' => 'required|mimetypes:application/pdf,image/png,image/jpg,image/jpeg'
        ]);
        $uploader = AppHelper::uploader($this->form(),$request);
        DB::transaction(function() use  ($uploader, $request){
            $surat = Surat::create([
                'no_surat' => $request->no_surat,
                'kode_surat_id' => $request->kode_surat,
                'kategori' => $request->kategori,
                'tipe' => $request->tipe,
                'kategori' => $request->kategori,
                'judul' => $request->judul,
                'keterangan' => $request->keterangan,
                'file_surat' => $uploader['file_surat'],
                'status' => 0
            ]);
            foreach ($request->user_id as $user) {
                $su = UserSurat::create([
                    'user_id' => $user,
                    'surat_id' => $surat->id,
                ]);
                Disposisi::create([
                    'dari_user' => Auth::user()->id,
                    'ke_user' => $user,
                    'keterangan' => $request->keterangan_disposisi,
                    'user_surat_id' => $su->id
                ]);
            }
        });
        return redirect(route('surat.index'));
    }

    public function edit($id)
    {
        
    }

    public function show($id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
