@extends('layouts.weblayout')

@section('content')

@push('login')
<script src="https://cdn.tailwindcss.com"></script>
@endpush
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">Login</h2>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-600 rounded-lg">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-600 rounded-lg">
        <p>{{ session('success') }}</p>
    </div>
@endif

        <form action="{{ route('ulogin') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-600 font-medium">Email</label>
                <input type="email" name="email" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label class="block text-gray-600 font-medium">Password</label>
                <input type="password" name="password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"  style="background-color:black;"
                class="w-full bg-blue-500 hover:bg-black-600 text-white font-bold py-2 rounded-lg transition duration-300">
                Login
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="#" class="text-sm text-blue-500 hover:underline">Forgot Password?</a>
        </div>

        <p class="mt-4 text-center text-gray-600">Don't have an account? 
            <a href="{{ route('userRegister') }}" class="text-blue-500 hover:underline">Sign up</a>
        </p>
    </div>
</div>
@endsection
