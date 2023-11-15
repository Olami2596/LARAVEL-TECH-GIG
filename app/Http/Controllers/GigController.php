<?php

namespace App\Http\Controllers;
use App\Models\Gig;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GigController extends Controller
{
    // show all gigs
    public function index() {
        return view('gigs.index', [
            'heading'  => 'Latest Gigs',
            'gigs'  => Gig::latest()->filter(request(['tag', 'search']))->paginate(10)
        ]);
        //if i dont want the numbers of the paginate to show i can just do simplePaginate instead of just paginate
        //the pagination is also showing because tailwind has been imported to use laravel template run php artisan vendor:publish the go from there
    }

    // show single gig
    public function show(Gig $gig) {
        return view('gigs.show', [
            'gig' => $gig
        ]);
    }

    //show create form
    public function create() {
        return view('gigs.create');
    }

    //show create form
    public function store(Request $request) {
        if (!auth()->check()) {
            return redirect('/login'); // Redirect to the login page or handle authentication as needed
        }
    
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            //, Rule::unique('gigs','company')
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            //run php artisan storage:link to make the picturess in the created folder accessible
        }

        $formFields['user_id'] = auth()->id();

        Gig::create($formFields);
        
        return redirect('/')->with('message', 'Gig created successfully');
    }

    //show edit form
    public function edit(Gig $gig) {
        return view('gigs.edit', ['gig' => $gig]);
    }

    //update listing data
    public function update(Request $request, Gig $gig) {
        //make sure logeend in user is owner
        if($gig->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            //, Rule::unique('gigs','company')
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            //run php artisan storage:link to make the picturess in the created folder accessible
        }

        
        $gig->update($formFields);

        return back()->with('message', 'Gig updated successfully');
        //return to the homepage after updating
        // return redirect('/')->with('message', 'Gig updated successfully');
    }

    //delete gig
    public function destroy(Gig $gig) {
        //make sure logeend in user is owner
        if($gig->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $gig->delete();
        return redirect('/')->with('message', 'Gig Deleted Successfully');
    }

    //manage listing
    public function manage() {
        return view('gigs.manage', ['gigs' => auth()->user()->gigs()->get()]);
    }
}
