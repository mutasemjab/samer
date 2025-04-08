<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $query = User::query();

        if ($searchQuery) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('phone', 'like', '%' . $searchQuery . '%');
            });
        }

        $data = $query->paginate(PAGINATION_COUNT);

        return view('admin.users.index', [
            'data' => $data,
            'searchQuery' => $searchQuery
        ]);
    }


    public function create()
    {
        if (auth()->user()->can('user-add')) {
            return view('admin.users.create');
        } else {
            return redirect()->back()
                ->with('error', "Access Denied");
        }
    }



    public function store(Request $request)
    {
        if (auth()->user()->can('user-add')) {
            try {

                $user = new User();
                $user->name = $request->get('name');
                $user->phone = $request->get('phone');
                $user->address = $request->get('address');
                $user->medical_history = $request->get('medical_history');
                $user->allergies = $request->get('allergies');
                $user->password = Hash::make($request->password);

                if ($user->save()) {
                    return redirect()->route('users.index')->with(['success' => 'user created']);
                } else {
                    return redirect()->back()->with(['error' => 'Something wrong']);
                }
            } catch (\Exception $ex) {
                return redirect()->back()
                    ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                    ->withInput();
            }
        } else {
            return redirect()->back()
                ->with('error', "Access Denied");
        }
    }

    public function edit($id)
    {
        if (auth()->user()->can('user-edit')) {
            $data = User::findorFail($id);
            return view('admin.users.edit', compact('data'));
        } else {
            return redirect()->back()
                ->with('error', "Access Denied");
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->can('setting-edit')) {
            $user = User::findorFail($id);
            try {
                $user->name = $request->get('name');
                $user->phone = $request->get('phone');
                $user->address = $request->get('address');
                $user->activate = $request->get('activate');
                $user->medical_history = $request->get('medical_history');
                $user->allergies = $request->get('allergies');
                if($request->password){
                    $user->password = Hash::make($request->password);
                }
               
                if ($user->save()) {
                    return redirect()->route('users.index')->with(['success' => 'user update']);
                } else {
                    return redirect()->back()->with(['error' => 'Something wrong']);
                }
            } catch (\Exception $ex) {
                return redirect()->back()
                    ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                    ->withInput();
            }
        } else {
            return redirect()->back()
                ->with('error', "Access Denied");
        }
    }
}
