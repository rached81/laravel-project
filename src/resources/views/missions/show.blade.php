@extends('layouts.app-legacy')

@section('title', 'تفاصيل المهمة')

@section('content')
    <div class="container my-4">
        <!-- Zone d'impression -->
        <div id="print-area" class="p-4 bg-white">
            <!-- Entête -->
            <div class="text-center mb-5">
                <h5 class="m-0">الجمهورية التونسية</h5>
                <h6 class="m-0">وزارة النقل</h6>
                <h6 class="m-0">إدارة المعدات والسيارات العامة</h6>
                <h6 class="m-0">إذن بمأمورية لاستعمال عربة مصلحة</h6>
                <h6 class="m-0">صالح من {{ \Carbon\Carbon::parse($mission->start_date)->translatedFormat('d-m-Y') }}
                    إلى {{ \Carbon\Carbon::parse($mission->return_date)->translatedFormat('d-m-Y') }}</h6>
            </div>

            <!-- Tableau pour les Données -->
            <table class="table table-bordered" style="width: 100%; font-size: 16px;">
                <tbody>
                <tr class="mb-3">
                    <td style="width: 50%;"><strong>يرخص للسيد(ة) :</strong> {{ $mission->permit_holder }}</td>
                    <td style="width: 50%;"><strong>صاحب(ة) بطاقة تعريف وطنية عدد :</strong> {{ $mission->cin }}</td>
                </tr>
                <tr class="mb-3">
                    <td><strong>الرتبة أو الصنف :</strong> {{ $mission->rank_or_position }}</td>
                    <td><strong>الخطة الوظيفية :</strong> {{ $mission->internal_function }}</td>
                </tr>
                <tr class="mb-3">
                    <td colspan="2"><strong>في استعمال عربة المصلحة رقم :</strong> {{ $mission->car_number }}</td>
                </tr>
                <tr class="mb-3">
                    <td colspan="2"><strong>الغاية من استعمال العربة :</strong> {{ $mission->vehicle_usage_reason }}</td>
                </tr>
                <tr class="mb-3">
                    <td><strong>مكان الانطلاق :</strong> {{ $mission->departure_location }}</td>
                    <td><strong>المكان المقصود :</strong> {{ $mission->destination_location }}</td>
                </tr>
                <tr class="mb-3">
                    <td><strong>تاريخ الانطلاق :</strong> {{ \Carbon\Carbon::parse($mission->start_date)->translatedFormat('d-m-Y') }}</td>
                    <td><strong>ساعة الانطلاق :</strong> {{ \Carbon\Carbon::parse($mission->start_time)->format('H:i') }}</td>
                </tr>
                <tr class="mb-3">
                    <td><strong>تاريخ الرجوع :</strong> {{ \Carbon\Carbon::parse($mission->return_date)->translatedFormat('d-m-Y') }}</td>
                    <td><strong>ساعة الرجوع :</strong> {{ \Carbon\Carbon::parse($mission->return_time)->format('H:i') }}</td>
                </tr>
                <tr class="mb-3">
                    <td colspan="2">
                        <strong>المرافقون :</strong>
                        @if(!empty($mission->companions))
                            <ul class="m-0 ps-4">
                                @foreach(explode(',', $mission->companions) as $companion)
                                    <li>{{ $companion }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="m-0">لا يوجد مرافقون</p>
                        @endif
                    </td>
                </tr>
                <tr class="mb-3">
                    <td colspan="2"><strong>الحمولة :</strong> {{ $mission->expenses }}</td>
                </tr>
                </tbody>
            </table>

            <!-- Signature -->
            <div class="text-center mt-5">
                <p class="mb-4"><strong>الختم والإمضاء :</strong></p>
                <p class="mb-0"><strong>السيد :</strong> ____________________</p>
            </div>

            <!-- Pied de page -->
            <div class="text-center mt-5">
                <p class="m-0">بتاريخ : {{ \Carbon\Carbon::parse($mission->start_date)->translatedFormat('d-m-Y') }}</p>
                <p class="m-0">رئيس الإدارة</p>
            </div>
        </div>

        <!-- Boutons (non imprimables) -->
        <div class="text-end mt-3 d-print-none">
            <button class="btn btn-primary btn-sm" onclick="printContent()">طباعة</button>
            <a href="{{ route('missions.index') }}" class="btn btn-secondary btn-sm">عودة إلى القائمة</a>
        </div>
    </div>

    <!-- Script pour l'impression -->
    <script>
        function printContent() {
            const printArea = document.getElementById('print-area').innerHTML;
            const originalContent = document.body.innerHTML;
            document.body.innerHTML = printArea;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
@endsection
