@extends('mail.modern._partials.layout')

@section('title', '网站通知')

@section('content')
    <div style="display:inline-block; margin:0 0 18px; padding:6px 12px; border-radius:999px; background:#f2f4f7; color:#344054; font-size:12px; font-weight:700; letter-spacing:.08em;">系统公告</div>
    <div class="headline" style="margin:0 0 16px; font-size:28px; line-height:1.2; font-weight:800; color:#101828;">网站通知</div>
    <div style="font-size:16px; line-height:1.9; color:#475467; margin:0 0 24px;">尊敬的用户您好！</div>
    <div style="font-size:15px; line-height:1.9; color:#344054; background:#f9fafb; border:1px solid #e4e7ec; border-radius:18px; padding:18px 20px;">{!! nl2br($content) !!}</div>
@endsection
