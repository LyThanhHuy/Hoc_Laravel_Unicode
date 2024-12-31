<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Phone;


class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function phone()
    {
        return $this->hasOne(
            Phone::class,
            'user_id',
            'id'
        );
    }

    public function group()
    {
        return $this->belongsTo(
            Groups::class,
            'group_id',
            'id'
        );
    }

    public function getAllUsers($filters = [], $keywords = null, $sortByArr = null, $perPage = null)
    {
        // $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');

        $users = DB::table($this->table)
            ->select('users.*', 'groups.name as group_name')
            ->join('groups', 'users.group_id', '=', 'groups.id')
            ->where('trash', 0);
        // ->orderBy('users.create_at', 'DESC');

        $orderBy = 'users.create_at';
        $orderType = 'desc';

        if (!empty($sortByArr) && is_array($sortByArr)) {
            if (!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])) {
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }

        $users = $users->orderBy($orderBy, $orderType);

        if (!empty($filters)) {
            $users = $users->where($filters);
        }

        if (!empty($keywords)) {
            $users = $users->where(function ($query) use ($keywords) {
                $query->orWhere('fullname', 'like', '%' . $keywords . '%');
                $query->orWhere('email', 'like', '%' . $keywords . '%');
            });
        }

        // $users = $users->get();

        if (!empty($perPage)) {
            $users = $users->paginate($perPage)->withQueryString();
        } else {
            $users = $users->get();
        }

        return $users;
    }

    public function addUser($data)
    {
        // DB::insert('INSERT INTO users (fullname, email, create_at) values (?, ?, ?)', $data);

        return DB::table($this->table)->insert($data);
    }

    public function getDetail($id)
    {
        return DB::select('SELECT * FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }

    public function updateUser($data, $id)
    {
        // $data = array_merge($data, [$id]);

        // $data[] = $id;
        // return DB::update('UPDATE ' . $this->table . ' SET fullname=?, email=?, update_at=? where id = ?', $data);

        return DB::table($this->table)->where('id', $id)->update($data);
    }

    public function deleteUser($id)
    {
        // return DB::delete("DELETE FROM $this->table WHERE id=?", [$id]);
        return DB::table($this->table)->where('id', $id)->delete();
    }

    public function statementUser($sql)
    {
        return DB::statement($sql);
    }

    public function learnQueryBuilder()
    {
        DB::enableQueryLog();
        // Lay tat ca ban ghi cua table
        $id = 20;


        // $status = DB::table('users')->insert([
        //     'fullname' => 'Nguyen Van An',
        //     'email' => 'nguyenvanan@gmail.com',
        //     'group_id' => 1,
        //     'create_at' => date('Y-m-d H:i:s')
        // ]);

        // $lastId = DB::getPdo()->lastInsertId();

        // $lastId = DB::table('users')->insertGetId([
        //     'fullname' => 'Nguyen Van An',
        //     'email' => 'nguyenvanan@gmail.com',
        //     'group_id' => 1,
        //     'create_at' => date('Y-m-d H:i:s')
        // ]);

        // dd($lastId);

        $status = DB::table('users')
            ->where('id', 11)
            ->update([
                'fullname' => 'Nguyen Van B',
                'email' => 'b@gmail.com',
                'update_at' => date('Y-m-d H:i:s')
            ]);



        dd($status);

        $sql = DB::getQueryLog();
        dd($sql);

        // Lay 1 ban ghi dau tien cua table (Lấy thông tin chi tiết)
        $detail = DB::table($this->table)->first();
    }
}
