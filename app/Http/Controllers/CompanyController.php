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

class CompanyController extends Controller
{
    
    public function __construct()
    {
        
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        'company_account' => 'required|max:50|unique:company',
        'password' => 'required|confirmed|min:6',
        'company_name' => 'required',
        'email' => 'email|unique:company',
        'company_address' =>'required',
        'postalcode' => 'required|digits:6',
        'business_licence' => 'required|unique:company',
        'organization_code' => 'required|unique:company',
        'company_introduction'=>'required',
        ]);
        $user=Company::create([
            'company_account'=>$request->company_account,
            'password'=>bcrypt($request->password),
            'company_name'=>$request->company_name,
            'email'=>$request->email,
            'company_address'=>$request->company_address,
            'postalcode'=>$request->postalcode,
            'business_licence'=>$request->business_licence,
            'organization_code'=>$request->organization_code,
            'company_introduction'=>$request->company_introduction,
            ]);
        session()->flash('success', '恭喜你,注册成功！请等待系统审核信息，审核通过即可登录！');
        return redirect('/');
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('company.show', compact('company'));
    }

    public function edit($id)
    {
        $company=Company::findOrFail($id);
        return view('company.edit',compact('company'));
    }

    public function update($id,Request $request)
    {
        $this->validate($request, [
        'company_account' => 'required|max:50|unique:company,company_account,'.$id,
        'password' => 'required|confirmed|min:6',
        'company_name' => 'required',
        'email' => 'email|unique:company,email,'.$id,
        'company_address' =>'required',
        'postalcode' => 'required|digits:6',
        'business_licence' => 'required|unique:company,business_licence,'.$id,
        'organization_code' => 'required|unique:company,organization_code,'.$id,
        'company_introduction' => 'required',
        ]);

        $company=Company::findOrFail($id);
        $data=[];
        $data['company_account']=$request->company_account;
        if ($request->password) {
            $data['password']=bcrypt($request->password);
        }
        $data['company_name']=$request->company_name;
        $data['email']=$request->email;
        $data['company_address']=$request->company_address;
        $data['postalcode']=$request->postalcode;
        $data['business_licence']=$request->business_licence;
        $data['organization_code']=$request->organization_code;
        $data['company_introduction']=$request->company_introduction;
        $data['activated']=0;
        $company->update($data);
        session()->flash('success','提交成功！请等待系统审核信息，审核通过即可登录！');
        return redirect('/');
    }

    public function destroy($id)
    {
        $company=Company::findOrFail($id);
        $company->delete();
        $relations=Relation::where('company',$id)->delete();
        $users=User::where('company',$id)->update(['company'=>null]);
        // foreach($users as $user) {
        //     $user->update([
        //         'company' => null,
        //         ]);
        // }
        session()->flash('success','公司已被成功删除('.$company->company_name.')！');
        return redirect()->back();
    }

    public function employee_manage($id,Request $request)
    {
        if($request->keyword==null)
        {
            $employees=User::where('company',$id)->paginate(10);
        }
        else
        {
            switch ($request->type) {
                    case 'gender':
                    $employees=User::where('company',$id)->where('gender','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'mobile':
                    $employees=User::where('company',$id)->where('mobile','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'real_name':
                    $employees=User::where('company',$id)->where('real_name','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'ID_card':
                    $employees=User::where('company',$id)->where('ID_card','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'address':
                    $employees=User::where('company',$id)->where('address','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'model':
                    $employees=User::where('company',$id)->where('model','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                    case 'plate':
                    $employees=User::where('company',$id)->where('plate','like','%'.$request->keyword.'%')->paginate(10);
                        break;
                default:
                    $employees=User::where('company',$id)->where('driver_licence_num','like','%'.$request->keyword.'%')->paginate(10);
                        break;
            }
        }
        return view('company.employee_manage',compact('employees'));
    }

    public function employee_audit_index($id)
    {
        $company=Company::findOrFail($id);
        $employees=$company->find_audit()->paginate(10);
        return view('company.employee_audit',compact('employees'));
    }

    public function employee_audit($id)
    {
        $employee=User::findOrFail($id);
        $company_id=Auth::company()->get()->id;
        $employee->company=$company_id;
        $employee->save();
        $relation=Relation::where('user',$id)->first();
        $relation->state=1;
        $relation->save();
        session()->flash('success','已成功审核员工('.$employee->real_name.')！');
        return redirect()->back();
    }

    public function employee_refuse_audit($id,Request $request)
    {
        $employee=User::findOrFail($id);
        $relation=Relation::where('user',$id)->first();
        $relation->state=2;
        $relation->reason=$request->reason;
        $relation->save();
        session()->flash('success','已拒绝该员工申请('.$employee->real_name.')！');
        return redirect()->back();
    }

    public function employee_delete($id)
    {
        $employee=User::findOrFail($id);
        $employee->company=null;
        $employee->save();
        $relation=Relation::where('user',$id)->first();
        $relation->state=3;
        $relation->save();
        session()->flash('success','已成功删除员工('.$employee->real_name.')！');
        return redirect()->back();
    }

    public function monitor()
    {
        return view('company.monitor');
    }
}
