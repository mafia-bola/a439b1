<?php

namespace App\Http\Controllers;

use App\Surat;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    private $template = [
        'title' => 'Surat Masuk',
        'route' => 'surat-masuk',
        'menu' => 'surat-masuk',
        'icon' => 'fa fa-enevelope',
        'theme' => 'skin-blue',
        'config' => [
            'index.delete.is_show' => false
        ]
    ];

    public function form()
    {
        return [];
    }

    public function index()
    {
        $data  = Surat::get();
        $form  = $this->form();
        $template = (object) $this->template;
        return view('admin.surat-masuk.index', compact('data','form','template'));
    }

    public function create(Request $request)
    {
        
    }
}
