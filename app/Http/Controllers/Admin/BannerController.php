<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class BannerController extends Controller
{

    private $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $banners = $this->banner->paginate(10);

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * validação do banner 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     * 
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $image = $request->file('image')->store('banners', 'public');
        $data['image'] = $image;

        dd(public_path("storage/{$image}"));
        
        // Redimensionando a imagem
        $image = Image::make(public_path("storage/{$image}"))->fit(1920, 500);
        $image->save();

        if (isset($request->status)) {
            $data['status'] = 1;
        }

        if (isset($request->title_active)) {
            $data['title_active'] = 1;
        }

        $this->banner->create($data);

        flash('Banner Criado com Sucesso!')->success();
        return redirect()->route('admin.banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($banner)
    {
        $banner = $this->banner->findOrFail($banner);
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $banner)
    {
        $data = $request->all();
        
        $banner = $this->banner->find($banner);

        if ($request->status == 1) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        if ($request->status == 1) {
            $data['title_active'] = 1;
        } else {
            $data['title_active'] = 0;
        }

        if ($request->hasFile('image')) {

            if (Storage::exists($banner->image)) {
                Storage::delete($banner->image);
            }

            $image = $request->file('image')->store('banners', 'public');
            $data['image'] = $image;

            // Redimensionando a imagem
            $image = Image::make(public_path("storage/{$image}"))->fit(1920, 500);
            $image->save();
        }

        $banner->update($data);

        flash('Banner Atualizado com Sucesso!')->success();
        return redirect()->route('admin.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($banner)
    {
        $banner = $this->banner->find($banner);

        if($banner->delete() == TRUE){
            if (Storage::exists($banner->image)) {
                Storage::delete($banner->image);
            }
        }

	    flash('Banner Removido com Sucesso!')->success();
	    return redirect()->route('admin.banners.index');
    }
}
