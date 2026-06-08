@extends('mail.modern._partials.layout')

@section('title', '登录确认')

@section('content')
    <div class="theme-accent-text" style="display:inline-block; margin:0 0 18px; padding:6px 12px; border-radius:999px; background:#eef4ff; font-size:12px; font-weight:700; letter-spacing:.08em;">安全登录</div>
    <div class="headline" style="margin:0 0 16px; font-size:28px; line-height:1.2; font-weight:800; color:#101828;">登入到{{$name}}</div>
    <div style="font-size:16px; line-height:1.9; color:#475467; margin:0 0 22px;">尊敬的用户您好，您正在登入到 {{$name}}，请在 5 分钟内点击下方按钮完成登入。如果您未授权该登入请求，请忽略此邮件。</div>
    <div style="text-align:center; margin:0 0 22px;">
        <a href="{{$link}}" class="theme-accent-bg" style="display:inline-block; padding:14px 24px; border-radius:12px; color:#ffffff; text-decoration:none; font-size:14px; font-weight:700;">立即登录</a>
    </div>
    <div style="font-size:13px; line-height:1.8; color:#667085; background:#f9fafb; border:1px solid #e4e7ec; border-radius:16px; padding:16px 18px; word-break:break-all;">如果按钮无法点击，可复制以下链接打开：<br><a href="{{$link}}" class="theme-accent-text" style="text-decoration:none;">{{$link}}</a></div>
@endsection
