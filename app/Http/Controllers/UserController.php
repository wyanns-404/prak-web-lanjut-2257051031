<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\UserModel;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function index()
    {
        $data = [
            'title' => 'List Users',
            'users' => $this->userModel->getUser(),
        ];

        return view('list_user', $data);
    }

    public function profile($nama = "", $kelas = "", $npm = "")
    {
        $data = [
            'nama' => $nama,
            'kelas' => $kelas,
            'npm' => $npm,
        ];

        return view('profile', $data);
    }

    public function create()
    {
        $kelas = $this->kelasModel->getKelas();

        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];

        return view('create_user', $data);
    }

    public function store(UserRequest $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')){
            $foto = $request->file('foto');
            $fileName = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->move(('uploads/img'), $fileName);
        } else {
            $fotoPath = null;
        }

        $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
            'foto' => $fotoPath,
        ]);


        return redirect()->to('/user')->with('success', 'User Berhasil ditambahkan');

        // return view('profile', [
        //     'nama' => $user->nama,
        //     'npm' => $user->npm,
        //     'nama_kelas' => $user->kelas->nama_kelas ?? 'Kelas tidak ditemukan.'
        // ]);
    }

    public function show($id){
        $user = $this->userModel->getUser($id);

        $data = [
            'title' => 'Profile',
            'user' => $user,
        ];

        return view('profile', $data);
    }
}
