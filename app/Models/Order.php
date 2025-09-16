<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'address',
        'payment_method',
        'total',
        'status'
    ];

    public function orderItem(){
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute()
    {
        $statuses = [
            1 => '<span class="text-info">'.__('admin.order.new') .'</span>',
            2 => '<span class="text-warning">'.__('admin.order.delivering') .'</span>',
            3 => '<span class="text-success">'.__('admin.order.completed') .'</span>',
            4 => '<span class="text-danger">'.__('admin.order.cancelled') .'</span>'
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
