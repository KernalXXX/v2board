@extends('mail.modern._partials.layout')

@section('title', '到期通知')

@section('content')
    <div style="display:inline-block; margin:0 0 18px; padding:6px 12px; border-radius:999px; background:#fffaeb; color:#b54708; font-size:12px; font-weight:700; letter-spacing:.08em;">续费提醒</div>
    <div class="headline" style="margin:0 0 16px; font-size:28px; line-height:1.2; font-weight:800; color:#101828;">到期通知</div>
    <div style="display:inline-block; margin:0 0 22px; padding:12px 16px; border-radius:16px; background:#fff7ed; border:1px solid #fed7aa; color:#b54708; font-size:15px; line-height:1.6; font-weight:700;">您的服务即将到期</div>
    <div style="font-size:15px; line-height:1.9; color:#344054; background:#f9fafb; border:1px solid #e4e7ec; border-radius:18px; padding:18px 20px;">为了避免服务中断，请您尽快续费，如已续费请忽略此邮件。</div>
    <div style="margin-top:24px; text-align:center;">
        <a href="{{$url}}" class="theme-accent-bg" style="display:inline-block; padding:12px 22px; border-radius:12px; color:#ffffff; text-decoration:none; font-size:14px; font-weight:700;">前往续费</a>
    </div>
@endsection
