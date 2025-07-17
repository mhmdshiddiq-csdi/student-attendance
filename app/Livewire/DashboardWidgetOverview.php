<?php

namespace App\Livewire;

use App\Models\Attendanc;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class DashboardWidgetOverview extends Component
{
    public $totalStudents;
    public $presentToday;
    public $absentToday;
    public $weeklyAttendanceRate;
    public $monthlyTrends = [];
    public $totalTeachers;
    public $attendanceToday;
    public $totalUsers;
    public function mount() 
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        //fetch data
        $this->totalStudents = Student::count();
        $this->totalUsers = User::count();
        $this->totalTeachers = User::where('role', 'teacher')->count();
        $this->attendanceToday = Attendanc::whereDate('date', $today)->where('status', 'present')->count();
        $this->presentToday = Attendanc::whereDate('date', $today)->where('status', 'present')->where('status', 'present')->count();
        $this->absentToday = Attendanc::whereDate('date', $today)->where('status', 'absent')->count();

        // weekly Attendance Rate
        $totalClasses = Attendanc::whereBetween('date', [$weekStart, $weekEnd])->count();
        $presentCount  = Attendanc::whereBetween('date', [$weekStart, $weekEnd])->where('status', 'present')->count();
        $this->weeklyAttendanceRate = $totalClasses > 0 ? round(($presentCount / $totalClasses) * 100, 2) : 0;

        for($i = 1; $i <= Carbon::now()->daysInMonth(); $i++) {
            $date = Carbon::createFromDate(Carbon::now()->year, Carbon::now()->month, $i);
            $this->monthlyTrends[] = [
                'day' => $i,
                'count' => Attendanc::whereDate('date', $date)->where('status', 'present')->count()
            ];
        }
    }
    public function render()
    {
        return view('livewire.dashboard-widget-overview');
    }
}
