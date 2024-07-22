<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function showBlogs()
    {
        $blogs = Blog::all();
        return view('auth.pages.blog', compact('blogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_blog' => 'required|string|max:255',
            'konten' => 'required',
            'gambar_blog' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('gambar_blog')) {
            $image = $request->file('gambar_blog');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        Blog::create([
            'judul_blog' => $request->judul_blog,
            'konten' => $request->konten,
            'gambar_blog' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Blog berhasil ditambahkan!');
    }

    public function update(Request $request, $id_blog)
    {
        $request->validate([
            'judul_blog' => 'required|string|max:255',
            'konten' => 'required',
            'gambar_blog' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('gambar_blog')) {
            $image = $request->file('gambar_blog');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $blog = Blog::findOrFail($id_blog);
        $blog->update([
            'judul_blog' => $request->judul_blog,
            'konten' => $request->konten,
            'gambar_blog' => $imageName ?? $blog->gambar_blog,
        ]);

        return redirect()->back()->with('success', 'Blog berhasil diupdate!');
    }

    public function destroy($id_blog)
    {
        $blog = Blog::findOrFail($id_blog);
        if ($blog->gambar_blog) {
            unlink(public_path('images') . '/' . $blog->gambar_blog);
        }
        $blog->delete();

        return redirect()->back()->with('success', 'Blog berhasil dihapus!');
    }
}
