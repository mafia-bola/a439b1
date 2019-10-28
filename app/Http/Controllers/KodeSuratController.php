<?php

namespace App\Http\Controllers;

use App\KodeSurat;
use App\Helpers\ControllerTrait;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\Alert;
use Auth;

class KodeSuratController extends Controller
{
    use ControllerTrait;

    private $template = [
        'title' => 'Kode Surat',
        'route' => 'kode-surat',
        'menu' => 'kode-surat ',
        'icon' => 'fa fa-cogs',
        'theme' => 'skin-blue',
        'config' => [
            'index.delete.is_show' => false
        ]
    ];

    private function form()
    {
        $subs = KodeSurat::select('id as value','keterangan as name')
            ->get();
        //TODO: Ini belum selesai
        return [
            [
                'label' => 'Kode Surat', 
                'name' => 'kode_surat',
                'view_index' => true
            ],
            [
                'label' => 'Keterangan',
                'name' => 'keterangan',
                'type' => 'textarea',
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
        $data = KodeSurat::all();
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
        $KodeSurat = $request->all();
        KodeSurat::create($KodeSurat);
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
        $data = KodeSurat::findOrFail($id);
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
        $data = KodeSurat::findOrFail($id);
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
        $KodeSurat = KodeSurat::findOrFail($id);
        $KodeSurat->update($data);
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
