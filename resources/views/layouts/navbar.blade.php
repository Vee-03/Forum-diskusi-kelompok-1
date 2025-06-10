<header class="bg-blue-900 text-white shadow transition-all duration-300 ease-in-out">
  <!-- Modal Logout -->
  <div id="logoutModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden justify-center items-center">
    <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-xl text-gray-800">
      <h2 class="text-2xl font-extrabold mb-4 text-blue-900 text-center select-none">Konfirmasi Logout</h2>
      <p class="mb-6 text-center text-gray-700 leading-relaxed select-none">Apakah Anda yakin ingin keluar dari akun Anda?</p>

      <div class="flex justify-center gap-4">
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="inline-flex items-center">
          @csrf
          <button type="submit"
            class="px-5 py-2 rounded-xl bg-red-600 text-white hover:bg-red-700 hover:scale-105 transition duration-200 ease-in-out font-semibold focus:outline-none focus:ring-2 focus:ring-red-700 transform">
            Logout
          </button>
        </form>
        <button onclick="closeModal()"
          class="inline-flex items-center px-5 py-2 rounded-xl bg-gray-300 hover:bg-gray-400 hover:scale-105 transition duration-200 ease-in-out font-semibold focus:outline-none focus:ring-2 focus:ring-blue-900 transform">
          Batal
        </button>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <div class="container mx-auto px-6 py-4 flex items-center justify-between">
    <!-- Logo dan Judul -->
    <a href="#" class="flex items-center space-x-3 focus:outline-none focus:ring-2 focus:ring-white rounded">
      <img
        src="https://storage.googleapis.com/a1aa/image/c2167073-3e4e-4465-08d7-9c74900fd1f6.jpg"
        alt="School Logo"
        class="w-14 h-14 object-contain rounded-full border-2 border-blue-700 shadow-md"
      />
      <span class="text-2xl font-bold tracking-wide select-none">Forum SMK 1 Garut</span>
    </a>

    <!-- Menu dan Tombol -->
    <div class="flex items-center space-x-6">
      <!-- Navbar Desktop -->
      <nav class="hidden md:flex space-x-8 font-semibold text-lg">
        <a href="{{ route('forum')}}" class="hover:text-blue-300 hover:scale-105 transition duration-200 ease-in-out transform px-2 py-1 focus:outline-none focus:ring-2 focus:ring-white rounded">Beranda</a>
        <a href="#" class="hover:text-blue-300 hover:scale-105 transition duration-200 ease-in-out transform px-2 py-1 focus:outline-none focus:ring-2 focus:ring-white rounded">Diskusi</a>
        <a href="#" class="hover:text-blue-300 hover:scale-105 transition duration-200 ease-in-out transform px-2 py-1 focus:outline-none focus:ring-2 focus:ring-white rounded">Pengumuman</a>
        <a href="{{ route('profile')}}" class="hover:text-blue-300 hover:scale-105 transition duration-200 ease-in-out transform px-2 py-1 focus:outline-none focus:ring-2 focus:ring-white rounded">Profil</a>
        @auth
          @if(auth()->user()->role === 'admin')
            <a href="{{ route('dashboard') }}" class="block hover:text-blue-300 hover:scale-105 transition duration-200 ease-in-out font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-white rounded px-2 py-1">Admin Page</a>
          @endif
        @endauth
      </nav>

      <!-- Tombol Logout Desktop -->
        <button type="button" onclick="openModal()"
        class="hidden md:inline-block bg-blue-700 hover:bg-blue-800 hover:scale-105 transition duration-200 ease-in-out text-white font-semibold py-2 px-5 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-white transform">
        Log Out
        </button>


      <!-- Tombol Hamburger -->
      <button id="menu-btn" aria-label="Toggle menu"
        class="md:hidden focus:outline-none focus:ring-2 focus:ring-white rounded p-1">
        <i class="fas fa-bars text-3xl"></i>
      </button>
    </div>
  </div>

  <!-- Navbar Mobile -->
  <nav id="mobile-menu"
    class="hidden bg-blue-900 text-white px-6 py-4 space-y-4 md:hidden transition-all duration-300">
    <a href="#" class="block hover:text-blue-300 hover:scale-105 transition duration-200 ease-in-out font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-white rounded px-2 py-1">Beranda</a>
    <a href="#" class="block hover:text-blue-300 hover:scale-105 transition duration-200 ease-in-out font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-white rounded px-2 py-1">Diskusi</a>
    <a href="#" class="block hover:text-blue-300 hover:scale-105 transition duration-200 ease-in-out font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-white rounded px-2 py-1">Pengumuman</a>
    <a href="#" class="block hover:text-blue-300 hover:scale-105 transition duration-200 ease-in-out font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-white rounded px-2 py-1">Profil</a>
    @auth
      @if(auth()->user()->role === 'admin')
        <a href="{{ route('dashboard') }}" class="block hover:text-blue-300 hover:scale-105 transition duration-200 ease-in-out font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-white rounded px-2 py-1">Admin Page</a>
      @endif
    @endauth
    <!-- Tombol Logout Mobile -->
    <button type="button" onclick="openModal()"
  class="w-full bg-blue-700 hover:bg-blue-800 transition duration-150 ease-in-out active:scale-95 hover:scale-105 text-white font-semibold py-2 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-white transform">
  Log Out
</button>

  </nav>
</header>

<script>
  function openModal() {
    const modal = document.getElementById('logoutModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closeModal() {
    const modal = document.getElementById('logoutModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  const menuBtn = document.getElementById("menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");

  menuBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
  });
</script>
