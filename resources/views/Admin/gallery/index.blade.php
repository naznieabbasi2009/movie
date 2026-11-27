@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">گالری</h5>
            <a href="{{ route('gallery.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> افزودن گالری
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>نام فیلم</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($galleries as $gallery)
                    <tr>
                        <td>
                            @if($gallery->image)
                                <img src="{{ asset('storage/' . $gallery->image) }}"
                                     alt="{{ $gallery->title }}"
                                     width="70" height="50" style="object-fit: cover;" />
                            @else
                                <img src="{{ asset('storage/gallery/images.png') }}"
                                     alt="بدون تصویر"
                                     width="70" height="50" style="object-fit: cover;" />
                            @endif
                        </td>
                        <td><span class="fw-medium">{{ $gallery->title }}</span></td>
                        <td>{{ $gallery->movies->title ?? '—' }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">هیچ کالکشنی ثبت نشده است.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
