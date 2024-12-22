<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //
    private $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    public function index()
    {
        // $statement = $this->users->statementUser("DELETE FROM users");
        // dd($statement);

        $title = 'Danh sach nguoi dung';

        $this->users->learnQueryBuilder();

        $users = new Users();

        $usersList = $this->users->getAllUsers();

        return view('clients.users.lists', compact('title', 'usersList'));
    }

    public function add()
    {
        $title = 'Them nguoi dung';

        return view('clients.users.add', compact('title'));
    }

    public function postAdd(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users'
        ], [
            'fullname.required' => 'Ten bat buoc phai nhap',
            'fullname.min' => 'Ho va ten phai tu :min ki tu tro len',

            'email.required' => 'Email bat buoc phai nhap',
            'email.email' => 'Email khong dung dinh dang',
            'email.unique' => 'Email da to tai tren he thong'
        ]);

        $dataInsert = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];

        $this->users->addUser($dataInsert);

        return redirect()->route('users.index')->with('msg', 'Them nguoi dung thanh cong');
    }

    public function getEdit(Request $request, $id = 0)
    {
        $title = 'Cap nhat nguoi dung';

        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $request->session()->put('id', $id);
                $userDetail = $userDetail[0];
            } else {
                return redirect()->route('users.index')->with('msg', 'Nguoi dung khong ton tai');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'Lien ket khong ton tai');
        }

        return view('clients.users.edit', compact('title', 'userDetail'));
    }

    public function postEdit(Request $request)
    {
        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'Lien ket khong ton tai');
        }
        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users,email,' . $id
        ], [
            'fullname.required' => 'Ten bat buoc phai nhap',
            'fullname.min' => 'Ho va ten phai tu :min ki tu tro len',

            'email.required' => 'Email bat buoc phai nhap',
            'email.email' => 'Email khong dung dinh dang',
            'email.unique' => 'Email da to tai tren he thong'
        ]);

        $dataUpdate = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];

        $this->users->updateUser($dataUpdate, $id);

        // return redirect()->route('users.edit', ['id' => $id])->with('cap nhat nguoi dung thanh cong');
        // ==
        return back()->with('msg', 'cap nhat nguoi dung thanh cong');
    }

    public function delete($id = 0)
    {
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $deleteStatus = $this->users->deleteUser($id);
                if ($deleteStatus) {
                    $msg = "Xoa nguoi dung thanh cong";
                } else {
                    $msg = "Ban khong the xoa nguoi dung luc nay. Vui long thu lai sau";
                }
            } else {
                $msg = "Nguoi dung khong ton tai";
            }
        } else {
            $msg = "Lien ket khong ton tai";
        }

        return redirect()->route('users.index')->with('msg', $msg);
    }
}
