@extends('layouts.appmin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3">Forum List</h6>
                        <a href="{{ route('forumAdmin.create') }}" class="btn btn-outline-light btn-sm me-3">
                            Add Data
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Diskusi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Anggota</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terakhir Aktif</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($forums as $item)
                                    <tr>
                                        {{-- Foto --}}
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if ($item->foto_forum)
                                                        <img class="avatar avatar-sm bg-gradient-dark me-3" src="{{ url('foto_forum/' . $item->foto_forum) }}" alt="Foto Forum">
                                                    @else
                                                        <img class="avatar avatar-sm bg-gradient-dark me-3" src="{{ url('default.png') }}" alt="Default Foto">
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Nama --}}
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->nama }}</p>
                                        </td>

                                        {{-- Judul --}}
                                        <td>
                                            <p class="text-xs text-secondary mb-0">{{ $item->judul }}</p>
                                        </td>

                                        {{-- Deskripsi --}}
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->deskripsi }}</span>
                                        </td>

                                        {{-- Jumlah Diskusi --}}
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->jumlah_diskusi }}</span>
                                        </td>

                                        {{-- Jumlah Anggota --}}
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->jumlah_anggota }}</span>
                                        </td>

                                        {{-- Terakhir Aktif --}}
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->terakhir_aktif }}</span>
                                        </td>

                                        {{-- Action --}}
                                        <td class="align-middle text-center">
                                            <a href="{{ url('forumAdmin/' . $item->id . '/edit') }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">Edit</a>
                                            |
                                            <form action="{{ url('forum/' . $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
