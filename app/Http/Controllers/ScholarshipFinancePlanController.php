<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipFinancePlan;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function exportPdf($id)
    {
        $plan = auth()->user()->financePlans()->findOrFail($id);

        $amount         = (float) $plan->scholarship_amount;
        $totalDays      = 180;
        $totalMonths    = 6;
        $rentTotal      = $plan->uses_rent && $plan->rent_cost ? (float) $plan->rent_cost * $totalMonths : 0;
        $transportTotal = $plan->uses_transport && $plan->transport_cost ? (float) $plan->transport_cost * $totalDays : 0;
        $remaining      = max(0, $amount - $rentTotal - $transportTotal);

        $foodPct    = $plan->food_percentage;
        $savingPct  = $plan->saving_percentage;
        $otherPct   = $plan->other_percentage;
        $pctSum     = $foodPct + $savingPct + $otherPct;

        $foodAmount   = $pctSum > 0 ? ($foodPct / $pctSum) * $remaining : 0;
        $savingAmount = $pctSum > 0 ? ($savingPct / $pctSum) * $remaining : 0;
        $otherAmount  = $pctSum > 0 ? ($otherPct / $pctSum) * $remaining : 0;

        $pdf = Pdf::loadView('finance-plans.pdf', compact(
            'plan', 'amount', 'totalDays', 'totalMonths',
            'rentTotal', 'transportTotal', 'remaining',
            'foodAmount', 'savingAmount', 'otherAmount'
        ))->setPaper('a4', 'portrait');

        $filename = 'rencana-keuangan-' . str_replace(' ', '-', strtolower($plan->title)) . '.pdf';

        return $pdf->download($filename);
    }

    public function destroy($id)
    {
        $plan = auth()->user()->financePlans()->findOrFail($id);
        $plan->delete();

        return redirect()->route('uang-beasiswa.index')->with('success', 'Rencana keuangan berhasil dihapus.');
    }
}
