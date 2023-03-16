<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Form;
use App\Models\SubCategory;

/**
 * model block
 */
class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Form::all();
        $title = 'List Data Kuesioner';
        return view('pages.backoffice.form.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data Kuesioner';
        $categories = SubCategory::all();
        $data = (object)[
            'name'        => '',
            'type'       => '',
            'value'       => '',
            'sub_category_id'       => '',
            'type'          => 'create',
        ];
        return view('pages.backoffice.form.form', compact('title', 'data','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'value' => 'required',
        ]);

        try {
            Form::create([
                'name' => $request->name,
                'type' => $request->type,
                'value' => $request->value,
            ]);
            return redirect('form')->with('success', 'Berhasil menambah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menambah data!'.$th->getMessage());
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
        $data = Form::where('id', $id)->first();
        $title = 'Detail Data Kuesioner';
        $data->type = 'detail';

        return view('pages.backoffice.form.form', compact('data', 'title'));
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
        $data = Form::where('id', $id)->first();
        $title = 'Edit Data Kuesioner';
        $categories = SubCategory::all();

        return view('pages.backoffice.form.form', compact('data', 'title', 'categories'));
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
        //
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'value' => 'required',
        ]);
        try {
            $data = ([
                'name' => $request->name,
                'type' => $request->type,
                'value' => $request->value,
            ]);

            Form::where('id', $id)->update($data);
            return redirect('form')->with('success', 'Berhasil mengubah data!');
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
        //
        Form::find($id)->delete();
        return redirect('form')->with('success', 'Berhasil mengubah data!');
    }
}
