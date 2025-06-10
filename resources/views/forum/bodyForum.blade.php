<html class="scroll-smooth" lang="id">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Daftar Diskusi {{ $forums->nama}}
  </title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com">
  </script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
        font-family: "Poppins", sans-serif;
      }
  </style>
 </head>
 <body class="bg-gray-100 min-h-screen flex flex-col">
  <!-- Sidebar -->
  @include('layouts.sidebar')
  <!-- Main Content -->
  <main class="ml-64 px-6 py-12 flex-grow">

    <div class="mb-10 relative">
      <!-- Tombol Back di kiri -->
      <a href="{{ route('forum') }}" 
        class="absolute left-0 top-1/2 transform -translate-y-1/2 inline-flex items-center px-4 py-2 bg-blue-900 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-md transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali
      </a>

      <!-- Judul Tetap di Tengah -->
      <h2 class="text-4xl font-extrabold text-blue-900 tracking-wide text-center">
        Daftar Diskusi {{ $forums->nama}}
      </h2>
      <!-- Tombol Aksi -->
      @if(Auth::user()->followedForums->contains($forums->id))
          <!-- Tombol Buka Modal -->
          <button type="button"
              onclick="document.getElementById('unfollowModal').classList.remove('hidden')"
              class="absolute right-0 top-1/2 transform -translate-y-1/2 inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-md transition duration-300">
              Berhenti Ikuti <i class="fas fa-times ml-2"></i>
          </button>
      @else
          <!-- Tombol Ikuti -->
          <form action="{{ route('forum.follow', $forums->id) }}" method="POST"
              class="absolute right-0 top-1/2 transform -translate-y-1/2">
              @csrf
              <button type="submit"
                  class="inline-flex items-center px-4 py-2 bg-blue-900 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-md transition duration-300">
                  Ikuti Forum <i class="fas fa-plus ml-2"></i>
              </button>
          </form>
      @endif


      <!-- Modal Konfirmasi Berhenti Ikuti -->
    <div id="unfollowModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-80">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi</h3>
            <p class="text-sm text-gray-700 mb-6">Apakah kamu yakin ingin berhenti mengikuti forum ini?</p>

            <div class="flex justify-end space-x-3">
                <!-- Tombol Batal -->
                <button onclick="document.getElementById('unfollowModal').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white text-sm font-semibold rounded">
                    Batal
                </button>

                <!-- Form Unfollow -->
                <form action="{{ route('forum.unfollow', $forums->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded">
                        Ya, Berhenti
                    </button>
                </form>
            </div>
        </div>
    </div>


    </div>






      <ul class="space-y-10 max-w-5xl mx-auto">
        <!-- Forum Matematika -->
         @if ($diskusi->isEmpty())
            <li class="text-center text-gray-600 text-lg py-10">
                Belum ada diskusi di forum ini.
            </li>
        @else
        @foreach ($diskusi as $item)
        <a href="{{ route('diskusi.show', $item->id) }}" class="block">
        <li class="bg-white rounded-3xl shadow-lg p-8 flex flex-col md:flex-row md:items-center md:justify-between 
           hover:shadow-2xl hover:scale-[1.02] transition duration-300 ease-in-out">
          <div class="flex items-center space-x-6 mb-6 md:mb-0">
            @if ($item->foto_diskusi)
            <img
              src="{{ url('foto_diskusi/' . $item->foto_diskusi) }}"
              alt="Ilustrasi "
              class="w-28 h-28 rounded-2xl object-cover shadow-md"
            />
            @endif
            <div>
              <h3 class="text-2xl font-bold text-blue-900 tracking-wide">
                {{ $item->judul }}
              </h3>
              @if ($item->isi)
              <p class="text-gray-700 mt-2 max-w-lg leading-relaxed">
                {{ $item->isi }}
              </p>
              @endif
            </div>
          </div>
          <div class="text-gray-600 text-base flex space-x-12 md:space-x-16">
            <div class="flex items-center space-x-2">
              <i class="fas fa-user text-blue-700 text-lg"></i>
              <span>{{ '@' . ($item->user->username ?? $item->user->nama_lengkap) }}</span>
            </div>
            <div class="flex items-center space-x-2">
              <i class="fas fa-comments text-blue-700 text-lg"></i>
              <span>{{ $item->komentar_count ?? 0 }}</span>
            </div>
            <div class="flex items-center space-x-2">
              <i class="fas fa-clock text-blue-700 text-lg"></i>
                  <span>Dibuat {{ $item->created_at->diffForHumans() }}</span>
            </div>
          </div>
        </li>
        </a>
        @endforeach
        @endif
    </ul>

    </main>
  <!-- Footer -->

  </footer>
 </body>
</html>
