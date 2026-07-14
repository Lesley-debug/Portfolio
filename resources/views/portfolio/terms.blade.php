@extends('layouts.app')

@section('title', 'Terms & Conditions — Lesley Tabi')
@section('meta_description', 'Terms and conditions for using Lesley Tabi\'s portfolio website.')
@section('canonical', url('/terms'))

@section('content')

<style>
    .legal-page {
        min-height: 100vh;
        background: #0a0e1a;
        color: #c9d1d9;
        font-family: 'Inter', sans-serif;
        padding: 80px 24px 60px;
    }
    .legal-inner {
        max-width: 760px;
        margin: 0 auto;
    }
    .legal-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #58a6ff;
        text-decoration: none;
        font-size: 0.85rem;
        margin-bottom: 40px;
        opacity: 0.8;
        transition: opacity 0.2s;
    }
    .legal-back:hover { opacity: 1; }
    .legal-page h1 {
        font-family: 'JetBrains Mono', monospace;
        font-size: 2rem;
        color: #e6edf3;
        margin-bottom: 6px;
    }
    .legal-date {
        font-size: 0.8rem;
        color: #6e7681;
        margin-bottom: 40px;
        font-family: 'JetBrains Mono', monospace;
    }
    .legal-page h2 {
        font-size: 1rem;
        color: #58a6ff;
        font-family: 'JetBrains Mono', monospace;
        margin: 36px 0 10px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .legal-page p, .legal-page li {
        font-size: 0.95rem;
        line-height: 1.75;
        color: #8b949e;
    }
    .legal-page ul { padding-left: 20px; }
    .legal-page li { margin-bottom: 6px; }
    .legal-page a { color: #58a6ff; }
    .legal-divider {
        border: none;
        border-top: 1px solid #21262d;
        margin: 40px 0;
    }
</style>

<div class="legal-page">
    <div class="legal-inner">

        <a href="/" class="legal-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            Back to portfolio
        </a>

        <h1>Terms &amp; Conditions</h1>
        <p class="legal-date">// Last updated: {{ date('F Y') }}</p>

        <p>By accessing and using this website (<strong>lesleydesigns.wuaze.com</strong>), you agree to the following terms. If you do not agree, please do not use this site.</p>

        <h2>01 — Use of this site</h2>
        <p>This is a personal portfolio website. You may browse the content for informational purposes only. You may not:</p>
        <ul>
            <li>Copy, reproduce, or redistribute any content without written permission</li>
            <li>Use the contact form for spam, harassment, or unsolicited commercial messages</li>
            <li>Attempt to probe, scan, or test the vulnerability of the site</li>
            <li>Misrepresent your identity when submitting the contact form</li>
        </ul>

        <h2>02 — Intellectual property</h2>
        <p>All content on this site — including text, design, code snippets, and project screenshots — is the intellectual property of Lesley Tabi unless otherwise stated. All rights reserved.</p>
        <p>Open-source projects linked from this portfolio are governed by their respective licenses (see each repository).</p>

        <h2>03 — Contact form</h2>
        <p>When you submit the contact form, your name, email address, and message are sent directly to me via email. This data is not stored in any database. See the <a href="/privacy">Privacy Policy</a> for details.</p>

        <h2>04 — External links</h2>
        <p>This site may link to third-party websites (GitHub, LinkedIn, etc.). I am not responsible for the content or privacy practices of those sites.</p>

        <h2>05 — Disclaimer</h2>
        <p>This site is provided "as is" without warranties of any kind. I do not guarantee uninterrupted availability or that the site is free from errors.</p>

        <h2>06 — Changes</h2>
        <p>These terms may be updated at any time. Continued use of the site after changes constitutes acceptance of the new terms.</p>

        <h2>07 — Contact</h2>
        <p>Questions? Reach me at <a href="mailto:esanglesley@gmail.com">esanglesley@gmail.com</a> or via the <a href="/#contact">contact form</a>.</p>

        <hr class="legal-divider">
        <p style="font-size:0.8rem; color:#6e7681;">&copy; {{ date('Y') }} Lesley Tabi. All rights reserved.</p>

    </div>
</div>

@endsection
