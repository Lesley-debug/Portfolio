@extends('layouts.app')

@section('title', 'Privacy Policy — Lesley Tabi')
@section('meta_description', 'Privacy policy for Lesley Tabi\'s portfolio website. Learn what data is collected and how it is used.')
@section('canonical', config('app.url') . '/privacy')

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
    .privacy-table {
        width: 100%;
        border-collapse: collapse;
        margin: 16px 0;
        font-size: 0.88rem;
    }
    .privacy-table th {
        text-align: left;
        padding: 8px 12px;
        background: #161b22;
        color: #e6edf3;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 600;
        border: 1px solid #21262d;
    }
    .privacy-table td {
        padding: 8px 12px;
        color: #8b949e;
        border: 1px solid #21262d;
        vertical-align: top;
    }
</style>

<div class="legal-page">
    <div class="legal-inner">

        <a href="/" class="legal-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            Back to portfolio
        </a>

        <h1>Privacy Policy</h1>
        <p class="legal-date">// Last updated: {{ date('F Y') }}</p>

        <p>This policy explains what information is collected when you visit this portfolio website and how it is handled. I take your privacy seriously — this site collects the absolute minimum.</p>

        <h2>01 — What data is collected</h2>
        <table class="privacy-table">
            <tr>
                <th>Data</th>
                <th>When</th>
                <th>Purpose</th>
            </tr>
            <tr>
                <td>Name, email, message</td>
                <td>Contact form submission</td>
                <td>To respond to your enquiry</td>
            </tr>
            <tr>
                <td>IP address, browser info</td>
                <td>Every page visit</td>
                <td>Standard server logs (hosting provider)</td>
            </tr>
        </table>

        <h2>02 — What is NOT collected</h2>
        <ul>
            <li>No cookies are set by this site</li>
            <li>No tracking pixels or analytics scripts</li>
            <li>No user accounts or passwords</li>
            <li>No payment information</li>
        </ul>

        <h2>03 — Contact form data</h2>
        <p>When you submit the contact form, your name, email, and message are delivered directly to my inbox (<strong>esanglesley@gmail.com</strong>) via Gmail SMTP. This data is <strong>not stored in any database</strong> on this server. It exists only in my email inbox and is used solely to reply to you.</p>

        <h2>04 — Server logs</h2>
        <p>Like all web servers, the hosting provider (InfinityFree) automatically logs basic request data (IP address, browser type, pages visited, timestamps). I do not control or access these logs directly. They are retained per the hosting provider's own policy.</p>

        <h2>05 — Third-party services</h2>
        <ul>
            <li><strong>Google Fonts</strong> — fonts are loaded from Google's CDN. Google may log your IP. See <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Google's Privacy Policy</a>.</li>
            <li><strong>GitHub / LinkedIn</strong> — external links only. Clicking them takes you to their platforms under their own privacy policies.</li>
        </ul>

        <h2>06 — Your rights</h2>
        <p>You have the right to request deletion of any personal data you submitted via the contact form. Simply email me at <a href="mailto:esanglesley@gmail.com">esanglesley@gmail.com</a> and I will delete it promptly.</p>

        <h2>07 — Children's privacy</h2>
        <p>This site is not directed at children under 13. I do not knowingly collect data from minors.</p>

        <h2>08 — Changes to this policy</h2>
        <p>This policy may be updated occasionally. The "last updated" date at the top will reflect any changes.</p>

        <h2>09 — Contact</h2>
        <p>For any privacy-related questions, contact me at <a href="mailto:esanglesley@gmail.com">esanglesley@gmail.com</a>.</p>

        <hr class="legal-divider">
        <p style="font-size:0.8rem; color:#6e7681;">&copy; {{ date('Y') }} Lesley Tabi. All rights reserved.</p>

    </div>
</div>

@endsection
