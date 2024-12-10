@extends('layouts.main_layout')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8">
            <div class="card p-5">

                <!-- logo -->
                <div class="text-center p-3">
                    <img src="assets/images/logo.png" alt="Notes logo">
                </div>

                <!-- form -->
                <div class="row justify-content-center">
                    <div class="col-md-10 col-12">
                        <form action="/singInSubmit" method="post" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="text_username" class="form-label">Usuário</label>
                                <input type="email" class="form-control bg-dark text-info" name="text_username" required>
                                {{-- show error --}}
                                @error('text_username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="text_password" class="form-label">Senha</label>
                                <input type="password" class="form-control bg-dark text-info" name="text_password" required>
                                {{-- show error --}}
                                @error('text_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success w-100">CRIAR CONTA</button>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('login') }}" class="btn btn-secondary w-100">FAZER LOGIN </a>
                            </div>
                            @if (session('singInError'))

                            <div class="alert alert-danger text-center">
                                {{ session('singInError')}}
                            </div>

                        @endif
                        </form>
                    </div>
                </div>

                <!-- copy -->
                <div class="text-center text-secondary mt-3">
                    <small>&copy; <?= date('Y') ?> Ricardo Xavier</small>
                </div>



            </div>
        </div>
    </div>
</div>

@endsection
