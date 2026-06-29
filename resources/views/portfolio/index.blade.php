@extends('layouts.app')

@section('title', 'Lesley Tabi — Backend Developer')

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
    </div>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="container">
        <div class="hero-request">
            <span class="hero-method">GET</span>
            <span>/developer/lesley-tabi</span>
            <span class="hero-status">200 OK</span>
        </div>

        <div class="json-block">
            <span class="json-bracket">{</span>
            <span class="json-key">"name"</span><span class="json-punct">:</span> <span class="json-string">"Lesley Tabi"</span><span class="json-punct">,</span>
            <span class="json-key">"role"</span><span class="json-punct">:</span> <span class="json-string">"Backend Developer"</span><span class="json-punct">,</span>
            <span class="json-key">"experience"</span><span class="json-punct">:</span> <span class="json-string">"1 year"</span><span class="json-punct">,</span>
            <span class="json-key">"location"</span><span class="json-punct">:</span> <span class="json-string">"Bamenda, Cameroon"</span><span class="json-punct">,</span>
            <span class="json-key">"stack"</span><span class="json-punct">:</span> <span class="json-bracket">[</span><span class="json-string">"PHP"</span><span class="json-punct">,</span> <span class="json-string">"Laravel"</span><span class="json-punct">,</span> <span class="json-string">"MySQL"</span><span class="json-bracket">]</span><span class="json-punct">,</span>
            <span class="json-key">"available_for_hire"</span><span class="json-punct">:</span> <span class="json-bool">true</span><span class="json-punct">,</span>
            <span class="json-key">"open_to"</span><span class="json-punct">:</span> <span class="json-bracket">[</span><span class="json-string">"full-time"</span><span class="json-punct">,</span> <span class="json-string">"contract"</span><span class="json-punct">,</span> <span class="json-string">"remote"</span><span class="json-bracket">]</span>
            <span class="json-bracket">}</span><span class="cursor-blink"></span>

            <div class="hero-headers">
                <span><b>cache:</b> miss</span>
                <span><b>latency:</b> 42ms</span>
                <span><b>server:</b> bamenda-edge-1</span>
                <span class="ok-color"><b>x-status:</b> open-to-work</span>
            </div>
        </div>

        <p class="hero-tagline">
            I build the parts of an application users never see directly — <strong>databases, APIs, and the logic that holds it all together</strong> — and I make sure it ships, even when the deployment gets messy.
        </p>

        <div class="hero-cta">
            <a href="#projects" class="btn btn-primary">View projects</a>
            <a href="#contact" class="btn btn-ghost">Get in touch</a>
        </div>
    </div>
</section>

{{-- SKILLS — SQL schema --}}
<section class="section" id="skills">
    <div class="container trace-rail">
        <div class="trace-step">
            <span class="trace-dot is-blue"></span>
            <div class="section-title-row">
                <div>
                    <div class="section-label">schema.sql</div>
                    <h2 class="section-title">CREATE TABLE <span class="accent">skills</span></h2>
                </div>
                <span class="latency-tag">step 1 / 3</span>
            </div>

            <div class="schema-table">
                @foreach($skills as $category => $items)
                <div class="schema-group-name">{{ $category }}</div>
                @foreach($items as $skill)
                <div class="schema-row">
                    <div class="schema-col-name">{{ $skill->name }}</div>
                    <div class="schema-col-type">VARCHAR</div>
                    <div class="schema-bar-track">
                        <div class="schema-bar-fill" style="width: {{ $skill->proficiency }}%;"></div>
                    </div>
                </div>
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- PROJECTS — API list --}}
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

            @foreach($projects as $project)
            <article class="project-card">
                <div class="project-card-top">
                    <div>
                        <div class="project-id">#{{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }}</div>
                        <h3 class="project-title">{{ $project->title }}</h3>
                    </div>
                    <span class="status-badge status-200">200</span>
                </div>

                <p class="project-summary">{{ $project->summary }}</p>

                @if($project->stack)
                <div class="project-stack">
                    @foreach(explode(',', $project->stack) as $tech)
                    <span class="stack-tag">{{ trim($tech) }}</span>
                    @endforeach
                </div>
                @endif

                <div class="project-links">
                    <a href="{{ route('projects.show', $project) }}">view details →</a>
                    @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener">live site ↗</a>
                    @endif
                    @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener">source ↗</a>
                    @endif
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

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
        © {{ date('Y') }} Lesley Tabi · built with <span class="heart">♥</span> in Laravel
    </div>
</footer>

@endsection