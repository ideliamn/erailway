<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $data['station'] = $db->table('stations')->get()->getResult();
        return view('index', $data);
    }
}
