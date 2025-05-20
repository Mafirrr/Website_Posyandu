<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Factory;
use Carbon\Carbon;



class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = \App\Models\Jadwal::all();
        return view('jadwal.jadwal', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'lokasi' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'tanggal' => 'required|date',
        ]);

        $jadwal = Jadwal::create($request->all());

        $tokens = Anggota::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

        if (!empty($tokens)) {
            $firebase = (new Factory)
                ->withServiceAccount(config('services.firebase.credentials'))
                ->createMessaging();

            Carbon::setLocale('id');

            $tanggal = Carbon::parse($jadwal->tanggal);
            $hari = $tanggal->isoFormat('dddd');
            $tanggalFormatted = $tanggal->format('d-m-Y');

            $messageText = "{$hari}\nTanggal: {$tanggalFormatted}\nJam: {$jadwal->jam_mulai}\n- {$jadwal->jam_selesai}";

            $data = [
                'title' => 'Jadwal Posyandu!',
                'body' => $messageText,
            ];

            foreach ($tokens as $token) {
                $message = CloudMessage::new()
                    ->withNotification(Notification::create($data['title'], $data['body']))
                    ->withData($data);

                $firebase->send($message->withChangedTarget('token', $token));
            }
        }

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil disimpan dan notifikasi terkirim.');
    }


    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'lokasi' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'tanggal' => 'required|date',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());

        $tokens = Anggota::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

        if (!empty($tokens)) {
            $firebase = (new Factory)
                ->withServiceAccount(config('services.firebase.credentials'))
                ->createMessaging();

            Carbon::setLocale('id');

            $tanggal = Carbon::parse($jadwal->tanggal);
            $hari = $tanggal->isoFormat('dddd');
            $tanggalFormatted = $tanggal->format('d-m-Y');

            $messageText = "{$hari}\nTanggal: {$tanggalFormatted}\nJam: {$jadwal->jam_mulai}\n- {$jadwal->jam_selesai}";

            $data = [
                'title' => 'Jadwal Posyandu Diperbarui!',
                'body' => $messageText,
            ];

            foreach ($tokens as $token) {
                $message = CloudMessage::new()
                    ->withNotification(Notification::create($data['title'], $data['body']))
                    ->withData($data);

                $firebase->send($message->withChangedTarget('token', $token));
            }
        }

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui dan notifikasi terkirim.');
    }
}
