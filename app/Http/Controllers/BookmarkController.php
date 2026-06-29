<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Bootcamp;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $scholarshipBookmarks = $user->bookmarks()
            ->where('bookmarkable_type', Scholarship::class)
            ->with('bookmarkable')
            ->get()
            ->filter(fn ($b) => $b->bookmarkable !== null)
            ->values();

        $bootcampBookmarks = $user->bookmarks()
            ->where('bookmarkable_type', Bootcamp::class)
            ->with('bookmarkable')
            ->get()
            ->filter(fn ($b) => $b->bookmarkable !== null)
            ->values();

        return view('bookmarks.index', compact('scholarshipBookmarks', 'bootcampBookmarks'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'type' => 'required|in:scholarship,bootcamp',
            'id'   => 'required|integer',
        ]);

        $user = auth()->user();
        $modelClass = $request->type === 'scholarship' ? Scholarship::class : Bootcamp::class;
        $model = $modelClass::findOrFail($request->id);

        $existing = $user->bookmarks()
            ->where('bookmarkable_type', $modelClass)
            ->where('bookmarkable_id', $model->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $bookmarked = false;
        } else {
            $user->bookmarks()->create([
                'bookmarkable_type' => $modelClass,
                'bookmarkable_id'   => $model->id,
            ]);
            $bookmarked = true;
        }

        if ($request->expectsJson()) {
            return response()->json(['bookmarked' => $bookmarked]);
        }

        return back()->with('success', $bookmarked ? 'Disimpan ke bookmark!' : 'Bookmark dihapus.');
    }
}
