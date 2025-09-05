<?php

namespace App\Http\Controllers;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::all();
        return view('resources.index', compact('resources'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'amount' => 'required|numeric',
            'hedera_tx_id' => 'nullable|string'
        ]);

        $resource = new Resource($validated);
        $resource->user_id = Auth::id();
        $resource->save();

        return redirect('/dashboard')->with('success', 'Resource shared!');
    }

    public function predict()
    {
        $total = Resource::sum('amount');
        $prediction = $total > 50 ? 'High demand - allocate more!' : 'Low demand';
        return view('resources.predict', ['prediction' => $prediction]);
    }
}
