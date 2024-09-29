<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // This method will show our home page
    public function index() {
        // Fetch the first 8 categories
        $categories = Category::where('status', 1)
            ->orderBy('name', 'ASC')
            ->take(8)
            ->get();

        // Fetch all categories
        $newCategories = Category::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();

        // Fetch 6 featured jobs
        $featuredJobs = Job::where('status', 1)
            ->with('jobType')
            ->where('isFeatured', 1)
            ->orderBy('created_at', 'DESC')
            ->take(6)
            ->get();

        // Fetch 6 latest jobs
        $latestJobs = Job::where('status', 1)
            ->with('jobType')
            ->orderBy('created_at', 'DESC')
            ->take(6)
            ->get();

        return view('front.home', [
            'categories' => $categories,
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs,
            'newCategories' => $newCategories
        ]);
    }
}
