<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class TestEmailController extends Controller
{
    public function sendTestEmail()
    {
        Mail::to('test@example.com')->send(new TestEmail());
        return 'Email has been sent!';
    }
}
