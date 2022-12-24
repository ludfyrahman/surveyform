<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\ProfileCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class ProfileCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProfileCompany::first();
        return view('pages.backoffice.settings.profileSetting', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $request->validate([
            'nama_perusahaan' => 'required',
        ]);


        try {
            if ($request->logo) {
                $fileType = $request->file('logo')->extension();
                $name = Str::random(8) . '.' . $fileType;
                $input['logo'] = Storage::putFileAs('logo', $request->file('logo'), $name);
            }
            if ($request->light_logo) {
                $fileType = $request->file('light_logo')->extension();
                $name = Str::random(8) . '.' . $fileType;
                $input['light_logo'] = Storage::putFileAs('logo', $request->file('light_logo'), $name);
            }
            $input['nama_perusahaan'] = $request->nama_perusahaan;
            $input['deskripsi'] = $request->deskripsi ?? '-';
            $input['address'] = $request->address ?? '-';
            $input['email'] = $request->email ?? '-';
            $input['about'] = $request->about ?? '-';
            $input['phone'] = $request->phone ?? '-';
            ProfileCompany::where('id', $id)->update($input);
            return back()->with('success', 'Berhasil mengubah data');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data ' . $th);
            throw $th;
        }
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
