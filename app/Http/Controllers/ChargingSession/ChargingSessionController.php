<?php

namespace App\Http\Controllers\ChargingSession;

use App\Models\Capacity;
use App\Models\Car;
use App\Models\ChargingSession;
use App\Models\Plug;
use App\Models\Voltage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class ChargingSessionController extends BaseController
{
    public function index()
    {
        $cars = Car::with(['plug', 'categoryCar'])->get();
        $plugs = Plug::get();
        $volts = Voltage::get();
        $capty = Capacity::get();
        return view('user.chargingsession.chargingsession', compact('cars', 'plugs', 'volts', 'capty'));
    }

    public function CreateCharging(Request $request)
    {
        $request->validate([
            'car' => 'required',
            'input_baterai' => 'required|integer|max:100',
            'input_harga' => 'required|numeric',
            'plug' => 'required',
            'voltage' => 'required',
            'capacity' => 'required',
            'note' => 'nullable',
        ]);

        $charging_session = new ChargingSession();

        $charging_session->user_id = Auth::guard('user')->user()->id;
        $charging_session->car_id = $request->input('car');
        $charging_session->input_harga = $request->input('input_harga');
        $charging_session->input_baterai = $request->input('input_baterai');
        $charging_session->plug_id = $request->input('plug');
        $charging_session->voltage_id = $request->input('voltage');
        $charging_session->capacity_id = $request->input('capacity');
        $charging_session->note = $request->input('note');

        $voltage = Voltage::find($request->input('voltage'));
        $capacity = Capacity::find($request->input('capacity'));

        $arus = 350;
        $daya = $voltage->voltage * $arus;
        $daya_per_kWh = $daya / 1000;

        $electricity_tariff = 2000;

        $remaining_persen = 100 - $charging_session->input_baterai;

        $total_price = ($remaining_persen / 100) * $capacity->amount_capacity * $electricity_tariff;
        $total_price = (int) round($total_price);

        $time_charge_hours = $capacity->amount_capacity / $daya_per_kWh;
        $time_charge_seconds = $time_charge_hours * 3600;
        $time_charge_formatted = gmdate('H:i:s', $time_charge_seconds);

        $charging_session->amount_price = $total_price;
        $charging_session->charging_time = $time_charge_formatted;

        $charging_session->save();

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        \Midtrans\Config::$overrideNotifUrl = config('app.url') . '/api/midtrans-callback';

        $params = [
            'transaction_details' => [
                'order_id' => $charging_session->id,
                'gross_amount' => $charging_session->amount_price,
            ],
            'customer_details' => [
                'first_name' => Auth::guard('user')->user()->name,
                'email' => Auth::guard('user')->user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $charging_session->snap_token = $snapToken;
        $charging_session->save();

        return redirect('/user/mycharge')->with('success', 'Charging Session Created Successfully');
    }

    public function Callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if (in_array($request->transaction_status, ['capture', 'settlement'])) {
                $charging_session = ChargingSession::find($request->order_id);
                if ($charging_session) {
                    $charging_session->status = 1;
                    $charging_session->save();
                }
            }
        }
    }

}
