<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'order_type',
        'customer_id',
        'payment'
    ];

    public static function getPaymentWithCustomers($where = [])
    {
        $query = self::selectRaw('
           cust.first_name as customer_first_name,
           cust.last_name as customer_last_name,
           cust.email as customer_email,
           cust.id customer_id,
           payments.id payment_id,
           payments.order_type,
           payments.payment as payment,
           payments.created_at payment_created_at,
           payments.updated_at payment_updated_at,
           payments.order_id payment_order_id,
           (SELECT COUNT(*) FROM payments WHERE payments.customer_id = cust.id AND order_type = 1) total_orders,
           (SELECT amount_after_discount FROM orders WHERE orders.id = payments.order_id) order_amount
        ')
            ->leftJoin('customers as cust', 'cust.id', '=', 'payments.customer_id')
            ->where($where)
            ->orderBy('cust.id', 'ASC');
        return $query;
    }

    public static function getMoneyRecord($where = [])
    {
        $query = self::selectRaw("
        IFNULL((SELECT SUM(payment) FROM payments), 0) + IFNULL((SELECT SUM(credit) FROM sales_purchases WHERE sale_purchase = 0), 0) - IFNULL((SELECT SUM(credit) FROM sales_purchases WHERE sale_purchase = 1), 0) AS present_payment,
        IFNULL((SELECT SUM(payment) FROM payments), 0) + IFNULL((SELECT SUM(credit) FROM sales_purchases WHERE sale_purchase = 0), 0) AS total_payment,
        IFNULL((SELECT SUM(payment) FROM payments WHERE DATE(payments.created_at) = CURRENT_DATE()), 0) + IFNULL((SELECT SUM(credit) FROM sales_purchases WHERE sale_purchase = 0 AND DATE(sales_purchases.created_at) = CURRENT_DATE()), 0) AS today_payment,
        IFNULL((SELECT SUM(payment) FROM payments WHERE DATE(payments.created_at) = DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY)), 0) + IFNULL((SELECT SUM(credit) FROM sales_purchases WHERE sale_purchase = 0 AND DATE(sales_purchases.created_at) = DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY)), 0) AS previousday_payment
        ")->first();

        return $query;
    }
}
