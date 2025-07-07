</main> <!-- Penutup tag <main> dari header -->

<footer class="footer bg-dark text-light text-center py-4 mt-5">
    <div class="container">
        <p>&copy; <?= date('Y') ?> LESSGOOOO KELOMPOK 6 MAJU MAJU MAJU.</p>
    </div>
</footer>

<!-- JS Bootstrap dan Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // ====== Chart.js (jika elemen dan data tersedia) ======
    <?php if (isset($chartLabels, $chartData, $targetKalori)): ?>
    const labels = <?= $chartLabels ?>;
    const values = <?= $chartData ?>;

    const ctx = document.getElementById('weeklyChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Kalori Konsumsi',
                        data: values,
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Target Kalori',
                        data: Array(7).fill(<?= $targetKalori ?>),
                        borderColor: '#dc3545',
                        borderDash: [5, 5],
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: 'Progress Kalori Mingguan'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 3000
                    }
                }
            }
        });
    }
    <?php endif; ?>

    // ====== Progress Ring: animasi (jika elemen tersedia) ======
    <?php if (isset($totalKalori, $targetKalori)): ?>
    const circle = document.querySelector('.progress-ring-fill');
    if (circle) {
        const current = <?= $totalKalori ?>;
        const target = <?= $targetKalori ?>;
        const radius = circle.r.baseVal.value;
        const circumference = 2 * Math.PI * radius;
        const progress = Math.min(current / target, 1);
        const offset = circumference - (progress * circumference);
        circle.style.strokeDasharray = `${circumference} ${circumference}`;
        circle.style.strokeDashoffset = offset;
    }
    <?php endif; ?>

    // ====== Smooth Scroll hanya untuk anchor internal ======
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        const target = document.querySelector(anchor.getAttribute('href'));
        if (target) {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        }
    });

    // ====== Scroll otomatis ke dashboard setelah submit makanan ======
    if (localStorage.getItem('scrollToDashboard') === 'yes') {
        localStorage.removeItem('scrollToDashboard');
        const dashboard = document.getElementById('dashboard');
        if (dashboard) {
            dashboard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    const form = document.getElementById('formTambah');
    if (form) {
        form.addEventListener('submit', () => {
            localStorage.setItem('scrollToDashboard', 'yes');
        });
    }

    // ====== Modal Trigger (jika ada) ======
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const modal = new bootstrap.Modal(document.getElementById('addFoodModal'));
            modal.show();
        });
    });

    // ====== Tambah makanan dari fitur kartu (jika ada) ======
    document.querySelectorAll('.feature-card .btn-outline-primary').forEach(button => {
        button.addEventListener('click', () => {
            const modal = new bootstrap.Modal(document.getElementById('addFoodModal'));
            modal.show();
        });
    });

});
</script>
</body>
</html>
