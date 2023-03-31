<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProfileCompany;
use App\Models\Sosmed;
use App\Models\SubCategory;
use App\Models\Form;
use App\Models\Answer;
use DB;
class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = [];
        $types = [];
        $social = [];
        $profiles = (object)['about' => null, 'logo' => null, 'deskripsi' => null, 'light_logo' => null, 'address'=> null, 'phone' => null, 'email' => null];
        $data = SubCategory::with(['category' => function($query){
            $query->orderBy('created_at', 'asc');
        },'question'])->get();
        return view('pages.frontend.form', compact('types', 'products','social','profiles', 'data'));
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
        $this->validate($request, [
            'question' => 'present|array',
        ]);
        $keyValue = Answer::max('key') + 1;
        DB::transaction(function () use($request, $keyValue){
            foreach ($request->question as $key => $question) {
                $form_id = $key;
                try {
                    Answer::insert(['form_id' => $form_id, 'answer' => $question ?? '-', 'key' => $keyValue, 'created_at' => date('Y-m-d H:i:s')]);
                } catch (\Throwable $th) {
                }
            }
        });
        return redirect(route('form.success'))->with('success', 'Berhasil menambah data!');
    }


    public function success(){
        return view('pages.frontend.success');
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
        //
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
