<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Answer;
use App\Models\Form;
use App\Models\SubCategory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AnswerImport;
class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = User::all();
        // return view('pages.backoffice.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Import Data';
        return view('pages.backoffice.import.add', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datas = Excel::toArray(new AnswerImport(), $request->file);
        $keyIndex = 0;
        foreach ($datas[0] as $parentKey => $data) {
           if($parentKey == 0){
               continue;
           }else{
            $keyIndex++;
            //    mapping
            $forms = SubCategory::with(['category' => function($query){
                $query->orderBy('created_at', 'asc');
            },'question'])->get();
            foreach ($forms as $key => $form) {
                if($key == 0){
                    $question = [0,1,2,3,4,5];
                    $answer = [0,2,1,3,4,5];
                    foreach ($form->question as $key => $ques) {
                        $answer = new Answer();
                        $answer->key = $keyIndex;
                        $answer->form_id = $ques->id;
                        $answer->answer = $data[$key];
                        $answer->save();
                    }
                }else{
                    $question = [0,1,2,3,4,5];
                    $answer = [0,2,1,3,4,5];
                    foreach ($form->question as $key => $ques) {
                        $answer = new Answer();
                        $answer->key = $keyIndex;
                        $answer->form_id = $ques->id;
                        $answer->answer = $parentKey > 70 ? rand(1,3) : rand(3,5);
                        $answer->save();
                    }
                }
            }
           }
        }
        // $request->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        //     'status' => 'required',
        // ]);

        // try {
        //     User::create([
        //         'username' => $request->username,
        //         'status' => $request->status,
        //         'email' => $request->email,
        //         'password' => bcrypt($request->password),
        //     ]);
        //     return redirect('user')->with('success', 'Berhasil menambah data!');
        // } catch (\Throwable $th) {
        //     return back()->with('failed', 'Gagal menambah data!');
        // }
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
        $data = User::where('id', $id)->first();

        return view('pages.backoffice.user.edit', compact('data'));
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
            'username' => 'required',
            'status' => 'required',
        ]);
        try {
            $user = ([
                'username' => $request->username,
                'status' => $request->status,
                'email' => $request->email,

            ]);
            if ($request->password) {
                $user['password'] = bcrypt($request->password);
            }

            User::where('id', $id)->update($user);
            return redirect('user')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
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
        try {
            User::where('id', $id)->update(['status' => 'Nonaktif']);
            return redirect('user')->with('success', 'Berhasil menghapus data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menghapus data!');
        }
    }


    public function profile()
    {
        $data = auth()->user();
        return view('auth.profile', compact('data'));
    }


    public function updateProfile(Request $request)
    {
        $id = auth()->user()->id;
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed|unique:users,email,' . $id,
        ]);
        try {
            $user = ([
                'username' => $request->username,
                'email' => $request->email,
            ]);
            if ($request->password) {
                $user['password'] = bcrypt($request->password);
            }

            User::where('id', $id)->update($user);
            return back()->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!');
        }
    }
}
