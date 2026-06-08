<?php

use App\Services\ThemeService;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    if (config('v2board.app_url') && config('v2board.safe_mode_enable', 0)) {
        if ($request->server('HTTP_HOST') !== parse_url(config('v2board.app_url'))['host']) {
            abort(403);
        }
    }
    $renderParams = [
        'title' => config('v2board.app_name', 'V2Board'),
        'theme' => config('v2board.frontend_theme', 'default'),
        'version' => config('app.version'),
        'description' => config('v2board.app_description', 'V2Board is best'),
        'logo' => config('v2board.logo')
    ];

    if (!config("theme.{$renderParams['theme']}")) {
        $themeService = new ThemeService($renderParams['theme']);
        $themeService->init();
    }

    $renderParams['theme_config'] = config('theme.' . config('v2board.frontend_theme', 'default'));
    return view('theme::' . config('v2board.frontend_theme', 'default') . '.dashboard', $renderParams);
});

//TODO:: 兼容
Route::get('/' . config('v2board.secure_path', config('v2board.frontend_admin_path', hash('crc32b', config('app.key')))), function () {
    return view('admin', [
        'title' => config('v2board.app_name', 'V2Board'),
        'theme_sidebar' => config('v2board.frontend_theme_sidebar', 'light'),
        'theme_header' => config('v2board.frontend_theme_header', 'dark'),
        'theme_color' => config('v2board.frontend_theme_color', 'default'),
        'background_url' => config('v2board.frontend_background_url'),
        'version' => config('app.version'),
        'logo' => config('v2board.logo'),
        'secure_path' => config('v2board.secure_path', config('v2board.frontend_admin_path', hash('crc32b', config('app.key'))))
    ]);
});

Route::get('/mail-preview/modern/{template}', function ($template) {
    $views = [
        'verify' => [
            'name' => config('v2board.app_name', 'V2Board'),
            'url' => config('v2board.app_url'),
            'code' => '483921',
        ],
        'notify' => [
            'name' => config('v2board.app_name', 'V2Board'),
            'url' => config('v2board.app_url'),
            'content' => "这是一封 modern 模板预览邮件。\n你可以用它确认配色、间距和信息层级是否符合预期。",
        ],
        'remindTraffic' => [
            'name' => config('v2board.app_name', 'V2Board'),
            'url' => config('v2board.app_url'),
        ],
        'remindExpire' => [
            'name' => config('v2board.app_name', 'V2Board'),
            'url' => config('v2board.app_url'),
        ],
        'mailLogin' => [
            'name' => config('v2board.app_name', 'V2Board'),
            'url' => config('v2board.app_url'),
            'link' => rtrim(config('v2board.app_url'), '/') . '/#/login?preview=1',
        ],
    ];

    abort_unless(isset($views[$template]), 404);

    return view('mail.modern.' . $template, $views[$template]);
});

if (!empty(config('v2board.subscribe_path'))) {
    Route::get(rtrim(config('v2board.subscribe_path'), '/') . '/raw/{token}', 'V1\\Client\\ClientController@rawSubscribe')->middleware('client');
    Route::get(rtrim(config('v2board.subscribe_path'), '/') . '/{token}', 'V1\\Client\\ClientController@subscribe')->middleware('client');
}
