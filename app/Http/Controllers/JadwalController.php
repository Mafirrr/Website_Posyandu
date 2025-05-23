<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Anggota;
use App\Models\Kehamilan;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Factory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;



class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::orderBy('tanggal', 'desc')->get();
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

        $tokens = Anggota::whereNotNull('fcm_token')
            ->whereHas('kehamilan', function($query) {
                $query->where('status', 'dalam_pemantauan');
            })
            ->pluck('fcm_token')
            ->toArray();

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

                try {
                    $firebase->send($message->withChangedTarget('token', $token));
                } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
                    Log::warning('Token FCM tidak valid: ' . $token);
                    continue;
                } catch (\Kreait\Firebase\Exception\MessagingException $e) {
                    Log::error('Gagal kirim notifikasi ke token: ' . $token . '. Error: ' . $e->getMessage());
                    continue;
                }
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

        $tokens = Anggota::whereNotNull('fcm_token')
            ->whereHas('kehamilan', function($query) {
                $query->where('status', 'dalam_pemantauan');
            })
            ->pluck('fcm_token')
            ->toArray();

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

                try {
                    $firebase->send($message->withChangedTarget('token', $token));
                } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
                    Log::warning('Token FCM tidak valid: ' . $token);
                    continue;
                } catch (\Kreait\Firebase\Exception\MessagingException $e) {
                    Log::error('Gagal kirim notifikasi ke token: ' . $token . '. Error: ' . $e->getMessage());
                    continue;
                }
            }
        }

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui dan notifikasi terkirim.');
    }
}
