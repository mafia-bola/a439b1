<?php

namespace App\Http\Controllers;

use App\Alur;
use App\Helpers\ControllerTrait;
use Illuminate\Http\Request;
use App\AlurPosisi;
use App\Posisi;
use App\Helpers\Alert;

class AlurPosisiController extends Controller
{
    use ControllerTrait;

    private $template = [
        'title' => 'Alur Posisi',
        'route' => 'alur-posisi',
        'menu' => 'alur-posisi',
        'icon' => 'fa fa-cogs',
        'theme' => 'skin-blue',
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
        $alur = Alur::select('id as value','nama_alur as name')
            ->get();
        $posisi = Posisi::select('id as value','nama_posisi as name')
            ->get();
        return [
            [
                'label' => 'Alur', 
                'name' => 'alur_id',
                'type' => 'select',
                'option' => $alur,
                'view_index' => true,
                'view_relation' => 'alur->nama_alur'
            ],
            [
                'label' => 'Posisi',
                'name' => 'posisi_id',
                'type' => 'select',
                'option' => $posisi,
                'view_index' => true,
                'view_relation' => 'posisi->nama_posisi'
            ],
            [
                'label' => 'Urut',
                'name' => 'urut',
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
        $data = AlurPosisi::all();
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
        $AlurPosisi = $request->all();
        AlurPosisi::create($AlurPosisi);
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
        $data = AlurPosisi::findOrFail($id);
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
        $data = AlurPosisi::findOrFail($id);
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
        $AlurPosisi = AlurPosisi::findOrFail($id);
        $AlurPosisi->update($data);
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
        AlurPosisi::destroy($id);
        Alert::make('success','Berhasil hapus data');
        return back();
    }
}
