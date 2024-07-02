@extends('layouts.app')

@section('title', 'Kampanya Kategorileri')

@section('content')
    @include('layouts.alert')
    <div class="container">
        <div class="card">
            <h5 class="card-header">
                Kampanya Kategorileri
            </h5>
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#createModal">
                    Kategori Oluştur
                </button>
            </div>
            <div class="container">
                <div class="alert alert-danger">
                    <b>Not:</b> Kategori silme işlemi kategoriye bağlı <b>tüm kampanyaları ve alt kategorileri de silecektir</b>. Lütfen dikkatli olun.
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Adı</th>
                            <th>Kategori</th>
                            <th>Oluşturan</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($campaignCategories as $key => $category)
                            <tr>
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    {{ ucfirst($category->name) }}
                                </td>
                                <td>
                                    @if (!$category->parent_id)
                                        <span class="badge bg-label-success me-1">Ana Kategori</span>
                                    @else
                                        <span class="badge bg-label-primary me-1">Alt Kategori</span> <b>></b> <span class="badge bg-label-info me-1">{{ ucfirst($category->parent->name) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <b>
                                        {{ ucfirst($category->user->name) }}
                                    </b>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="deleteCategory({{$category->id}})">Sil</button>
                                </td>
                            </tr>
                        @endforeach
                        @if($campaignCategories->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Kategori bulunamadı.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $campaignCategories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    @include('admin.campaign-settings.modals.create')

    <script>
        function deleteCategory(id) {
            if (confirm('Bu kategoriyi silmek istediğinize emin misiniz?')) {
                var url = '{{ route('admin.categories.delete', ':id') }}';
                url = url.replace(':id', id);
                window.location.href = url;
            }
        }
    </script>
@endsection
