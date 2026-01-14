<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderFooter;
use Illuminate\Http\Request;

class HeaderFooterController extends Controller
{
    public function index()
    {
        $settings = HeaderFooter::first();
        if (!$settings) {
            $settings = HeaderFooter::create([]);
        }
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = HeaderFooter::first();
        if (!$settings) {
            $settings = HeaderFooter::create([]);
        }

        $validated = $request->validate([
            'header_title' => 'nullable|string',
            'footer_content' => 'nullable|string',
            'footer_title' => 'nullable|string',
            'footer_contact_title' => 'nullable|string',
            'facebook_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'mobile_no' => 'nullable|string',
            'home_meta_title' => 'nullable|string',
            'home_meta_keywords' => 'nullable|string',
            'home_meta_description' => 'nullable|string',
        ]);

        $settings->update($validated);
        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully');
    }
}
