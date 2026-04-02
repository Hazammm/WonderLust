@extends('layouts.admin')

@section('header', 'Edit Category: ' . $category->name)

@section('content')
    <div class="card" style="max-width: 600px;">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Category Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">FontAwesome Icon Class</label>
                <div style="display: flex; gap: 10px;">
                    <div style="width: 45px; height: 45px; border: 1px solid var(--admin-border); border-radius: 8px; display: flex; justify-content: center; align-items: center; font-size: 20px; background: #f8fafc;" id="icon-preview">
                        <i class="fa-solid {{ $category->icon }}"></i>
                    </div>
                    <input type="text" name="icon" id="icon-input" class="form-control" value="{{ old('icon', $category->icon) }}" placeholder="e.g. fa-mountain">
                </div>
                <small style="color: var(--admin-text-light); margin-top: 5px; display: block;">Use FontAwesome free classes (e.g., fa-mountain, fa-city, fa-water)</small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Theme Color (Hex)</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input type="color" name="color" id="color-picker" value="{{ old('color', $category->color) }}" style="width: 45px; height: 45px; border: 1px solid var(--admin-border); border-radius: 8px; cursor: pointer; padding: 2px;">
                    <input type="text" id="color-text" class="form-control" value="{{ old('color', $category->color) }}" style="width: 120px;" readonly>
                </div>
            </div>
            
            <div class="form-group" style="display: flex; gap: 15px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Update Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline" style="padding: 12px 30px;">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('icon-input').addEventListener('input', function() {
        document.getElementById('icon-preview').innerHTML = '<i class="fa-solid ' + (this.value || 'fa-compass') + '"></i>';
    });
    
    document.getElementById('color-picker').addEventListener('input', function() {
        document.getElementById('color-text').value = this.value.toUpperCase();
    });
</script>
@endsection
