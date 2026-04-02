@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
    <!-- Stats Row -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="card" style="margin-bottom: 0; background: linear-gradient(135deg, #4ea8de, #0077b6); color: white;">
            <div style="font-size: 14px; opacity: 0.8; margin-bottom: 10px;">Total Destinations</div>
            <div style="font-size: 32px; font-weight: 700;">{{ $stats['total_destinations'] }}</div>
            <i class="fa-solid fa-map" style="position: absolute; right: 25px; top: 25px; font-size: 40px; opacity: 0.3;"></i>
        </div>
        
        <div class="card" style="margin-bottom: 0; background: linear-gradient(135deg, #ff8fa3, #ff4d6d); color: white;">
            <div style="font-size: 14px; opacity: 0.8; margin-bottom: 10px;">Featured</div>
            <div style="font-size: 32px; font-weight: 700;">{{ $stats['featured'] }}</div>
            <i class="fa-solid fa-star" style="position: absolute; right: 25px; top: 25px; font-size: 40px; opacity: 0.3;"></i>
        </div>
        
        <div class="card" style="margin-bottom: 0; background: linear-gradient(135deg, #48cae4, #0096c7); color: white;">
            <div style="font-size: 14px; opacity: 0.8; margin-bottom: 10px;">Hidden Gems</div>
            <div style="font-size: 32px; font-weight: 700;">{{ $stats['hidden_gems'] }}</div>
            <i class="fa-solid fa-gem" style="position: absolute; right: 25px; top: 25px; font-size: 40px; opacity: 0.3;"></i>
        </div>
        
        <div class="card" style="margin-bottom: 0; background: linear-gradient(135deg, #ffd166, #f4a261); color: white;">
            <div style="font-size: 14px; opacity: 0.8; margin-bottom: 10px;">Categories</div>
            <div style="font-size: 32px; font-weight: 700;">{{ $stats['categories'] }}</div>
            <i class="fa-solid fa-tags" style="position: absolute; right: 25px; top: 25px; font-size: 40px; opacity: 0.3;"></i>
        </div>
    </div>

    <!-- Recent Destinations Table -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="font-size: 18px;">Recently Added Destinations</h2>
            <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add New</a>
        </div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Destination</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentDestinations as $dest)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div style="width: 48px; height: 48px; border-radius: 8px; overflow: hidden; background: #eee;">
                                        <img src="{{ $dest->hero_image_url }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <span style="font-weight: 500;">{{ $dest->name }}</span>
                                </div>
                            </td>
                            <td>
                                @if($dest->category)
                                    <span class="badge" style="background: {{ $dest->category->color }}22; color: {{ $dest->category->color }};">
                                        <i class="fa-solid {{ $dest->category->icon }}"></i> {{ $dest->category->name }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $dest->location }}</td>
                            <td>
                                @if($dest->is_featured)
                                    <span class="badge badge-warning">Featured</span>
                                @endif
                                @if($dest->is_hidden_gem)
                                    <span class="badge" style="background: #e2e8f0; color: #0f172a;">Hidden Gem</span>
                                @endif
                                @if(!$dest->is_featured && !$dest->is_hidden_gem)
                                    <span class="badge badge-secondary">Standard</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 10px;">
                                    <a href="{{ route('destinations.show', $dest->slug) }}" target="_blank" class="btn btn-outline" style="padding: 6px 12px;" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.destinations.edit', $dest->id) }}" class="btn btn-outline" style="padding: 6px 12px; color: var(--admin-secondary); border-color: var(--admin-secondary);" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
