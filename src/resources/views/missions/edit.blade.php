@extends('layouts.app-legacy')

@section('title', 'تعديل المهمة')

@section('content')
    <h1>تعديل المهمة</h1>

    <form action="{{ route('missions.update', $mission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">العنوان</label>
            <input type="text" name="title" class="form-control" value="{{ $mission->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea name="description" class="form-control">{{ $mission->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="destination" class="form-label">الوجهة</label>
            <input type="text" name="destination" class="form-control" value="{{ $mission->destination }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">الحالة</label>
            <select name="status" class="form-select" required>
                <option value="pending" {{ $mission->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                <option value="approved" {{ $mission->status == 'approved' ? 'selected' : '' }}>موافقة</option>
                <option value="rejected" {{ $mission->status == 'rejected' ? 'selected' : '' }}>رفض</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">تحديث المهمة</button>
        <a href="{{ route('missions.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
@endsection

{{--@extends('layouts.app')--}}

{{--@section('title', 'تعديل المهمة')--}}

{{--@section('content')--}}
{{--    <div class="container my-5">--}}
{{--        <h1 class="text-center mb-4">تعديل المهمة</h1>--}}

{{--        <form action="{{ route('missions.update', $mission->id) }}" method="POST" class="p-4 border rounded bg-light">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}
{{--            <div class="mb-3">--}}
{{--                <label for="permit_holder" class="form-label">صاحب الترخيص</label>--}}
{{--                <input type="text" name="permit_holder" class="form-control" value="{{ $mission->permit_holder }}" required>--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="license_number" class="form-label">عدد الرخصة</label>--}}
{{--                <input type="text" name="license_number" class="form-control" value="{{ $mission->license_number }}" required>--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="destination_location" class="form-label">الوجهة</label>--}}
{{--                <input type="text" name="destination_location" class="form-control" value="{{ $mission->destination_location }}" required>--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="start_date" class="form-label">تاريخ الانطلاق</label>--}}
{{--                <input type="date" name="start_date" class="form-control" value="{{ $mission->start_date }}" required>--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="start_time" class="form-label">ساعة الانطلاق</label>--}}
{{--                <input type="time" name="start_time" class="form-control" value="{{ $mission->start_time }}" required>--}}
{{--            </div>--}}
{{--            <div class="d-flex justify-content-between">--}}
{{--                <button type="submit" class="btn btn-primary">تحديث</button>--}}
{{--                <a href="{{ route('missions.index') }}" class="btn btn-secondary">إلغاء</a>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--@endsection--}}

