<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Company;
use App\Models\Manager;
use App\Models\Relation;
use Auth;

class ManagerController extends Controller
{
    public function __construct()
    {
        
    }

    public function show($id)
    {
        $manager = Manager::findOrFail($id);
        return view('manager.show', compact('manager'));
    }

    public function company_manage_index($id,Request $request)
    {
        // $manager = Manager::findOrFail($id);
        // 
        // 
        if($request->keyword==null)
        {
            $companies = Company::paginate(10);
        }
        else
        {
            switch ($request->type) {
                    case 'company_account':
                    $companies=Company::where('company_account','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'company_name':
                    $companies=Company::where('company_name','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'company_introduction':
                    $companies=Company::where('company_introduction','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'company_address':
                    $companies=Company::where('company_address','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'email':
                    $companies=Company::where('email','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'postalcode':
                    $companies=Company::where('postalcode','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'business_licence':
                    $companies=Company::where('business_licence','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                default:
                    $companies=Company::where('organization_code','like','%'.$request->keyword.'%')->paginate(10);
                        break;
            }
        }
        return view('manager.company_manage_index', compact('manager','companies'));
    }

    public function audit($id)
    {
        $company=Company::findOrFail($id);
        $company->update([
            'activated' => 1,
            ]);
        session()->flash('success','公司信息审核成功('.$company->company_name.')！');
        return redirect()->back();
    }

    public function refuse_audit($id)
    {
        $company=Company::findOrFail($id);
        $company->update([
            'activated' => 2,
            ]);
        session()->flash('success','已驳回公司信息('.$company->company_name.')！');
        return redirect()->back();
    }

    public function users_manage($id,Request $request)
    {
        if($request->keyword==null)
        {
            $users=User::paginate(10);
        }
        else
        {
            switch ($request->type) {
                    case 'username':
                        $users=User::where('username','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'gender':
                    $users=User::where('gender','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'mobile':
                    $users=User::where('mobile','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'real_name':
                    $users=User::where('real_name','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'ID_card':
                    $users=User::where('ID_card','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'address':
                    $users=User::where('address','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'model':
                    $users=User::where('model','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'plate':
                    $users=User::where('plate','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'driver_licence_num':
                    $users=User::where('driver_licence_num','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                default:
                    $company_ids=Company::where('company_name','like','%'.$request->keyword.'%')->get()->pluck('id')->toArray();;
                    $users=User::whereIn('company',$company_ids)->paginate(10);
                    break;
            }
        }
        return view('manager.users_manage', compact('users'));
    }

    public function forms_manage($id)
    {
        return view('manager.forms_manage');
    }
}
