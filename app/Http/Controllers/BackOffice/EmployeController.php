<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::leftJoin('users', 'users.id', 'pegawai.users_id')
            ->select('pegawai.*', 'users.username')
            ->get();
        return view('pages.backoffice.employe.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.backoffice.employe.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'username' => 'required',
            'password' => 'required',
            'alamat' => 'required',
        ]);
        try {
            $user = User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => 'Pegawai',
                'status' => 'Aktif',
            ]);
            Employee::create([
                'nama' => $request->nama,
                'users_id' => $user->id,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'status' => 'Aktif',
            ]);
            return redirect('employe')->with('success', 'Berhasil menambah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menambah data!');
        }
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
        $data = Employee::leftJoin('users', 'users.id', 'pegawai.users_id')
            ->select('pegawai.*', 'users.username')
            ->where('pegawai.id', $id)
            ->first();
        return view('pages.backoffice.employe.edit', compact('data'));
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
            'nama' => 'required',
            'telepon' => 'required',
            'username' => 'required',
            'status' => 'required',
            'alamat' => 'required',
        ]);
        try {
            $data = Employee::where('id', $id)->first();
            $inputUser = ([
                'username' => $request->username,
                'status' => $request->status,
            ]);
            if ($request->password) {
                $inputUser['password'] = bcrypt($request->password);
            }

            User::where('id', $data->users_id)->update($inputUser);
            Employee::where('id', $id)->update([
                'nama' => $request->nama,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'status' => $request->status,
            ]);
            return redirect('employe')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return $th;
            return back()->with('failed', 'Gagal mengubah data!');
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
        Employee::find($id)->delete();
        return redirect('employe')->with('success', 'Berhasil mengubah data!');
    }
}
