<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class MonthlyRevenue extends Model
{
    protected $fillable = [
        'year',
        'month',
        'total_revenue',
    ];

    /**
     * Calculate and store the total revenue for a specific month
     *
     * @param int $year
     * @param int $month
     * @return MonthlyRevenue
     */
    public static function calculateAndStoreMonthlyRevenue($year = null, $month = null)
    {
        // If no year or month provided, use current month
        if ($year === null || $month === null) {
            $year = now()->year;
            $month = now()->month;
        }

        // Calculate total revenue for the month from appointments
        $totalRevenue = Appointment::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where('status', 'confirmed')
            ->sum('price');

        // Update or create the monthly revenue record
        return self::updateOrCreate(
            ['year' => $year, 'month' => $month],
            ['total_revenue' => $totalRevenue]
        );
    }
}
