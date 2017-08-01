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
use Input;
use DB;
use File;
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'only'=>['edit','update']]);
        $this->middleware('guest',[
            'only'=>['create']]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function sms()
    {
        $statusStr = array(
        "0" => "短信发送成功",
        "-1" => "参数不全",
        "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
        "30" => "密码错误",
        "40" => "账号不存在",
        "41" => "余额不足",
        "42" => "帐户已过期",
        "43" => "IP地址限制",
        "50" => "内容含有敏感词"
         );  
        $smsapi = "http://www.smsbao.com/"; //短信网关
        $user = "weiwei2018"; //短信平台帐号
        $pass = md5("w123456"); //短信平台密码
        $code=rand(100000,999999);
        Session_Start();
        $_SESSION["verify_code"]=$code;
        $content="【智眼Zyan】验证码：".$code;//要发送的短信内容
        $phone = $_GET["mobile"];
        $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
        $result =file_get_contents($sendurl) ;
        // echo $statusStr[$result];
    }

    public function store(Request $request)
    {
        session_start();
        $this->validate($request, [
        'username' => 'required|max:50|unique:users',
        'password' => 'required|confirmed|min:6',
        'mobile' => 'required|unique:users|digits:11',
        'verification_code' =>'required|digits:6',
        'gender' => 'required'
        ]);
        if ($request->verification_code==$_SESSION["verify_code"]) {
        $user=User::create([
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'mobile'=>$request->mobile,
            'gender'=>$request->gender,
            ]);
        // $this->sendEmailConfirmationTo($user);
        session()->flash('success', '恭喜你，注册成功！');
        return redirect('/');
        }
        else
        {
            session()->flash('danger', '短信验证码输入有误，请重新输入！');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user=User::findOrFail($id);
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    public function update($id,Request $request)
    {
        $this->validate($request,[
            'username'=>'required|max:50',
            'password'=>'confirmed|min:6',
            'real_name'=>'required',
            'ID_card'=>'required|alpha_num|unique:users,ID_card,'.$id,
            'address'=>'required',
            'delivery_address'=>'required',
            'model'=>'required',
            'plate'=>'required|unique:users,plate,'.$id,
            'driver_licence_num'=>'required|unique:users,driver_licence_num,'.$id,
            'myfile'=>'image'
            ]);
        $user=User::findOrFail($id);
        $this->authorize('update',$user);
        $data=[];
        // 图片处理
        if ($request->myfile) {
            $file = Input::file('myfile');  
            if($file->isValid()){
            $clientName = $file -> getClientOriginalName();  
            $tmpName = $file ->getFileName();
            $realPath = $file -> getRealPath();
            $entension = $file -> getClientOriginalExtension();
            $mimeTye = $file -> getMimeType();  
            $newName = md5(date("Y-m-d H:i:s")).$id."-portrait".".".$entension;  
            $path = $file -> move('images',$newName);
            if($user->image_url)
            {
                $delete_path='images/'.$user->image_url;
                File::delete($delete_path);
            }
            $data['image_url']=$newName;
            }
        }
        //图片处理结束
        $data['username']=$request->username;
        if ($request->password) {
            $data['password']=bcrypt($request->password);
        }
        $data['real_name']=$request->real_name;
        $data['ID_card']=$request->ID_card;
        $data['address']=$request->address;
        $data['delivery_address']=$request->delivery_address;
        $data['model']=$request->model;
        $data['plate']=$request->plate;
        $data['driver_licence_num']=$request->driver_licence_num;
        $user->update($data);
        $this->sendEmailConfirmationTo($user);
        session()->flash('success','个人资料修改成功！');
        return redirect()->route('users.edit',$id);
    }

    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        session()->flash('success','已成功删除用户'.$user->username.'!');
        return redirect()->back();
    }

    public function getReset()
    {
        return view('users.password_reset');
    }

    public function postRset(Request $request)
    {
        session_start();
        $this->validate($request, [
        'password' => 'required|confirmed|min:6',
        'mobile' => 'required|digits:11',
        'verification_code' =>'required|digits:6'
        ]);
        if($user=User::where('mobile',$request->mobile)->first())
        {
            if ($request->verification_code==$_SESSION["verify_code"]) {
            $user->update([
            'password' => bcrypt($request->password),
            ]);
            session()->flash('success', '恭喜你，密码修改成功！');
            return redirect('/');
            }
            else
            {
                session()->flash('danger', '验证码输入有误，请重新输入！');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('danger', '手机号不存在，请重新输入！');
            return redirect()->back();
        }
        
    }

    public function join_company($id,Request $request)
    {
        $user=User::findOrFail($id);
        if ($user->real_name==null||$user->ID_card==null||$user->address==null||$user->plate==null||$user->model==null||$user->driver_licence_num==null) {
            session()->flash('danger', '请先完善您的个人信息再申请加入公司！');
            return redirect()->route('users.edit',$id);
        }
        else
        {
            $relation_id=0;
            $state=0;
            if($is_relation=Relation::where('user',Auth::user()->get()->id)->first())
            {
                $relation_id=$is_relation->company;
                $state=$is_relation->state;
                if($is_relation->state==2)
                {
                    session()->flash('danger', '很遗憾，您申请加入的公司('.$is_relation->get_company_name($is_relation->company).')拒绝了您的申请，拒绝原因为:"'.$is_relation->reason.'"，请重新申请！');
                    $is_relation->delete();
                    return redirect()->route('join_company',$id);
                }
                if($is_relation->state==3)
                {
                    session()->flash('danger', '很遗憾，您已被移出公司('.$is_relation->get_company_name($is_relation->company).')！');
                    $is_relation->delete();
                    return redirect()->route('join_company',$id);
                }
            }
            if($request->keyword)
            {
                $companies=Company::where('activated',1)->where('company_name','like','%'.$request->keyword.'%')->paginate(10);
            }
            else
            {
                $companies=Company::where('activated',1)->paginate(10);
            }
            return view('users.join_company',compact('companies','relation_id','state'));
        }
    }

    public function join_in($company_id)
    {
        if($is_relation=Relation::where('user',Auth::user()->get()->id)->first())
        {
            session()->flash('danger', '对不起，您已经申请了加入公司('.$is_relation->get_company_name($is_relation->company).'),不能同时申请加入其他公司！');
            return redirect()->back();
        }

        $relation=Relation::create([
            'user' => Auth::user()->get()->id,
            'company' => $company_id,
            'state' => 0,
            ]);
        
        session()->flash('success', '提交申请成功，请耐心等待公司审核！');
        return redirect()->back();
    }

    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.test';
        $data = compact('user');
        $from = '18581688661@163.com';
        $name = '【智眼Zyan】';
        $to = '240728816@qq.com';
        $subject = "【智眼Zyan】报警提示";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }
}
