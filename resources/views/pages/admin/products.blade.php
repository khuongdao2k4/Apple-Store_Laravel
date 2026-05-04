@extends('layouts.admin')
@section('title', 'Quản lý Sản phẩm')
@section('content')

<div class="page-hdr d-flex justify-content-between align-items-start">
    <div>
        <h1>Sản phẩm</h1>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span> Quản lý Sản phẩm
        </div>
    </div>
    <a href="{{ route('add-product') }}" class="btn-apple btn-filled">
        <span class="material-icons-round">add</span> Thêm sản phẩm
    </a>
</div>
 
 <!-- SEARCH & FILTER BAR -->
 <form method="GET" action="{{ route('admin.products') }}">
 <div class="adm-card mb-3" style="padding:14px 18px">
     <div class="row g-2 align-items-end">
         <div class="col-md-7">
             <label class="f-label">Tìm kiếm</label>
             <div style="position:relative">
                 <span class="material-icons-round" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--apple-gray-500);font-size:18px;pointer-events:none">search</span>
                 <input type="text" name="search" value="{{ request('search') }}" placeholder="Tên sản phẩm, ID, nhóm sản phẩm (series)..." class="f-input" style="padding-left:36px">
             </div>
         </div>
         <div class="col-md-5" style="display:flex;gap:6px">
             <button type="submit" class="btn-apple btn-filled" style="flex:1;justify-content:center">
                 <span class="material-icons-round">filter_list</span> Tìm kiếm
             </button>
             @if(request()->filled('search'))
             <a href="{{ route('admin.products') }}" class="btn-apple btn-ghost" style="padding:0 10px" title="Xóa bộ lọc">
                 <span class="material-icons-round">close</span>
             </a>
             @endif
         </div>
     </div>
 </div>
 </form>

<div class="adm-card">
    <div style="padding:14px 20px;border-bottom:1px solid var(--apple-gray-100);display:flex;align-items:center;gap:8px">
        <span class="adm-card-title">Danh sách</span>
        <span style="font-size:13px;color:var(--apple-gray-500);font-weight:400">· {{ $products->total() }} sản phẩm</span>
    </div>
    <div class="table-responsive">
        <table class="adm-table">
            <thead><tr>
                <th style="width:64px">Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Tồn kho</th>
                <th>Màu sắc</th>
                <th class="text-end">Thao tác</th>
            </tr></thead>
            <tbody>
                @forelse($products as $p)
                <tr>
                    <td>
                        <div style="width:48px;height:48px;background:transparent;display:flex;align-items:center;justify-content:center;overflow:hidden">
                            <img src="{{ asset($p->image_url) }}" alt="" style="width:40px;height:40px;object-fit:contain">
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:600;font-size:14px">{{ $p->name }}</div>
                        <div style="font-size:12px;color:var(--apple-gray-500);margin-top:2px">ID: {{ $p->id }} · {{ $p->series }}</div>
                    </td>
                    <td style="font-weight:500">{{ $p->price }}</td>
                    <td>
                        <span class="chip" style="background:var(--apple-gray-100);color:var(--apple-gray-700)">{{ $p->quantity }} chiếc</span>
                    </td>
                    <td>
                        <div style="display:flex;gap:5px;flex-wrap:wrap">
                            @foreach(explode(',', $p->colors) as $c)
                            <div style="width:18px;height:18px;background:{{ trim($c) }};border-radius:50%;border:2px solid #fff;box-shadow:0 0 0 1.5px var(--apple-gray-200)" title="{{ trim($c) }}"></div>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div style="display:flex;justify-content:flex-end;gap:6px">
                            <a href="{{ route('edit-product', ['id'=>$p->id]) }}" class="btn-apple btn-tonal btn-sm">
                                <span class="material-icons-round" style="font-size:15px">edit</span> Sửa
                            </a>
                            <button onclick="deleteProduct({{ $p->id }})" class="btn-apple btn-danger-light btn-sm">
                                <span class="material-icons-round" style="font-size:15px">delete</span> Xóa
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6">
                    <div class="empty-state">
                        <span class="material-icons-round">inventory_2</span>
                        <p>Chưa có sản phẩm nào.</p>
                    </div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
    <div style="padding:14px 20px;border-top:1px solid var(--apple-gray-100);display:flex;justify-content:center">
        {{ $products->links() }}
    </div>
    @endif
</div>

@push('scripts')
<script>
function deleteProduct(id) {
    Swal.fire({
        title: 'Xóa sản phẩm?', text: 'Dữ liệu sẽ bị xóa vĩnh viễn.',
        icon: 'warning', showCancelButton: true,
        confirmButtonColor: '#ff3b30', cancelButtonColor: '#86868b',
        confirmButtonText: 'Xóa', cancelButtonText: 'Hủy'
    }).then(r => {
        if (r.isConfirmed) {
            const f = document.createElement('form'); f.method='POST'; f.action='{{ route('delete-product') }}';
            const c = document.createElement('input'); c.type='hidden'; c.name='_token'; c.value='{{ csrf_token() }}';
            const i = document.createElement('input'); i.type='hidden'; i.name='id'; i.value=id;
            f.appendChild(c); f.appendChild(i); document.body.appendChild(f); f.submit();
        }
    });
}
</script>
@endpush
@endsection
