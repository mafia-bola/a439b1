<?php

namespace App\Http\Controllers;

use App\Bidang;
use App\Helpers\ControllerTrait;
use App\Jabatan;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\Alert;
use App\Posisi;
use Auth;

class UserController extends Controller
{
    use ControllerTrait;

    private $template = [
        'title' => 'User',
        'route' => 'user',
        'menu' => 'user',
        'icon' => 'fa fa-users',
        'theme' => 'skin-blue',
        'config' => [
            'index.delete.is_show' => false
        ]
    ];

    private function form()
    {
        $role = [
            ['value' => 'Admin','name' => 'Admin'],
            ['value' => 'Operator','name' => 'Operator'],
        ];
        $status = [
            [
                'value' => 'Aktif',
                'name' => 'Aktif'
            ],
            [
                'value' => 'Tidak Aktif',
                'name' => 'Tidak Aktif'
            ]
        ];
        $jabatan = Jabatan::select('id as value','nama_jabatan as name')
            ->get();
        $bidang = Bidang::select('id as value','nama_bidang as name')
            ->get();
        $posisi = Posisi::select('id as value','nama_posisi as name')
            ->where('status',1)
            ->get();
        return [
            [
                'label' => 'Nama Pengguna', 
                'name' => 'nama',
                'view_index' => true
            ],
            [
                'label' => 'Username',
                'name' => 'username',
                'view_index' => true,
                'validation.store' => 'required|unique:users,username'
            ],
            [
                'label' => 'Password',
                'name' => 'password',
                'type' => 'password',
                'validation.store' => 'required|confirmed',
                'validation.update' => ''
            ],
            [
                'label' => 'NIP',
                'name' => 'nip',
                'view_index' => false,
                'validation.store' => 'required|unique:users,nip'
            ],
            [
                'label' => 'Alamat',
                'name' => 'alamat',
                'view_index' => false,
                'type' => 'textarea',
            ],
            [
                'label' => 'Telepon',
                'name' => 'telepon',
                'view_index' => false,
            ],
            [
                'label' => 'Tanggal Lahir',
                'name' => 'tanggal_lahir',
                'view_index' => false,
                'type' => 'datepicker'
            ],
            [
                'label' => 'Tempat Lahir',
                'name' => 'tempat_lahir',
                'view_index' => false,
            ],
            [
                'label' => 'Jabatan',
                'name' => 'jabatan_id',
                'type' => 'select',
                'option' => $jabatan,
                'view_relation' => 'jabatan->nama_jabatan'
            ],
            [
                'label' => 'Bidang',
                'name' => 'bidang_id',
                'type' => 'select',
                'option' => $bidang,
                'view_relation' => 'bidang->nama_bidang'
            ],
            [
                'label' => 'Posisi',
                'name' => 'posisi_id',
                'type' => 'select',
                'option' => $posisi,
                'view_relation' => 'posisi->nama_posisi'
            ],
            [
                'label' => 'Role',
                'name' => 'role',
                'type' => 'select',
                'option' => $role,
                'view_index' => true
            ],
            [
                'label' => 'Status',
                'name' => 'status',
                'type' => 'select',
                'option' => $status,
                'view_index' => false
            ]
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        $form = $this->form();
        $template = (object) $this->template;
        return view('admin.master.index',compact('data','form','template'));
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
        return view('admin.master.create', compact('template','form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->formValidation($request);
        $user = $request->all();
        $user['password'] = bcrypt($request->password);
        unset($user['password_confirmation']);
        User::create($user);
        Alert::make('success','Berhasil simpan data');
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
        $data = User::findOrFail($id);
        return view('admin.master.show',compact('form','template','data'));
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
        $data = User::findOrFail($id);
        return view('admin.master.edit',compact('form','template','data'));
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
        $this->formValidation($request);
        $data = $request->all();
        $user = User::findOrFail($id);
        unset($data['password_confirmation']);
        if($request->has('password')){
            $data['password'] = bcrypt($request->password);
        }else{
            unset($data['password']);
        }
        $user->update($data);
        Alert::make('success','Berhasil simpan data');
        return back();
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

    public function profile()
    {
        $data = Auth::user();
        $form = $this->form();
        $template = (object) $this->template;
        return view('admin.master.profile',compact('data','form','template'));
    }

    public function updateProfile(Request $request)
    {
        $this->formValidation($request,[
            'username' => 'required|unique:users,username,'.auth()->user()->id,
            'nip' => 'required|unique:users,username,'.auth()->user()->id,
            'password' => 'nullable'
        ]);
        $data = $request->all();
        if(trim($request->password) != ''){
            $data['password'] = bcrypt($request->password);
        }else{
            unset($data['password']);
        }
        unset($data['password_confirmation']);
        User::find(auth()->user()->id)
            ->update($data);
        Alert::make('success','Berhasil simpan data');
        return back();  
    }
}
