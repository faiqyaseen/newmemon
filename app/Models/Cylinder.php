<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cylinder extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'date_puchased',
        'condition'
    ];

    public static function getSoldCylindersWithCustomers() {
        $query = self::selectRaw("
            cylinders.id as cyl_id,
            cylinders.type as cyl_type,
            cylinders.buy_price as buy_price,
            cylinders.sell_price as sell_price,
            cylinders.date_sell as sell_date,
            cylinders.wall_type as wall_type,
            cust.id as customers_id,
            cust.first_name as first_name,
            cust.last_name as last_name
        ")
            ->leftJoin('customers as cust', 'cust.id', '=', 'cylinders.sell_to')
            ->where('cylinders.sell_to', '<>', 0)
            ->orderBy('cust.id', 'ASC')
            ->get();
        return $query;
        // ->selectRaw('COUNT(SELECT * FROM cylinders cy LEFT JOIN customers cu ON cy.sell_to =  WHERE cy.sell_to = customers_id) as cyl_count')
    }
    // public static function getSoldCylindersWithCustomers() {
    //     $query = self::selectRaw("
    //         cylinders.id as cyl_id,
    //         cylinders.type as cyl_type,
    //         cylinders.buy_price as buy_price,
    //         cylinders.sell_price as sell_price,
    //         cylinders.date_sell as sell_date,
    //         cylinders.wall_type as wall_type,
    //         cust.id as customers_id,
    //         cust.first_name as first_name,
    //         cust.last_name as last_name,
    //         COUNT(cust.id) as cyl_count
    //     ")
    //         ->leftJoin('customers as cust', 'cust.id', '=', 'cylinders.sell_to')
    //         ->where('cylinders.sell_to', '<>', 0)
    //         ->groupBy(
    //             'cylinders.id',
    //             'cylinders.type',
    //             'cylinders.buy_price',
    //             'cylinders.sell_price',
    //             'cylinders.date_sell',
    //             'cylinders.wall_type',
    //             'cust.id',
    //             'cust.first_name',
    //             'cust.last_name'
    //         )
    //         ->get();
    //     return $query;
    //     // ->selectRaw('COUNT(SELECT * FROM cylinders cy LEFT JOIN customers cu ON cy.sell_to =  WHERE cy.sell_to = customers_id) as cyl_count')
    // }
    // public static function getSoldCylindersWithCustomers() {
    //     $query = self::select(
    //         "cylinders.type as cyl_type",
    //         "cylinders.buy_price as buy_price",
    //         "cylinders.sell_price as sell_price",
    //         "cylinders.date_sell as sell_date",
    //         "cylinders.wall_type as wall_type",
    //         "cust.id as customers_id",
    //         "cust.first_name as first_name",
    //         "cust.last_name as last_name",
    //         )
    //         ->selectRaw('COUNT(SELECT * FROM cylinders cy LEFT JOIN customers cu ON cy.sell_to =  WHERE cy.sell_to = customers_id) as cyl_count')
    //         ->leftJoin('customers as cust', 'cust.id', '=', 'cylinders.sell_to')
    //         ->where('cylinders.sell_to', '<>', 0)
    //         ->get();
    //     return $query;
    //     // ->selectRaw('COUNT(SELECT * FROM cylinders cy LEFT JOIN customers cu ON cy.sell_to =  WHERE cy.sell_to = customers_id) as cyl_count')
    // }

    public static function getCylindersCount()
    {
        $query = self::selectRaw("
            (SELECT COUNT(*) FROM cylinders) AS total,
            (SELECT COUNT(*) FROM cylinders WHERE sell_to = 0) AS present_total,
            (SELECT COUNT(*) FROM cylinders WHERE sell_to = 0 AND assign_to <> 0) AS onparty_total,
            (SELECT COUNT(*) FROM cylinders WHERE sell_to = 0 AND assign_to = 0) AS remaining_total,
            (SELECT COUNT(*) FROM cylinders WHERE sell_to = 0 AND assign_to = 0 AND is_filled = 1) AS remaining_filled_total,
            (SELECT COUNT(*) FROM cylinders WHERE sell_to = 0 AND assign_to = 0 AND is_filled = 0) AS remaining_empty_total,
            (SELECT COUNT(*) FROM cylinders WHERE sell_to <> 0) AS total_sold,"

            // Commercial (Kg = 45.4, type = 1)
            ."(SELECT COUNT(*) FROM cylinders WHERE type = 1 AND sell_to = 0) AS present_commercial,
            (SELECT COUNT(*) FROM cylinders WHERE type = 1 AND sell_to = 0 AND assign_to = 0 AND is_filled = 1) AS remaining_filled_commercial,
            (SELECT COUNT(*) FROM cylinders WHERE type = 1 AND sell_to = 0 AND assign_to = 0  AND is_filled = 0) AS remaining_empty_commercial,
            (SELECT COUNT(*) FROM cylinders WHERE type = 1 AND sell_to = 0 AND assign_to = 0) AS remaining_commercial,
            (SELECT COUNT(*) FROM cylinders WHERE type = 1) AS total_commercial,
            (SELECT COUNT(*) FROM cylinders WHERE type = 1 AND assign_to <> 0) AS onparty_commercial,
            (SELECT COUNT(*) FROM cylinders WHERE type = 1 AND sell_to <> 0) AS sold_commercial,"

            // Domestic (Kg = 11.8, type = 2)
            ."(SELECT COUNT(*) FROM cylinders WHERE type = 2 AND sell_to = 0) AS present_domestic,
            (SELECT COUNT(*) FROM cylinders WHERE type = 2 AND sell_to = 0 AND assign_to = 0) AS remaining_domestic,
            (SELECT COUNT(*) FROM cylinders WHERE type = 2 AND sell_to = 0 AND assign_to = 0 AND is_filled = 1) AS remaining_filled_domestic,
            (SELECT COUNT(*) FROM cylinders WHERE type = 2 AND sell_to = 0 AND assign_to = 0 AND is_filled = 0) AS remaining_empty_domestic,
            (SELECT COUNT(*) FROM cylinders WHERE type = 2) AS total_domestic,
            (SELECT COUNT(*) FROM cylinders WHERE type = 2 AND assign_to <> 0) AS onparty_domestic,
            (SELECT COUNT(*) FROM cylinders WHERE type = 2 AND sell_to <> 0) AS sold_domestic,"
            
            // Domestic (kg = 6, type = 3)
            ."(SELECT COUNT(*) FROM cylinders WHERE type = 3 AND sell_to = 0) AS present_domestic6,
            (SELECT COUNT(*) FROM cylinders WHERE type = 3 AND sell_to = 0 AND assign_to = 0) AS remaining_domestic6,
            (SELECT COUNT(*) FROM cylinders WHERE type = 3 AND sell_to = 0 AND assign_to = 0 AND is_filled = 1) AS remaining_filled_domestic6,
            (SELECT COUNT(*) FROM cylinders WHERE type = 3 AND sell_to = 0 AND assign_to = 0 AND is_filled = 0) AS remaining_empty_domestic6,
            (SELECT COUNT(*) FROM cylinders WHERE type = 3) AS total_domestic6,
            (SELECT COUNT(*) FROM cylinders WHERE type = 3 AND assign_to <> 0) AS onparty_domestic6,
            (SELECT COUNT(*) FROM cylinders WHERE type = 3 AND sell_to <> 0) AS sold_domestic6,"
            
            // Domestic (kg = 10, type = 4)
            ."(SELECT COUNT(*) FROM cylinders WHERE type = 4 AND sell_to = 0) AS present_domestic10,
            (SELECT COUNT(*) FROM cylinders WHERE type = 4 AND sell_to = 0 AND assign_to = 0) AS remaining_domestic10,
            (SELECT COUNT(*) FROM cylinders WHERE type = 4 AND sell_to = 0 AND assign_to = 0 AND is_filled = 1) AS remaining_filled_domestic10,
            (SELECT COUNT(*) FROM cylinders WHERE type = 4 AND sell_to = 0 AND assign_to = 0 AND is_filled = 0) AS remaining_empty_domestic10,
            (SELECT COUNT(*) FROM cylinders WHERE type = 4) AS total_domestic10,
            (SELECT COUNT(*) FROM cylinders WHERE type = 4 AND assign_to <> 0) AS onparty_domestic10,
            (SELECT COUNT(*) FROM cylinders WHERE type = 4 AND sell_to <> 0) AS sold_domestic10
        ")->first();

        return $query;
    }

    public static function getCustomersEmpties($where = [])
    {
        $query = self::selectRaw("
            DISTINCT cust.id customer_id,
            cust.first_name customer_firstname,
            cust.last_name customer_lastname,
            cust.email customer_email,
            (SELECT MAX(CAST(updated_at as DATETIME)) FROM cylinders WHERE cylinders.assign_to = cust.id) last_activity,
            (SELECT COUNT('assign_to') FROM cylinders WHERE cylinders.assign_to = cust.id) total_empties,
            (SELECT COUNT('assign_to') FROM cylinders WHERE cylinders.assign_to = cust.id AND type = 1) commercial_empties,
            (SELECT COUNT('assign_to') FROM cylinders WHERE cylinders.assign_to = cust.id AND type = 2) domestic_empties,
            (SELECT COUNT('assign_to') FROM cylinders WHERE cylinders.assign_to = cust.id AND type = 3) domestic6_empties,
            (SELECT COUNT('assign_to') FROM cylinders WHERE cylinders.assign_to = cust.id AND type = 4) domestic10_empties
        ")
            ->leftJoin('customers AS cust', 'cust.id', '=', 'cylinders.assign_to')
            ->whereNot('cylinders.assign_to', 0)
            ->where($where)
            ->get();

        return $query;
    }
}
