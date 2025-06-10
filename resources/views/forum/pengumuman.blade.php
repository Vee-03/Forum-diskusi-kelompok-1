<html class="scroll-smooth" lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Forum SMEA - Pengumuman & Notifikasi
  </title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
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
 <body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
  @include('layouts.sidebar')
  <!-- Main content -->
  <main class="flex-1 ml-0 md:ml-64 p-6 max-w-7xl mx-auto">
   <header class="mb-8">
    <h1 class="text-3xl font-bold text-blue-900">
     Pengumuman &amp; Notifikasi
    </h1>
    <p class="text-gray-700 mt-1">
     Lihat notifikasi dan pengumuman terbaru dari forum dan publisher resmi.
    </p>
   </header>
   <nav aria-label="Tab navigation" class="mb-8 border-b border-gray-300 max-w-4xl mx-auto">
    <ul class="flex space-x-4 text-lg font-semibold text-blue-900">
     <li>
      <button aria-selected="true" class="tab-button border-b-4 border-blue-900 pb-2 focus:outline-none" data-tab="notifications" type="button">
       Notifikasi
      </button>
     </li>
     <li>
      <button aria-selected="false" class="tab-button border-b-4 border-transparent pb-2 hover:border-blue-700 focus:outline-none" data-tab="announcements" type="button">
       Pengumuman
      </button>
     </li>
    </ul>
   </nav>

   <section aria-label="Daftar notifikasi" class="max-w-4xl mx-auto" id="notificationsTab">
    <!-- Notification 1 -->
     @forelse($pengumuman as $item) 
            <article class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row md:items-center md:space-x-6 mb-6">
                <img alt="Notification image showing a chat bubble with a bell icon on a blue background" class="w-full md:w-48 h-32 md:h-32 object-cover rounded-lg mb-4 md:mb-0" height="128" src="https://storage.googleapis.com/a1aa/image/b229d2c2-bc75-474b-0413-81a79bc39f2e.jpg" width="192"/>
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-blue-900 mb-2">
                        {!! $item->pesan !!}
                    </h2>

                    @if ($item->tipe == 'diskusi')
                        <p class="text-gray-700 mb-2">
                            Ada postingan baru dari {{ '@' . ($item->diskusi->user->username ?? $item->diskusi->user->nama_lengkap) }}. Yuk, cek dan berikan tanggapan Anda!
                        </p>
                    @elseif ($item->tipe == 'komentar')
                        <p class="text-gray-700 mb-2">
                            Ada komentar baru dari {{ '@' . ($item->komentar->user->username ?? $item->komentar->user->nama_lengkap) }} pada diskusi "{{ $item->diskusi->judul }}". Yuk, cek dan balas komentar tersebut!
                        </p>
                    @endif

                    <time class="text-sm text-gray-500" datetime="{{ $item->created_at }}">
                        {{ $item->created_at->diffForHumans() }}
                    </time>
                </div>
            </article>
        @empty
            <p class="text-gray-700 mb-2">
                Tidak ada notifikasi
            </p>
        @endforelse

   </section>

   <section aria-label="Daftar pengumuman" class="max-w-4xl mx-auto hidden" id="announcementsTab">
    <!-- Announcement 1 -->
    <article class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row md:items-center md:space-x-6 mb-6">
     <img alt="Announcement image showing a megaphone with sound waves on a blue background" class="w-full md:w-48 h-32 md:h-32 object-cover rounded-lg mb-4 md:mb-0" height="128" src="https://storage.googleapis.com/a1aa/image/a27f8e8b-0a49-4203-5df7-de1303ea3561.jpg" width="192"/>
     <div class="flex-1">
      <h2 class="text-xl font-semibold text-blue-900 mb-2">
       Forum SMEA Resmi Dibuka
      </h2>
      <p class="text-gray-700 mb-2">
       Kami dengan bangga mengumumkan bahwa Forum SMEA kini resmi dibuka untuk umum. Bergabunglah dan mulai berdiskusi dengan anggota komunitas lainnya.
      </p>
      <time class="text-sm text-gray-500" datetime="2024-06-01">
       1 Juni 2024
      </time>
     </div>
    </article>
    <!-- Announcement 2 -->
    <article class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row md:items-center md:space-x-6 mb-6">
     <img alt="Announcement image showing a calendar with a marked date and a clock" class="w-full md:w-48 h-32 md:h-32 object-cover rounded-lg mb-4 md:mb-0" height="128" src="https://storage.googleapis.com/a1aa/image/cfd0648a-0776-465f-47db-b51a9ad7e3a2.jpg" width="192"/>
     <div class="flex-1">
      <h2 class="text-xl font-semibold text-blue-900 mb-2">
       Jadwal Diskusi Mingguan
      </h2>
      <p class="text-gray-700 mb-2">
       Diskusi mingguan akan diadakan setiap hari Jumat pukul 19.00 WIB. Pastikan Anda bergabung untuk mendapatkan informasi terbaru dan berbagi pengalaman.
      </p>
      <time class="text-sm text-gray-500" datetime="2024-06-05">
       5 Juni 2024
      </time>
     </div>
    </article>
    <!-- Announcement 3 -->
    <article class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row md:items-center md:space-x-6 mb-6">
     <img alt="Announcement image showing a laptop with a chat bubble and notification icon" class="w-full md:w-48 h-32 md:h-32 object-cover rounded-lg mb-4 md:mb-0" height="128" src="https://storage.googleapis.com/a1aa/image/69f75866-af87-497d-4c8e-1369cef4bb8b.jpg" width="192"/>
     <div class="flex-1">
      <h2 class="text-xl font-semibold text-blue-900 mb-2">
       Fitur Notifikasi Baru
      </h2>
      <p class="text-gray-700 mb-2">
       Kini Anda dapat menerima notifikasi langsung saat ada postingan baru di forum. Aktifkan notifikasi di pengaturan profil Anda.
      </p>
      <time class="text-sm text-gray-500" datetime="2024-06-10">
       10 Juni 2024
      </time>
     </div>
    </article>
    <!-- Announcement 4 -->
    <article class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row md:items-center md:space-x-6 mb-6">
     <img alt="Announcement image showing a group of people discussing with speech bubbles" class="w-full md:w-48 h-32 md:h-32 object-cover rounded-lg mb-4 md:mb-0" height="128" src="https://storage.googleapis.com/a1aa/image/887bc2c4-be3a-4e9c-71fc-e9852d051c1a.jpg" width="192"/>
     <div class="flex-1">
      <h2 class="text-xl font-semibold text-blue-900 mb-2">
       Kompetisi Diskusi Terbaik
      </h2>
      <p class="text-gray-700 mb-2">
       Ikuti kompetisi diskusi terbaik bulan ini dan menangkan hadiah menarik. Lihat detail dan syarat di halaman kompetisi.
      </p>
      <time class="text-sm text-gray-500" datetime="2024-06-15">
       15 Juni 2024
      </time>
     </div>
    </article>
    <!-- Announcement 5 -->
    <article class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row md:items-center md:space-x-6 mb-6">
     <img alt="Announcement image showing a checklist and a pen on a desk" class="w-full md:w-48 h-32 md:h-32 object-cover rounded-lg mb-4 md:mb-0" height="128" src="https://storage.googleapis.com/a1aa/image/bbf85a4e-7f92-49b6-52c5-18d6b329d67a.jpg" width="192"/>
     <div class="flex-1">
      <h2 class="text-xl font-semibold text-blue-900 mb-2">
       Peraturan Forum Diperbarui
      </h2>
      <p class="text-gray-700 mb-2">
       Kami telah memperbarui peraturan forum untuk menciptakan lingkungan diskusi yang lebih sehat dan produktif. Harap baca dan patuhi peraturan terbaru.
      </p>
      <time class="text-sm text-gray-500" datetime="2024-06-20">
       20 Juni 2024
      </time>
     </div>
    </article>
    <!-- Announcement 6 -->
    <article class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row md:items-center md:space-x-6 mb-6">
     <img alt="Announcement image showing a smartphone with notification icons on screen" class="w-full md:w-48 h-32 md:h-32 object-cover rounded-lg mb-4 md:mb-0" height="128" src="https://storage.googleapis.com/a1aa/image/bbe87aff-c9fa-445f-9078-d0f16c66f07e.jpg" width="192"/>
     <div class="flex-1">
      <h2 class="text-xl font-semibold text-blue-900 mb-2">
       Aplikasi Mobile Forum SMEA
      </h2>
      <p class="text-gray-700 mb-2">
       Forum SMEA kini hadir dalam aplikasi mobile untuk Android dan iOS. Unduh sekarang dan nikmati kemudahan akses di mana saja.
      </p>
      <time class="text-sm text-gray-500" datetime="2024-06-25">
       25 Juni 2024
      </time>
     </div>
    </article>
    <!-- Announcement 7 -->
    <article class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row md:items-center md:space-x-6 mb-6">
     <img alt="Announcement image showing a trophy and confetti on a blue background" class="w-full md:w-48 h-32 md:h-32 object-cover rounded-lg mb-4 md:mb-0" height="128" src="https://storage.googleapis.com/a1aa/image/46391446-25ab-4ce1-b0ba-8401a50505a6.jpg" width="192"/>
     <div class="flex-1">
      <h2 class="text-xl font-semibold text-blue-900 mb-2">
       Penghargaan Anggota Aktif
      </h2>
      <p class="text-gray-700 mb-2">
       Kami memberikan penghargaan khusus untuk anggota yang paling aktif berkontribusi di forum selama bulan ini. Terima kasih atas partisipasinya!
      </p>
      <time class="text-sm text-gray-500" datetime="2024-06-28">
       28 Juni 2024
      </time>
     </div>
    </article>
    <!-- Announcement 8 -->
    <article class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row md:items-center md:space-x-6">
     <img alt="Announcement image showing a shield with a checkmark symbolizing security" class="w-full md:w-48 h-32 md:h-32 object-cover rounded-lg mb-4 md:mb-0" height="128" src="https://storage.googleapis.com/a1aa/image/a3ea6d9e-b522-4f65-2d4d-4455d671b5e5.jpg" width="192"/>
     <div class="flex-1">
      <h2 class="text-xl font-semibold text-blue-900 mb-2">
       Peningkatan Keamanan Forum
      </h2>
      <p class="text-gray-700 mb-2">
       Kami telah meningkatkan sistem keamanan forum untuk melindungi data dan privasi anggota. Pastikan Anda menggunakan password yang kuat.
      </p>
      <time class="text-sm text-gray-500" datetime="2024-06-30">
       30 Juni 2024
      </time>
     </div>
    </article>
   </section>
  </main>
  <script>
   const tabs = document.querySelectorAll('.tab-button');
    const notificationsTab = document.getElementById('notificationsTab');
    const announcementsTab = document.getElementById('announcementsTab');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        // Remove active styles and aria-selected from all tabs
        tabs.forEach(t => {
          t.classList.remove('border-blue-900');
          t.classList.add('border-transparent');
          t.setAttribute('aria-selected', 'false');
          t.classList.remove('pb-2');
          t.classList.remove('border-b-4');
        });
        // Add active styles and aria-selected to clicked tab
        tab.classList.add('border-blue-900');
        tab.classList.add('border-b-4');
        tab.classList.add('pb-2');
        tab.setAttribute('aria-selected', 'true');

        // Show/hide content sections
        if (tab.dataset.tab === 'notifications') {
          notificationsTab.classList.remove('hidden');
          announcementsTab.classList.add('hidden');
        } else {
          announcementsTab.classList.remove('hidden');
          notificationsTab.classList.add('hidden');
        }
      });
    });
  </script>
 </body>
</html>