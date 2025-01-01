<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminApprovalController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.approval', compact('users'));
    }

    public function update(User $user)
    {
        $user->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'User approved successfully.');
    }

    public function approveUser($userId)
    {
        // Find the user by ID
        $user = User::findOrFail($userId);

        // Update the user status to 'approved'
        $user->status = 'approved';
        $user->save();

        // Redirect back to the approval page with a success message
        return redirect()->route('admin.approval')->with('success', 'User approved successfully!');
    }

    // TS-03: Approval Registrasi oleh Admin
    public function approveRegistration(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);

        $user = User::find($request->user_id);
        $user->status = 'approved';
        $user->email_verified_at = now();
        $user->save();

        return response()->json(['message' => 'User approved successfully'], 200);
    }
}
