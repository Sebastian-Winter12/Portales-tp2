<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function news()
    {  
        $news = News::all();

        return view('news.news', compact('news'));
    }


    public function view(int $id)
    {
        $new = News::findOrFail($id);

        return view('news.view', [
            'new' => $new
        ]);
    }

    public function createForm()
    {
        return view('news.create-form');
    }

    public function createProcess(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'journalist' => 'required|min:3|max:255',
            'release_date' => 'required|date',
            'synopsis' => 'required|min:3|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ], [
            'title.required' => 'El título debe tener un valor',
            'journalist.required' => 'El periodista debe tener un nombre',
            'release_date.required' => 'La fecha de estreno debe tener un valor',
            'synopsis.required' => 'La sinopsis debe tener un valor',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.max' => 'La imagen no puede exceder los 2MB.'
        ]);

        $input = $request->only(['title', 'image', 'release_date', 'synopsis', 'journalist', 'news_id']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $input['image'] = $path;
        }

        News::create($input);

        return redirect()
            ->route('news.news')
            ->with('feedback.message', 'La noticia <b>"' . e($input['title']) . '"</b> se publicó con éxito.');
    }

    public function editForm(int $id)
    {
        $new = News::findOrFail($id);

        return view('news.edit-form', [
            'new' => $new
        ]);
    }

    public function editProcess(int $id, Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'journalist' => 'required|min:3|max:255',
            'release_date' => 'required|date',
            'synopsis' => 'required|min:3|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ], [
            'title.required' => 'El título debe tener un valor',
            'journalist.required' => 'El periodista debe tener un nombre',
            'release_date.required' => 'La fecha de estreno debe tener un valor',
            'synopsis.required' => 'La sinopsis debe tener un valor',
            'image.max' => 'La imagen no puede exceder los 2MB.'
        ]);

        $input = $request->only(['title', 'image', 'release_date', 'synopsis', 'journalist', 'news_id']);

        $new = News::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($new->image) {
                Storage::disk('public')->delete($new->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $input['image'] = $path;
        }

        $new->update($input);

        return redirect()
            ->route('admin.index')
            ->with('feedback.message', 'La noticia <b>"' . e($input['title']) . '"</b> se editó con éxito.');
    }

    public function deleteProcess(int $id)
    {
        $new = News::findOrFail($id);

        if ($new->image) {
            Storage::disk('public')->delete($new->image);
        }

        $new->delete();

        return redirect()
            ->route('news.news')
            ->with('feedback.message', 'La noticia <b>"' . e($new->title) . '"</b> se eliminó con éxito.');
    }

    public function edit($id)
    {
        $new = News::findOrFail($id);
        return view('news.edit-form', compact('new'));
    }

    public function update(Request $request, $id)
    {
        $new = News::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
            'journalist' => 'required|min:3|max:255',
            'release_date' => 'required|date',
            'synopsis' => 'required|min:3|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($new->image && file_exists(public_path($new->image))) {
                unlink(public_path($new->image)); 
            }

            $imagePath = $request->file('image')->store('news_images', 'public');
            $validatedData['image'] = $imagePath;
        } else {
            $validatedData['image'] = $new->image;
        }

        $new->update($validatedData);

        return redirect()->route('news.news')->with('success', 'Noticia actualizada con éxito');
    }
}
