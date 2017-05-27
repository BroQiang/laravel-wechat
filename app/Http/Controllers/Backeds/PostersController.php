<?php

namespace App\Http\Controllers\Backeds;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostersRequest;
use App\Models\Poster;
use App\Uploads\Uploads;
use App\Uploads\UploadsException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('backeds.posters.index')
            ->with('posters', Poster::orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backeds.posters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostersRequest $request)
    {
        Poster::create($request->all());

        return redirect('backed/poster');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backeds.posters.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backeds.posters.create');
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
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }

    public function uploadShow(Request $request, Poster $poster)
    {
        return view('backeds.posters.upload', compact('poster'));
    }

    public function upload(Request $request, Poster $poster)
    {
        try {
            $poster->img_url = (new Uploads('img_url', 'posters', '1'))->upload($request);
        } catch (UploadsException $e) {
            return back()->with('error', $e->getMessage());
        }

        $poster->save();

        return redirect('backed/poster');
    }

    public function preview(Request $request, Poster $poster)
    {
        return response()->file(storage_path('app/' . $poster->img_url));
    }
}
