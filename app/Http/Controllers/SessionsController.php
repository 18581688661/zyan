<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>['create','mana_create','company_create']]);
    }
    
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
    		'username'=>'required|max:25',
    		'password'=>'required|min:6'
    		]);
    	$credentials=['username'=>$request->username,'password'=>$request->password,];
    	if(Auth::user()->attempt($credentials,$request->has('remember')))
    	{
            session()->flash('success','欢迎回来！');
            return redirect()->intended(route('users.show',[Auth::user()->get()]));
    	}
    	else
    	{
    		session()->flash('danger','很抱歉，您的用户名和密码不匹配，请重新登录');
    		return redirect()->back();
    	}
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success','您已成功退出！');
        return redirect('/');
    }

    public function mana_create()
    {
        return view('sessions.mana_create');
    }

    public function mana_store(Request $request)
    {
        $this->validate($request,[
            'mana_name'=>'required|max:25',
            'password'=>'required|min:6'
            ]);
        $credentials=['mana_name'=>$request->mana_name,'password'=>$request->password,];
        if(Auth::manager()->attempt($credentials,$request->has('remember')))
        {
            session()->flash('success','欢迎回来！');
            return redirect()->intended(route('manager.show',[Auth::manager()->get()]));
        }
        else
        {
            session()->flash('danger','很抱歉，您的用户名和密码不匹配，请重新登录');
            return redirect()->back();
        }
    }

    public function company_create()
    {
        return view('sessions.company_create');
    }

    public function company_store(Request $request)
    {
        $this->validate($request,[
            'company_account'=>'required|max:25',
            'password'=>'required|min:6'
            ]);
        $credentials=['company_account'=>$request->company_account,'password'=>$request->password,];
        if(Auth::company()->attempt($credentials,$request->has('remember')))
        {
            $id=Auth::company()->get()->id;
            if (Auth::company()->get()->activated==0) {
                Auth::logout();
                session()->flash('danger','对不起，您的账号尚未验证通过，请耐心等待系统验证！');
                return redirect('/');
            }
            else if(Auth::company()->get()->activated==2) {

                Auth::logout();
                session()->flash('danger','对不起，您的信息被系统管理员驳回，请核实并修改信息等待重新审核！');
                return redirect()->route('company.edit',$id);
            }
            else
            {
                session()->flash('success','欢迎回来！');
                return redirect()->intended(route('company.show',[Auth::company()->get()]));
            }
        }
        else
        {
            session()->flash('danger','很抱歉，您的用户名和密码不匹配，请重新登录');
            return redirect()->back();
        }
    }
}
