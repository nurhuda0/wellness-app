<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Partner;
use App\Models\Company;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display the admin dashboard with comprehensive analytics
     */
    public function dashboard()
    {
        // Get current date and last 30 days
        $now = Carbon::now();
        $thirtyDaysAgo = $now->copy()->subDays(30);

        // User statistics
        $totalUsers = User::count();
        $newUsersThisMonth = User::where('created_at', '>=', $thirtyDaysAgo)->count();
        $activeUsers = User::where('last_login_at', '>=', $thirtyDaysAgo)->count();
        $usersWithMemberships = User::whereNotNull('membership_id')->count();

        // Booking statistics
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $completedBookings = Booking::where('status', 'completed')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();
        $bookingsThisMonth = Booking::where('created_at', '>=', $thirtyDaysAgo)->count();

        // Partner statistics
        $totalPartners = Partner::count();
        $activePartners = Partner::where('is_active', true)->count();

        // Company statistics
        $totalCompanies = Company::count();
        $activeCompanies = Company::where('is_active', true)->count();

        // Membership statistics
        $totalMemberships = Membership::count();
        $activeMemberships = Membership::where('is_active', true)->count();

        // Revenue analytics (if price tracking is implemented)
        $totalRevenue = Booking::where('status', 'completed')
            ->join('partners', 'bookings.partner_id', '=', 'partners.id')
            ->sum('partners.price');

        // Monthly booking trends
        $monthlyBookings = Booking::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top performing partners
        $topPartners = Partner::withCount(['bookings' => function($query) use ($thirtyDaysAgo) {
            $query->where('created_at', '>=', $thirtyDaysAgo);
        }])
        ->orderBy('bookings_count', 'desc')
        ->take(5)
        ->get();

        // Recent activities
        $recentBookings = Booking::with(['user', 'partner'])
            ->latest()
            ->take(10)
            ->get();

        $recentUsers = User::latest()
            ->take(5)
            ->get();

        // System health metrics
        $systemHealth = [
            'database_size' => $this->getDatabaseSize(),
            'last_backup' => $this->getLastBackupTime(),
            'active_sessions' => $this->getActiveSessions(),
        ];

        return view('admin.dashboard', compact(
            'totalUsers',
            'newUsersThisMonth',
            'activeUsers',
            'usersWithMemberships',
            'totalBookings',
            'pendingBookings',
            'completedBookings',
            'cancelledBookings',
            'bookingsThisMonth',
            'totalPartners',
            'activePartners',
            'totalCompanies',
            'activeCompanies',
            'totalMemberships',
            'activeMemberships',
            'totalRevenue',
            'monthlyBookings',
            'topPartners',
            'recentBookings',
            'recentUsers',
            'systemHealth'
        ));
    }

    /**
     * Display users management page
     */
    public function users(Request $request)
    {
        $query = User::with(['company', 'membership']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by membership
        if ($request->filled('membership')) {
            if ($request->membership === 'with') {
                $query->whereNotNull('membership_id');
            } elseif ($request->membership === 'without') {
                $query->whereNull('membership_id');
            }
        }

        $users = $query->latest()->paginate(20);
        $roles = ['user', 'admin', 'super_admin'];
        $memberships = Membership::where('is_active', true)->get();

        return view('admin.users', compact('users', 'roles', 'memberships'));
    }

    /**
     * Display bookings management page
     */
    public function bookings(Request $request)
    {
        $query = Booking::with(['user', 'partner']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('partner', function($partnerQuery) use ($search) {
                    $partnerQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('booking_time', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('booking_time', '<=', $request->date_to);
        }

        $bookings = $query->latest()->paginate(20);
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];

        return view('admin.bookings', compact('bookings', 'statuses'));
    }

    /**
     * Display partners management page
     */
    public function partners(Request $request)
    {
        $query = Partner::withCount('bookings');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $partners = $query->latest()->paginate(20);
        $categories = Partner::distinct()->pluck('category')->filter();

        return view('admin.partners', compact('partners', 'categories'));
    }

    /**
     * Display companies management page
     */
    public function companies(Request $request)
    {
        $query = Company::withCount('users');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('industry', 'like', "%{$search}%");
            });
        }

        // Filter by industry
        if ($request->filled('industry')) {
            $query->where('industry', $request->industry);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $companies = $query->latest()->paginate(20);
        $industries = Company::distinct()->pluck('industry')->filter();

        return view('admin.companies', compact('companies', 'industries'));
    }

    /**
     * Display memberships management page
     */
    public function memberships(Request $request)
    {
        $query = Membership::withCount('users');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $memberships = $query->latest()->paginate(20);

        return view('admin.memberships', compact('memberships'));
    }

    /**
     * Get database size for system health
     */
    private function getDatabaseSize()
    {
        try {
            $size = DB::select("SELECT pg_size_pretty(pg_database_size(current_database())) as size")[0]->size ?? 'Unknown';
            return $size;
        } catch (\Exception $e) {
            return 'Unknown';
        }
    }

    /**
     * Get last backup time (placeholder)
     */
    private function getLastBackupTime()
    {
        // This would typically check your backup system
        return Carbon::now()->subHours(6)->format('Y-m-d H:i:s');
    }

    /**
     * Get active sessions count
     */
    private function getActiveSessions()
    {
        try {
            return DB::table('sessions')->where('last_activity', '>=', time() - 3600)->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Export data for reporting
     */
    public function export(Request $request)
    {
        $type = $request->type;
        $format = $request->format ?? 'csv';

        switch ($type) {
            case 'users':
                $data = User::with(['company', 'membership'])->get();
                break;
            case 'bookings':
                $data = Booking::with(['user', 'partner'])->get();
                break;
            case 'partners':
                $data = Partner::withCount('bookings')->get();
                break;
            default:
                abort(400, 'Invalid export type');
        }

        // For now, return JSON. In production, you'd implement CSV/Excel export
        return response()->json($data);
    }

    /**
     * System settings page
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Update system settings
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'maintenance_mode' => 'boolean',
            'max_bookings_per_user' => 'required|integer|min:1',
            'booking_advance_days' => 'required|integer|min:1',
        ]);

        // Update settings (you'd typically store these in a settings table or config)
        // For now, we'll just return success
        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully');
    }
} 