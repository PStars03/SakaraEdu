<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipFinancePlan;
use Illuminate\Http\Request;

class ScholarshipFinancePlanController extends Controller
{
    public function index()
    {
        $plans = auth()->user()->financePlans()->latest()->get();
        return view('finance-plans.index', compact('plans'));
    }

    public function create()
    {
        return view('finance-plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'scholarship_amount' => 'required|numeric|min:100000',
            'uses_transport' => 'required|boolean',
            'uses_rent' => 'required|boolean',
            'rent_cost' => 'nullable|numeric|min:0',
            'transport_cost' => 'nullable|numeric|min:0',
            'rent_percentage' => 'required|integer',
            'food_percentage' => 'required|integer',
            'transport_percentage' => 'required|integer',
            'saving_percentage' => 'required|integer',
            'other_percentage' => 'required|integer',
        ]);

        // Clear nominal costs if scenario is not selected
        if (!$validated['uses_rent']) {
            $validated['rent_cost'] = null;
        }
        if (!$validated['uses_transport']) {
            $validated['transport_cost'] = null;
        }

        auth()->user()->financePlans()->create($validated);

        return redirect()->route('uang-beasiswa.index')->with('success', 'Rencana keuangan berhasil dibuat.');
    }

    public function show($id)
    {
        $plan = auth()->user()->financePlans()->findOrFail($id);
        return view('finance-plans.show', compact('plan'));
    }

    public function edit($id)
    {
        $plan = auth()->user()->financePlans()->findOrFail($id);
        return view('finance-plans.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $plan = auth()->user()->financePlans()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'scholarship_amount' => 'required|numeric|min:100000',
            'uses_transport' => 'required|boolean',
            'uses_rent' => 'required|boolean',
            'rent_cost' => 'nullable|numeric|min:0',
            'transport_cost' => 'nullable|numeric|min:0',
            'rent_percentage' => 'required|integer',
            'food_percentage' => 'required|integer',
            'transport_percentage' => 'required|integer',
            'saving_percentage' => 'required|integer',
            'other_percentage' => 'required|integer',
        ]);

        // Clear nominal costs if scenario is not selected
        if (!$validated['uses_rent']) {
            $validated['rent_cost'] = null;
        }
        if (!$validated['uses_transport']) {
            $validated['transport_cost'] = null;
        }

        $plan->update($validated);

        return redirect()->route('uang-beasiswa.index')->with('success', 'Rencana keuangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $plan = auth()->user()->financePlans()->findOrFail($id);
        $plan->delete();

        return redirect()->route('uang-beasiswa.index')->with('success', 'Rencana keuangan berhasil dihapus.');
    }
}
