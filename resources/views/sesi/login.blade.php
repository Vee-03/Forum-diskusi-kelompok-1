<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #e6ebf8;
      min-height: 100vh;
      position: relative;
      padding-top: 4rem;
    }
  </style>
</head>
<body class="flex justify-center items-center p-6 min-h-screen relative">

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


  <div
    class="flex flex-col w-full max-w-md rounded-3xl shadow-md overflow-hidden bg-white p-10"
  >
    <div class="flex flex-col items-center mb-4">
      <img
        alt="School Logo, a blue and white emblem with a book and torch symbolizing education"
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
      Login
    </h1>

    <div class="flex justify-center space-x-6 mb-8">
      <button
        aria-label="Login with Google"
        class="flex items-center justify-center w-12 h-12 border border-gray-300 rounded-lg text-gray-800 font-semibold hover:bg-gray-100 transition shadow-sm"
        type="button"
      >
        <i class="fab fa-google text-2xl text-red-600"></i>
      </button>
      <button
        aria-label="Login with Facebook"
        class="flex items-center justify-center w-12 h-12 border border-gray-300 rounded-lg text-gray-800 font-semibold hover:bg-gray-100 transition shadow-sm"
        type="button"
      >
        <i class="fab fa-facebook-f text-2xl text-blue-800"></i>
      </button>
    </div>

    <p class="text-xs font-semibold text-center text-gray-600 mb-6 tracking-wide">
      or use your email password
    </p>

    <form action="{{route('sesi.login')}}" method="POST" class="flex flex-col space-y-5">
        @csrf
      <input
        class="w-full py-3 px-5 rounded-xl bg-gray-100 placeholder-gray-600 text-sm font-semibold border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-900 transition shadow-sm"
        placeholder="Username"
        type="text"
        name='username'
        required
      />
      <input
        class="w-full py-3 px-5 rounded-xl bg-gray-100 placeholder-gray-600 text-sm font-semibold border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-900 transition shadow-sm"
        placeholder="Password"
        type="password"
        name="password"
        required
      />
      <p
        class="text-xs font-semibold text-blue-900 cursor-pointer hover:underline text-right"
      >
        Forget Your Password?
      </p>

      <div class="flex flex-col sm:flex-row justify-between mt-6 gap-4">
        <button
          class="bg-blue-900 text-white text-sm font-semibold py-2 px-8 rounded-xl shadow hover:bg-blue-800 transition flex-1"
          type="submit"
        >
          LOGIN
        </button>
        <a
          href="{{ route('sesi.register')}}"
          class="text-center bg-transparent border border-blue-900 text-blue-900 text-sm font-semibold py-2 px-8 rounded-xl shadow hover:bg-blue-900 hover:text-white transition flex-1"
          role="button"
        >
          DAFTAR
        </a>
      </div>
    </form>
  </div>

  <style>
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-10px);}
      to {opacity: 1; transform: translateY(0);}
    }
    .animate-fadeIn {
      animation: fadeIn 0.3s ease forwards;
    }
  </style>
</body>
</html>