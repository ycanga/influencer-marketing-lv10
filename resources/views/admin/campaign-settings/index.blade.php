@extends('layouts.app')

@section('title', 'Kampanya Kategorileri')

@section('content')
    @include('layouts.alert')
    <div class="container">
        <div class="card">
            <h5 class="card-header">
                Kampanya Kategorileri
            </h5>
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
                        @foreach ($categories as $key=> $category)
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
                                        <span class="badge bg-label-primary me-1">Alt Kategori</span>
                                    @endif
                                </td>
                                <td>
                                    <b>
                                        {{ucfirst($category->created_by)}}
                                    </b>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm">Sil</button>
                                    <button class="btn btn-warning btn-sm">Düzenle</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $categories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
