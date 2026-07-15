<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->get();
        $skills = Skill::portfolioSkills()->groupBy('category');

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
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            Mail::raw(
                implode("\n", [
                    "New message from your portfolio!",
                    "",
                    "Name:    {$data['name']}",
                    "Email:   {$data['email']}",
                    "Subject: {$data['subject']}",
                    "",
                    "Message:",
                    $data['message'],
                ]),
                function ($mail) use ($data) {
                    $mail->to('esanglesley@gmail.com')
                        ->subject('Portfolio: ' . $data['subject'])
                        ->replyTo($data['email'], $data['name']);
                }
            );
        } catch (\Exception $e) {
            // mail failed silently — still show success to visitor
        }

        return redirect('/#contact')->with('contact_status', 'Message sent! I will get back to you shortly.');
    }
}
