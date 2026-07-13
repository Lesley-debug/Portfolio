@extends('layouts.app')

@section('title', 'Lesley Tabi — Software Engineer')

@section('content')

{{-- NAV --}}
<nav class="nav">
    <div class="nav-inner">
        <div class="nav-brand">lesley<span class="dot">.</span>dev</div>
        <ul class="nav-links">
            <li><a href="#skills">schema</a></li>
            <li><a href="#projects">projects</a></li>
            <li><a href="#contact">contact</a></li>
        </ul>
        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

{{-- MOBILE DRAWER --}}
<div class="nav-drawer" id="navDrawer">
    <div class="nav-drawer-backdrop" id="navBackdrop"></div>
    <div class="nav-drawer-panel">
        <a href="#skills"  class="nav-drawer-link" data-close>schema</a>
        <a href="#projects" class="nav-drawer-link" data-close>projects</a>
        <a href="#contact"  class="nav-drawer-link" data-close>contact</a>
        <a href="{{ asset('files/resume.pdf') }}" target="_blank" rel="noopener" class="nav-drawer-cv">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            View CV
        </a>
    </div>
</div>

<script>
    (function () {
        const toggle = document.getElementById('navToggle');
        const drawer = document.getElementById('navDrawer');
        const backdrop = document.getElementById('navBackdrop');

        function open() {
            toggle.classList.add('is-open');
            drawer.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function close() {
            toggle.classList.remove('is-open');
            drawer.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        toggle.addEventListener('click', () => drawer.classList.contains('is-open') ? close() : open());
        backdrop.addEventListener('click', close);
        drawer.querySelectorAll('[data-close]').forEach(el => el.addEventListener('click', close));
    })();
</script>

{{-- HERO --}}
<section class="hero">
    <div class="hero-grid"></div>
    <video class="hero-video" autoplay muted loop playsinline
        poster="{{ asset('images/hero-poster.jpg') }}">
        <source src="{{ asset('videos/hero-demo.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>
    <div class="hero-video-credit">background: live preview — NST Herbal Clinic</div>
    <div class="container">
        <div class="hero-request">
            <span class="hero-method">GET</span>
            <span>/developer/lesley-tabi</span>
            <span class="hero-status">200 OK</span>
        </div>

        <div class="json-block">
            <div class="json-titlebar">
                <div class="json-titlebar-dots">
                    <span></span><span></span><span></span>
                </div>
                <span class="json-titlebar-name">response.json</span>
                <span class="json-titlebar-lang">JSON</span>
            </div>
            <div class="json-code">
                <div class="json-gutter">
                    <span>1</span><span>2</span><span>3</span><span>4</span>
                    <span>5</span><span>6</span><span>7</span><span>8</span>
                    <span>9</span>
                </div>
                <div class="json-content">
                    <span class="json-line"><span class="json-bracket">{</span></span>
                    <span class="json-line">  <span class="json-key">"name"</span><span class="json-punct">:</span> <span class="json-string">"Lesley Tabi"</span><span class="json-punct">,</span></span>
                    <span class="json-line">  <span class="json-key">"role"</span><span class="json-punct">:</span> <span class="json-string">"Software Engineer"</span><span class="json-punct">,</span></span>
                    <span class="json-line">  <span class="json-key">"focus"</span><span class="json-punct">:</span> <span class="json-string">"Backend-heavy, full-stack capable"</span><span class="json-punct">,</span></span>
                    <span class="json-line">  <span class="json-key">"location"</span><span class="json-punct">:</span> <span class="json-string">"Bamenda, Cameroon"</span><span class="json-punct">,</span></span>
                    <span class="json-line">  <span class="json-key">"stack"</span><span class="json-punct">:</span> <span class="json-bracket">[</span><span class="json-string">"PHP"</span><span class="json-punct">,</span> <span class="json-string">"Laravel"</span><span class="json-punct">,</span> <span class="json-string">"Livewire"</span><span class="json-punct">,</span> <span class="json-string">"React"</span><span class="json-punct">,</span> <span class="json-string">"MySQL"</span><span class="json-bracket">]</span><span class="json-punct">,</span></span>
                    <span class="json-line">  <span class="json-key">"available_for_hire"</span><span class="json-punct">:</span> <span class="json-bool">true</span><span class="json-punct">,</span></span>
                    <span class="json-line">  <span class="json-key">"open_to"</span><span class="json-punct">:</span> <span class="json-bracket">[</span><span class="json-string">"full-time"</span><span class="json-punct">,</span> <span class="json-string">"contract"</span><span class="json-punct">,</span> <span class="json-string">"remote"</span><span class="json-bracket">]</span></span>
                    <span class="json-line"><span class="json-bracket">}</span><span class="cursor-blink"></span></span>
                </div>
            </div>
            <div class="hero-headers">
                <span><b>cache:</b> miss</span>
                <span><b>latency:</b> 42ms</span>
                <span><b>server:</b> bamenda-edge-1</span>
                <span class="ok-color"><b>x-status:</b> open-to-work</span>
            </div>
        </div>

        <p class="hero-tagline">
            I build full products — <strong>Laravel/Livewire or React on the frontend, backed by APIs and databases that don't fall over</strong> — and I make sure it ships, even when the deployment gets messy.
        </p>

        <div class="hero-cta">
            <a href="#projects" class="btn btn-primary">View projects</a>
            <a href="#contact" class="btn btn-ghost">Get in touch</a>
            <a href="{{ asset('files/resume.pdf') }}" target="_blank" rel="noopener" class="btn btn-ghost">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                View CV
            </a>
        </div>
    </div>
</section>

{{-- SKILLS — category grid --}}
<section class="section" id="skills">
    <div class="container">
        <div class="section-label">CREATE TABLE skills</div>
        <h2 class="section-title">Tech <span class="accent">stack</span></h2>

        <div class="skills-grid">
            @foreach($skills as $category => $items)
            <div class="skill-card" data-category="{{ \Illuminate\Support\Str::slug($category) }}">
                <div class="skill-card-header">
                    <span class="skill-card-accent"></span>
                    <span class="skill-card-title">{{ $category }}</span>
                    <span class="skill-card-count">{{ count($items) }} fields</span>
                </div>
                @foreach($items as $skill)
                <div class="schema-row" data-category="{{ \Illuminate\Support\Str::slug($category) }}">
                    <div class="schema-col-name">{{ $skill->name }}</div>
                    <div class="schema-bar-track">
                        <div class="schema-bar-fill" data-percent="{{ $skill->proficiency }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const rows = document.querySelectorAll('.schema-row');

        if (reduceMotion) {
            rows.forEach(row => {
                row.classList.add('is-visible');
                const fill = row.querySelector('.schema-bar-fill');
                if (fill) fill.style.width = fill.dataset.percent + '%';
            });
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    const row = entry.target;
                    setTimeout(() => {
                        row.classList.add('is-visible');
                        const fill = row.querySelector('.schema-bar-fill');
                        if (fill) fill.style.width = fill.dataset.percent + '%';
                    }, i * 60);
                    observer.unobserve(row);
                }
            });
        }, {
            threshold: 0.2
        });

        rows.forEach(row => observer.observe(row));
    });
