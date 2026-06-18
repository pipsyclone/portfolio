@extends('layouts.email')

@section('subject', $subject ?? 'New Contact Message')

@section('content')
    <!-- Title -->
    <h2 style="margin: 0 0 24px; font-size: 20px; font-weight: 700; color: #1e293b;">
        📬 {{ __('New Contact Message') }}
    </h2>

    <!-- Sender Info Card -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 24px;">
        <tr>
            <td style="padding: 20px 24px;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding-bottom: 12px;">
                            <span style="display: inline-block; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; margin-bottom: 4px;">{{ __('From') }}</span>
                            <p style="margin: 4px 0 0; font-size: 15px; font-weight: 600; color: #1e293b;">{{ $senderName }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 12px;">
                            <span style="display: inline-block; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; margin-bottom: 4px;">{{ __('Email') }}</span>
                            <p style="margin: 4px 0 0; font-size: 15px; color: #3b82f6;">
                                <a href="mailto:{{ $senderEmail }}" style="color: #3b82f6; text-decoration: none;">{{ $senderEmail }}</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span style="display: inline-block; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; margin-bottom: 4px;">{{ __('Subject') }}</span>
                            <p style="margin: 4px 0 0; font-size: 15px; font-weight: 500; color: #334155;">{{ $subject }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Message Content -->
    <div style="margin-bottom: 8px;">
        <span style="display: inline-block; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; margin-bottom: 8px;">{{ __('Message') }}</span>
        <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-left: 4px solid #3b82f6; border-radius: 8px; padding: 20px 24px;">
            <p style="margin: 0; font-size: 14px; line-height: 1.8; color: #475569; white-space: pre-wrap;">{{ $messageBody }}</p>
        </div>
    </div>

    <!-- Timestamp -->
    <p style="margin: 20px 0 0; font-size: 12px; color: #94a3b8; text-align: right;">
        🕐 {{ now()->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
    </p>
@endsection
