@extends('layouts.appmin')

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <form action="{{ route('diskusiAdmin') }}" method="GET" class="d-flex align-items-center mb-3" style="gap: 8px;">
                <label for="forum_id" class="me-2 fw-semibold" style="min-width: 110px;">Filter Forum:</label>

                <select name="forum_id" id="forum_id" 
                    class="form-control" 
                    style="width: 220px; height: 36px; padding: 4px 12px; line-height: 1.5;">
                    <option value="">-- Semua Forum --</option>
                    @foreach ($forums as $forum)
                        <option value="{{ $forum->id }}" {{ request('forum_id') == $forum->id ? 'selected' : '' }}>
                            {{ $forum->nama }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary" style="height: 36px; padding: 0 16px;">
                    Filter
                </button>

                @if(request('forum_id'))
                    <a href="{{ route('diskusiAdmin') }}" class="btn btn-outline-secondary" style="height: 36px; padding: 0 16px;">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Tabel Diskusi -->
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3">Diskusi List</h6>
                        <a href="{{ route('diskusiAdmin.create') }}" class="btn btn-outline-light btn-sm me-3">
                            Add Data
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto Diskusi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Diskusi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Isi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Forum</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pembuat</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Komentar</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dibuat</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diskusi as $item)
                                    <tr>
                                        {{-- Foto --}}
                                        <td>
                                            <div class="d-flex px-2 py-1 justify-content-center">
                                                <div>
                                                    @if ($item->foto_diskusi)
                                                        <img class="avatar avatar-sm bg-gradient-dark me-3" src="{{ url('foto_diskusi/' . $item->foto_diskusi) }}" alt="Foto Diskusi">
                                                    @else
                                                        <span class="text-secondary text-xs font-weight-bold text-center">Tidak ada foto</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Judul --}}
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->judul }}</span>
                                        </td>
                                        
                                        {{-- Isi --}}
                                        <td class="align-middle text-center text-sm">
                                            @if ($item->isi)
                                                <span class="text-secondary text-xs font-weight-bold">{{ $item->isi }}</span>
                                            @else
                                                <span class="text-secondary text-xs font-weight-bold">Tidak ada isi</span>
                                            @endif
                                        </td>
                                        
                                        {{-- Forum --}}
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->forum->nama }}</span>
                                        </td>

                                        {{-- Pembuat --}}
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ '@' . ($item->user->username ?? $item->user->nama_lengkap) }}</span>
                                        </td>

                                        {{-- Jumlah Komentar --}}
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->komentar_count ?? 0 }}</span>
                                        </td>

                                        {{-- Dibuat --}}
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->created_at->diffForHumans() }}</span>
                                        </td>

                                        {{-- Action --}}
                                        <td class="align-middle text-center">
                                            <a href="{{ url('diskusiAdmin/' . $item->id . '/edit') }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">Edit</a>
                                            |
                                            <form action="{{ url('diskusi/' . $item->id) }}" method="POST" style="display:inline;">
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
