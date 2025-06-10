<html class="scroll-smooth" lang="id">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Profil Pengguna - Forum Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Poppins", sans-serif;
      }
      /* Prevent text overflow in forum titles on small screens */
      @media (max-width: 640px) {
        .forum-title {
          white-space: normal !important;
          overflow-wrap: break-word !important;
          word-break: break-word !important;
        }
      }
    </style>
  </head>
  <body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <main
      class="flex-grow px-6 py-12 md:ml-64 max-w-5xl mx-auto w-full"
      style="min-height: calc(100vh - 3rem)"
    >
      <section class="bg-white rounded-3xl shadow-lg p-8">
        <!-- Profile Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between md:space-x-12">
          <div class="flex items-center space-x-6 mb-6 md:mb-0">
            @if ($users->foto_profile)
            <img
              alt="User Profile"
              class="w-36 h-36 md:w-48 md:h-48 rounded-full object-cover shadow-md"
              height="192"
              src="{{ url('foto/' . $item->foto_profile) }}"
              width="192"
            />
            @else
            <img
              alt="Default Profile"
              class="w-36 h-36 md:w-48 md:h-48 rounded-full object-cover shadow-md"
              height="192"
              src="{{ url('default.png') }}"
              width="192"
              />
            @endif
          </div>
          <div class="flex-grow text-center md:text-left">
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4 justify-center md:justify-start">
              <h1
                class="text-3xl md:text-4xl font-extrabold text-blue-900 tracking-wide break-words"
              >
                {{ '@' . $users->username }}
              </h1>
              <button
                class="mt-3 md:mt-0 px-4 py-1 border border-gray-300 rounded-md text-gray-700 font-semibold hover:bg-gray-100 transition"
                type="button"
              >
                Edit Profile
              </button>
            </div>
            
            <div
              class="flex justify-center md:justify-start space-x-8 mt-6 text-gray-700 font-semibold"
            >
              <div class="text-center">
                <span class="block text-xl font-bold text-blue-900">
                  {{ $postCount ?? 0 }}
                </span>
                <span>Postingan</span>
              </div>
              <div
                class="text-center hidden sm:block"
                title="Teman"
              >
                <span class="block text-xl font-bold text-blue-900">
                  {{ $followersCount ?? 0 }}
                </span>
                <span>Teman</span>
              </div>
              <div
                class="text-center hidden sm:block"
                title="Komentar"
              >
                <span class="block text-xl font-bold text-blue-900">
                  {{ $commentCount ?? 0 }}
                </span>
                <span>Komentar</span>
              </div>
            </div>
            <p
              class="mt-6 text-gray-700 text-lg max-w-xl mx-auto md:mx-0 leading-relaxed"
            >
              {{ $user->description ?? 'Belum ada deskripsi.' }}
            </p>
            <div
              class="mt-6 flex flex-col md:flex-row md:space-x-8 text-gray-600 text-base max-w-xl mx-auto md:mx-0"
            >
              <div class="flex items-center space-x-3 mb-3 md:mb-0 justify-center md:justify-start">
                <i class="fas fa-user text-blue-700 text-xl w-6"></i>
                <span class="break-all">{{ $users->nama_lengkap }}</span>
              </div>
              <div class="flex items-center space-x-3 justify-center md:justify-start">
                <i class="fas fa-envelope text-blue-700 text-xl w-6"></i>
                <span class="break-all">{{ $users->email }}</span>
              </div>
            </div>
          </div>
        </div>

        <hr class="my-10 border-gray-300" />

        <section>
          <h4
            class="text-2xl font-semibold text-blue-900 mb-6 tracking-wide"
          >
            Aktivitas Terbaru
          </h4>
          <ul class="space-y-6">
          @foreach ($aktivitas as $aktiv)
          <li class="bg-blue-50 rounded-3xl p-6 shadow-inner flex flex-col md:flex-row md:justify-between md:items-center">
            <div class="max-w-xl truncate">
              @if ($aktiv->type == 'diskusi')
                  <h5 class="text-xl font-semibold text-blue-900 mb-2 truncate">
                    Membuat diskusi baru: "{{ $aktiv->title }}"
                  </h5>
                  {{-- Bisa tambah ringkasan --}}
              @elseif ($aktiv->type == 'komentar')
                  <h5 class="text-xl font-semibold text-blue-900 mb-2 truncate">
                    Mengomentari diskusi: "{{ $aktiv->diskusi->judul ?? 'Diskusi Tidak Diketahui' }}"
                  </h5>
                  <p class="text-gray-700 leading-relaxed line-clamp-2">
                    {{ Str::limit($aktiv->isi, 100) }}
                  </p>
              @endif
            </div>
            <time class="text-gray-500 text-sm mt-4 md:mt-0 md:ml-6 whitespace-nowrap">
              {{ $aktiv->created_at->diffForHumans() }}
            </time>
          </li>
          @endforeach
          </ul>

        </section>

        <hr class="my-10 border-gray-300" />

        <section>
          <h4 class="text-2xl font-semibold text-blue-900 mb-6 tracking-wide">
            Forum Diikuti
          </h4>
          <ul class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @forelse ($forums as $forum)
            <a href="{{ route('forum.show', $forum->id) }}" class="block">
            <li class="bg-white rounded-3xl shadow-lg p-4 flex items-center space-x-4 hover:shadow-2xl hover:scale-[1.02] transition duration-300 ease-in-out">
              <img
                alt="{{ $forum->nama }}"
                class="w-16 h-16 rounded-2xl object-cover shadow-md"
                height="64"
                src="{{ url('foto_forum/' . $forum->foto_forum) }}"
                width="64"
              />
              <div class="min-w-0">
                <h5 class="text-lg font-bold text-blue-900 tracking-wide forum-title truncate">
                  {{ $forum->nama }}
                </h5>
                <p class="text-gray-700 mt-0.5 truncate">
                  {{ $forum->jumlah_diskusi ?? 0 }} Diskusi • {{ $forum->jumlah_anggota ?? 0 }} Anggota
                </p>
              </div>
            </li>
            @empty
            <p class="text-gray-500">Belum mengikuti forum apapun.</p>
            @endforelse
          </ul>
      </section>

        <div class="px-6 py-6 border-t ">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 transition duration-200 ease-in-out active:scale-95 hover:scale-105 text-white font-semibold py-3 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-white transform">
                    Log Out
                  </button>
                </form>
              </div>
      </section>
    </main>
  </body>
</html>