<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
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
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' =>
                    bcrypt($data['new_password'])]);
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
