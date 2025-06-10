
<!-- Sidebar -->
<aside aria-label="Sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-blue-900 text-white flex flex-col transition-transform transform -translate-x-full md:translate-x-0" id="sidebar">
  <div class="flex items-center space-x-3 px-6 py-6 border-b border-blue-700">
    <img alt="Logo SMEA" class="w-14 h-14 object-contain rounded-full shadow-md" src="{{asset('assets/logo/smea.png')}}"/>
    <span class="text-2xl font-bold tracking-wide select-none">Forum SMEA</span>
  </div>
  <nav role="navigation" class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
    <a class="flex items-center gap-4 px-4 py-3 rounded-lg font-semibold text-lg transition transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white {{ request()->routeIs('forum') ? 'bg-blue-800' : '' }}" href="{{ route('forum') }}">
      <i class="fas fa-home w-5"></i> Beranda
    </a>
    <a class="flex items-center gap-4 px-4 py-3 rounded-lg font-semibold text-lg transition transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white" href="#">
      <i class="fas fa-comments w-5"></i> Diskusi
    </a>
    @php
        $notifCount = auth()->user()->pengumuman()->where('is_read', false)->count();
    @endphp
    <a class="flex items-center gap-4 px-4 py-3 rounded-lg font-semibold text-lg transition transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white {{ request()->routeIs('pengumuman') ? 'bg-blue-800' : '' }}" href="{{ route('pengumuman') }}">
      <i class="fas fa-bullhorn w-5"></i> Pengumuman
      @if($notifCount > 0)
            <span class="absolute top-0 right-0 w-2 h-2 bg-red-600 rounded-full animate-ping"></span>
      @endif
    </a>
    <a class="flex items-center gap-4 px-4 py-3 rounded-lg font-semibold text-lg transition transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white {{ request()->routeIs('profile') ? 'bg-blue-800' : '' }}" href="{{ route('profile') }}">
      @if ($users->foto_profile)
      <img alt="User Profile" class="w-8 h-8 rounded-full object-cover border-2 border-white" src="{{ url('foto/' . $item->foto_profile) }}" />
      @else
      <img alt="Default Profile" class="w-8 h-8 rounded-full object-cover border-2 border-white" src="{{ url('default.png') }}" />
      @endif
      Profil
    </a>
    @auth
      @if(auth()->user()->role === 'admin')
        <a class="flex items-center gap-4 px-4 py-3 rounded-lg font-semibold text-lg transition transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white {{ request()->routeIs('dashboard') ? 'bg-blue-800' : '' }}" href="{{ route('dashboard') }}">
          <i class="fas fa-cogs w-5"></i> Admin Page
        </a>
      @endif
    @endauth
  </nav>
  @include('layouts.footer')
  
</aside>

