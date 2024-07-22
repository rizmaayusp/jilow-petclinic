<?php

// app/Http/Controllers/Auth/EmailNewsletterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailNewsletter;
use Illuminate\Http\Request;

class EmailNewsletterController extends Controller
{
    public function index()
    {
        $emails = EmailNewsletter::all();
        return view('auth.pages.email_newsletter', compact('emails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:email_newsletters,email',
        ]);

        EmailNewsletter::create(['email' => $request->email]);

        return redirect()->back()->with('success', 'Email baru berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        $email = EmailNewsletter::findOrFail($id);
        $email->delete();

        return redirect()->back()->with('success', 'Email berhasil dihapus!');
    }
}

