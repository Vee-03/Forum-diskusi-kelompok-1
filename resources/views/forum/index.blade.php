<html class="scroll-smooth" lang="id">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Forum Sekolah</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />

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
      <h2 class="text-4xl font-extrabold text-blue-900 mb-10 text-center tracking-wide">
        Daftar Forum Diskusi Sekolah
      </h2>

      <ul class="space-y-10 max-w-5xl mx-auto">
        <!-- Forum Matematika -->
        @foreach ($forums as $forum)
        @php
            $lastActive = \Carbon\Carbon::parse($forum->terakhir_aktif);
            $diffInSeconds = now()->diffInSeconds($lastActive);
        @endphp
        <a href="{{ route('forum.show', $forum->id) }}" class="block">
        <li class="bg-white rounded-3xl shadow-lg p-8 flex flex-col md:flex-row md:items-center md:justify-between 
           hover:shadow-2xl hover:scale-[1.02] transition duration-300 ease-in-out">
          <div class="flex items-center space-x-6 mb-6 md:mb-0">
            <img
              src="{{ url('foto_forum/' . $forum->foto_forum) }}"
              alt="Ilustrasi {{ $forum->nama }}"
              class="w-28 h-28 rounded-2xl object-cover shadow-md"
            />
            <div>
              <h3 class="text-2xl font-bold text-blue-900 tracking-wide">
                {{ $forum->nama }}
              </h3>
              <p class="text-gray-700 mt-2 max-w-lg leading-relaxed">
                {{ $forum->deskripsi }}
              </p>
            </div>
          </div>
          <div class="text-gray-600 text-base flex space-x-12 md:space-x-16">
            <div class="flex items-center space-x-2">
              <i class="fas fa-comments text-blue-700 text-lg"></i>
              <span>{{ $forum->diskusi_count }}</span>
            </div>
            <div class="flex items-center space-x-2">
              <i class="fas fa-users text-blue-700 text-lg"></i>
              <span>{{ $forum->jumlah_anggota }}</span>
            </div>
            <div class="flex items-center space-x-2">
              <i class="fas fa-clock text-blue-700 text-lg"></i>
              @if ($diffInSeconds < 60)
                  <span class="text-green-500 font-semibold">Forum Online</span>
              @else
                  <span class="text-gray-500">Terakhir aktif {{ $lastActive->diffForHumans() }}</span>
              @endif
            </div>
          </div>
        </li>
        </a>
        @endforeach

    </main>

    <!-- Footer -->
    
  </body>
</html>
