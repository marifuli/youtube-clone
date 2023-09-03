<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $files = Media::latest();
        if($request->category) $files->where('category', $request->category);
        $files = $files->paginate();
        return view('home', [
            'videos' => $files,
        ]);
    }
    public function store(Request $request)
    {
        $name = $request->name;
        foreach($request->file('videos') as $f)
        {
            $name_ = $name ?: str_replace('.mp4', '', $f->getClientOriginalName());
            $path = Storage::put('videos', $f);
            Media::create([
                'name' => $name_,
                'path' => $path,
                'category' => $request->category ?: 'General',
            ]);
        }
        return back();
    }
}
