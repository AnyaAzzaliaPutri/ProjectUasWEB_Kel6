<?= $this->extend('templates/header') ?>
<?= $this->section('content') ?>

<section class="container py-5" style="max-width: 720px;">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <h3 class="mb-4 text-center fw-bold">Profil Pengguna</h3>

        <form action="<?= base_url('/dashboard/updateProfile') ?>" method="post" enctype="multipart/form-data">
            <div class="text-center mb-4">
                <div class="position-relative d-inline-block">
                    <img src="<?= base_url($user['foto'] ?? 'assets/images/default-profile.png') ?>" class="rounded-circle shadow" style="width: 130px; height: 130px; object-fit: cover;" alt="Foto Profil">
                    <label for="foto" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle" title="Ganti Foto">
                        <i class="fas fa-camera"></i>
                    </label>
                    <input type="file" name="foto" id="foto" class="d-none" accept="image/*">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Pengguna</label>
                <input type="text" class="form-control" name="username" value="<?= esc($user['username']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" name="email" value="<?= esc($user['email']) ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3"><?= esc($user['alamat']) ?></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-gradient px-5">
                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Tambahkan sedikit styling -->
<style>
    .btn-gradient {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        border: none;
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #5a67d8, #6b46c1);
        color: #fff;
    }
</style>

<?= $this->endSection() ?>
