<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    /**
     * Halaman login
     */
    public function index()
    {
        // Jika sudah login, arahkan ke dashboard
        if (session()->has('user_id')) {
            return redirect()->to('/dashboard');
        }

        return view('login');
    }

    /**
     * Proses login
     */
    public function login()
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('user_id', $user['id']);
            session()->set('username', $user['username']);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Data tidak valid atau password tidak cocok')->withInput();
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    /**
     * Halaman register
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Proses registrasi
     */
    public function registerPost()
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirm  = $this->request->getPost('confirm_password');

        // Validasi input kosong
        if (empty($username) || empty($password) || empty($confirm)) {
            return redirect()->back()->with('error', 'Semua field wajib diisi')->withInput();
        }

        // Cek password sama
        if ($password !== $confirm) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak cocok')->withInput();
        }

        // Cek username sudah ada
        if ($model->where('username', $username)->first()) {
            return redirect()->back()->with('error', 'Username sudah digunakan')->withInput();
        }

        // Simpan user
        $model->save([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        // Redirect ke login dengan pesan sukses
        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
