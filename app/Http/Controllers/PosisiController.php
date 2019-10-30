<?php

namespace App\Http\Controllers;

use App\Posisi;
use App\Helpers\ControllerTrait;
use Illuminate\Http\Request;
use App\Helpers\Alert;

class PosisiController extends Controller
{
    use ControllerTrait;

    private $template = [
        'title' => 'Posisi',
        'route' => 'posisi',
        'menu' => 'posisi',
        'icon' => 'fa fa-cogs',
        'theme' => 'skin-blue',
        'config' => [
            'index.delete.is_show' => false
        ]
    ];

    private function form()
    {
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
        return [
            [
                'label' => 'Nama Posisi', 
                'name' => 'nama_posisi',
                'view_index' => true
            ],
            [
                'label' => 'Status',
                'name' => 'status',
                'type' => 'select',
                'option' => $status,
                'view_index' => true
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
        $data = Posisi::all();
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
        $Posisi = $request->all();
        Posisi::create($Posisi);
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
        $data = Posisi::findOrFail($id);
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
        $data = Posisi::findOrFail($id);
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
        $Posisi = Posisi::findOrFail($id);
        $Posisi->update($data);
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
}
