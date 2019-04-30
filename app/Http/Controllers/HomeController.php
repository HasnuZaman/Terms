<?php

namespace App\Http\Controllers;

use DB;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Session::put('SESS_USER_TYPE', auth()->user()->user_type); //to put the session value
        Session::put('SESS_USER_ID', auth()->user()->id);          //to put the session value
        $this->pendingTerms();

        if (Session::get('SESS_PENDING_TERMS') == "TRUE")
        {
            return redirect('/pending-agreements');

        }

        return view('home');
    }

    public function pendingTerms()
    {

        if (Session::get('SESS_USER_TYPE') == "agent")
        {

            $sqlQuery = "SELECT term_id,term_title,term_condition,created_at,'not_active' as term_status FROM terms WHERE term_id NOT IN (SELECT term_id FROM approved_terms where user_id=" . Session::get('SESS_USER_ID') . ")";

            $terms = DB::select(DB::raw($sqlQuery));

            if (!empty($terms))
            {
                Session::put('SESS_PENDING_TERMS', 'TRUE'); //to put the session value

            }
            else
            {
                Session::put('SESS_PENDING_TERMS', 'FALSE'); //to put the session value

            }

        }

    }

}
