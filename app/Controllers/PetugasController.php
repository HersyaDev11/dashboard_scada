<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Petugas;

class PetugasController extends BaseController
{
    public function index()
    {
        return view('v_login');
    }
    public function login()
    {

        $Datapetugas = new Petugas;
        $syarat = [
            'username' => $this->request->getPost('txtUsername'),
            'password' => md5($this->request->getPost('txtPassword'))
        ];

        $Userpetugas = $Datapetugas->where($syarat)->find();

        if (count($Userpetugas) == 1) {
            $session_data = [
                'username' => $Userpetugas[0]['username'],
                'id_petugas' => $Userpetugas[0]['id_petugas'],
                'level'    => $Userpetugas[0]['level'],
                'sudahkahLogin' => TRUE
            ];
            session()->set($session_data);
            return redirect()->to('/petugas/dashboard');
        } else {
            return redirect()->to('/petugas');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/petugas');
    }
    public function tampilPetugas()
    {
        if (!session()->get('sudahkahLogin')) {
            return redirect()->to('/petugas');
            exit;
        }

        // cek apakah yang login bukan admin ?
        if (session()->get('level') != 'admin') {
            return redirect()->to('/petugas/dashboard');
            exit;
        }

        $Datapetugas = new Petugas;
        $data['ListPetugas'] = $Datapetugas->findAll();
        return view('Petugas/tampil-petugas', $data);
    }
    public function tambahPetugas()
    {
        if (!session()->get('sudahkahLogin')) {
            return redirect()->to('/petugas');
            exit;
        }

        // cek apakah yang login bukan admin ?
        if (session()->get('level') != 'admin') {
            return redirect()->to('/petugas/dashboard');
            exit;
        }

        return view('Petugas/tambah-petugas');
    }
    public function simpanPetugas()
    {

        if (!session()->get('sudahkahLogin')) {
            return redirect()->to('/petugas');
            exit;
        }

        // cek apakah yang login bukan admin ?
        if (session()->get('level') != 'admin') {
            return redirect()->to('/petugas/dashboard');
            exit;
        }

        helper(['form']);
        $Datapetugas = new Petugas;
        $datanya = [
            'nama_petugas' => $this->request->getPost('txtInputNama'), 'username' => $this->request->getPost('txtInputUser'),
            'password' => md5($this->request->getPost(txtInputPassword)),
            'level' => $this->request->getPost('selectLevel')
        ];
        $Datapetugas->insert($datanya);
        return redirect()->to('/petugas/tampil');
    }
    public function editPetugas($idPetugas)
    {
        // cek apakah sudah login ?
        if (!session()->get('sudahkahLogin')) {
            return redirect()->to('/petugas');
            exit;
        }

        // cek apakah yang login bukan admin ?
        if (session()->get('level') != 'admin') {
            return redirect()->to('/petugas/dashboard');
            exit;
        }

        // cek apakah yang login bukan admin ?
        if (session()->get('level') != 'admin') {
            return redirect()->to('/petugas/dashboard');
            exit;
        }

        $Datapetugas = new Petugas;
        $data['detailPetugas'] = $Datapetugas->where('id_petugas', $idPetugas)->findAll();
        return view('Petugas/edit-petugas', $data);
    }
    public function updatePetugas()
    {
        // cek apakah sudah login
        if (!session()->get('sudahkahLogin')) {
            return redirect()->to('/petugas');
            exit;
        }

        // cek apakah yang login bukan admin ?
        if (session()->get('level') != 'admin') {
            return redirect()->to('/petugas/dashboard');
            exit;
        }

        $Datapetugas = new Petugas;
        if ($this->request->getPost('txtInputPassword')) {
            $data = [
                'nama_petugas' => $this->request->getPost('txtInputNama'),
                'password' => md5($this->request->getPost('txtInputPassword')),
                'level' => $this->request->getPost('selectLevel')
            ];
        } else {
            $data = [
                'nama_petugas' => $this->request->getPost('txtInputNama'),
                'level' => $this->request->getPost('selectLevel')
            ];
        }
        $Datapetugas->update($this->request->getPost('txtInputUser'), $data);
        return redirect()->to('/petugas/tampil');
    }
    public function hapusPetugas($idPetugas)
    {
        if (!session()->get('sudahkahLogin')) {
            return redirect()->to('/petugas');
            exit;
        }

        // cek apakah yang login bukan admin ?
        if (session()->get('level') != 'admin') {
            return redirect()->to('/petugas/dashboard');
            exit;
        }

        $Datapetugas = new Petugas;
        $Datapetugas->where('id_petugas', $idPetugas)->delete();
        return redirect()->to('/petugas/tampil');
    }
}
