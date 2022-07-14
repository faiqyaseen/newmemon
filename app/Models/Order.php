<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'remarks',
        'driver',
        'vehicle_name',
        'vehicle_number',
        'conductor',
        'location',
    ];

    public static function getOrdersWithTotalProducts($where = []) {
        $query = self::selectRaw('
            orders.id order_id,
            orders.status order_status,
            orders.total_amount order_amount,
            orders.discount order_discount,
            orders.amount_after_discount order_discount_amount,
            orders.remarks order_remarks,
            orders.created_at order_created_at,
            orders.updated_at order_updated_at,
            orders.customer_id customer_id,
            orders.remarks remarks,
            orders.cash_amount pay,
            orders.status status,
            orders.driver driver,
            orders.conductor conductor,
            orders.vehicle_name vehicle_name,
            orders.vehicle_number vehicle_number,
            orders.location location,
            cust.first_name customer_first_name,
            cust.last_name customer_last_name,
            (SELECT price FROM orders_products WHERE orders_products.order_id = orders.id AND orders_products.type = 1 LIMIT 1) AS commercial_cylinder_price,
            (SELECT price FROM orders_products WHERE orders_products.order_id = orders.id AND orders_products.type = 2 LIMIT 1) AS domestic_cylinder_price,
            (SELECT price FROM orders_products WHERE orders_products.order_id = orders.id AND orders_products.type = 3 LIMIT 1) AS domestic6_cylinder_price,
            (SELECT discount FROM orders_products WHERE orders_products.order_id = orders.id AND orders_products.type = 1 LIMIT 1) AS commercial_cylinder_discount,
            (SELECT discount FROM orders_products WHERE orders_products.order_id = orders.id AND orders_products.type = 2 LIMIT 1) AS domestic_cylinder_discount,
            (SELECT discount FROM orders_products WHERE orders_products.order_id = orders.id AND orders_products.type = 3 LIMIT 1) AS domestic6_cylinder_discount,
            (SELECT COUNT(*) FROM orders_products WHERE orders_products.order_id = orders.id) AS total_products,
            (SELECT COUNT(*) FROM orders_products WHERE orders_products.order_id = orders.id AND orders_products.type = 1) AS commercial_cylinders,
            (SELECT COUNT(*) FROM orders_products WHERE orders_products.order_id = orders.id AND orders_products.type = 2) AS domestic_cylinders,
            (SELECT COUNT(*) FROM orders_products WHERE orders_products.order_id = orders.id AND orders_products.type = 3) AS domestic6_cylinders
        ')
            ->leftJoin('customers as cust', 'cust.id', '=', 'orders.customer_id')
            ->where($where)
            ->orderBy('orders.id', 'DESC');
        return $query;
    }

    public static function getCutomerName($where = [])
    {
        $query = self::selectRaw("
            cust.first_name firstname,
            cust.last_name lastname,
            cust.email email
        ")->leftJoin('customers as cust', 'cust.id', '=', 'orders.customer_id')
           ->where($where)
           ->get();

        return $query;
    }
}
