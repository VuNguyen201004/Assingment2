@extends('layout.add')

@section('content')
<div class="uk-container uk-container-small uk-margin-top">
    <h2 class="uk-heading-line"><span>Category Details</span></h2>
    <table class="uk-table uk-table-divider">
        <tr>
            <th>ID</th>
            <td>{{ $category->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $category->name }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $category->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $category->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('categories.index') }}" class="uk-button uk-button-primary">Back</a>
</div>
@endsection
