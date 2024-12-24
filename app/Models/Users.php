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
