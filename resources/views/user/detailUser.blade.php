@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1 class="display-4">User Details</h1>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Chi tiết</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>Tên tài khoản:</strong> {{ $user->name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>Created At:</strong> {{ $user->created_at->format('d M Y, H:i') }}</li>
                <li class="list-group-item"><strong>Updated At:</strong> {{ $user->updated_at->format('d M Y, H:i') }}</li>
            </ul>
        </div>
        <div class="card-footer">
           
            <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
</div>
@endsection
