@extends('layouts.user_template')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@500&display=swap');

    .dashboard-wrapper {
        font-family: 'DM Sans', sans-serif;
        padding: 2rem;
    }

    /* ── Header ── */
    .dashboard-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .dashboard-header h4 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
    }

    .dashboard-header h4 i { color: #0dcaf0; }

    .welcome-pill {
        background: #f0f9ff;
        border: 1px solid #bae6fd;
        color: #0369a1;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.4rem 1rem;
        border-radius: 999px;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* ── Stat Cards ── */
    .stat-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.10);
    }

    .stat-card-body {
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        opacity: 0.85;
        color: #fff;
        margin-bottom: 0.3rem;
    }

    .stat-value {
        font-size: 2.2rem;
        font-weight: 700;
        color: #fff;
        line-height: 1;
        font-family: 'DM Mono', monospace;
    }

    .stat-footer {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.8);
        margin-top: 0.6rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .stat-icon-wrap {
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon-wrap i { font-size: 1.4rem; color: #fff; }

    .stat-users     { background: linear-gradient(135deg, #0d6efd, #6ea8fe); }
    .stat-reminders { background: linear-gradient(135deg, #198754, #75c799); }
    .stat-done      { background: linear-gradient(135deg, #0dcaf0, #38bdf8); }
    .stat-pending   { background: linear-gradient(135deg, #f59e0b, #fbbf24); }

    /* ── Generic white card ── */
    .dash-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
    }

    .dash-card-header {
        padding: 1.1rem 1.5rem 0.85rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dash-card-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin: 0;
    }

    .dash-card-title i { color: #0dcaf0; }

    .dash-card-body { padding: 1.1rem 1.5rem; }

    .live-badge {
        background: linear-gradient(135deg, #0dcaf0, #0d6efd);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        letter-spacing: 0.04em;
    }

    /* ── Completion Rate ── */
    .completion-wrap { padding: 0.25rem 0 0.5rem; }

    .completion-numbers {
        display: flex;
        justify-content: space-between;
        font-size: 0.78rem;
        color: #64748b;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .completion-numbers span:first-child { color: #0f172a; font-weight: 700; font-size: 1rem; }

    .progress-track {
        background: #f1f5f9;
        border-radius: 999px;
        height: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #0dcaf0, #0d6efd);
        transition: width 0.6s ease;
    }

    .completion-legend {
        display: flex;
        gap: 1.25rem;
        margin-top: 0.75rem;
        font-size: 0.78rem;
        font-weight: 500;
    }

    .legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 0.3rem;
    }

    /* ── Mini tables ── */
    .mini-table { width: 100%; border-collapse: collapse; }

    .mini-table thead th {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #94a3b8;
        padding: 0 0 0.6rem;
        border-bottom: 1px solid #f1f5f9;
        text-align: left;
    }

    .mini-table tbody tr { border-bottom: 1px solid #f8fafc; }
    .mini-table tbody tr:last-child { border-bottom: none; }

    .mini-table tbody td {
        padding: 0.55rem 0;
        font-size: 0.82rem;
        color: #334155;
        vertical-align: middle;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.15rem 0.55rem;
        border-radius: 999px;
    }

    .pill-done    { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .pill-pending { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }

    .mini-avatar {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0dcaf0, #0d6efd);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.5rem;
        flex-shrink: 0;
        font-family: 'DM Mono', monospace;
    }

    .user-cell { display: flex; align-items: center; }

    .time-text {
        font-size: 0.72rem;
        color: #94a3b8;
        font-family: 'DM Mono', monospace;
    }
</style>

<div class="dashboard-wrapper">

    {{-- Header --}}
    <div class="dashboard-header">
        <h4><i class="bi bi-speedometer2"></i> Dashboard</h4>
        <div class="welcome-pill">
            <i class="bi bi-person-circle"></i>
            Welcome back, {{ session('user')->name ?? 'Admin' }}!
            &nbsp;·&nbsp;
            <i class="bi bi-calendar3"></i>
            {{ now()->format('M d, Y') }}
        </div>
    </div>

    {{-- Row 1: 4 Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card stat-users">
                <div class="stat-card-body">
                    <div>
                        <div class="stat-label">Total Users</div>
                        <div class="stat-value" id="stat-usercount">{{ $usercount }}</div>
                        <div class="stat-footer"><i class="bi bi-people-fill"></i> Registered</div>
                    </div>
                    <div class="stat-icon-wrap"><i class="bi bi-people-fill"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card stat-reminders">
                <div class="stat-card-body">
                    <div>
                        <div class="stat-label">Total Reminders</div>
                        <div class="stat-value" id="stat-todocount">{{ $todocount }}</div>
                        <div class="stat-footer"><i class="bi bi-bell-fill"></i> All time</div>
                    </div>
                    <div class="stat-icon-wrap"><i class="bi bi-bell-fill"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card stat-done">
                <div class="stat-card-body">
                    <div>
                        <div class="stat-label">Completed</div>
                        <div class="stat-value" id="stat-donecount">{{ $donecount }}</div>
                        <div class="stat-footer"><i class="bi bi-check-circle-fill"></i> Done</div>
                    </div>
                    <div class="stat-icon-wrap"><i class="bi bi-check-circle-fill"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card stat-pending">
                <div class="stat-card-body">
                    <div>
                        <div class="stat-label">Pending</div>
                        <div class="stat-value" id="stat-pendingcount">{{ $pendingcount }}</div>
                        <div class="stat-footer"><i class="bi bi-hourglass-split"></i> To-do</div>
                    </div>
                    <div class="stat-icon-wrap"><i class="bi bi-hourglass-split"></i></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 2: Chart + Completion Rate --}}
    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="dash-card">
                <div class="dash-card-header">
                    <div class="dash-card-title"><i class="bi bi-bar-chart-fill"></i> RemindMe! Overview</div>
                    <span class="live-badge">Live Data</span>
                </div>
                <div class="dash-card-body">
                    <canvas id="myChart" style="max-height: 220px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dash-card h-100">
                <div class="dash-card-header">
                    <div class="dash-card-title"><i class="bi bi-pie-chart-fill"></i> Completion Rate</div>
                </div>
                <div class="dash-card-body">
                    <div class="completion-wrap">
                        <div class="completion-numbers">
                            <span id="completion-rate">{{ $completionRate }}%</span>
                            <span id="completion-legend">{{ $donecount }} of {{ $todocount }} done</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" id="completion-fill" style="width: {{ $completionRate }}%;"></div>
                        </div>
                        <div class="completion-legend">
                            <div>
                                <span class="legend-dot" style="background:#0dcaf0;"></span>
                                <span style="color:#0369a1;">Completed: <span id="done-count">{{ $donecount }}</span></span>
                            </div>
                            <div>
                                <span class="legend-dot" style="background:#fbbf24;"></span>
                                <span style="color:#b45309;">Pending: <span id="pending-count">{{ $pendingcount }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 3: Recent Reminders + Recent Users --}}
    <div class="row g-3">
        <div class="col-md-7">
            <div class="dash-card">
                <div class="dash-card-header">
                    <div class="dash-card-title"><i class="bi bi-clock-history"></i> Recent Reminders</div>
                </div>
                <div class="dash-card-body">
                    <table class="mini-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTodos as $todo)
                            <tr>
                                <td style="font-weight:600; color:#0f172a; max-width:160px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                    {{ $todo->task }}
                                </td>
                                <td>
                                    <div class="user-cell">
                                        <span class="mini-avatar">{{ strtoupper(substr($todo->user->name ?? '?', 0, 1)) }}</span>
                                        {{ $todo->user->name ?? 'Unknown' }}
                                    </div>
                                </td>
                                <td>
                                    @if($todo->is_done)
                                        <span class="status-pill pill-done"><i class="bi bi-check-circle-fill"></i> Done</span>
                                    @else
                                        <span class="status-pill pill-pending"><i class="bi bi-hourglass-split"></i> Pending</span>
                                    @endif
                                </td>
                                <td class="time-text">{{ $todo->created_at->format('M d') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" style="text-align:center; color:#94a3b8; padding: 1rem 0;">No reminders yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="dash-card">
                <div class="dash-card-header">
                    <div class="dash-card-title"><i class="bi bi-person-plus-fill"></i> Recent Users</div>
                </div>
                <div class="dash-card-body">
                    <table class="mini-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $u)
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <span class="mini-avatar">{{ strtoupper(substr($u->name, 0, 1)) }}</span>
                                        <span style="font-weight:600; color:#0f172a;">{{ $u->name }}</span>
                                    </div>
                                </td>
                                <td style="color:#64748b; font-size:0.78rem;">{{ Str::limit($u->email, 18) }}</td>
                                <td class="time-text">{{ $u->created_at->format('M d') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" style="text-align:center; color:#94a3b8; padding: 1rem 0;">No users yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Users', 'Total', 'Completed', 'Pending'],
            datasets: [{
                label: 'Count',
                data: [{{ $usercount }}, {{ $todocount }}, {{ $donecount }}, {{ $pendingcount }}],
                backgroundColor: [
                    'rgba(13, 110, 253, 0.85)',
                    'rgba(25, 135, 84, 0.85)',
                    'rgba(13, 202, 240, 0.85)',
                    'rgba(245, 158, 11, 0.85)',
                ],
                borderWidth: 0,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#333',
                    bodyColor: '#666',
                    borderColor: '#ddd',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 10,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: { color: '#999', font: { size: 11, family: "'DM Sans', sans-serif" } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#555', font: { size: 12, weight: '600', family: "'DM Sans', sans-serif" } }
                }
            }
        }
    });


    const myChart = chart;

    function updateDashboard() {
        fetch('/dashboard/stats', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => {
            if (!res.ok) throw new Error('Not ok');
            return res.json();
        })
        .then(data => {
            if (data.donecount === undefined) return; 

            
            document.getElementById('stat-donecount').textContent    = data.donecount;
            document.getElementById('stat-pendingcount').textContent = data.pendingcount;
            document.getElementById('stat-todocount').textContent    = data.todocount;

            
            document.getElementById('completion-fill').style.width   = data.completionRate + '%';
            document.getElementById('completion-rate').textContent   = data.completionRate + '%';
            document.getElementById('completion-legend').textContent = data.donecount + ' of ' + data.todocount + ' done';
            document.getElementById('done-count').textContent        = data.donecount;
            document.getElementById('pending-count').textContent     = data.pendingcount;

            
            myChart.data.datasets[0].data = [data.usercount, data.todocount, data.donecount, data.pendingcount];
            myChart.update();
        })
        .catch(() => {}); 
    }

    setInterval(updateDashboard, 5000);
</script>
@endsection