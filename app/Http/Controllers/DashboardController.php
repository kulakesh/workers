<?php

namespace App\Http\Controllers;

use App\Models\Accountant;
use App\Models\District;
use App\Models\Operator;
use App\Models\Registration;
use App\Models\Renewals;
use App\Models\User;
use App\SMS;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller{

    public function adminDashboard(){
        $entries = Registration::whereDel(0)->count();
        return view('admin.dashboard', compact('entries'));
    }
    public function districtDashboard(){
        $entries = Registration::whereIn('operator_id', function ($query) {
            $query->select('id')
            ->from('operators')
            ->where('district_id', auth()->user()->id);
        })
        ->whereDel(0)
        ->count();

        $approvals = Registration::whereIn('operator_id', function ($query) {
            $query->select('id')
            ->from('operators')
            ->where('district_id', auth()->user()->id);
        })
        ->where('approval', 0)
        ->whereDel(0)
        ->count();
        return view('district.dashboard', compact('entries', 'approvals'));
    }
    public function operatorDashboard(){
        $entries = Registration::where('operator_id', auth()->user()->id)
        ->whereDel(0)
        ->count();
        return view('operator.dashboard', compact('entries'));
    }
    public function accountantDashboard(){
        $entries = Renewals::whereDel(0)->whereApproval(0)->count();
        return view('accountant.dashboard', compact('entries'));
    }
    public function acChangePasswordIndex(){
        return view('accountant.password');
    }
    public function acChangePasswordCreate(Request $request){
        $request->validate([
			'current_password' => ['required', function ($attribute, $value, $fail) {
				if (!Hash::check($value,auth()->user()->password)) {
					return $fail(__('The current password is incorrect.'));
				}
			}],
			'password' => ['required','confirmed', Password::min(6)]
		]);

		$record = Accountant::where('id',auth()->user()->id)->first();

		$record->update([
			'password' => Hash::make($request->password)
		]);

		return redirect(route('accountant.ChangePasswordIndex'))->with('success', 'Password Changed Successfully');
    }
    public function opChangePasswordIndex(){
        return view('operator.password');
    }
    public function opChangePasswordCreate(Request $request){
        $request->validate([
			'current_password' => ['required', function ($attribute, $value, $fail) {
				if (!Hash::check($value,auth()->user()->password)) {
					return $fail(__('The current password is incorrect.'));
				}
			}],
			'password' => ['required','confirmed', Password::min(6)]
		]);

		$record = Operator::where('id',auth()->user()->id)->first();

		$record->update([
			'password' => Hash::make($request->password)
		]);

		return redirect(route('operator.ChangePasswordIndex'))->with('success', 'Password Changed Successfully');
    }
    public function dtChangePasswordIndex(){
        return view('district.password');
    }
    public function dtChangePasswordCreate(Request $request){
        $request->validate([
			'current_password' => ['required', function ($attribute, $value, $fail) {
				if (!Hash::check($value,auth()->user()->password)) {
					return $fail(__('The current password is incorrect.'));
				}
			}],
			'password' => ['required','confirmed', Password::min(6)]
		]);

		$record = District::where('id',auth()->user()->id)->first();

		$record->update([
			'password' => Hash::make($request->password)
		]);

		return redirect(route('district.ChangePasswordIndex'))->with('success', 'Password Changed Successfully');
    }
    public function adminChangePasswordIndex(){
        return view('admin.password');
    }
    public function adminChangePasswordCreate(Request $request){
        $request->validate([
			'current_password' => ['required', function ($attribute, $value, $fail) {
				if (!Hash::check($value,auth()->user()->password)) {
					return $fail(__('The current password is incorrect.'));
				}
			}],
			'password' => ['required','confirmed', Password::min(6)]
		]);

		$record = User::where('id',auth()->user()->id)->first();

		$record->update([
			'password' => Hash::make($request->password)
		]);

		return redirect(route('admin.ChangePasswordIndex'))->with('success', 'Password Changed Successfully');
    }


}