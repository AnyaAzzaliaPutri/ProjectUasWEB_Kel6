<?= $this->extend('templates/header') ?>
<?= $this->section('content') ?>

<style>
    .food-card {
        border: none;
        border-radius: 15px;
        padding: 25px;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .food-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        cursor: pointer;
    }

    .circle-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px auto; /* ⬅ Ini bikin benar-benar tengah */
        color: white;
        font-size: 24px;
        line-height: 1;
    }


    .circle-icon i {
        line-height: 1; /* penting */
        vertical-align: middle;
    }

    .kategori-karbohidrat { background-color: #ffc107; }
    .kategori-protein    { background-color: #28a745; }
    .kategori-sayuran    { background-color: #20c997; }
    .kategori-ikan       { background-color: #17a2b8; }
</style>


<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Daftar Makanan</h2>

    <div class="row justify-content-center">
        <?php foreach ($foods as $item): ?>
            <?php
                // Atur kelas warna icon berdasarkan kategori
                $kategori = strtolower($item['kategori']);
                $iconClass = 'fas fa-utensils';
                $bgClass = 'kategori-' . $kategori;

                // Bisa juga pakai switch jika ingin icon berbeda per kategori
                switch ($kategori) {
                    case 'karbohidrat': $iconClass = 'fas fa-bread-slice'; break;
                    case 'protein':     $iconClass = 'fas fa-drumstick-bite'; break;
                    case 'sayuran':     $iconClass = 'fas fa-leaf'; break;
                    case 'ikan':        $iconClass = 'fas fa-fish'; break;
                }
            ?>
            <div class="col-md-3 mb-4">
                <div class="food-card text-center">
                    <div class="circle-icon <?= $bgClass ?>">
                        <i class="<?= $iconClass ?> fa-lg"></i>
                    </div>
                    <h5 class="fw-bold mb-1"><?= esc($item['nama']) ?></h5>
                    <p class="text-muted mb-2"><?= esc(ucfirst($item['kategori'])) ?></p>
                    <p class="mb-1 small">Per 100g</p>
                    <p class="fw-bold text-primary fs-5"><?= esc($item['kalori']) ?> kal</p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
