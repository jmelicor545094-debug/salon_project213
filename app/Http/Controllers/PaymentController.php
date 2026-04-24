<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payments.index', [
            'payments' => Payment::with('appointment.service')->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function create()
    {
        return view('payments.create', [
            'appointments' => Appointment::with('service')
                ->where('payment_status', '!=', 'Paid')
                ->orderBy('scheduled_at')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:Paid,Unpaid',
            'payment_method' => 'nullable|string|max:255',
        ]);

        $payment = Payment::create($data);

        $payment->appointment->update([
            'payment_status' => $data['status'],
        ]);

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully.');
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', [
            'payment' => $payment,
            'appointments' => Appointment::with('service')->orderBy('scheduled_at')->get(),
        ]);
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:Paid,Unpaid',
            'payment_method' => 'nullable|string|max:255',
        ]);

        $oldAppointment = $payment->appointment;

        if ($oldAppointment->id !== (int) $data['appointment_id']) {
            $oldAppointment->update([
                'payment_status' => 'Unpaid',
            ]);
        }

        $payment->update($data);

        $newAppointment = Appointment::findOrFail($data['appointment_id']);
        $newAppointment->update([
            'payment_status' => $data['status'],
        ]);

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->appointment->update([
            'payment_status' => 'Unpaid',
        ]);

        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment record deleted successfully.');
    }
}