</script>

{{-- PROJECTS — bento grid --}}
<section class="section" id="projects">
    <div class="container trace-rail">
        <div class="trace-step">
            <span class="trace-dot is-green"></span>
            <div class="section-title-row">
                <div>
                    <div class="section-label">GET /api/projects</div>
                    <h2 class="section-title">Recent <span class="accent">work</span></h2>
                </div>
                <span class="latency-tag">step 2 / 3</span>
            </div>

            <div class="api-list-meta">
                returning <span class="count">{{ $projects->count() }}</span> {{ $projects->count() === 1 ? 'result' : 'results' }}
            </div>

            <div class="project-bento">
                @foreach($projects as $i => $project)
                <article class="pcard pcard--{{ $loop->first ? 'featured' : 'grid' }}" data-index="{{ $loop->index }}">
                    <div class="pcard-bar">
                        <div class="pcard-bar-dots">
                            <span></span><span></span><span></span>
                        </div>
                        <span class="pcard-bar-id">project_{{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }}.json</span>
                        @if($project->is_featured)
                        <span class="status-badge status-200">200 OK</span>
                        @else
                        <span class="status-badge status-wip">WIP</span>
                        @endif
                    </div>

                    <div class="pcard-body">
                        <h3 class="pcard-title">{{ $project->title }}</h3>
                        <p class="pcard-summary">{{ $project->summary }}</p>

                        @if($project->stack)
                        <div class="project-stack">
                            @foreach(explode(',', $project->stack) as $tech)
                            <span class="stack-tag">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                        @endif

                        <div class="pcard-footer">
                            <div class="project-links">
                                <a href="{{ route('projects.show', $project) }}">view details →</a>
                                @if($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" rel="noopener">live site ↗</a>
                                @endif
                                @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener">source ↗</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach

                {{-- more coming card --}}
                <div class="pcard pcard--more" data-index="{{ $projects->count() }}">
                    <div class="pcard-body pcard-body--more">
                        <div class="pcard-more-icon">{ }</div>
                        <p class="pcard-more-text">More projects shipping soon</p>
                        <span class="pcard-more-sub">currently in active development</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const cards = document.querySelectorAll('.pcard');

        if (reduceMotion) {
            cards.forEach(c => c.classList.add('is-visible'));
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const card = entry.target;
                    const delay = parseInt(card.dataset.index) * 120;
                    setTimeout(() => card.classList.add('is-visible'), delay);
                    observer.unobserve(card);
                }
            });
        }, { threshold: 0.12 });

        cards.forEach(c => observer.observe(c));
    });
