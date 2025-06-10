<html class="scroll-smooth" lang="en">
 <head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Forum SMEA - Detail Diskusi
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
 <body class="bg-gray-100 min-h-screen flex relative">
  <!-- Sidebar -->
  @include('layouts.sidebar')

  <!-- Tombol Back di kiri -->
      <a href="{{ url()->previous() }}"  
        class="fixed top-6 left-4 md:left-72 z-40 inline-flex items-center px-4 py-2 bg-blue-900 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-md transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali
      </a>

  <!-- Main content -->
  <main class="flex-1 ml-0 md:ml-64 px-6 py-6 max-w-4xl mx-auto">
   <article class="bg-white rounded-lg shadow-md p-6">
    <!-- Optional Discussion Image -->
     @if($diskusi->foto_diskusi)
    <img alt="Foto Diskusi" class="w-full h-64 object-cover rounded-lg mb-6 " height="400" id="discussionImage" loading="lazy" src="{{ url('foto_diskusi/' . $diskusi->foto_diskusi) }}" width="600"/>
    @else
    <img alt="Foto Diskusi Hidden" class="w-full h-64 object-cover rounded-lg mb-6 hidden" height="400" id="discussionImage" loading="lazy" src="#" width="600"/>
    @endif
    <!-- Discussion Title -->
    <h1 class="text-3xl font-bold text-blue-900 mb-4" id="discussionTitle">
     {{ $diskusi->judul }}
    </h1>
    <!-- Discussion Content -->
    <div class="prose max-w-none text-gray-800 mb-6" id="discussionContent">
     <p>
      {{ $diskusi->isi }}
     </p>
    </div>
    <!-- Discussion Creator -->
    <div class="flex items-center space-x-4 mb-8">
      @if ($diskusi->user->foto_profile)
     <img 
      alt="Foto profil pembuat diskusi {{ '@' . ($diskusi->user->username ?? $diskusi->user->nama_lengkap) }}" 
      class="w-12 h-12 rounded-full object-cover border-2 border-blue-900" 
      height="48" 
      loading="lazy" 
      src="{{ url('foto/' . $diskusi->user->foto_profile) }}" 
      width="48"/>
      @else
      <img 
       alt="Foto profil pembuat diskusi {{ '@' . ($diskusi->user->username ?? $diskusi->user->nama_lengkap) }}" 
       class="w-12 h-12 rounded-full object-cover border-2 border-blue-900" 
       height="48" 
       loading="lazy" 
       src="{{ url('default.png') }}" 
       width="48"/>
       @endif
     <div>
      <p class="font-semibold text-blue-900" id="discussionCreatorName">
       Dibuat oleh: {{ '@' . ($diskusi->user->username ?? $diskusi->user->nama_lengkap) }}
      </p>
      <time class="text-sm text-gray-500" datetime="2024-07-01" id="discussionCreatedAt">
       {{ $diskusi->created_at->diffForHumans() }}
      </time>
     </div>
    </div>
    <!-- Comments Section -->
    <section aria-label="Komentar diskusi" class="mb-8">
     <h2 class="text-2xl font-semibold text-blue-900 mb-4">
      Komentar
     </h2>
     <ul class="space-y-6 max-h-96 overflow-y-auto" id="commentsList">
      <!-- Example comment -->
       @foreach($diskusi->komentar()->latest()->get() as $comment)
      <li class="bg-gray-50 rounded-lg p-4 shadow-sm">
       <div class="flex items-center space-x-3 mb-2">
        <img alt="Foto profil pengguna" class="w-10 h-10 rounded-full object-cover border-2 border-blue-700" height="40" loading="lazy" src="{{ $comment->user->foto_profile ? url('foto/' . $comment->user->foto_profile) : url('default.png') }}" width="40"/>
        <div>
         <p class="font-semibold text-blue-900">
          {{ $comment->user->username ?? $comment->user->nama_lengkap }}
         </p>
         <time class="text-xs text-gray-500" datetime="2024-07-02T10:15:00Z">
          {{ $comment->created_at->format('d M Y, H:i') }}
         </time>
        </div>
       </div>
       <p class="text-gray-700">
        {{ $comment->isi }}
       </p>
      </li>
      @endforeach
     </ul>
    </section>
    <!-- Add Comment Form -->
    <section aria-label="Form tambah komentar">
     <h2 class="text-2xl font-semibold text-blue-900 mb-4">
      Tambahkan Komentar
     </h2>
     <form class="space-y-4" id="commentForm">
      <textarea class="w-full rounded-lg border border-gray-300 p-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-600 resize-none" id="commentInput" name="comment" placeholder="Tulis komentar Anda di sini..." required="" rows="4"></textarea>
      <button class="inline-flex items-center gap-2 px-5 py-3 bg-blue-900 text-white font-semibold rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 transition" type="submit">
       <i class="fas fa-paper-plane">
       </i>
       Kirim Komentar
      </button>
     </form>
    </section>
   </article>
  </main>
  <script>
   // Example data for comments (in real app, fetched from backend)
    const commentsList = document.getElementById("commentsList");
    const commentForm = document.getElementById("commentForm");
    const commentInput = document.getElementById("commentInput");

    // Function to create comment element
    function createCommentElement({ username, avatar, datetime, content }) {
      const li = document.createElement("li");
      li.className = "bg-gray-50 rounded-lg p-4 shadow-sm";

      li.innerHTML = `
        <div class="flex items-center space-x-3 mb-2">
          <img alt="Foto profil pengguna komentar, ${username}" class="w-10 h-10 rounded-full object-cover border-2 border-blue-700" src="${avatar}" loading="lazy" />
          <div>
            <p class="font-semibold text-blue-900">${username}</p>
            <time class="text-xs text-gray-500" datetime="${datetime}">${new Date(datetime).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</time>
          </div>
        </div>
        <p class="text-gray-700">${content}</p>
      `;
      return li;
    }

    // Handle new comment submission
    commentForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const content = commentInput.value.trim();
      if (!content) return;

      try {
        const response = await fetch("{{ route('diskusi.comment', ['id' => $diskusi->id]) }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          body: JSON.stringify({ comment: content }),
        });

        if (!response.ok) throw new Error('Gagal mengirim komentar');

        const data = await response.json();

        const commentElement = createCommentElement(data);
        commentsList.appendChild(commentElement);
        commentInput.value = "";
        commentInput.focus();

        commentElement.scrollIntoView({ behavior: "smooth" });
      } catch (error) {
        alert(error.message);
      }
    });

  </script>
 </body>
</html>
