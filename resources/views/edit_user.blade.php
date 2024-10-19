
@extends('layouts.app')

@section('content')

    <div class="container flex justify-center items-center h-screen bg-gradient-to-r from-blue-950 to-blue-900">

        <div class="bg-black/30 p-10 w-96 rounded-xl">
            <div class="block mb-7 text-xl font-medium text-gray-900 dark:text-white text-center">
                Edit User
            </div>
            <div class="w-full flex mb-1 justify-center">
                @if ($user->foto)
                    <img src="{{ asset($user->foto) }}" alt="User Photo" width="100" class="rounded-full border-4 mb-5">
                @endif
            </div>
            <form action="{{ route('user.update', $user->id) }}" method="POST" class="max-w-sm mx-auto" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    @foreach ($errors->get('nama') as $msg)
                        <p class="block mb-2 mt-1 text-sm font-medium text-red-600 text-center">{{ $msg }}</p>
                    @endforeach
                </div>
                <div class="mb-5">
                    <label for="kelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                    {{-- <input type="text" name="kelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required /> --}}
                    <select name="kelas_id" id="kelas_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($kelas as $kelasItem)
                            <option value="{{ $kelasItem->id }}"
                                {{ $kelasItem->id == $user->kelas_id ? 'selected' : '' }}>
                                {{ $kelasItem->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label for="npm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NPM</label>
                    <input type="text" name="npm" id="npm" value="{{ old('npm', $user->npm) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    @foreach ($errors->get('npm') as $msg)
                        <p class="block mb-2 mt-1 text-sm font-medium text-red-600 text-center">{{ $msg }}</p>
                    @endforeach
                </div>
                <div class="mb-5">
                    <label for="foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto</label>
                    <input type="file" id="foto" name="foto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>

    </div>

@endsection