@extends('layouts.app-legacy')

@section('title', 'إضافة مهمة جديدة')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">إضافة مهمة جديدة</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('missions.store') }}" method="POST" class="p-4 border rounded bg-light">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="permit_holder" class="form-label">صاحب الترخيص</label>
                    <input type="text" name="permit_holder" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="cin" class="form-label">صاحب(ة) بطاقة تعريف وطنية عدد</label>
                    <input type="text" name="cin" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="rank_or_position" class="form-label">الرتبة أو الصنف</label>
                    <input type="text" name="rank_or_position" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="internal_function" class="form-label">الخطة الوظيفية</label>
                    <input type="text" name="internal_function" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="vehicle_usage_reason" class="form-label"> الغاية من إستعمال العربة</label>
                <input type="text" name="vehicle_usage_reason" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="car_number" class="form-label">    رقم السيارة</label>
                <input type="text" name="car_number" class="form-control" required>
            </div>
{{--            <div class="mb-3">--}}
{{--                <label for="companions" class="form-label"> المرافقون</label>--}}
{{--                <input type="text" name="companions" class="form-control" hidden="hidden">--}}
{{--            </div>--}}
            <div class="mb-3">
                <label class="form-label">المرافقون</label>
                <table class="table table-bordered" id="companions-table">
                    <thead>
                    <tr>
                        <th>الاسم و اللقب</th>
                        <th>ب.ت.و</th>
                        <th>الإجراء</th>
                    </tr>
                    </thead>
                    <tbody id="companions-list">
                    <!-- Les lignes seront ajoutées dynamiquement -->
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary btn-sm" id="add-companion">إضافة مرافق</button>
            </div>
            <div class="mb-3">
                <label for="expenses" class="form-label">الحمولة</label>
                <input type="text" name="expenses" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="license_number" class="form-label">عدد الرخصة</label>
                <input type="text" name="license_number" class="form-control" required>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="departure_location" class="form-label">مكان الإنطلاق</label>
                    <input type="text" name="departure_location" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="destination_location" class="form-label">المكان المقصود</label>
                    <input type="text" name="destination_location" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="start_date" class="form-label">تاريخ الانطلاق</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="start_time" class="form-label">ساعة الانطلاق</label>
                    <input type="time" name="start_time" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="return_date" class="form-label">تاريخ الرجوع</label>
                    <input type="date" name="return_date" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="return_time" class="form-label">ساعة الرجوع</label>
                    <input type="time" name="return_time" class="form-control" required>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">حفظ</button>
                <a href="{{ route('missions.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
{{--            <div class="d-flex justify-content-between">--}}
{{--                <button type="submit" class="btn btn-success">حفظ</button>--}}
{{--                <a href="{{ route('missions.index') }}" class="btn btn-secondary">إلغاء</a>--}}
{{--            </div>--}}
        </form>
    </div>

    <!-- Script pour gérer les accompagnants dynamiquement -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addCompanionButton = document.getElementById('add-companion');
            const companionsList = document.getElementById('companions-list');

            // Fonction pour ajouter une nouvelle ligne
            function addCompanionRow() {
                const rowId = `companion-${Date.now()}`;
                const row = document.createElement('tr');
                row.setAttribute('id', rowId);

                row.innerHTML = `
            <td>
                <input type="text" name="companion_name[]" class="form-control" placeholder="الاسم و اللقب" required>
            </td>
            <td>
                <input type="text" name="companion_cin[]" class="form-control" placeholder="ب.ت.و" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-companion" data-row-id="${rowId}">حذف</button>
            </td>
        `;

                companionsList.appendChild(row);
            }

            // Ajouter un accompagnant lorsque le bouton est cliqué
            addCompanionButton.addEventListener('click', addCompanionRow);

            // Supprimer une ligne
            companionsList.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-companion')) {
                    const rowId = event.target.getAttribute('data-row-id');
                    const rowToRemove = document.getElementById(rowId);
                    if (rowToRemove) {
                        rowToRemove.remove();
                    }
                }
            });

            // Avant la soumission du formulaire, restructurer les données
            const form = document.querySelector('form');
            form.addEventListener('submit', function (event) {
                // Réinitialiser les données pour éviter les erreurs
                let companions = [];
                const companionNames = document.querySelectorAll('input[name="companion_name[]"]');
                const companionCins = document.querySelectorAll('input[name="companion_cin[]"]');

                // Rassembler les données dans un tableau structuré
                companionNames.forEach((nameInput, index) => {
                    const cinInput = companionCins[index];
                    if (nameInput && cinInput && nameInput.value.trim() && cinInput.value.trim()) {
                        companions.push({
                            name: nameInput.value.trim(),
                            cin: cinInput.value.trim()
                        });
                    }
                });

                // Ajouter un champ caché pour transmettre les données structurées
                let companionsInput = document.querySelector('input[name="companions"]');
                if (!companionsInput) {
                    companionsInput = document.createElement('input');
                    companionsInput.type = 'hidden';
                    companionsInput.name = 'companions';
                    form.appendChild(companionsInput);
                }
                companionsInput.value = JSON.stringify(companions);

                // Vérification des données dans la console (pour débogage)
                console.log('Données envoyées pour les accompagnants :', companions);

                // Ne pas supprimer les champs individuels pour permettre le débogage si nécessaire
            });
        });





    </script>
@endsection

