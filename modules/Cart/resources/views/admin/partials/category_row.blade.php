<tr>
    <td>{{ $category['id'] }}</td>
    <td>{{ $category['name'] }}</td>
    <td><a href="{{ $category['slug'] }}" class="btn btn-primary">Link</a></td>
    <td>{{ $category['created_at'] }}</td>
    <td>
        <div class="d-flex justify-content-around">
            <a href="{{ route('edit', $category['id']) }}" class="btn btn-warning">Sửa</a>
            <form method="POST" action="{{ route('delete', $category['id']) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger">Xóa</button>
            </form>
        </div>
    </td>
</tr>

@if(isset($category['sub_categories']) && !empty($category['sub_categories']))
    @foreach($category['sub_categories'] as $childCategory)
        @include('partials.category_row.blade.php', ['category' => $childCategory])
    @endforeach
@endif
