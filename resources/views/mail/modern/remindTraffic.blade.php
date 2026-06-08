@extends('mail.modern._partials.layout')

@section('title', '流量通知')

@section('content')
    <div style="display:inline-block; margin:0 0 18px; padding:6px 12px; border-radius:999px; background:#ecfdf3; color:#027a48; font-size:12px; font-weight:700; letter-spacing:.08em;">流量提醒</div>
    <div class="headline" style="margin:0 0 16px; font-size:28px; line-height:1.2; font-weight:800; color:#101828;">流量通知</div>
    <div style="font-size:16px; line-height:1.9; color:#475467; margin:0 0 20px;">尊敬的用户您好！</div>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%; margin:0 0 22px; border-collapse:collapse;">
        <tr>
            <td width="100%" style="padding-right:14px;">
                <div style="height:12px; background:#e4e7ec; border-radius:999px; overflow:hidden;">
                    <div class="theme-accent-bg" style="width:95%; height:12px; border-radius:999px;"></div>
                </div>
            </td>
            <td class="theme-accent-text" style="font-size:20px; font-weight:800; white-space:nowrap; vertical-align:middle;">95%</td>
        </tr>
    </table>
    <div style="font-size:15px; line-height:1.9; color:#344054; background:#f9fafb; border:1px solid #e4e7ec; border-radius:18px; padding:18px 20px;">你的流量已经使用95%。为了不造成使用上的影响，请合理安排流量的使用。</div>
    <div style="margin-top:24px; font-size:13px; line-height:1.8; color:#667085;">建议尽快检查当前套餐情况，避免出现服务中断。</div>
@endsection
