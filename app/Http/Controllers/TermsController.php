<?php

namespace App\Http\Controllers;

use App\ApprovedTerms;
use App\Terms;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class TermsController extends Controller
{
    public function __construct()
    {

    }

//
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Session::get('SESS_USER_TYPE') != 'admin')
        {
            return redirect()->route('dashboard');

        }

        $terms = Terms::orderBy('created_at', 'DESC')->paginate(10);

        return view('terms.index')->with('terms', $terms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Session::get('SESS_USER_TYPE') != "admin")
        {
            return redirect('/terms')->with('danger', 'Unauthorized Entry !!!');
        }

        return view('terms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Session::get('SESS_USER_TYPE') != "admin")
        {
            return redirect('/terms')->with('danger', 'Unauthorized Entry !!!');
        }

        $this->validate($request, [
            'termTitle'     => 'required',
            'termCondition' => 'required'
        ]);

        //Create Term
        $terms                 = new Terms;
        $terms->term_title     = $request->input('termTitle');
        $terms->term_condition = $request->input('termCondition');
        $terms->user_id        = auth()->user()->id;
        $terms->save();

        return redirect('/terms')->with('success', 'Term Created!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($term_id)
    {

        if (Session::get('SESS_USER_ID') == "")
        {

            return redirect('/')->with('danger', 'Unauthorized Entry !!!');
        }

        $term = Terms::find($term_id);
        return view('terms.show')->with('term', $term);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($term_id)
    {

        if (Session::get('SESS_USER_TYPE') != "admin")
        {
            return redirect('/terms')->with('danger', 'Unauthorized Entry !!!');
        }

        //
        $term = Terms::find($term_id);
        return view('terms.edit')->with('term', $term);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $term_id)
    {

        if (Session::get('SESS_USER_TYPE') != "admin")
        {
            return redirect('/terms')->with('danger', 'Unauthorized Entry !!!');
        }

        //
        $this->validate($request, [
            'termTitle'     => 'required',
            'termCondition' => 'required'
        ]);

//Create Term
        $terms                 = Terms::find($term_id);
        $terms->term_title     = $request->input('termTitle');
        $terms->term_condition = $request->input('termCondition');

        $terms->save();

        return redirect('/terms')->with('success', 'Term Updated!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($term_id)
    {

        if (Session::get('SESS_USER_TYPE') != "admin")
        {
            return redirect('/terms')->with('danger', 'Unauthorized Entry !!!');
        }

        //
        $terms = Terms::find($term_id);
        $terms->delete();

        return redirect('/terms')->with('success', 'Term Deleted!!');

    }

    public function approve($term_id)
    {

        if (Session::get('SESS_USER_TYPE') != "agent")
        {
            return redirect('/terms')->with('danger', 'Unauthorized Entry !!!');
        }

        //Create Term
        $approvedTerms          = new ApprovedTerms;
        $approvedTerms->user_id = Session::get('SESS_USER_ID');
        $approvedTerms->term_id = $term_id;

        $approvedTerms->save();

        return redirect('/')->with('success', 'Term Accepted!!');
    }

    public function pendingList()
    {

        if (Session::get('SESS_USER_TYPE') == "agent")
        {

            $sqlQuery = "SELECT term_id,term_title,term_condition,created_at,'not_active' as term_status FROM terms WHERE term_id NOT IN (SELECT term_id FROM approved_terms where user_id=" . Session::get('SESS_USER_ID') . ")";

            $terms = DB::select(DB::raw($sqlQuery));

            if (!empty($terms))
            {

                return view('terms.index')->with('terms', $terms);

            }

            Session::put('SESS_PENDING_TERMS', 'FALSE'); //to put the session value

        }

        return redirect()->route('dashboard');

    }

}
