<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetail;
use Hash;
use Auth;
use Image;


class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function updateAdminPassword(Request $request){
        if($request->isMethod('post')){
        $data = $request->all();
        //check current password
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
        //Check if new password is matching with confirm password
        if($data['confirm_password'] == $data['new_password']) {
        Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' =>bcrypt($data['new_password'])]);
            return redirect()->back()->with('success_message', 'Password Updated Successfully !');
            }else{
            return redirect()->back()->with('error_message', 'New password and Confirm Password does not Matching!');
            }
            }else{
            return redirect()->back()->with('error_message', 'Your Current password is Incorrect!');
            }
        }

        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }

    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
            ];
            $customMessages = [
                'admin_name.required' => 'Name is required',
                'admin_name.regex' => 'Valid Name is required',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric' => ' Valid Mobile is required',
            ];
            $this->validate($request, $rules, $customMessages);

           //Upload Admin Photo

        // Check if the request object has a file called 'admin_image'
        if ($request->hasFile('admin_image')) {

        // Retrieve the file and store it in the $image_tmp variable
        $image_tmp = $request->file('admin_image');

         // Check if the file is valid
        if ($image_tmp->isValid()) {

        // Get the file extension
        $extension = $image_tmp->getClientOriginalExtension();

        // Generate a new name for the image using a random number and the file extension
        $imageName = rand(111, 99999) . '.' . $extension;

        // Create a file path for the image
        $imagePath = 'admin/images/photos/' . $imageName;

       // Use the Image class to create an image object from the file and save it to the specified path
        Image::make($image_tmp)->save($imagePath);
       }
       //Ignore Image when not updating Image
      }else  if(!empty($data['current_admin_image'])){

        $imageName = $data['current_admin_image'];

     }else {

        $imageName = "";


     }
            //Update Admin Details
            Admin::where('id',Auth::guard('admin')->user()->id)->update(['name'=>$data['admin_name'],
             'mobile'=>$data['admin_mobile'], 'email'=>$data['admin_email'], 'image'=>$imageName]);
             return redirect()->back()->with('success_message', 'Admin Details Updated Successfully!');
        }
        return view('admin.settings.update_admin_details');
    }


    public function updateVendorDetails($slug, Request $request){
        if($slug=="personal"){
            if($request->isMethod('post')){
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;

                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'required|numeric',
                ];
                $customMessages = [
                    'vendor_name.required' => 'Name is required',
                    'vendor_city.required' => 'City is required',
                    'vendor_name.regex' => 'Valid Name is required',
                    'vendor_city.regex' => 'Valid City is required',
                    'vendor_mobile.required' => 'Mobile is required',
                    'vendor_mobile.numeric' => ' Valid Mobile is required',

                ];
                $this->validate($request, $rules, $customMessages);

               //Upload Admin Photo

            // Check if the request object has a file called 'admin_image'
            if ($request->hasFile('vendor_image')) {

            // Retrieve the file and store it in the $image_tmp variable
            $image_tmp = $request->file('vendor_image');

             // Check if the file is valid
            if ($image_tmp->isValid()) {

            // Get the file extension
            $extension = $image_tmp->getClientOriginalExtension();

            // Generate a new name for the image using a random number and the file extension
            $imageName = rand(111, 99999) . '.' . $extension;

            // Create a file path for the image
            $imagePath = 'admin/images/photos/' . $imageName;

           // Use the Image class to create an image object from the file and save it to the specified path
            Image::make($image_tmp)->save($imagePath);
           }
           //Ignore Image when not updating Image
          }else  if(!empty($data['current_vendor_image'])){

            $imageName = $data['current_vendor_image'];

         }else {

            $imageName = "";


         }
                //Update Vendors Details in admin table
                Admin::where('id',Auth::guard('admin')->user()->id)->update
                (['name'=>$data['vendor_name'],
                 'mobile'=>$data['vendor_mobile'],
                  'email'=>$data['vendor_email'],
                  'image'=>$imageName]);

                 // Update in Vendors Table
                 Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->update
                 (['name'=>$data['vendor_name'],
                 'mobile'=>$data['vendor_mobile'],
                 'address'=>$data['vendor_address'],
                 'city'=>$data['vendor_city'],
                 'state'=>$data['vendor_state'],
                 'country'=>$data['vendor_country'],
                 'pincode'=>$data['vendor_pincode']]);

                 return redirect()->back()->with('success_message', 'Vendors Details Updated Successfully!');

            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

        }else if($slug=="business"){
            if($request->isMethod('post')){
                $data = $request->all();
                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric',
                    // 'address_proof' => 'required',
                    // 'address_proof_image' => 'required|image',
                    'business_license_number' => 'required'
                ];
                $customMessages = [
                    'shop_name.required' => 'Name is required',
                    'shop_city.required' => 'City is required',
                    'shop_name.regex' => 'Valid Name is required',
                    'shop_city.regex' => 'Valid City is required',
                    'shop_mobile.required' => 'Mobile is required',
                    'shop_mobile.numeric' => ' Valid Mobile is required',
                    // 'address_proof_image.required' => 'Proof of Address Image is required',
                    // 'address_proof_image.image' => 'Valid Proof of Address Image is required',
                ];
                $this->validate($request, $rules, $customMessages);
               //Upload Admin Photo
            // Check if the request object has a file called 'admin_image'
            if($request->hasFile('address_proof_image')){
                // Retrieve the file and store it in the $image_tmp variable
                $image_tmp = $request->file('address_proof_image');
                 // Check if the file is valid
                if($image_tmp->isValid()){
                // Get the file extension
                $extension = $image_tmp->getClientOriginalExtension();
                // Generate a new name for the image using a random number and the file extension
                $imageName = rand(111, 99999).'.'.$extension;
                // Create a file path for the image
                $imagePath = 'admin/images/proofs/' . $imageName;
               // Use the Image class to create an image object from the file and save it to the specified path
                Image::make($image_tmp)->save($imagePath);
               }
               //Ignore Image when not updating Image
              }else  if(!empty($data['current_address_proof'])){
                $imageName = $data['current_address_proof'];
             }else {
                $imageName = "";
             }
              // Update in Vendors Business Detail Table
              VendorsBusinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update
              ([
              'shop_name'=>$data['shop_name'],
              'shop_mobile'=>$data['shop_mobile'],
              'shop_address'=>$data['shop_address'],
              'shop_city'=>$data['shop_city'],
              'shop_state'=>$data['shop_state'],
              'shop_country'=>$data['shop_country'],
              'shop_pincode'=>$data['shop_pincode'],
              'business_license_number'=>$data['business_license_number'],
              'address_proof'=>$data['address_proof'],
              'address_proof_image'=>$imageName]);

              return redirect()->back()->with('success_message', 'Vendors Business  Details Updated Successfully!');
            }
            $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user
            ()->vendor_id)->first()->toArray();

        }else if($slug=="bank"){
        }
        return view('admin.settings.update_vendor_details')->with(compact('slug', 'vendorDetails'));

    }




    public function login(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();

            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password'], 'status'=>1])){
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message', 'Invalide Email or Password');
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }


}
