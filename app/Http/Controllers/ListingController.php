<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings by tag and search
    //* We need to override from the Model the method scopeFilter
    public function index(Request $request)
    {
        // get latest registers
        // Filter by
        // from the request-> get the query param called tag or search
        return view('listings.index', [
            'listings' => Listing::latest()
                         ->filter(
                            ['tag' =>$request->tag, 
                             'search' => $request->search
                            ])->paginate(6) //?page=2,?page=3 etc..for more items
        ]);
    }
    /* 
    * @param() Listing $listing 
    * it comes from Route-Model-Binding
    */
    public function show(Listing $listing)
    {
        return view('listings.show', ['listing' => $listing]);
    }
    // Show form
    public function create()
    {
        return view('listings.create');
    }

    //Store Listing Data
    public function store(Request $request)
    {
    // get file from the request by default it saves the image on storage/app
    //* We need to change config/filesystems -> default -> local to public
    // dd($request->file('logo')->store());
        $formFields = $request->validate([
            'title' => 'required|min:2',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location'=> 'required',
            'website'=> 'required',
            'email'=> ['required', 'email'],
            'tags'=> 'required',
            'description'=> 'required'
        ]);
        //* Get the Image 
        if($request->hasFile('logo')){
            // Save on the array the path
            // then store at the same time the image in storage/app/public/logos
            // check config/fylesystem
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        Listing::create($formFields);

        // Session::flash('message','Listing created'); 1. or directly with 'with method'

        return redirect('/')->with('message', 'Listing created successfully!');
    }


    public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request,Listing $listing){
        $formFields = $request->validate([
            'title' => 'required|min:2',
            'company' => ['required'],
            'location'=> 'required',
            'website'=> 'required',
            'email'=> ['required', 'email'],
            'tags'=> 'required',
            'description'=> 'required'
        ]);

        //* Get the Image 
        if($request->hasFile('logo')){
            // Save on the array the path
            // then store at the same time the image in storage/app/public/logos
            // check config/fylesystem
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $listing->update($formFields); //* Update

        // Session::flash('message','Listing created'); 1. or directly with 'with method'

        return back()->with('message', 'Listing updated successfully!');
    }

    public function destroy(Listing $listing){
        $listing->delete();
        return to_route('listings.index')->with('message', 'Listing deleted successfully');
    }


}
