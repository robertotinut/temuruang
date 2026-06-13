<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('master.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('master.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_guest' => 'nullable|integer',
            'max_gallery' => 'nullable|integer',
            'max_template' => 'nullable|integer',
        ]);

        Package::create([
            'name' => $request->name,
            'price' => $request->price,
            'max_guest' => $request->max_guest,
            'max_gallery' => $request->max_gallery,
            'max_template' => $request->max_template,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('master.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        return view('master.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_guest' => 'nullable|integer',
            'max_gallery' => 'nullable|integer',
            'max_template' => 'nullable|integer',
        ]);

        $package->update([
            'name' => $request->name,
            'price' => $request->price,
            'max_guest' => $request->max_guest,
            'max_gallery' => $request->max_gallery,
            'max_template' => $request->max_template,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('master.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('master.packages.index')->with('success', 'Package deleted successfully.');
    }
}
