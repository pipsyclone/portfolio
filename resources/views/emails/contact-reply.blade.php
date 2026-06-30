@extends('layouts.email')

@section('subject', 'Re: ' . $subject)

@section('content')
    <!-- Title -->
    <h2 style="margin: 0 0 24px; font-size: 20px; font-weight: 700; color: #1e293b;">
        📬 Re: {{ $subject }}
    </h2>

    <!-- Message Content -->
    <div style="margin-bottom: 8px;">
        <span style="display: inline-block; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; margin-bottom: 8px;">Pesan Balasan</span>
        <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-left: 4px solid #3b82f6; border-radius: 8px; padding: 20px 24px;">
            <p style="margin: 0; font-size: 14px; line-height: 1.8; color: #475569; white-space: pre-wrap;">{{ $replyMessage }}</p>
        </div>
    </div>

    <!-- Timestamp -->
    <p style="margin: 20px 0 0; font-size: 12px; color: #94a3b8; text-align: right;">
        🕐 {{ now()->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
    </p>
@endsection
