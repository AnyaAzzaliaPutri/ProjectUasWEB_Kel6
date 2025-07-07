<?= $this->extend('templates/header') ?>
<?= $this->section('content') ?>

<!-- Section: Riwayat Makanan -->
<section class="py-5">
    <div class="container">
        <!-- Judul -->
        <div class="row mb-4 text-center">
            <div class="col">
                <h2 class="fw-bold">Riwayat Makanan</h2>
                <p class="text-muted">Lihat semua makanan yang telah Anda input sebelumnya</p>
            </div>
        </div>

        <!-- Tabel Riwayat -->
        <div class="table-responsive shadow-sm">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Tanggal & Waktu</th>
                        <th>Nama Makanan</th>
                        <th>Jumlah</th>
                        <th>Kalori</th>
                        <th>Waktu Makan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($histories)): ?>
                        <?php foreach ($histories as $item): ?>
                            <tr>
                                <td class="text-center"><?= date('d M Y H:i', strtotime($item['created_at'])) ?></td>
                                <td><?= esc($item['nama_makanan']) ?></td>
                                <td class="text-center"><?= esc($item['jumlah']) ?> g</td>
                                <td class="text-center"><?= esc($item['kalori']) ?> kal</td>
                                <td class="text-center"><?= esc($item['waktu_makan']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data makanan yang tercatat.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center mt-4">
            <a href="<?= base_url('/dashboard') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
            </a>
        </div>
        
    </div>
</section>

<?= $this->include('templates/footer') ?>
<?= $this->endSection() ?>
