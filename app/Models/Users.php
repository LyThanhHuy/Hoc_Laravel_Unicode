<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function getAllUsers()
    {
        $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');
        return $users;
    }

    public function addUser($data)
    {
        DB::insert('INSERT INTO users (fullname, email, create_at) values (?, ?, ?)', $data);
    }

    public function getDetail($id)
    {
        return DB::select('SELECT * FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }

    public function updateUser($data, $id)
    {
        // $data = array_merge($data, [$id]);

        $data[] = $id;

        return DB::update('UPDATE ' . $this->table . ' SET fullname=?, email=?, update_at=? where id = ?', $data);
    }

    public function deleteUser($id)
    {
        return DB::delete("DELETE FROM $this->table WHERE id=?", [$id]);
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
        // $lists = DB::table($this->table)
        //     ->select('fullname as hoten', 'email', 'id', 'update_at', 'create_at')
        //     ->whereDate('update_at', '2024-12-03')
        //     ->get();


        $lists = DB::table('users')
            ->select('users.*', 'groups.name as group_name')
            ->join('groups', 'users.group_id', '=', 'groups.id')
            ->get();

        dd($lists);
        $sql = DB::getQueryLog();
        dd($sql);

        // Lay 1 ban ghi dau tien cua table (Lấy thông tin chi tiết)
        $detail = DB::table($this->table)->first();
    }
}
