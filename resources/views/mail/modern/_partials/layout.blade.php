@php
    $themeColorKey = config('v2board.frontend_theme_color', 'default');
    $themeColorKey = in_array($themeColorKey, ['darkblue', 'black', 'default', 'green']) ? $themeColorKey : 'default';
@endphp
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('v2board.app_name', 'V2Board'))</title>
    <style type="text/css">
        html, body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            height: 100% !important;
            background: #eef2f7;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            font-family: 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .theme-default .theme-accent-bg { background-color: #0665d0 !important; }
        .theme-default .theme-accent-text { color: #0665d0 !important; }
        .theme-default .theme-accent-border { border-color: #0665d0 !important; }

        .theme-darkblue .theme-accent-bg { background-color: #3b5998 !important; }
        .theme-darkblue .theme-accent-text { color: #3b5998 !important; }
        .theme-darkblue .theme-accent-border { border-color: #3b5998 !important; }

        .theme-black .theme-accent-bg { background-color: #343a40 !important; }
        .theme-black .theme-accent-text { color: #343a40 !important; }
        .theme-black .theme-accent-border { border-color: #343a40 !important; }

        .theme-green .theme-accent-bg { background-color: #319795 !important; }
        .theme-green .theme-accent-text { color: #319795 !important; }
        .theme-green .theme-accent-border { border-color: #319795 !important; }

        @media only screen and (max-width: 640px) {
            .wrap {
                padding: 18px 12px !important;
            }

            .card {
                width: 100% !important;
            }

            .header {
                padding: 22px 22px 18px !important;
            }

            .content {
                padding: 28px 22px !important;
            }

            .footer {
                padding: 18px 22px 22px !important;
            }

            .headline {
                font-size: 24px !important;
            }
        }
    </style>
</head>
<body class="theme-{{$themeColorKey}}" bgcolor="#eef2f7" style="margin:0; padding:0; background:#eef2f7;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#eef2f7" style="width:100%; background:#eef2f7; border-collapse:collapse;">
        <tr>
            <td align="center" class="wrap" style="padding: 32px 16px;">
                <table role="presentation" class="card" width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="width:600px; max-width:600px; background:#ffffff; border-collapse:separate; border-spacing:0; border:1px solid #e7ecf3; border-radius:24px; overflow:hidden; box-shadow:0 18px 40px rgba(15, 23, 42, 0.08);">
                    <tr>
                        <td class="header theme-accent-bg" style="padding: 28px 32px 24px; color:#ffffff;">
                            <div style="font-size:12px; line-height:1; letter-spacing: .24em; text-transform: uppercase; opacity: .82;">Mail Center</div>
                            <div style="margin-top:10px; font-size:28px; line-height:1.2; font-weight:800; letter-spacing:-0.02em;">{{ config('v2board.app_name', 'V2Board') }}</div>
                            <div style="margin-top:8px; font-size:14px; line-height:1.6; opacity:.92;">{{$name}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="content" style="padding: 34px 32px 30px; color:#101828; background:#ffffff;">
                            @yield('content')
                        </td>
                    </tr>
                    <tr>
                        <td class="footer" style="padding: 0 32px 28px; background:#ffffff;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%; border-top:1px solid #eef2f7;">
                                <tr>
                                    <td style="padding-top:18px; font-size:12px; line-height:1.8; color:#98a2b3;">
                                        <div>本邮件由系统自动发送，请勿直接回复。</div>
                                        <div><a href="{{$url}}" class="theme-accent-text" style="text-decoration:none;">返回{{$name}}</a></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
