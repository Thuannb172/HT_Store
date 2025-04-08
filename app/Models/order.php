<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class order extends Model
{
    // Thêm các trường cần thiết vào fillable để cho phép gán giá trị
    protected $fillable = ['name', 'phone', 'email', 'address', 'ward', 'district', 'city', 'note', 'status', 'order_detail'];

    // Cast order_detail thành array
    protected $casts = [
        'order_detail' => 'array',
        'status' => 'integer'
    ];
}
