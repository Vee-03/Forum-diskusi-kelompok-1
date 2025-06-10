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
        <main class="ml-64 px-6 py-12 flex-grow max-w-5xl w-full mx-auto">
            @yield('content')
        </main>

    <!-- Footer -->
  </body>
</html>
