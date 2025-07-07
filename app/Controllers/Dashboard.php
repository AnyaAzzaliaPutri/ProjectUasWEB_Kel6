<?php

namespace App\Controllers;

use App\Models\FoodModel;
use App\Models\UserModel;
use App\Models\ExerciseModel;


class Dashboard extends BaseController
{
    public function index()
    {
        // Redirect jika belum login
        if (!session()->get('user_id')) return redirect()->to('/login');

        $userId = session()->get('user_id');

        $foodModel = new FoodModel();
        $userModel = new UserModel();

        // Ambil data user dan target kalori default jika kosong
        $user = $userModel->find($userId);
        $targetKalori = $user['target_kalori'] ?? 2200;

        // Data harian
        $foods = $foodModel->getFoodsByDate($userId, date('Y-m-d'));
        $totalKalori = $foodModel->getTotalKaloriHariIni($userId);
        $jumlahItem = $foodModel->getJumlahItemHariIni($userId);

        // Data mingguan untuk grafik
        $mingguan = $foodModel->getKaloriMingguan($userId);

        $labels = [];
        $values = [];

        for ($i = 6; $i >= 0; $i--) {
            $tgl = date('Y-m-d', strtotime("-$i days"));
            $labels[] = $this->konversiHari(date('D', strtotime($tgl)));

            $match = array_filter($mingguan, fn($d) => $d['tanggal'] == $tgl);
            $values[] = $match ? array_values($match)[0]['total_kalori'] : 0;
        }

        return view('dashboard', [
            'foods' => $foods,
            'totalKalori' => $totalKalori,
            'jumlahItem' => $jumlahItem,
            'targetKalori' => $targetKalori,
            'chartLabels' => json_encode($labels),
            'chartData' => json_encode($values),
        ]);
    }

    public function tambah()
    {
        if (!session()->get('user_id')) return redirect()->to('/login');

        $foodModel = new FoodModel();

        $foodModel->save([
            'user_id'       => session()->get('user_id'),
            'nama_makanan'  => $this->request->getPost('nama_makanan'),
            'jumlah'        => $this->request->getPost('jumlah'),
            'kalori'        => $this->request->getPost('kalori'),
            'waktu_makan'   => $this->request->getPost('waktu_makan')
        ]);

        return redirect()->to('/dashboard');
    }

    public function history()
    {
        if (!session()->get('user_id')) return redirect()->to('/login');

        $userId = session()->get('user_id');
        $foodModel = new FoodModel();

        $histories = $foodModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('history', ['histories' => $histories]);
    }

    public function daftarMakanan()
    {
        if (!session()->get('user_id')) return redirect()->to('/login');

        $foods = [
            ['nama' => 'Nasi Putih',     'kategori' => 'Karbohidrat', 'kalori' => 175],
            ['nama' => 'Ayam Panggang',  'kategori' => 'Protein',     'kalori' => 165],
            ['nama' => 'Tahu Goreng',    'kategori' => 'Protein',     'kalori' => 130],
            ['nama' => 'Brokoli Rebus',  'kategori' => 'Sayuran',     'kalori' => 35],
            ['nama' => 'Ikan Bakar',     'kategori' => 'Ikan',        'kalori' => 140],
            ['nama' => 'Kentang Rebus',  'kategori' => 'Karbohidrat', 'kalori' => 90],
            ['nama' => 'Tempe Goreng',   'kategori' => 'Protein',     'kalori' => 150],
            ['nama' => 'Bayam Rebus',    'kategori' => 'Sayuran',     'kalori' => 30],
        ];

        return view('dashboard/daftar_makanan', ['foods' => $foods]);
    }


    private function konversiHari($en)
    {
        return [
            'Mon' => 'Sen', 'Tue' => 'Sel', 'Wed' => 'Rab',
            'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab', 'Sun' => 'Min'
        ][$en] ?? $en;
    }
    public function kalkulatorKalori()
    {
        if (!session()->get('user_id')) return redirect()->to('/login');
        return view('dashboard/kalkulator_kalori');
    }
    
    public function updateTargetKalori()
    {
        if (!session()->get('user_id')) return redirect()->to('/login');

        $userModel = new \App\Models\UserModel();
        $userId = session()->get('user_id');
        $targetKalori = $this->request->getPost('target_kalori');

        if ($targetKalori && is_numeric($targetKalori)) {
            $userModel->update($userId, ['target_kalori' => $targetKalori]);
        }

        return redirect()->to('/dashboard');
    }

    public function tambahOlahraga()
    {
        if (!session()->get('user_id')) return redirect()->to('/login');

        $exerciseModel = new ExerciseModel();

        $exerciseModel->save([
            'user_id'       => session()->get('user_id'),
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'durasi'        => $this->request->getPost('durasi'),
            'kalori'        => $this->request->getPost('kalori'),
        ]);

        return redirect()->to('/dashboard');
    }

    public function profile()
        {
            if (!session()->get('user_id')) return redirect()->to('/login');

            $userModel = new \App\Models\UserModel();
            $user = $userModel->find(session()->get('user_id'));

            return view('dashboard/profile', ['user' => $user]);
        }

        public function updateProfile()
        {
            if (!session()->get('user_id')) return redirect()->to('/login');

            $userModel = new \App\Models\UserModel();
            $userId = session()->get('user_id');

            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'alamat' => $this->request->getPost('alamat'),
            ];

            // Handle foto jika ada
            $file = $this->request->getFile('foto');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/', $newName);
                $data['foto'] = 'uploads/' . $newName;
            }

            $userModel->update($userId, $data);
            return redirect()->to('/dashboard/profile');
        }

}
