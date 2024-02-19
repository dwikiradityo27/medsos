<?php

namespace App\Http\Controllers;

use App\Models\Feeds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feed = Feeds::latest()->paginate(1);
        return view('feed.index', compact('feed'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feed.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video' => ['required', 'file', 'mimes:mp4', 'max:10240'],
            'caption' => ['nullable', 'string', 'max:100'],
        ]);

        $user = auth()->user();
        $feed = new feeds();
        $feed->created_by = $user->id;
        $feed->video = $request->file('video')->store('feeds');
        $feed->caption = $request->caption;
        $feed->save();

        return redirect()->route('feed.index')->with('success', 'feeds Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feeds $feed)
    {
        // Hapus feeds dari penyimpanan sebelum menghapus data dari database
        if ($feed->video) {
            Storage::delete($feed->video);
        }

        if ($feed->delete()) {
            return redirect()->route('feed.index')->with('success', 'Feeds berhasil dihapus!');
        }

        return redirect()->route('feed.index')->with('error', 'Gagal menghapus feeds.');
    }
}
