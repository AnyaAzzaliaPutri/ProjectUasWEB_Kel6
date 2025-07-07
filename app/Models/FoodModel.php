<?php

namespace App\Models;

use CodeIgniter\Model;

class FoodModel extends Model
{
    protected $table            = 'foods';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'user_id',
        'nama_makanan',
        'jumlah',
        'kalori',
        'waktu_makan',
        'created_at'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = ''; // kosong karena tidak pakai updated_at

    /**
     * Ambil semua makanan user di tanggal tertentu
     */
    public function getFoodsByDate($userId, $date)
    {
        return $this->where('user_id', $userId)
                    ->where('DATE(created_at)', $date)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Total kalori hari ini
     */
    public function getTotalKaloriHariIni($userId)
    {
        $result = $this->selectSum('kalori')
                       ->where('user_id', $userId)
                       ->where('DATE(created_at)', date('Y-m-d'))
                       ->first();

        return $result['kalori'] ?? 0;
    }

    /**
     * Jumlah item hari ini
     */
    public function getJumlahItemHariIni($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('DATE(created_at)', date('Y-m-d'))
                    ->countAllResults();
    }

    /**
     * Total kalori untuk 7 hari terakhir
     */
    public function getKaloriMingguan($userId)
    {
        return $this->select("DATE(created_at) as tanggal, SUM(kalori) as total_kalori")
                    ->where('user_id', $userId)
                    ->where('created_at >=', date('Y-m-d', strtotime('-6 days')))
                    ->groupBy('DATE(created_at)')
                    ->orderBy('tanggal', 'ASC')
                    ->findAll();
    }

    /**
     * Opsional: Total kalori tanggal tertentu
     */
    public function getKaloriPerTanggal($userId, $date)
    {
        return $this->selectSum('kalori')
                    ->where('user_id', $userId)
                    ->where('DATE(created_at)', $date)
                    ->first()['kalori'] ?? 0;
    }

    /**
     * Opsional: Ambil semua makanan user (semua tanggal)
     */
    public function getAllByUser($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}
