<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Groups;
use App\Models\Phone;
use App\Models\Users;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //
    private $users;
    const _PER_PAGE = 4;

    public function __construct()
    {
        $this->users = new Users();
    }

    public function index(Request $request)
    {
        // $statement = $this->users->statementUser("DELETE FROM users");
        // dd($statement);

        $title = 'Danh sach nguoi dung';

        // $this->users->learnQueryBuilder();

        $filters = [];

        $keywords = null;

        if (!empty($request->status)) {
            $status = $request->status;
            if ($status === 'active') {
                $status = 1;
            } else {
                $status = 0;
            }
            $filters[] = [
                'users.status',
                '=',
                $status
            ];
        }

        if (!empty($request->group_id)) {
            $groupId = $request->group_id;

            $filters[] = [
                'users.group_id',
                '=',
                $groupId
            ];
        }

        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }

        // xu ly logic sap xep
        // $sortBy = 'fullname';
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');
        $allowSort = ['asc', 'desc'];

        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            if ($sortType == 'desc') {
                $sortType = 'asc';
            } else {
                $sortType = 'desc';
            }
        } else {
            $sortType = 'asc';
        }

        $sortArray = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];
        $usersList = $this->users->getAllUsers($filters, $keywords, $sortArray, self::_PER_PAGE);
        return view('clients.users.lists', compact('title', 'usersList', 'sortType'));
    }

    public function add()
    {
        $title = 'Them nguoi dung';

        $allGroups = getAllGroups();

        return view('clients.users.add', compact('title', 'allGroups'));
    }

    public function postAdd(UserRequest $request)
    {

        $dataInsert = [
            // $request->fullname,
            // $request->email,
            // date('Y-m-d H:i:s')
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'create_at' => date('Y-m-d H:i:s')
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

        $allGroups = getAllGroups();

        return view('clients.users.edit', compact('title', 'userDetail', 'allGroups'));
    }

    public function postEdit(UserRequest $request)
    {
        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'Lien ket khong ton tai');
        }

        $dataUpdate = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'update_at' => date('Y-m-d H:i:s')
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

    public function relations()
    {
        // $phone = Users::find(18)->phone;
        // $idPhone = $phone->id;
        // $phoneNumber = $phone->phone;
        // echo 'id phone:' . $idPhone . '<br/>';
        // echo 'phone number:' . $phoneNumber . '<br/>';

        // $phone = Users::find(18)->phone();
        // dd($phone);

        // $user = Phone::where('phone', '0123456789')->first()->user;
        // $fullName = $user->fullname;
        // $email = $user->email;

        // echo 'Fullname: '.$fullName.'<br/>';
        // echo 'Email: ' . $email . '<br/>';

        // $users = Groups::find(1)->users()->where('email', 'D@gmail.com')->get();

        // if ($users->count() > 0) {
        //     foreach ($users as $item) {
        //         echo $item->fullname . '<br/>';
        //     }
        // }

        $group = Users::find(4)->group;
        $groupName = $group->name;
        dd($groupName);
    }
}
