<?php
// File: app/Views/dashboard.php
?>
<?= $this->extend('templates/header') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section text-white py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-4 fw-bold mb-4 fade-in-up">Kelola Kalori Harian Anda dengan Mudah</h1>
                <p class="lead mb-4 fade-in-up">MyCalories membantu Anda mencapai target kesehatan dengan tracking kalori yang akurat dan mudah digunakan.</p>
                <a href="#dashboard" class="btn btn-light btn-lg me-3">Mulai Tracking <i class="fas fa-arrow-down ms-2"></i></a>
                <a href="<?= base_url('/dashboard/daftar-makanan') ?>" class="btn btn-outline-light btn-lg" style="position:relative; z-index:2;">Lihat Daftar Makanan</a>
            </div>
            <div class="col-lg-6 text-center mt-4 mt-lg-0">
                <img src="<?= base_url('assets/images/apel4.png') ?>" alt="Ilustrasi Kalori" class="img-fluid" style="max-height: 300px;">
            </div>
        </div>
    </div>
</section>

<!-- Dashboard Section -->
<section id="dashboard" class="py-5">
    <div class="container">
        <div class="row mb-5 text-center">
            <h2 class="fw-bold">Dashboard Harian</h2>
            <h6>Pantau progress kalori Anda hari ini</h6>
        </div>

        <!-- Progress Ring -->
        <div class="progress-container text-center mb-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="progress-ring position-relative mx-auto" style="width: 150px; height: 150px;">
                        <svg>
                            <circle cx="75" cy="75" r="50" stroke="#eee" stroke-width="10" fill="none" />
                            <circle class="progress-ring-fill" cx="75" cy="75" r="50" stroke="#28a745" stroke-width="10" fill="none"
                                stroke-dasharray="314.15"
                                stroke-dashoffset="<?= 314.15 - min($totalKalori / $targetKalori, 1) * 314.15 ?>"
                                style="transition: stroke-dashoffset 0.4s ease;" />
                        </svg>
                        <div class="position-absolute top-50 start-50 translate-middle text-center">
                            <h4 class="fw-bold mb-0"><?= $totalKalori ?></h4>
                            <small>/ <?= $targetKalori ?> kal</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Ring -->
            <div class="row mt-4 text-center">
                <div class="col-md-4">
                    <h6 class="text-primary">Sisa Kalori</h6>
                    <h5 class="fw-bold"><?= max($targetKalori - $totalKalori, 0) ?> kal</h5>
                    <small class="text-muted">Target: <?= $targetKalori ?> kal</small>
                    <form action="<?= base_url('/dashboard/updateTargetKalori') ?>" method="post" class="d-flex gap-2 mt-2 justify-content-center">
                        <input type="number" name="target_kalori" class="form-control form-control-sm" value="<?= $targetKalori ?>" required style="width: 100px;">
                        <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <h6 class="text-success">Makanan</h6>
                    <h5 class="fw-bold"><?= $totalKalori ?> kal</h5>
                    <small class="text-muted"><?= $jumlahItem ?> item hari ini</small>
                </div>
                <div class="col-md-4">
                    <h6 class="text-warning">Olahraga</h6>
                    <h5 class="fw-bold">-</h5>
                    <small class="text-muted">belum ada data</small>
                </div>
            </div>
        </div>

        <!-- Form Tambah -->
        <div id="form-makanan" class="form-container mb-5">
            <h5 class="fw-bold mb-3">Tambah Makanan</h5>
            <form id="formTambah" method="post" action="/dashboard/tambah">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" name="nama_makanan" placeholder="Nama Makanan" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="number" class="form-control" name="jumlah" placeholder="Gram" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="number" class="form-control" name="kalori" placeholder="Kalori" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <select name="waktu_makan" class="form-select" required>
                            <option value="">Pilih Waktu Makan</option>
                            <option value="Sarapan">Sarapan</option>
                            <option value="Makan Siang">Makan Siang</option>
                            <option value="Makan Malam">Makan Malam</option>
                            <option value="Snack">Snack</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="submit" class="btn btn-primary w-100">Tambah</button>
                    </div>
                </div>
            </form>
        </div>

    

        <!-- Tabel Makanan Hari Ini -->
        <div class="meal-section">
            <h4 class="fw-bold mb-3">Makanan Hari Ini</h4>
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Kalori</th>
                        <th>Waktu</th>
                        <th>Waktu Input</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($foods): foreach($foods as $item): ?>
                        <tr>
                            <td><?= esc($item['nama_makanan']) ?></td>
                            <td><?= esc($item['jumlah']) ?>g</td>
                            <td><?= esc($item['kalori']) ?> kal</td>
                            <td><?= esc($item['waktu_makan']) ?></td>
                            <td><?= date('d M Y H:i', strtotime($item['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Grafik Mingguan -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4 text-center">
            <h2 class="fw-bold mb-3">Progress Mingguan</h2>
            <p class="text-muted">Lihat perkembangan kalori Anda dalam 7 hari terakhir</p>
        </div>
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="form-container bg-white p-4 rounded shadow">
                    <canvas id="weeklyChart" style="max-height: 400px;"></canvas>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="stat-card mb-4 p-3 bg-white shadow rounded">
                    <h6 class="text-muted mb-1">Rata-rata Harian</h6>
                    <div class="stat-number h4"><?= round(array_sum(json_decode($chartData)) / 7) ?> kal</div>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>dibanding minggu lalu</small>
                </div>
                <div class="stat-card mb-4 p-3 bg-white shadow rounded">
                    <h6 class="text-muted mb-1">Target Tercapai</h6>
                    <div class="stat-number h4">
                        <?= count(array_filter(json_decode($chartData), fn($v) => $v >= $targetKalori)) ?>/7
                    </div>
                    <small class="text-warning"><i class="fas fa-check-circle me-1"></i>hari sesuai target</small>
                </div>
                <div class="stat-card p-3 bg-white shadow rounded">
                    <h6 class="text-muted mb-1">Streak Terpanjang</h6>
                    <div class="stat-number h4">-</div>
                    <small class="text-info"><i class="fas fa-fire me-1"></i>belum tersedia</small>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>
<?= $this->endSection() ?>
