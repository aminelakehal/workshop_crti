<?php
require_once __DIR__ . '/../controllers/Admin_controllers.php';
require_once __DIR__ . '/../controllers/user_controller.php';
require_once __DIR__ . '/../controllers/condidats.php';
require_once __DIR__ . '/../layout/header.php';

function get_dashboard_data($pdo) {
    $admin_count = count_admins($pdo);
    $user_count = count_users($pdo);
    $total_files = count_total_files($pdo);
    
    return [
        'admin_count' => $admin_count,
        'user_count' => $user_count,
        'total_files' => $total_files,
    ];
}
$data = get_dashboard_data($pdo);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        transition: background-color 0.3s ease;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    .dashboard {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 20px;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        flex: 1;
        min-width: 200px;
        color: #fff;
    }
    .card h3 {
        margin-top: 0;
    }
    .card .count {
        font-size: 2em;
        font-weight: bold;
    }
    .chart-container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: background-color 0.3s ease;
    }
    .files-card { background-color: #ff6384; }
    .users-card { background-color: #36a2eb; }
    .admins-card { background-color: #ffce56; }
    .card i {
        font-size: 2em;
        margin-bottom: 10px;
    }
    .darkmode {
        background-color: #1a1a2e;
        color: #fff;
    }
    .darkmode .chart-container {
        background-color: #363648 !important;
    }
    .darkmode h1 {
        color: #fff;
    }
</style>

<div class="container">
    <div class="titre mb-4">
    <h2>Admin Dashboard</h2>
    <br>
    <div class="dashboard">
        <div class="card files-card">
            <i class="fas fa-file"></i>
            <h3>Number of Uploaded Files</h3>
            <div class="count" id="fileCount">0</div>
        </div>
        <div class="card users-card">
            <i class="fas fa-users"></i>
            <h3>Number of Condidates</h3>
            <div class="count" id="userCount">0</div>
        </div>
        <div class="card admins-card">
            <i class="fas fa-user-shield"></i>
            <h3>Number of Admins</h3>
            <div class="count" id="adminCount">0</div>
        </div>
    </div>
    <div class="chart-container">
        <canvas id="statsChart"></canvas>
    </div>
</div>

<script>
    const dashboardData = {
        fileCount: <?php echo $data['total_files']; ?>,
        userCount: <?php echo $data['user_count']; ?>,
        adminCount: <?php echo $data['admin_count']; ?>
    };

    document.getElementById('fileCount').textContent = dashboardData.fileCount;
    document.getElementById('userCount').textContent = dashboardData.userCount;
    document.getElementById('adminCount').textContent = dashboardData.adminCount;

    const ctx = document.getElementById('statsChart').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Uploaded Files', 'Users', 'Admins'],
            datasets: [{
                label: 'Dashboard Statistics',
                data: [dashboardData.fileCount, dashboardData.userCount, dashboardData.adminCount],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function updateDarkMode(isDarkMode) {
        if (isDarkMode) {
            document.body.classList.add('darkmode');
        } else {
            document.body.classList.remove('darkmode');
        }
        updateChartColors(isDarkMode);
    }

    function updateChartColors(isDarkMode) {
        const textColor = isDarkMode ? '#fff' : '#666';
        chart.options.plugins.legend.labels.color = textColor;
        chart.options.scales.x.ticks.color = textColor;
        chart.options.scales.y.ticks.color = textColor;
        chart.update();
    }

    // Check for initial dark mode state
    if (document.body.classList.contains('darkmode')) {
        updateChartColors(true);
    }

    // Listen for changes to the dark mode state
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                const isDarkMode = document.body.classList.contains('darkmode');
                updateChartColors(isDarkMode);
            }
        });
    });

    observer.observe(document.body, { attributes: true });
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>