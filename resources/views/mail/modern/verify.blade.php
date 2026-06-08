@extends('mail.modern._partials.layout')

@section('title', '邮箱验证码')

@section('content')
    <div class="theme-accent-text" style="display:inline-block; margin:0 0 18px; padding:6px 12px; border-radius:999px; background:#eef4ff; font-size:12px; font-weight:700; letter-spacing:.08em;">安全验证</div>
    <div class="headline" style="margin:0 0 12px; font-size:30px; line-height:1.2; font-weight:800; color:#101828;">邮箱验证码</div>
    <div style="font-size:16px; line-height:1.9; color:#475467; margin:0 0 24px;">尊敬的用户您好，您正在进行邮箱验证，请在 5 分钟内使用下方验证码完成验证。</div>
    <div style="text-align:center; margin:0 0 26px;">
        <div class="theme-accent-text" style="display:inline-block; min-width:220px; padding:18px 28px; border-radius:18px; background:#f8fafc; border:1px solid #e4e7ec; font-size:34px; line-height:1; font-weight:800; letter-spacing:6px; font-family:'SFMono-Regular',Consolas,'Liberation Mono',Menlo,monospace;">{{$code}}</div>
    </div>
    <div style="font-size:14px; line-height:1.8; color:#667085; margin:0 0 28px;">如果不是您本人操作，请忽略此邮件。</div>
    <div style="text-align:center;">
        <a href="{{$url}}" class="theme-accent-bg" style="display:inline-block; padding:12px 22px; border-radius:12px; color:#ffffff; text-decoration:none; font-size:14px; font-weight:700;">立即前往</a>
    </div>
@endsection