</script>

{{-- CONTACT — POST request --}}
<section class="section" id="contact">
    <div class="container trace-rail">
        <div class="trace-step">
            <span class="trace-dot is-orange"></span>
            <div class="section-title-row">
                <div>
                    <div class="section-label">POST /contact</div>
                    <h2 class="section-title">Let's <span class="accent">talk</span></h2>
                </div>
                <span class="latency-tag">step 3 / 3</span>
            </div>

            <div class="request-block">
                <div class="request-line">
                    <span class="method">POST</span> /contact HTTP/1.1 &nbsp; Content-Type: application/json
                </div>

                @if(session('contact_status'))
                <div class="alert-success">✓ {{ session('contact_status') }}</div>
                @endif

                @if($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">name</label>
                            <input type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="Jane Doe">
                        </div>
                        <div class="form-group">
                            <label class="form-label">email</label>
                            <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="jane@company.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">subject</label>
                        <input type="text" name="subject" class="form-input" value="{{ old('subject') }}" placeholder="Backend role at...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">message</label>
                        <textarea name="message" class="form-textarea" placeholder="Tell me about the role or project...">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send request</button>
                </form>

                <div class="contact-meta">
                    <a href="mailto:esanglesley@gmail.com">esanglesley@gmail.com</a>
                    <a href="https://github.com/Lesley-debug" target="_blank" rel="noopener">github.com/Lesley-debug</a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="footer-inner">
            <div class="footer-brand">lesley<span class="dot">.</span>dev</div>

            <div class="footer-links">
                <a href="https://github.com/Lesley-debug" target="_blank" rel="noopener" aria-label="GitHub">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.009-.868-.013-1.703-2.782.604-3.369-1.342-3.369-1.342-.454-1.155-1.11-1.463-1.11-1.463-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0 1 12 6.836a9.59 9.59 0 0 1 2.504.337c1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.202 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.163 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
                    <span>Lesley-debug</span>
                </a>
                <a href="https://www.linkedin.com/in/lesley-tabi-a0b1a1267" target="_blank" rel="noopener" aria-label="LinkedIn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    <span>lesley-tabi</span>
                </a>
                <a href="{{ asset('files/resume.pdf') }}" download="Lesley_Tabi_CV.pdf" class="footer-cv">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    <span>Download CV</span>
                </a>
            </div>

            <div class="footer-copy">
                &copy; {{ date('Y') }} Lesley Tabi &middot; built with <span class="heart">&hearts;</span> in Laravel
                &middot; <a href="/terms">Terms</a> &middot; <a href="/privacy">Privacy</a>
            </div>
        </div>
    </div>
</footer>

@endsection