@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">اخبار</h5>
            <a href="{{ route('collection.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> افزودن خبر
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>فیلم ها</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($collections as $collection)
                    <tr>
                        <td>
                            @if($collection->image)
                                <img src="{{ asset('storage/' . $collection->image) }}"
                                     alt="{{ $collection->title }}"
                                     width="70" height="50" style="object-fit: cover;" />
                            @else
                                <img src="{{ asset('storage/collection/images.png') }}"
                                     alt="بدون تصویر"
                                     width="70" height="50" style="object-fit: cover;" />
                            @endif
                        </td>
                        <td><span class="fw-medium">{{ $collection->title }}</span></td>
                        <td>{{ $collection->movies->title ?? '—' }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('news.edit', $collection->id) }}">
                                        <i class="ti ti-pencil me-1"></i> ویرایش
                                    </a>
                                    <form action="{{ route('news.destroy', $collection->id) }}" method="POST"
                                          onsubmit="return confirm('آیا از حذف این خبر مطمئن هستید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="ti ti-trash me-1"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">هیچ خبری ثبت نشده است.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
