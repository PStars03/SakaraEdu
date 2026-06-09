<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminBootcampController extends Controller
{
    public function index()
    {
        return view('admin.bootcamps.index');
    }

    public function create()
    {
        return view('admin.bootcamps.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'curriculum' => 'nullable|string',
            'registration_link' => 'required|url',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
            'is_paid' => 'required|boolean',
            'price' => 'nullable|numeric|min:1000',
        ]);

        // Validation based on is_paid
        if (! $validated['is_paid']) {
            $validated['price'] = null;
        } elseif (empty($validated['price']) || $validated['price'] < 1000) {
            return back()->withErrors(['price' => 'Harga wajib diisi minimal 1000 jika berbayar.'])->withInput();
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        $validated['created_by'] = auth()->id();

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        Bootcamp::create($validated);

        return redirect()->route('admin.bootcamp.index')->with('success', 'Bootcamp berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);
        return view('admin.bootcamps.edit', compact('bootcamp'));
    }

    public function update(Request $request, $id)
    {
        $bootcamp = Bootcamp::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'curriculum' => 'nullable|string',
            'registration_link' => 'required|url',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
            'is_paid' => 'required|boolean',
            'price' => 'nullable|numeric|min:1000',
        ]);

        if (! $validated['is_paid']) {
            $validated['price'] = null;
        } elseif (empty($validated['price']) || $validated['price'] < 1000) {
            return back()->withErrors(['price' => 'Harga wajib diisi minimal 1000 jika berbayar.'])->withInput();
        }

        if ($request->hasFile('poster')) {
            if ($bootcamp->poster) {
                Storage::disk('public')->delete($bootcamp->poster);
            }
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        if ($bootcamp->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        }

        $bootcamp->update($validated);

        return redirect()->route('admin.bootcamp.index')->with('success', 'Bootcamp berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);
        
        if ($bootcamp->poster) {
            Storage::disk('public')->delete($bootcamp->poster);
        }
        
        $bootcamp->delete();

        return redirect()->back()->with('success', 'Bootcamp berhasil dihapus.');
    }
}
