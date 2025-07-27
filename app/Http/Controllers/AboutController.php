<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about us page.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get the locale from the query parameter or use the default
        $locale = $request->query('locale', app()->getLocale());
        
        if ($locale && in_array($locale, ['en', 'th', 'zh'], true)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
        }
        // In a real application, this data might come from a database
        $aboutData = [
            'title' => __('frontend.about_title'),
            'description' => __('frontend.about_description'),
            'history' => __('frontend.about_history'),
            'mission' => __('frontend.about_mission'),
            'team' => [
                [
                    'name' => __('frontend.team_member_1_name'),
                    'position' => __('frontend.team_member_1_position'),
                    'bio' => __('frontend.team_member_1_bio'),
                ],
                [
                    'name' => __('frontend.team_member_2_name'),
                    'position' => __('frontend.team_member_2_position'),
                    'bio' => __('frontend.team_member_2_bio'),
                ],
                [
                    'name' => __('frontend.team_member_3_name'),
                    'position' => __('frontend.team_member_3_position'),
                    'bio' => __('frontend.team_member_3_bio'),
                ],
            ],
        ];
        
        return view('about', compact('aboutData'));
    }
}
