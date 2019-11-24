<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Admin\BaseController;
use App\Rules\CurrentPasswordMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends BaseController
{
    /**
     * Main method for showing view
     * @url GET /admin/profile
     */
    public function index()
	{
		$user = Auth::guard('admins')->user();

		return View('admin.profile')
			->with('activeTab', Session::get('activeTab') ?: 'info')
			->with('user', $user);
    }

    /**
     * Method for updating admin details
     * @url POST /admin/profile/update
     * @return Redirect
     */
    public function update(Request $request)
	{

        // Getting connected admin
        $admin = Auth::guard('admins')->user();

        // Validations

        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
        ]);



        // Updating admin details
       $update = $admin->update($validatedData);


        if($update) {
            return 'Profile Updated Successfully';

        } else {
            toastr([
                'type' => 'error',
                'message' => 'admin not saved'
            ]);
            return back();
        }


    }

    /**
     * Method for updating admin password
     * @url POST /admin/profile/change-password
     * @return Redirect
     */
    public function changePassword(Request $request)
	{

	    // Getting connected admin
        $admin = Auth::guard('admins')->user();

        $validatedData = $request->validate([
            'current_password' => ['required', new CurrentPasswordMatch()],
            'new_password'     => 'required|min:6|confirmed',
        ]);


        // Updating admin password
       $reset = $admin->update([ 'password' => bcrypt($validatedData['new_password']) ]);

       if($reset) {
           return 'Password Reset Successfully';
       } else {
           toastr([
               'type' => 'error',
               'message' => 'admin not saved'
           ]);
           return back();
       }
    }
    public function reset()
    {
        $data = [];

        Mail::send('emails.resetPassword', $data, function ($message){

            $message->to('dummy@gmail.com')
                ->subject('Reset your password');
        });
    }
}
