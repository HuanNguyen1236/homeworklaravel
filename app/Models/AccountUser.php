<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Kế thừa từ Authenticatable

class AccountUser extends Authenticatable
{
    use HasFactory;

    // Các thuộc tính có thể được gán giá trị hàng loạt
    protected $table = 'account_users';
    protected $fillable = ['name', 'email', 'password', 'age', 'address', 'avatar'];
}
