<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;

use App\Models\BusinessCategory;
use App\Models\Currency;
use App\Models\BusinessOwner;

use Exception;

class BusinessesController extends Controller
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
     * Display a listing of the Businesss.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $businesses = Business::with("businessOwners","currency","businessCategory")->where("status",1)->where("is_deleted",0)->get();

        return view('admin.businesses.businesses.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new Business.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        $business_categories = BusinessCategory::all();
        $currencies = Currency::all();

        return view('admin.businesses.businesses.create',compact("business_categories","currencies"));
    }

    /**
     * Store a new Business in the storage.
     *
     * @param App\Http\Requests\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $certificate = NULL;
            if($request->hasFile('certificate')) {
                $file = $request->file('certificate');
                $certificate = time(). '-' .$file->getClientOriginalName();
                $certificateArray = explode(".",$certificate);

                if (($certificateArray[count($certificateArray) - 1] == "png") || ($certificateArray[count($certificateArray) - 1] == "jpg") | ($certificateArray[count($certificateArray) - 1] == "jpeg") || ($certificateArray[count($certificateArray) - 1] == "pdf") || ($certificateArray[count($certificateArray) - 1] == "docx")) {

                    $destinationPath = 'storage/business/certificates';
                    $file->move($destinationPath,$certificate);

                } else {

                    return back()->withInput()
                        ->withErrors(['unexpected_error' => 'Unsupported file format!']);

                }
            
            }

            $businessId = Business::create([
                'business_category_id' => $request->get("business_category"),
                'business_type' => $request->get("business_type"),
                'name' => $request->get("name"),
                'physical_address' => $request->get("physical_address"),
                'email' => $request->get("email"),
                'phone' => $request->get("phone"),
                'website' => $request->get("website"),
                'currency_id' => $request->get("currency"),
                'certificate' => $certificate,
                'geo_tag' => $request->get("geo_tag")
            ])->id;

            BusinessOwner::create([
                'business_id' => $businessId,
                'user_id' => auth()->user()->id
            ]);
      

            return redirect()->route('admin.businesses.business.index')
                ->with('success_message', 'Business has been added successfully');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified Business.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $business = Business::where("status",1)->where("is_deleted",0)->findOrFail($id);

        return view('admin.businesses.businesses.show', compact('business'));
    }

    /**
     * Show the form for editing the specified Business.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $business = Business::where("status",1)->where("is_deleted",0)->findOrFail($id);
        $business_categories = BusinessCategory::all();
        $currencies = Currency::all();

        return view('admin.businesses.businesses.edit', compact('business',"business_categories","currencies"));
    }

    /**
     * Update the specified Business in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $business = Business::where("status",1)->where("is_deleted",0)->findOrFail($id);
            $business->update([
                'business_category_id' => $request->get("business_category"),
                'business_type' => $request->get("business_type"),
                'name' => $request->get("name"),
                'physical_address' => $request->get("physical_address"),
                'email' => $request->get("email"),
                'phone' => $request->get("phone"),
                'website' => $request->get("website"),
                'currency_id' => $request->get("currency"),
                // 'certificate' => $certificate,
                'geo_tag' => $request->get("geo_tag")
            ]);

            return redirect()->route('admin.businesses.business.index')
                ->with('success_message', 'Business has been updated successfully');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified Business from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $business = Business::where("status",1)->where("is_deleted",0)->findOrFail($id);
            $business->update([
                'is_deleted' => 1
            ]);

            return redirect()->route('admin.businesses.business.index')
                ->with('success_message', 'Business has been deleted successfully');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    public function download_certificate($id){

        try {

            $business = Business::where("status",1)->where("is_deleted",0)->findOrFail($id);
            if ($business) {

                if (file_exists("storage/business/certificates/" . $business->certificate)) {

                    return response()->download("storage/business/certificates/" . $business->certificate);

                } else {

                    return back()
                        ->withErrors(['unexpected_error' => 'File not found.']);

                }
                

            } else {

                return back()
                    ->withErrors(['unexpected_error' => 'Data not found.']);

            }
            

        } catch (\Exception $e) {

            return back()
                ->withErrors(['unexpected_error' => $e->getMessage()]);

        }

    }


}
