<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmailsImport;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function uploadExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->store('uploads');

        Excel::import(new EmailsImport, $path);

        return redirect()->back()->with('success', 'Emails imported successfully.');
    }

    public function sendEmails()
    {
        $emails = Email::all();

        foreach ($emails as $email) {
            Mail::raw('This is a test email.', function ($message) use ($email) {
                $message->to($email->email_address)
                        ->subject('Test Email');
            });
        }

        return redirect()->back()->with('success', 'Emails sent successfully.');
    }
}