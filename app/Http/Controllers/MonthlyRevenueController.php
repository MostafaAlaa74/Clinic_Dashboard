<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonthlyRevenue;
use Carbon\Carbon;

class MonthlyRevenueController extends Controller
{
    /**
     * Display a listing of monthly revenues.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all monthly revenues ordered by year and month
        $revenues = MonthlyRevenue::orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
            
        // Format the data for display
        $formattedRevenues = $revenues->map(function ($revenue) {
            $date = Carbon::createFromDate($revenue->year, $revenue->month, 1);
            return [
                'id' => $revenue->id,
                'month_name' => $date->format('F'),
                'year' => $revenue->year,
                'month' => $revenue->month,
                'month_year' => $date->format('F Y'),
                'total_revenue' => $revenue->total_revenue,
                'created_at' => $revenue->created_at,
                'updated_at' => $revenue->updated_at,
            ];
        });
        
        return view('revenues.index', compact('formattedRevenues'));
    }
    
    /**
     * Calculate and update the revenue for the current month.
     *
     * @return \Illuminate\Http\Response
     */
    public function calculateCurrent()
    {
        $year = now()->year;
        $month = now()->month;
        
        $revenue = MonthlyRevenue::calculateAndStoreMonthlyRevenue($year, $month);
        
        return redirect()->route('revenues.index')
            ->with('success', "Revenue for " . now()->format('F Y') . " has been updated: $" . number_format($revenue->total_revenue, 2));
    }
    
    /**
     * Calculate and update the revenue for a specific month.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculateSpecific(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:2000|max:' . (now()->year + 1),
            'month' => 'required|integer|min:1|max:12',
        ]);
        
        $year = $request->input('year');
        $month = $request->input('month');
        
        $revenue = MonthlyRevenue::calculateAndStoreMonthlyRevenue($year, $month);
        
        $date = Carbon::createFromDate($year, $month, 1);
        
        return redirect()->route('revenues.index')
            ->with('success', "Revenue for " . $date->format('F Y') . " has been updated: $" . number_format($revenue->total_revenue, 2));
    }
}
