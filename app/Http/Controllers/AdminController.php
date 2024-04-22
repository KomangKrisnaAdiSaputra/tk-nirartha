<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblOrangTua;
use App\Models\Firebase\TblUser;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'data orang tua';
        $data = [];
        return view('backoffice.orang-tua.index', compact('data', 'menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = (new TblUser)->getDataUsers();
        if (count($data) > 0) unset($data['last_update']);
        $data =  array_values(array_filter($data, function ($item) {
            return (string) $item['tipe_user'] === '3';
        }));
        $data = json_decode(json_encode($data));
        return view('backoffice.orang-tua.tabel.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = 'data orang tua';
        $data = (new TblOrangTua)->getOneData($id);
        $data = $data;

        unset($data['id_user']);
        unset($data['id_orangtua']);

        foreach ($data as $key => $value) {
            $newData[ucwords(str_replace('_', ' ', $key))] = $value;
        }
        $data = json_decode(json_encode($newData));
        return view('backoffice.orang-tua.detail', compact('data', 'menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
