<?php
namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    // Afficher la liste des missions
    public function index()
    {
        // Autoriser uniquement les utilisateurs ayant la permission de visualiser les missions
        if (Auth::user()->can('view mission')) {
                $missions = Mission::all();
            return view('missions.index', compact('missions'));
        } else {
            abort(403, 'Vous n\'avez pas la permission d\'accéder à cette page.');
        }
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('missions.create');
    }

    // Enregistrer une nouvelle mission
    public function store(Request $request)
    {
        dd($request->all());
        // Validation des données avec messages personnalisés
        $data = $request->validate([
            'permit_holder' => 'required|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'cin' => 'required|string|max:8',
            'car_number' => 'required|string|max:20',
            'rank_or_position' => 'required|string|max:255',
            'internal_function' => 'required|string|max:255',
            'vehicle_usage_reason' => 'required|string|max:255',
            'departure_location' => 'required|string|max:255',
            'destination_location' => 'required|string|max:255',
            'companions' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'return_date' => 'nullable|date|after_or_equal:start_date',
            'return_time' => 'nullable|date_format:H:i|after:start_time',
            'expenses' => 'nullable|string|max:255',
        ], [
            // Messages personnalisés
            'permit_holder.required' => 'اسم صاحب الترخيص مطلوب.',
            'permit_holder.string' => 'اسم صاحب الترخيص يجب أن يكون نصاً.',
            'permit_holder.max' => 'اسم صاحب الترخيص يجب ألا يتجاوز 255 حرفاً.',
            'cin.required' => 'رقم بطاقة التعريف مطلوب.',
            'cin.string' => 'رقم بطاقة التعريف يجب أن يكون نصاً.',
            'cin.max' => 'رقم بطاقة التعريف يجب ألا يتجاوز 8 أرقام.',
            'car_number.required' => 'رقم السيارة مطلوب.',
            'car_number.string' => 'رقم السيارة يجب أن يكون نصاً.',
            'car_number.max' => 'رقم السيارة يجب ألا يتجاوز 10 أحرف.',
            'rank_or_position.required' => 'الرتبة أو المنصب مطلوب.',
            'internal_function.required' => 'الوظيفة الداخلية مطلوبة.',
            'vehicle_usage_reason.required' => 'سبب استخدام السيارة مطلوب.',
            'departure_location.required' => 'مكان المغادرة مطلوب.',
            'destination_location.required' => 'مكان الوصول مطلوب.',
            'companions.required' => 'يرجى إدخال أسماء المرافقين.',
            'start_date.required' => 'تاريخ الانطلاق مطلوب.',
            'start_date.date' => 'تاريخ الانطلاق يجب أن يكون صيغة تاريخ صحيحة.',
            'start_time.required' => 'وقت الانطلاق مطلوب.',
            'start_time.date_format' => 'وقت الانطلاق يجب أن يكون بصيغة HH:mm.',
            'return_date.date' => 'تاريخ الرجوع يجب أن يكون صيغة تاريخ صحيحة.',
            'return_date.after_or_equal' => 'تاريخ الرجوع يجب أن يكون بعد أو يساوي تاريخ الانطلاق.',
            'return_time.date_format' => 'وقت الرجوع يجب أن يكون بصيغة HH:mm.',
            'return_time.after' => 'وقت الرجوع يجب أن يكون بعد وقت الانطلاق.',
            'expenses.string' => 'المصاريف يجب أن تكون نصاً.',
        ]);
        dd($request->all());
        // Ajouter l'utilisateur connecté comme créateur de la mission
        $data['user_id'] = Auth::id();
        $companions = json_decode($request->input('companions'), true);
        dd($companions);
        // Validation supplémentaire des accompagnants si nécessaire
        if (!empty($companions)) {
            foreach ($companions as $companion) {
                if (empty($companion['name']) || empty($companion['cin'])) {
                    return back()->withErrors(['companions' => 'جميع الحقول الخاصة بالمرافقين مطلوبة.']);
                }
            }
        }

        // Enregistrer les accompagnants au format JSON
        $validatedData['companions'] = json_encode($companions);
        // Création de la mission
        $mission =  Mission::create($data);

        // Redirection avec message de succès
        return redirect()->route('missions.show',['mission'=>$mission])->with('success', 'تم إضافة المهمة بنجاح.');
    }

    // Afficher les détails d'une mission
    public function show(Mission $mission)
    {
        return view('missions.show', compact('mission'));
    }

    // Afficher le formulaire d'édition
    public function edit(Mission $mission)
    {
        return view('missions.edit', compact('mission'));
    }

    // Mettre à jour une mission existante
    public function update(Request $request, Mission $mission)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'requester_id' => 'required|integer',
            'approver_id' => 'nullable|integer',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'destination' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'budget' => 'nullable|numeric',
        ]);

        $mission->update($request->all());

        return redirect()->route('missions.index')->with('success', 'Mission updated successfully.');
    }

    // Supprimer une mission
    public function destroy(Mission $mission)
    {
        $mission->delete();

        return redirect()->route('missions.index')->with('success', 'Mission deleted successfully.');
    }
}
