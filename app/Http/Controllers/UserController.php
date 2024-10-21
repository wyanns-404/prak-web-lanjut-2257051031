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
            $file = $request->file('foto');
            $fileName = time() . '.' . $request->foto->extension();
            $file->storeAs('uploads', $fileName, 'public');

            $this->userModel->create([
                'nama' => $request->input('nama'),
                'npm' => $request->input('npm'),
                'kelas_id' => $request->input('kelas_id'),
                'foto' => $fileName,
            ]);
        }

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
            'title' => 'Detail',
            'user' => $user,
        ];

        return view('profile', $data);
    }

    public function edit($id){
        $user = $this->userModel->findOrFail($id);
        $kelas = $this->kelasModel->getKelas();
        $title = 'Edit User';

        return view('edit_user', compact('user', 'kelas', 'title'));
    }

    public function update(Request $request, $id){
        $user = $this->userModel->findOrFail($id);

        $user->nama = $request->nama;
        $user->npm = $request->npm;
        $user->kelas_id = $request->kelas_id;

        if ($request->hasFile('foto')){
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(('uploads/img'), $fileName);
            $user->foto = 'uploads/img/'. $fileName;
        }

        $user->save();

        return redirect()->route('user.list')->with('Succes', 'User Updated Successfully');
    }

    public function destroy($id){
        $user = $this->userModel->findOrFail($id);
        $user->delete();

        return redirect()->to('/user')->with('succes', 'User has been deleted successfully');
    }
}
