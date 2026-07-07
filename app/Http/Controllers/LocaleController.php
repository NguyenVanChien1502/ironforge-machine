<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request, string $locale): RedirectResponse
    {
        abort_unless(in_array($locale, ['vi', 'en'], true), 404);

        $request->session()->put('locale', $locale);

        $response = redirect()->back();

        if ($locale === 'en') {
            return $response->withCookie(cookie('googtrans', '/vi/en', 60 * 24 * 365, null, null, false, false));
        }

        return $response->withCookie(cookie()->forget('googtrans'));
    }
}
