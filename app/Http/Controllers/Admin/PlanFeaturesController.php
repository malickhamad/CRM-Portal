<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PlanFeature;
use App\Models\SubscribtionPlan;
use Illuminate\Http\Request;

class PlanFeaturesController extends Controller
{
    public function index()
    {
       $features = PlanFeature::with('plan')->get();

        return view('backend.plan-features.index', compact('features'));
    }

    public function create()
    {
        $plans = SubscribtionPlan::all();
        return view('backend.plan-features.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:subscribtion_plans,id',
            'feature_name' => 'required|string|max:255',
        ]);

        PlanFeature::create([
            'subscribtion_plan_id' => $request->plan_id,
            'feature_name' => $request->feature_name,
        ]);

        return redirect()->route('admin.plan-features.index')->with('success', 'Feature created successfully!');
    }
    public function edit($id)
    {
        $feature = PlanFeature::findOrFail($id);
        $plans = SubscribtionPlan::all();
        return view('backend.plan-features.edit', compact('feature', 'plans'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:subscribtion_plans,id',
            'feature_name' => 'required|string|max:255',
        ]);

        $feature = PlanFeature::findOrFail($id);
        $feature->update([
            'subscribtion_plan_id' => $request->plan_id,
            'feature_name' => $request->feature_name,
        ]);

        return redirect()->route('admin.plan-features.index')->with('success', 'Feature updated successfully!');
    }

    public function destroy($id)
    {
        $feature = PlanFeature::findOrFail($id);
        $feature->delete();

        return redirect()->route('admin.plan-features.index')->with('success', 'Feature deleted successfully!');
    }
}
