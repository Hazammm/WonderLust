@extends('layouts.admin')

@section('header', 'Categories Manager')

@section('content')
    <div class="card" style="max-width: 800px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="font-size: 18px;">All Categories</h2>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Category</a>
        </div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">Icon</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Destinations Count</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: {{ $category->color }}22; color: {{ $category->color }}; display: flex; justify-content: center; align-items: center; font-size: 18px;">
                                    <i class="fa-solid {{ $category->icon }}"></i>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 500; font-size: 15px; color: var(--admin-text);">{{ $category->name }}</div>
                                <div style="font-size: 13px; color: var(--admin-text-light);">/{{ $category->slug }}</div>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 20px; height: 20px; border-radius: 4px; background: {{ $category->color }};"></div>
                                    <span>{{ $category->color }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-secondary">{{ $category->destinations_count }}</span>
                            </td>
                            <td>
                                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                    <a href="{{ route('destinations.index', ['category' => $category->slug]) }}" target="_blank" class="btn btn-outline" style="padding: 6px 10px;" title="View public page">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline" style="padding: 6px 10px; color: var(--admin-secondary); border-color: var(--admin-secondary);" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    @if($category->destinations_count == 0)
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline" style="padding: 6px 10px; color: #ef4444; border-color: #ef4444;" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
