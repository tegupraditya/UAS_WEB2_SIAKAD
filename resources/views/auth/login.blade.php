<x-auth-layout title="Login" section_title="Welcome Back" section_description="Login with your account">
    <form action="{{ route('auth.authenticate') }}" method="POST" class="flex flex-col gap-4 mt-4">
        @csrf
        @method('POST')
        
        @error('email')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <div class="flex flex-col gap-2">
            <label for="email" class="font-semibold text-sm">Email</label>
            <input type="email" id="email" name="email"
                class="px-3 py-2 border border-zinc-300 bg-slate-50"
                placeholder="Your Email" value="{{ old('email') }}">
        </div>

        <div class="flex flex-col gap-2">
            <label for="password" class="font-semibold text-sm">Password</label>
            <input type="password" id="password" name="password"
                class="px-3 py-2 border border-zinc-300 bg-slate-50"
                placeholder="Your Password">
        </div>

        <div class="flex flex-col gap-2">
            <label for="role" class="font-semibold text-sm">Login as</label>
            <select name="role" id="role" class="px-3 py-2 border border-zinc-300 bg-slate-50">
                <option value="">-- Login Sebagai --</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded text-center mt-4 hover:bg-blue-900">
            <span>Login</span>
        </button>
    </form>
</x-auth-layout>
