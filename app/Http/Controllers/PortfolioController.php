<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->get();
        $skills = Skill::orderBy('sort_order')->get()->groupBy('category');

        return view('portfolio.index', [
            'projects' => $projects,
            'skills'   => $skills,
        ]);
    }

    public function showProject(Project $project)
    {
        return view('portfolio.project', [
            'project' => $project,
        ]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            Mail::raw(
                "New message from your portfolio site!\n\n" .
                    "Name: " . $request->name . "\n" .
                    "Email: " . $request->email . "\n" .
                    "Subject: " . $request->subject . "\n\n" .
                    "Message:\n" . $request->message,
                function ($mail) use ($request) {
                    $mail->to(env('PORTFOLIO_OWNER_EMAIL', 'lesleytabi@example.com'))
                        ->subject('Portfolio Contact: ' . $request->subject)
                        ->replyTo($request->email, $request->name);
                }
            );
        } catch (\Exception $e) {
            Log::warning('Portfolio contact email failed: ' . $e->getMessage());
        }

        return back()->with('contact_status', 'Message sent! I will get back to you soon.');
    }
}
