@extends('layout')

@section('css')
<link href="{{ url('common/bootstrap-table.css') }}" rel="stylesheet">
<style>
    .main-wrapper{
        min-height:100vh;
        height:auto
    }
</style>
@endsection

@section('content')
 <div class="container-fluid p-4 bg-light min-vh-100">

    <!-- 🔵 TOP STATS -->
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <p class="text-muted mb-1">Total Contacts</p>
                    <h4 class="fw-bold">1,250</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <p class="text-muted mb-1">Messages Today</p>
                    <h4 class="fw-bold text-primary">320</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <p class="text-muted mb-1">Total Messages</p>
                    <h4 class="fw-bold text-success">8,540</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <p class="text-muted mb-1">Failed Messages</p>
                    <h4 class="fw-bold text-danger">23</h4>
                </div>
            </div>
        </div>

    </div>


    <!-- 🟣 CHART + QUICK ACTION -->
    <div class="row g-4 mb-4">

        <!-- Chart -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="fw-semibold mb-3">SMS Activity (Last 7 Days)</h5>
                    <canvas id="smsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-grid gap-3">

                    <h5 class="fw-semibold">Quick Actions</h5>

                    <a href="#" class="btn btn-primary">
                        ➕ Send SMS
                    </a>

                    <a href="#" class="btn btn-success">
                        👥 Manage Contacts
                    </a>

                    <a href="#" class="btn btn-dark">
                        📊 View Reports
                    </a>

                </div>
            </div>
        </div>

    </div>


    <!-- 🟢 RECENT LOGS -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3">Recent SMS Logs</h5>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="text-muted">
                        <tr>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>+639123456789</td>
                            <td>Hi John, promo available...</td>
                            <td><span class="badge bg-success">Sent</span></td>
                            <td>Apr 10, 2026</td>
                        </tr>

                        <tr>
                            <td>+639987654321</td>
                            <td>Reminder for your appointment...</td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td>Apr 10, 2026</td>
                        </tr>

                        <tr>
                            <td>+639111222333</td>
                            <td>Promo ends today...</td>
                            <td><span class="badge bg-danger">Failed</span></td>
                            <td>Apr 09, 2026</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection