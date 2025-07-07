<?= $this->extend('templates/header') ?>
<?= $this->section('content') ?>

<style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }
    .calculator-container {
        max-width: 700px;
        margin: 0 auto;
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #444;
    }
    label {
        font-weight: 600;
        color: #333;
    }
    input, select {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 10px;
        border: 1px solid #ccc;
    }
    .btn-kalkulasi {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        font-weight: bold;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.3s ease;
    }
    .btn-kalkulasi:hover {
        opacity: 0.9;
    }
    .hasil-kalori {
        margin-top: 20px;
        padding: 20px;
        background: #f7f7f7;
        border-radius: 15px;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
    }
</style>

<div class="container my-5">
    <div class="calculator-container">
        <h2>📊 Kalkulator Kebutuhan Kalori</h2>
        <form id="kaloriForm">
            <label for="gender">Jenis Kelamin</label>
            <select id="gender" required>
                <option value="male">Laki-laki</option>
                <option value="female">Perempuan</option>
            </select>

            <label for="age">Usia (tahun)</label>
            <input type="number" id="age" min="10" required>

            <label for="weight">Berat Badan (kg)</label>
            <input type="number" id="weight" min="10" required>

            <label for="height">Tinggi Badan (cm)</label>
            <input type="number" id="height" min="50" required>

            <label for="activity">Aktivitas Harian</label>
            <select id="activity" required>
                <option value="1.2">Sangat Ringan (tidak olahraga)</option>
                <option value="1.375">Ringan (1-3x/minggu)</option>
                <option value="1.55">Sedang (3-5x/minggu)</option>
                <option value="1.725">Berat (6-7x/minggu)</option>
                <option value="1.9">Sangat Berat (2x sehari)</option>
            </select>

            <label for="goal">Tujuan</label>
            <select id="goal" required>
                <option value="-500">Turun 0.5kg/minggu</option>
                <option value="-250">Turun 0.25kg/minggu</option>
                <option value="0" selected>Pertahankan Berat</option>
                <option value="250">Naik 0.25kg/minggu</option>
                <option value="500">Naik 0.5kg/minggu</option>
            </select>

            <button type="button" class="btn-kalkulasi" onclick="hitungKalori()">Hitung Kebutuhan Kalori</button>
        </form>

        <div class="hasil-kalori" id="hasilKalori" style="display:none;">
            Kebutuhan Kalori Harian Anda: <span id="hasilTarget">0</span> kal
        </div>
    </div>
</div>

<script>
    function hitungKalori() {
        const gender = document.getElementById('gender').value;
        const age = parseInt(document.getElementById('age').value);
        const weight = parseFloat(document.getElementById('weight').value);
        const height = parseFloat(document.getElementById('height').value);
        const activity = parseFloat(document.getElementById('activity').value);
        const goal = parseInt(document.getElementById('goal').value);

        if (!age || !weight || !height) {
            alert("Isi semua data dengan benar.");
            return;
        }

        let bmr;
        if (gender === 'male') {
            bmr = (10 * weight) + (6.25 * height) - (5 * age) + 5;
        } else {
            bmr = (10 * weight) + (6.25 * height) - (5 * age) - 161;
        }

        const tdee = bmr * activity;
        const target = Math.round(tdee + goal);

        document.getElementById('hasilTarget').innerText = target;
        document.getElementById('hasilKalori').style.display = 'block';
    }
</script>

<?= $this->endSection() ?>
