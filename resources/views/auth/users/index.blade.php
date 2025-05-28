<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
</head>
<body>
    <h1>Manajemen User</h1>
    <a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>

    <h2>Daftar User</h2>
    <ul>
        @foreach($users as $user)
            <li>
                {{ $user->username }}
                <form action="{{ url('/users/'.$user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h3>Tambah User</h3>
    <form action="{{ url('/users') }}" method="POST">
        @csrf
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Tambah User</button>
    </form>
</body>
</html>
