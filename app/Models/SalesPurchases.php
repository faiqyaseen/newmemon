<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPurchases extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_purchase',
        'kg', 
        'rate',
        'sale_purchase_date',
        'remarks',
        'driver',
        'conductor',
        'vehicle_name',
        'vehicle_number',
        'company_id',
        'branch_id',
        'credit',
    ];

    public static function getPurchaseRecord($where = [])
    {
        $query = self::selectRaw("
            sales_purchases.*,
            sales_purchases.kg*sales_purchases.rate AS total_rate,
            companies.name AS company_name,
            branches.name AS branch_name,
            (sales_purchases.kg*sales_purchases.rate) - sales_purchases.credit AS less
        ")
            ->leftJoin('companies', 'companies.id', '=', 'sales_purchases.company_id')
            ->leftJoin('branches', 'branches.id', '=', 'sales_purchases.branch_id')
            ->where($where)
            ->orderBy('sales_purchases.id', 'DESC')
            ->get();
        return $query;
    }
}
