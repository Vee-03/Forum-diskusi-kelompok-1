<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #e6ebf8;
      min-height: 100vh;
    }
    @keyframes fadeDown {
      from {opacity: 0; transform: translateY(-20px);}
      to {opacity: 1; transform: translateY(0);}
    }
    .animate-fadeIn {
      animation: fadeDown 0.3s ease-out forwards;
    }
  </style>
</head>
<body class="flex justify-center items-center p-6 relative">

  {{-- Notifikasi Error (Tengah atas) --}}
  @if(session('error'))
    <div
      class="fixed top-4 inset-x-0 mx-auto z-50 max-w-md w-full bg-red-600 text-white rounded-lg shadow-lg p-4 flex items-start space-x-3 animate-fadeIn"
      role="alert"
      aria-live="assertive"
      aria-atomic="true"
    >
      <i class="fas fa-exclamation-circle mt-1 text-xl flex-shrink-0"></i>
      <div class="flex-1">
        <p class="font-semibold mb-1">Error</p>
        <p class="text-sm">{{ session('error') }}</p>
      </div>
      <button
        aria-label="Close notification"
        class="text-white hover:text-gray-200 transition ml-3 flex-shrink-0"
        onclick="this.parentElement.style.display='none';"
      >
        <i class="fas fa-times"></i>
      </button>
    </div>
  @endif

  <div class="flex flex-col w-full max-w-md rounded-3xl shadow-md overflow-hidden bg-white p-10">
    <!-- School logo and name -->
    <div class="flex flex-col items-center mb-4">
      <img
        alt="School Logo"
        class="w-24 h-24 object-contain rounded-full border-4 border-blue-900 shadow-md mb-2"
        src="https://storage.googleapis.com/a1aa/image/c2167073-3e4e-4465-08d7-9c74900fd1f6.jpg"
        width="96"
        height="96"
      />
      <h3 class="text-2xl font-bold text-blue-900 tracking-wide">
        Forum SMK Negeri 1 Garut
      </h3>
    </div>

    <h1 class="text-4xl font-extrabold text-center text-blue-900 mb-6 tracking-wide relative before:absolute before:-bottom-3 before:left-1/2 before:-translate-x-1/2 before:w-20 before:h-1 before:rounded-full before:bg-blue-900">
      Daftar
    </h1>

    <form action="{{ route('sesi.register') }}" class="flex flex-col space-y-5" method="POST">
      @csrf
      <input
        class="w-full py-3 px-5 rounded-xl bg-gray-100 placeholder-gray-600 text-sm font-semibold border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-900 transition shadow-sm"
        placeholder="Username"
        type="text"
        name="username"
        value="{{ old('username') }}"
        required
      />
      <input
        class="w-full py-3 px-5 rounded-xl bg-gray-100 placeholder-gray-600 text-sm font-semibold border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-900 transition shadow-sm"
        placeholder="Nama Lengkap"
        type="text"
        name="nama_lengkap"
        value="{{ old('nama_lengkap') }}"
        required
      />
      <input
        class="w-full py-3 px-5 rounded-xl bg-gray-100 placeholder-gray-600 text-sm font-semibold border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-900 transition shadow-sm"
        placeholder="Email"
        type="email"
        name="email"
        value="{{ old('email') }}"
        required
      />
      <input
        class="w-full py-3 px-5 rounded-xl bg-gray-100 placeholder-gray-600 text-sm font-semibold border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-900 transition shadow-sm"
        placeholder="Password"
        type="password"
        name="password"
        required
      />
      
      <div class="flex justify-center mt-6">
        <button
          class="bg-blue-900 text-white text-sm font-semibold py-2 px-16 rounded-xl shadow hover:bg-blue-800 transition w-full max-w-xs"
          type="submit"
        >
          DAFTAR
        </button>
      </div>
    </form>
  </div>
</body>
</html>
