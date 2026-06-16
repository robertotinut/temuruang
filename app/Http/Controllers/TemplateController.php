<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::with('eventType')->get();
        return view('master.templates.index', compact('templates'));
    }

    public function create()
    {
        $eventTypes = EventType::where('is_active', true)->get();
        return view('master.templates.create', compact('eventTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_type_id' => 'required|exists:event_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'preview_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'theme_category' => 'nullable|string|max:255',
        ]);

        $data = [
            'event_type_id' => $request->event_type_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_premium' => $request->has('is_premium') ? true : false,
            'is_active' => $request->has('is_active') ? true : false,
            'theme_category' => $request->theme_category,
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('templates', 'public');
        }

        if ($request->hasFile('preview_image')) {
            $data['preview_image'] = $request->file('preview_image')->store('templates', 'public');
        }

        Template::create($data);

        return redirect()->route('master.templates.index')->with('success', 'Template created successfully.');
    }

    public function edit(Template $template)
    {
        $eventTypes = EventType::where('is_active', true)->get();
        return view('master.templates.edit', compact('template', 'eventTypes'));
    }

    public function update(Request $request, Template $template)
    {
        $request->validate([
            'event_type_id' => 'required|exists:event_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'preview_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'theme_category' => 'nullable|string|max:255',
        ]);

        $data = [
            'event_type_id' => $request->event_type_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_premium' => $request->has('is_premium') ? true : false,
            'is_active' => $request->has('is_active') ? true : false,
            'theme_category' => $request->theme_category,
        ];

        if ($request->hasFile('thumbnail')) {
            if ($template->thumbnail) {
                Storage::disk('public')->delete($template->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('templates', 'public');
        }

        if ($request->hasFile('preview_image')) {
            if ($template->preview_image) {
                Storage::disk('public')->delete($template->preview_image);
            }
            $data['preview_image'] = $request->file('preview_image')->store('templates', 'public');
        }

        $template->update($data);

        return redirect()->route('master.templates.index')->with('success', 'Template updated successfully.');
    }

    public function destroy(Template $template)
    {
        if ($template->thumbnail) {
            Storage::disk('public')->delete($template->thumbnail);
        }
        if ($template->preview_image) {
            Storage::disk('public')->delete($template->preview_image);
        }
        
        $template->delete();
        return redirect()->route('master.templates.index')->with('success', 'Template deleted successfully.');
    }
}
