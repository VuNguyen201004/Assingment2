@extends('layout.add')

@section('content')
<div class="uk-container uk-container-large uk-margin-top">
    <h2 class="uk-heading-line"><span>Categories</span></h2>
    <a href="{{ route('categories.create') }}" class="uk-button uk-button-primary uk-margin-bottom">Add Category</a>
    @if(session('success'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <table class="uk-table uk-table-divider">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('categories.show', $category->id) }}" class="uk-button uk-button-small uk-button-default">View</a>
                        <a href="{{ route('categories.edit', $category->id) }}" class="uk-button uk-button-small uk-button-primary">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="uk-button uk-button-small uk-button-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
