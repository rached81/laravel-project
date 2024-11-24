@extends('layouts.app-legacy')

@section('title', 'قائمة المهام')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">قائمة المهام</h1>
        <!-- Bouton pour ajouter une nouvelle mission -->
        @can('create mission')
            <div class="mb-4 text-end">
                <a href="{{ route('missions.create') }}" class="btn btn-success">إضافة مهمة جديدة</a>
            </div>
        @endcan
        <!-- Formulaire de recherche -->
        <form method="GET" action="{{ route('missions.index') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <input type="text" name="permit_holder" class="form-control" placeholder="صاحب الترخيص" value="{{ request('permit_holder') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="destination_location" class="form-control" placeholder="الوجهة" value="{{ request('destination_location') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">بحث</button>
            </div>
        </form>

        <!-- Table des missions -->
        <table class="table table-bordered text-center">
            <thead class="table-dark">
            <tr>
                <th>صاحب الترخيص</th>
                <th>عدد الرخصة</th>
                <th>الوجهة</th>
                <th>تاريخ الانطلاق</th>
                <th>تاريخ الرجوع</th>
                <th>العمليات</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($missions as $mission)
                <tr>
                    <td>{{ $mission->permit_holder }}</td>
                    <td>{{ $mission->license_number }}</td>
                    <td>{{ $mission->destination_location }}</td>
                    <td>{{ $mission->start_date }}</td>
                    <td>{{ $mission->return_date }}</td>
                    <td>
                        @can('view mission')
                            <a href="{{ route('missions.show', $mission->id) }}" class="btn btn-info btn-sm">عرض</a>
                        @endcan
                        @can('edit mission')
                            <a href="{{ route('missions.edit', $mission->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                        @endcan
                        @can('delete mission')
                            <form action="{{ route('missions.destroy', $mission->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                            </form>
                        @endcan
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6">لا توجد مهام لعرضها.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

