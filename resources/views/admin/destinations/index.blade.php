@extends('layouts.admin')

@section('header', 'Destinations Manager')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="font-size: 18px;">All Destinations</h2>
            <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Destination</a>
        </div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 80px;">Image</th>
                        <th>Name & Location</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinations as $dest)
                        <tr>
                            <td>
                                <div style="width: 60px; height: 60px; border-radius: 8px; overflow: hidden; background: #eee;">
                                    <img src="{{ $dest->hero_image_url }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 500; font-size: 15px; color: var(--admin-text);">{{ $dest->name }}</div>
                                <div style="font-size: 13px; color: var(--admin-text-light); margin-top: 4px;">
                                    <i class="fa-solid fa-location-dot"></i> {{ $dest->location }}
                                </div>
                            </td>
                            <td>
                                @if($dest->category)
                                    <span class="badge" style="background: {{ $dest->category->color }}22; color: {{ $dest->category->color }};">
                                        {{ $dest->category->name }}
                                    </span>
                                @else
                                    <span class="badge badge-secondary">Uncategorized</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 5px; align-items: flex-start;">
                                    @if($dest->is_featured)
                                        <span class="badge badge-warning"><i class="fa-solid fa-star"></i> Featured</span>
                                    @endif
                                    @if($dest->is_hidden_gem)
                                        <span class="badge" style="background: #e2e8f0; color: #0f172a;"><i class="fa-solid fa-gem"></i> Hidden Gem</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                    <a href="{{ route('destinations.show', $dest->slug) }}" target="_blank" class="btn btn-outline" style="padding: 6px 10px;" title="View public page">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.destinations.edit', $dest->id) }}" class="btn btn-outline" style="padding: 6px 10px; color: var(--admin-secondary); border-color: var(--admin-secondary);" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.destinations.destroy', $dest->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this destination?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline" style="padding: 6px 10px; color: #ef4444; border-color: #ef4444;" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px;">
                                <div style="color: var(--admin-text-light); font-size: 16px; margin-bottom: 10px;">No destinations found</div>
                                <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">Create Your First Destination</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 20px;">
            {{ $destinations->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
