<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return View|RedirectResponse
     */
    public function registration(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('auth.registration');
        }
        return redirect("login")->withErrors('Kamu tidak memiliki akses registration page.');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('dashboardanak')
                            ->withSuccess('Kamu berhasil login sebagai Admin');
            } else {
                return redirect()->intended('dashboard')
                            ->withSuccess('Kamu berhasil login');
            }
        }

        return redirect("login")->withErrors('Email/Password salah, coba lagi');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request): RedirectResponse
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        $currentUser = Auth::user();
       
        $data = $request->all();
        $user = $this->create($data);
        
        Auth::login($currentUser);

        return redirect("success")->withSuccess('Berhasil membuat akun baru');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard(): View|RedirectResponse
    {
        if(Auth::check()){
            return view('dashboard.dashboard');
        }
  
        return redirect("login")->withErrors('Oops! You do not have access to the dashboard');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => $data['role']
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
    
    /**
     * Write code on Method
     *
     * @return View|RedirectResponse
     */
    public function dashboardAdmin(): View|RedirectResponse
    {
        if(Auth::check() && Auth::user()->role == 'admin'){
            return view('dashboard.dashboardadmin');
        }

        return redirect("login")->withErrors('Kamu tidak memiliki akses dashboard admin.');
    }
    
    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'role' => 'required|in:admin,user'
    ]);

    try {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user
        $user->update([
            'name' => $validatedData['name'],
            'role' => $validatedData['role']
        ]);

        // Redirect back with success message
        return redirect()->view('success.success')->with('success', 'User updated successfully');
    } catch (\Exception $e) {
        // Log the error
        \Log::error('User update error: ' . $e->getMessage());

        // Redirect back with error message
        return redirect()->back()->with('error', 'Failed to update user');
    }
}


    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($userId)
{
    try {
        $user = User::findOrFail($userId);
        $user->delete();
        
        return response()->json([
            'message' => 'User successfully deleted',
            'status' => 'success'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to delete user',
            'status' => 'error'
        ], 500);
    }
}

    
    public function show($id)
    {
        $user = User::with('children')->findOrFail($id);
        return view('detailuser', compact('user'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'LIKE', "%{$search}%")->get();
        return view('dashboard.dashboardadmin', compact('users'));
    }
}