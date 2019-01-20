<?php
/**
 * controls the behaviour of the home page
 *
 * @copyright Md Fahim Uddin <visionq9@gmail.com>
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * display the welcome message
     *
     * @return View
     */
    public function sayWelcome(): View
    {
        return view('index.welcome', ['message' => 'Welcome to VD note management solution']);
    }
}