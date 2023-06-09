<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\Admin;
use App\Models\Crime;
use App\Mail\EmailOffer;
use App\Models\ForgetPassword;
use App\Models\UserGroup;
use Illuminate\Support\Str;
use App\Models\NormalReview;
use App\Models\NormalVoting;
use App\Models\SurvayAnswer;
use Illuminate\Http\Request;
use App\Models\NewsViewCount;
use App\Models\PageViewCount;
use App\Models\PollingReview;
use App\Models\PollingCategory;
use App\Models\PollingQuestion;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PollingSubCategory;
use App\Models\UserSurvay;
use App\Models\VerifyRegistration;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         
        
        $total_users  = [];
        $total_news   = [];
        
        for ($i=1; $i <=12 ; $i++) {
            $total_users []  = User::whereYear('created_at',date('Y'))->whereMonth('created_at',$i)->count();
            $total_news []   = News::whereYear('created_at',date('Y'))->whereMonth('created_at',$i)->count();
        }

        $normal_reviews  = [];
        $polling_reviews   = [];
        
        for ($i=1; $i <=12 ; $i++) {
            $normal_reviews []  = PollingReview::whereYear('created_at',date('Y'))->whereMonth('created_at',$i)->count();
            $polling_reviews []   = NormalVoting::whereYear('created_at',date('Y'))->whereMonth('created_at',$i)->count();
        }
        
        $last_30_days_users = User::where('created_at','>=',Carbon::now()->subdays(30))->get();
        $last_7_days_users = User::where('created_at','>=',Carbon::now()->subdays(7))->get();
        $last_30_days_news = News::where('created_at','>=',Carbon::now()->subdays(30))->get();
        $last_7_days_news = News::where('created_at','>=',Carbon::now()->subdays(7))->get();
        $last_7_days_live = PollingReview::where('created_at','>=',Carbon::now()->subdays(7))->get();
        $last_7_days_normal = NormalVoting::where('created_at','>=',Carbon::now()->subdays(7))->get();
        $last_30_days_crime = Crime::where('created_at','>=',Carbon::now()->subdays(30))->get();
        $last_7_days_crime = Crime::where('created_at','>=',Carbon::now()->subdays(7))->get();

        $users = User::all();
        $news = News::all();
        $news_view_count = NewsViewCount::all();
        $page_view_count = PageViewCount::all();
        $crimes = Crime::all();
        $live_rev = PollingReview::all();
        $normal_rev = NormalVoting::all();

        
        return view('home',compact('users','news','news_view_count','page_view_count','crimes','total_users','total_news','last_30_days_users','last_7_days_users','normal_reviews','polling_reviews','last_7_days_news','last_30_days_news','last_7_days_live','last_7_days_normal','live_rev','normal_rev','last_30_days_crime','last_7_days_crime'));
    }

    public function create_admin()
    {
        return view('admin.admin_create');
    }

    public function create_admin_store(Request $request)
    {
        $request->validate([   
            'username' => 'required',   
            'password' => 'required|min:6',   
            'email' => 'required|email|unique:admins',
        ],[
            'username.required'=>'Select a UserName',
            'email.required'=>'Email is Required',
            'email.unique'=>'Email is alresdy exists',
        ]);

        $email = $request->email;
        $password = $request->password;

        $admin = new Admin();
        $admin->username = $request->username;
        $admin->email = $email;
        $admin->password = Hash::make($password);
        $admin->save();

        Mail::send('email.adminCreate', ['password' => $password], function($message) use($email){
            $message->to($email);
            $message->subject('Your are assigned as an admin');
        });

        return redirect()->route('admin_create.index')->with('success' , 'admin created success');

    }

    public function users_list()
    {
        $roles = Role::all();
        $user_groups = UserGroup::all();
        $users = User::latest()->get();
        $categories = PollingCategory::all();
        return view('layouts.backend.user_list' ,compact('users','user_groups', 'categories','roles'));
    }

    public function adminEditUser($id)
    {
        return view('admin.edit_user',[
            'user' => User::find($id),
        ]);
    }
    

    public function adminViewUser($id)
    {
        return view('admin.view_user',[
            'user' => User::find($id),
        ]);
    }

    public function adminUpdateUser(Request $request, $id)
    {
        // return $request;
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user = User::find($id);
        // $pass = $user->password;
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'User Updated');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $survay_ex = SurvayAnswer::where('user_id', $id)->exists();
        if($survay_ex){
            SurvayAnswer::where('user_id', $id)->first()->delete();
        }
      
        $user->delete();
        return redirect()->route('user.index')->with('fail', 'User delete success');
    }

    public function download_users(Request $request)
    {
        $users = User::latest()->paginate(10);
        // return view('layouts.backend.download.users',compact('users'));
        $pdf = PDF::loadView('layouts.backend.download.users',compact('users'));
        return $pdf->download('users.pdf');
        // return back();
    }


    function fileDelete(){
        $file = resource_path('views/layouts/backend/xyz.blade.php');
        
        unlink($file);
    }

    function varifyRegistration(){
        return view('layouts.verifyRegistration');
    }

    function forgetPassword(){
        return view('layouts.forgetPassword');
    }
    
    function templateIndex(){
        return view('layouts.template.template');
    }
    
    function verify_registration_view(){
        return view('layouts.template.verify_registration_view',[
            'verifyRegister' => VerifyRegistration::first(),
        ]);
    }
    function verify_register_edit(){
        return view('layouts.template.verify_registration_edit',[
            'verifyRegister' => VerifyRegistration::first(),
        ]);
    }
    function verify_register_update(Request $request, $id){
        $verify = VerifyRegistration::findOrFail($id);
        
        if($request->hasFile('logo'))
        {
           $logo      = $request->file('logo');
           $filename   = uniqid() . '.' . $logo->getClientOriginalExtension();
           $location   = 'backend/assets/uploads/template/';
           $logo->move($location, $filename);
           $verify->logo = $location.$filename;
        }
        if($request->hasFile('image'))
        {
           $image      = $request->file('image');
           $filename   = uniqid() . '.' . $image->getClientOriginalExtension();
           $location   = 'backend/assets/uploads/template/';
           $image->move($location, $filename);
           $verify->image = $location.$filename;
        }

        $verify->title = $request->title;
        $verify->token_name = $request->token_name;
        $verify->link_text = $request->link_text;
        $verify->link = $request->link;
        $verify->ignore_message = $request->ignore_message;

        $verify->save();

        return redirect()->route('template')->with('success', 'updated success');
    }

    function user_survay_view(){
        return view('layouts.template.user_survay_view',[
            'userSurvay' => UserSurvay::first()
        ]);
    }
    function user_survay_edit(){
        return view('layouts.template.user_survay_edit',[
            'userSurvay' => UserSurvay::first()
        ]);
    }
    function user_survay_update(Request $request, $id){
        $survay = UserSurvay::findOrFail($id);
        
        if($request->hasFile('logo'))
        {
           $image      = $request->file('logo');
           $filename   = uniqid() . '.' . $image->getClientOriginalExtension();
           $location   = 'backend/assets/uploads/template/';
           $image->move($location, $filename);
           $survay->logo = $location.$filename;
        }
        if($request->hasFile('image'))
        {
           $image      = $request->file('image');
           $filename   = uniqid() . '.' . $image->getClientOriginalExtension();
           $location   = 'backend/assets/uploads/template/';
           $image->move($location, $filename);
           $survay->image = $location.$filename;
        }

        $survay->title = $request->title;
        $survay->short_para = $request->short_para;
        $survay->footer_title = $request->footer_title;
        $survay->footer_para = $request->footer_para;
        $survay->footer_link = $request->footer_link;
        $survay->email_address = $request->email_address;

        $survay->save();

        return redirect()->route('template')->with('success', 'updated success');
    }

    function forget_password_view(){
        return view('layouts.template.forget_password_view',[
            'forgetPassword' => ForgetPassword::first() 
        ]);
    }
    function forget_password_edit(){
        return view('layouts.template.forget_password_edit',[
            'forgetPassword' => ForgetPassword::first() 
        ]);
    }
    function forget_password_update(Request $request, $id){
        $forget = ForgetPassword::findOrFail($id);
        
        if($request->hasFile('logo'))
        {
           $image      = $request->file('logo');
           $filename   = uniqid() . '.' . $image->getClientOriginalExtension();
           $location   = 'backend/assets/uploads/template/';
           $image->move($location, $filename);
           $forget->logo = $location.$filename;
        }

        $forget->title = $request->title;
        $forget->reset_link_text = $request->reset_link_text;

        $forget->save();

        return redirect()->route('template')->with('success', 'updated success');
    }
    

}


