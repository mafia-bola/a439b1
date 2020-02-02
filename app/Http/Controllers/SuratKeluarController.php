<?php

namespace App\Http\Controllers;

use App\Surat;
use App\KodeSurat;
use App\User;
use App\Disposisi;
use Auth;
use DB;
use App\Helpers\AppHelper;
use App\Helpers\ControllerTrait;
use Illuminate\Http\Request;
use App\Helpers\Alert;

class SuratKeluarController extends Controller
{
    use ControllerTrait;

    private $template = [
        'title' => 'Surat',
        'route' => 'surat-keluar',
        'menu' => 'surat-keluar',
        'icon' => 'fa fa-cogs',
        'theme' => 'skin-blue',
        'config' => [
            'index.delete.is_show' => false
        ]
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

        $status = [
            [
                'value' => 'Aktif',
                'name' => 'Aktif',
            ],
            [
                'value' => 'Tidak Aktif',
                'name' => 'Tidak Aktif'
            ],
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
                'type' => 'hidden',
                'value' => 'Keluar',
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
                'type' => 'file',
                'hideEdit' => true
            ],
            [
                'label' => 'Kirim Ke',
                'name' => 'user_id[]',
                'type' => 'select2',
                'option' => $users,
                'attr' => 'multiple',
                'hideEdit' => true
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
                'type' => 'ckeditor',
                'hideEdit' => true
            ],
            [
                'label' => 'Status',
                'name' => 'status',
                'type' => 'select',
                'option' => $status,
                'view_index' => true
            ],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Surat::where('tipe','Keluar')->get();
        $form = $this->form();
        $template = (object) $this->template;
        return view('admin.surat-keluar.index',compact('data','form','template'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template = (object) $this->template;
        $form = $this->form();
        return view('admin.surat-keluar.create', compact('template','form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->formValidation($request);
        // dd($request->all());
        $uploader = AppHelper::uploader($this->form(),$request);
        DB::transaction(function() use  ($uploader, $request){
            $surat = Surat::create([
                'tipe' => $request->tipe,
                'no_surat' => $request->no_surat,
                'judul' => $request->judul,
                'kode_surat_id' => $request->kode_surat,
                'kategori' => $request->kategori, 
                'keterangan' => $request->keterangan,
                'file_surat' => $uploader['file_surat'],
                'status' => 'Aktif'
            ]);

            foreach ($request->user_id as $user) {            
                Disposisi::create([
                    'dari_user' => Auth::user()->id,
                    'ke_user' => $user,
                    'keterangan' => $request->keterangan_disposisi,
                    'surat_id' => $surat->id
                ]);
            }
        });
        Alert::make('success','Berhasil mengirim surat');
        return redirect(route($this->template['route'].'.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = $this->form();
        $template = (object) $this->template;
        $data = Surat::findOrFail($id);
        return view('admin.surat-keluar.show',compact('form','template','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = $this->form();
        $template = (object) $this->template;
        $data = Surat::findOrFail($id);
        return view('admin.surat-keluar.edit',compact('form','template','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->formValidation($request);
        $data = $request->all();
        $Surat = Surat::findOrFail($id);
        $Surat->update($data);
        Alert::make('success','Berhasil simpan data');
        return redirect(route($this->template['route'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
