<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Invoice;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPatients = Patient::count();
        $appointmentsToday = Appointment::whereDate('appointment_date', today())->count();
        $outstandingInvoices = Invoice::whereIn('status', ['sent', 'overdue'])->count();
        
        return view('admin.dashboard', compact('totalPatients', 'appointmentsToday', 'outstandingInvoices'));
    }
}


