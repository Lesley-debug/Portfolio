@extends('layouts.app')

@section('title', $project->title . ' — Lesley Tabi, Software Engineer')
@section('meta_description', $project->summary . ' Built by Lesley Tabi, Software Engineer in Bamenda, Cameroon.')
@section('canonical', route('projects.show', $project))
@php
    $projectHasCover = $project->cover_image && file_exists(public_path('images/' . $project->cover_image));
    $projectImage = $projectHasCover ? asset('images/' . $project->cover_image) : asset('images/og-cover.png');
@endphp
@section('image', $projectImage)
@section('image_alt', $projectHasCover ? $project->title . ' project screenshot by Lesley Tabi' : 'Lesley Tabi software engineer portfolio preview')

@section('content')

{{-- NAV --}}
<nav class="nav">
    <div class="nav-inner">
        <div class="nav-brand">lesley<span class="dot">.</span>dev</div>
        <ul class="nav-links">
            <li><a href="/#skills">schema</a></li>
            <li><a href="/#projects">projects</a></li>
            <li><a href="/#contact">contact</a></li>
        </ul>
    </div>
</nav>

<div class="proj-page">
    <div class="container">

        {{-- breadcrumb --}}
        <div class="proj-breadcrumb">
            <a href="/#projects">← /api/projects</a>
            <span>/</span>
            <span>{{ $project->slug }}</span>
        </div>

        {{-- title row --}}
        <div class="proj-header">
            <div class="proj-header-meta">
                <span class="proj-endpoint">GET /api/projects/{{ $project->slug }}</span>
                @if($project->is_featured)
                    <span class="status-badge status-200">200 OK</span>
                @else
                    <span class="status-badge status-wip">WIP</span>
                @endif
            </div>
            <h1 class="proj-title">{{ $project->title }}</h1>

            @if($project->stack)
            <div class="project-stack">
                @foreach(explode(',', $project->stack) as $tech)
                <span class="stack-tag">{{ trim($tech) }}</span>
                @endforeach
            </div>
            @endif
        </div>

        {{-- screenshot --}}
        <div class="proj-screenshot">
            @if($project->cover_image && file_exists(public_path('images/' . $project->cover_image)))
                <img
                    src="{{ asset('images/' . $project->cover_image) }}"
                    alt="{{ $project->title }} screenshot"
                    class="proj-screenshot-img"
                >
            @else
                <div class="proj-screenshot-placeholder">
                    <div class="proj-placeholder-inner">
                        <div class="proj-placeholder-dots">
                            <span></span><span></span><span></span>
                        </div>
                        <span class="proj-placeholder-label">
                            @if($project->is_featured)
                                screenshot coming soon
                            @else
                                in development — preview not available yet
                            @endif
                        </span>
                    </div>
                </div>
            @endif
        </div>

        {{-- body --}}
        <div class="proj-body">

            {{-- description --}}
            <div class="proj-description">
                <div class="proj-section-label">// description</div>
                <p>{{ $project->description }}</p>
            </div>

            {{-- links --}}
            <div class="proj-links-block">
                <div class="proj-section-label">// links</div>
                <div class="proj-action-links">
                    @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="btn btn-primary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        Live site
                    </a>
                    @endif
                    @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="btn btn-ghost">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.009-.868-.013-1.703-2.782.604-3.369-1.342-3.369-1.342-.454-1.155-1.11-1.463-1.11-1.463-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0 1 12 6.836a9.59 9.59 0 0 1 2.504.337c1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.202 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.163 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
                        Source code
                    </a>
                    @endif
                    @if(!$project->live_url && !$project->github_url)
                    <span class="proj-no-links">// links will be added when the project ships</span>
                    @endif
                </div>
            </div>

        </div>

        {{-- back --}}
        <div class="proj-back">
            <a href="/#projects">← back to all projects</a>
        </div>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="footer-inner">
            <div class="footer-brand">lesley<span class="dot">.</span>dev</div>
            <div class="footer-links">
                <a href="https://github.com/Lesley-debug" target="_blank" rel="noopener">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.009-.868-.013-1.703-2.782.604-3.369-1.342-3.369-1.342-.454-1.155-1.11-1.463-1.11-1.463-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0 1 12 6.836a9.59 9.59 0 0 1 2.504.337c1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.202 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.163 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
                    <span>Lesley-debug</span>
                </a>
                <a href="https://www.linkedin.com/in/lesley-tabi-a0b1a1267" target="_blank" rel="noopener">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    <span>lesley-tabi</span>
                </a>
                <a href="{{ asset('files/resume.pdf') }}" download="Lesley_Tabi_CV.pdf" class="footer-cv">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    <span>Download CV</span>
                </a>
            </div>
            <div class="footer-copy">&copy; {{ date('Y') }} Lesley Tabi &middot; built with <span class="heart">&hearts;</span> in Laravel</div>
        </div>
    </div>
</footer>

@endsection
