<?php

namespace App\Http\Controllers\Admin;

use App\CompanyInfo;
use App\Http\Controllers\Controller;
use App\Member;
use App\SponsorRecruiter;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MembershipController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $members = Member::paginate(10);
        $members = Member::with('company')->get();
        // dd( $members->company->center_name);
        return view('backend.membership.index', ['members' => $members, 'role' => 'admin']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies = CompanyInfo::select('company_name', 'company_phone')->get();
        return view('backend.membership.create', ['role' => 'admin', 'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'userID' => 'unique:members,userID',
            'first_password_login' => 'required',
            'second_password_eWallet' => 'required',
        ]);
        // dd($request);
        $member = new Member();
        $member->userID = $request->userID;
        $member->name = $request->name;
        $member->phone = $request->phone;
        if (empty($request->email)) {
            $request->email = '-';
        }
        $member->email = $request->email;
        $member->rrn = $request->rrn;
        $member->deposit_name = $request->deposit_name;
        $member->deposit_date = $request->deposit_date;
        $member->voucher_no = $request->voucher_no;
        $member->account_owner = $request->account_owner;
        $member->bank_name = $request->bank_name;
        $member->account_number = $request->account_number;
        $member->recruiter_id = $request->recruiter_id;
        $member->recruiter_name = $request->recruiter_name;
        $member->sponsor_id = $request->sponsor_id;
        $member->sponsor_name = $request->sponsor_name;
        $member->password = Hash::make($request->first_password_login);
        $member->second_password_eWallet = Hash::make($request->second_password_eWallet);
        $member->save();

        if ($member) {
            $company = new CompanyInfo();
            $company->center_qualify = $request->center_qualify;
            if ($request->center_qualify == 'yes') {
                $company->company_name = $request->center_name;
            } else {
                $company->company_name = $request->center_name_text;
            }
            $company->company_phone = $request->center_phone;
            $company->member_id = $member->id;
            $company->save();
        } else {

            return redirect()->route('membership.index', ['role' => 'admin', 'error' => 'Member Couldnot be created.']);
        }

        // dd($member);
        return redirect()->route('membership.index', ['role' => 'admin', 'success' => 'Member created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        return view('backend.membership.show', ['member' => $member, 'role' => 'admin']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        $companies = CompanyInfo::where('member_id', $id)->first();
        // dd($companies);
        // $companies = CompanyInfo::select('company_name', 'company_phone')->get();
        return view('backend.membership.edit', ['member' => $member, 'role' => 'admin', 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        // dd($request);
        $member = Member::find($id);
        // $member->userID = $request->userID;
        $member->name = $request->name;
        $member->phone = $request->phone;
        if (empty($request->email)) {
            $request->email = '-';
        }
        $member->email = $request->email;
        $member->rrn = $request->rrn;
        $member->deposit_name = $request->deposit_name;
        $member->deposit_date = $request->deposit_date;
        $member->voucher_no = $request->voucher_no;
        $member->account_owner = $request->account_owner;
        $member->bank_name = $request->bank_name;
        $member->account_number = $request->account_number;
        $member->recruiter_id = $request->recruiter_id;
        $member->recruiter_name = $request->recruiter_name;
        $member->sponsor_id = $request->sponsor_id;
        $member->sponsor_name = $request->sponsor_name;
        $member->save();

        $company = CompanyInfo::where('member_id',$id)->first();
        if (empty($company)) {
            $company = new CompanyInfo();
        }
        // dd($old_company);
        // $company =  new CompanyInfo();
        $company->company_name = $request->center_name;
        $company->company_phone = $request->center_phone;
        $company->center_qualify = $request->center_qualify;
        $company->member_id = $id;
        $company->save();


        return redirect()->route('membership.index')
            ->with('success', 'Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();

        return redirect()->route('membership.index')
            ->with('success', 'Member deleted successfully');
    }

    public function changeInfo()
    {
        $userIds = Member::select('userID', 'id')->get();
        // echo "<pre>";
        // print_r($userIds);
        // die;
        return view('backend.membership.changeInfo', ['role' => 'admin', 'userIds' => $userIds]);
    }
    public function checkRecruiterInfo(Request $request)
    {
        $info = $request->all();
        $member = Member::select('name')->where('userID', $info['id'])->get();
        $checkrepeatation = Member::where('sponsor_id', '=', $info['id'])->get();
        $row_count = $checkrepeatation->count();
        return response()->json(['success' => 'Got the Request', 'data' => $member, 'count' => $row_count]);

        // return response()->json(['success' => 'Got the Request', 'data' => $member]);
    }

    public function checkUserID(Request $request)
    {
        dd($request);
    }


    public function checkPassword(Request $request)
    {
        //"curpwd":"adsf","pwd":"asdf","conpwd":"asdf"
        // $currentpassword = User::find(Auth::id());
        // return strcmp(bcrypt($request->curpwd), $currentpassword->password);
        return Auth::id();
        $user = User::find(Auth::id());
        $user->password = bcrypt($request->pwd);
        $response = $user->save();
        if ($response > 0) {
            return view('cauth.changepassword', ['msg' => 'Password Change Successfully']);
        }
    }

    public function memberChangePassword()
    {
        $userIds = Member::select('userID', 'id')->get();
        return view('backend.membership.changePassword', ['userIds' => $userIds, 'role' => 'admin']);
    }

    public function showSponsors()
    {
        return view('backend.chart', ['role' => 'admin']);
    }
}
