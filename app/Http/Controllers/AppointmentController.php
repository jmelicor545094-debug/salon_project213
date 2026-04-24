<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('appointments.index', [
            'appointments' => Appointment::with('service')->orderBy('scheduled_at', 'desc')->get(),
        ]);
    }

    public function create()
    {
        return view('appointments.create', [
            'services' => Service::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:50',
            'scheduled_at' => 'required|date|after_or_equal:today',
        ]);

        $service = Service::findOrFail($data['service_id']);

        Appointment::create([
            'service_id' => $service->id,
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'scheduled_at' => $data['scheduled_at'],
            'price' => $service->price,
            'payment_status' => 'Unpaid',
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment booked successfully.');
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', [
            'appointment' => $appointment,
            'services' => Service::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:50',
            'scheduled_at' => 'required|date|after_or_equal:today',
        ]);

        $service = Service::findOrFail($data['service_id']);

        $appointment->update([
            'service_id' => $service->id,
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'scheduled_at' => $data['scheduled_at'],
            'price' => $service->price,
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
