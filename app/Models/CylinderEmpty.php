<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CylinderEmpty extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'cylinder_type',
        'customer_id',
        'order_id',
        'quantity',
    ];

    public static function countEmpties($customer_id = 0)
    {
        $query = self::selectRaw("
           (SELECT SUM(IF(type = 0 AND customer_id = $customer_id AND cylinder_type = 1 , quantity, 0))) AS commercial_give,
           (SELECT SUM(IF(type = 0 AND customer_id = $customer_id AND cylinder_type = 2 , quantity, 0))) AS domestic_give,
           (SELECT SUM(IF(type = 0 AND customer_id = $customer_id AND cylinder_type = 3 , quantity, 0))) AS domestic6_give,
           (SELECT SUM(IF(type = 0 AND customer_id = $customer_id AND cylinder_type = 4 , quantity, 0))) AS domestic10_give,
           (SELECT SUM(IF(type = 1 AND customer_id = $customer_id AND cylinder_type = 1 , quantity, 0))) AS commercial_recieve,
           (SELECT SUM(IF(type = 1 AND customer_id = $customer_id AND cylinder_type = 2 , quantity, 0))) AS domestic_recieve,
           (SELECT SUM(IF(type = 1 AND customer_id = $customer_id AND cylinder_type = 3 , quantity, 0))) AS domestic6_recieve,
           (SELECT SUM(IF(type = 1 AND customer_id = $customer_id AND cylinder_type = 4 , quantity, 0))) AS domestic10_recieve,
           (SELECT SUM(IF(type = 0 AND customer_id = $customer_id AND cylinder_type = 1 , quantity, 0)) - SUM(IF(type = 1 AND customer_id = $customer_id AND cylinder_type = 1 , quantity, 0))) AS commercial_difference,
           (SELECT SUM(IF(type = 0 AND customer_id = $customer_id AND cylinder_type = 2 , quantity, 0)) - SUM(IF(type = 1 AND customer_id = $customer_id AND cylinder_type = 2 , quantity, 0))) AS domestic_difference,
           (SELECT SUM(IF(type = 0 AND customer_id = $customer_id AND cylinder_type = 3 , quantity, 0)) - SUM(IF(type = 1 AND customer_id = $customer_id AND cylinder_type = 3 , quantity, 0))) AS domestic6_difference,
           (SELECT SUM(IF(type = 0 AND customer_id = $customer_id AND cylinder_type = 4 , quantity, 0)) - SUM(IF(type = 1 AND customer_id = $customer_id AND cylinder_type = 4 , quantity, 0))) AS domestic10_difference
        ")->first();

        return $query;
    }
}
