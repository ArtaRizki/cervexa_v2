<?php

namespace app\custom;

use App\Notifikasi;
use App\VUser;
use App\AppDriverFCM;
use Exception;
use Illuminate\Support\Arr;
use Google\Auth\ApplicationDefaultCredentials;
use Google\Auth\HttpHandler\HttpHandlerFactory;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use App\AppSalesFCM;

class NewFCMPushNotification
{
  private $url = 'https://fcm.googleapis.com/fcm/send';
  private $serverKey = 'AAAAfPPhzzc:APA91bGZhOKMXT_1fqjf-8fxZOOVmmiP08dgQUYVkKmqH7Rge1aFcj7S-6-eYa3N2KqZFFOeeElpppsUsuspObkCnMIZJq8YIfKLf3ldRxSVdScquvMhz3pi8kRYBAMubvRYMGlvcnBQ';

  // ADIT | START | MERGE DEPO MALANG | 25 agustus 2025
  public function saveToken($id, $token)
  {
    // menghapus token yang sama yang dipakai user lain
    AppDriverFCM::where('token', $token)->update(['token' => '']);
    // menyimpan token yang baru sesuai id karyawan saat ini
    AppDriverFCM::updateOrCreate(['karyawan_id' => $id], ['token' => $token]);
  }
  // ADIT |  END  | MERGE DEPO MALANG | 25 agustus 2025
  public function userSend($id, $nama, $user, $type, $title, $body = '', $screen, $screenid = '', $extra = [])
  {
    $arrUser = VUser::aktif()->where('nama', '=', $user)->pluck('id');
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid, $extra);
  }

  public function userCabangSend($id, $nama, $user, $type, $title, $body = '', $screen, $screenid = '', $cabang)
  {
    $arrUser = VUser::aktif()->where('nama', '=', $user)->kotaCabang($cabang)->pluck('id');
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  public function multiUserSend($id, $nama, $multiUser, $type, $title, $body = '', $screen, $screenid = '', $extra = [])
  {
    $arrUser = VUser::aktif()->whereIn('nama', $multiUser)->pluck('id')->toArray();
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid, $extra);
  }

  // START | ADIT | NO_WO | kirim notifikasi ke Mb Anda, Pak Agus, Pak Glory
  public function multiUserIdSend($id, $nama, $multiUserId, $type, $title, $body = '', $screen, $screenid = '')
  {
    // foreach ($multiUserId as $item) {
    //   $arrUser[] = VUser::aktif()->where('id', '=', $item)->pluck('id');
    // }
    // $arrUser = Arr::flatten($arrUser);
    return $this->_send($id, $nama, $multiUserId, $type, $title, $body, $screen, $screenid);
  }
  // END | ADIT | NO_WO | kirim notifikasi ke Mb Anda, Pak Agus, Pak Glory

  public function multiUserCabangSend($id, $nama, $multiUser, $type, $title, $body = '', $screen, $screenid = '', $cabang)
  {
    $arrUser = VUser::aktif()->whereIn('nama', $multiUser)->kotaCabang($cabang)->pluck('id')->toArray();
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  public function jabatSend($id, $nama, $jabat, $type, $title, $body = '', $screen, $screenid = '')
  {
    $arrUser = VUser::aktif()->userFromJabat($jabat)->pluck('id');
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  public function jabatCabangSend($id, $nama, $jabat, $type, $title, $body = '', $screen, $screenid = '', $cabang)
  {
    $arrUser = VUser::aktif()->userFromJabatCabang($jabat, $cabang)->pluck('id');
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  public function multiJabatSend($id, $nama, $multiJabat, $type, $title, $body = '', $screen, $screenid = '')
  {
    foreach ($multiJabat as $iter) {
      $arrUser[] = VUser::aktif()->userFromJabat($iter)->pluck('id');
    }
    $arrUser = Arr::flatten($arrUser);
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  public function multiJabatCabangSend($id, $nama, $multiJabat, $type, $title, $body = '', $screen, $screenid = '')
  {
    foreach ($multiJabat as $iter) {
      $arrUser[] = VUser::aktif()->userFromJabatCabang($iter["jabatan"], $iter["cabang"])->pluck('id');
    }
    $arrUser = Arr::flatten($arrUser);
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  public function bagianSend($id, $nama, $bagian, $type, $title, $body = '', $screen, $screenid = '')
  {
    $arrUser = VUser::aktif()->userFromBagian($bagian)->pluck('id');
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  public function bagianCabangSend($id, $nama, $bagian, $type, $title, $body = '', $screen, $screenid = '', $cabang)
  {
    $arrUser = VUser::aktif()->userFromBagianCabang($bagian, $cabang)->pluck('id');
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  public function multiBagianSend($id, $nama, $multiBagian, $type, $title, $body = '', $screen, $screenid = '')
  {
    foreach ($multiBagian as $iter) {
      $arrUser[] = VUser::aktif()->userFromBagian($iter)->pluck('id');
    }
    $arrUser = Arr::flatten($arrUser);
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  public function multiBagianCabangSend($id, $nama, $multiBagian, $type, $title, $body = '', $screen, $screenid = '')
  {
    foreach ($multiBagian as $iter) {
      $arrUser[] = VUser::aktif()->userFromBagianCabang($iter['bagian'], $iter['cabang'])->pluck('id');
    }
    $arrUser = Arr::flatten($arrUser);
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  public function multiBagianJabatSend($id, $nama, $multiBagianJabat, $type, $title, $body = '', $screen, $screenid = '')
  {
    foreach ($multiBagianJabat as $iter) {
      $arrUser[] = VUser::aktif()->userFromBagianJabat($iter['bagian'], $iter['jabatan'])->pluck('id');
    }
    $arrUser = Arr::flatten($arrUser);
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  public function multiBagianJabatCabangSend($id, $nama, $multiBagianJabat, $type, $title, $body = '', $screen, $screenid = '')
  {
    foreach ($multiBagianJabat as $iter) {
      $arrUser[] = VUser::aktif()->userFromBagianJabatCabang($iter['bagian'], $iter['jabatan'], $iter['cabang'])->pluck('id');
    }
    $arrUser = Arr::flatten($arrUser);
    return $this->_send($id, $nama, $arrUser, $type, $title, $body, $screen, $screenid);
  }

  // ARTA | START | PO WO CHAT + MIGRASI FIREBASE V1 | September 2025
  private function _send($id, $nama, $arrUser, $type, $title, $body = '', $screen, $screenid = '', $extra = [])
  {
    try {
      $arrToken = AppDriverFCM::whereIn('karyawan_id', $arrUser)
        ->pluck('token')
        ->filter()
        ->toArray();

      if (empty($arrToken)) {
        return response()->json(['msg' => "Token tidak ditemukan"], 400);
      }

      $projectId = "driverapp-b527b";
      $accessToken = $this->getAccessToken();
      $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

      $headers = [
        "Authorization: Bearer {$accessToken}",
        "Content-Type: application/json"
      ];

      $responses = [];
      foreach ($arrToken as $deviceToken) {
        $payload = [
          "message" => [
            "token" => $deviceToken,
            // biar tidak double handle background dan foreground muncul bersamaa, dihandle awesome notif saja
            "notification" => [
              "title" => $title,
              "body"  => $body,
            ],
            "data" => [
              "type"     => $type,
              "title"    => $title,
              "body"     => $body,
              "screen"   => $screen,
              "screenid" => $screenid,
              "extra" => $extra
            ],
          ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);


        if ($result === FALSE) {
          \Log::error("FCM gagal: " . curl_error($ch));
          continue; // skip ke token berikut
        }

        // cek user penerima untuk simpan history
        $toUser = AppDriverFCM::userToken($deviceToken)->pluck('karyawan_id')->first();
        if (!$toUser) {
          \Log::warning("FCM: Token $deviceToken tidak punya karyawan_id");
          continue;
        }

        // insert ke Notifikasi
        Notifikasi::firstOrCreate([
          'type'        => $type,
          'from'        => $nama,
          'to'          => $toUser,
          'text'        => $title,
          'desc'        => $body,
          'url'         => empty($screenid) ? $screen : $screen . '/' . $screenid,
          'id_karyawan' => $id,
        ]);
      }

      return response()->json(['msg' => "Sukses mengirim notifikasi"]);
    } catch (Exception $e) {
      return response()->json(['msg' => $e->getMessage()], $e->getCode() == 0 ? 500 : $e->getCode());
    }
  }
  // ARTA | END | PO WO CHAT + MIGRASI FIREBASE V1 | September 2025


  public function seenNotif($id, $type, $title, $body = '', $screen, $screenid = '', $seen)
  {
    $code = 200;
    $data = $msg = $error = "";
    try {
      $Notifikasiory = [
        'type'      => $type,
        'text'      => $title,
        'desc'      => $body,
        'url'       => empty($screenid) ? $screen : $screen . '/' . $screenid,
        'to'        => $id,
      ];
      //update
      Notifikasi::where($Notifikasiory)->update(['seen' => $seen]);
      //kroscek
      if (Notifikasi::where($Notifikasiory)->exists()) {
        $msg = "Sukses konfirm notifikasi";
      } else {
        $code = 403;
        $msg = "Gagal konfirm notifikasi";
      }
    } catch (\Throwable $th) {
      $code   = 500;
      $msg    = "Konfirm notifikasi digagalkan";
      $error  = $th;
    }
    $res = ['data' => $data, 'msg' => $msg, 'error' => $error];
    return response()->json($res, $code);
  }

  private function _sendTest($id, $nama, $arrUser, $type, $title, $body = '', $screen, $screenid = '')
  {
    try {
      $arrToken = AppDriverFCM::selectRaw('COALESCE(token, \'\') AS token')->whereIn('karyawan_id', $arrUser)->pluck('token');
      foreach ($arrToken as $iter) {
        Notifikasi::create([
          'type'         => $type,
          'from'         => $nama,
          'id_karyawan'  => $id,
          'to'           => AppDriverFCM::userToken($iter)->pluck('karyawan_id')->first(),
          'text'         => $title,
          'desc'         => $body,
          'url'          => empty($screenid) ? $screen : $screen . '/' . $screenid,
        ]);
      }
      $res = ['msg' => "Sukses mengirim notifikasi",];
      return response()->json($res);
    } catch (Exception $e) {
      $res = ['msg' => $e->getMessage()];
      return response()->json($e->getMessage(), $e->getCode() == 0 ? 500 : $e->getCode());
    }
  }

  private function getAccessToken()
  {
    // $json = json_decode(storage_path(file_get_contents(__DIR__ . 'app/driverapp-b527b-6a3d3eb44c40.json')), true);
    // $privateKey  = $json['private_key'];
    // $clientEmail = $json['client_email'];cls
    // $tokenUri    = $json['token_uri'];
    // dd(server('HTTP_USER_AGENT'));
    $privateKey   = "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCyiIih/fWz8HFs\nribCmUOciWRrS8rxaA0D4t9r82OMO6YsH9Drgv65LHQWjnETfOZwRLQsm/xyKofO\nuaE0uJOx8VQjRum1xmBBOIAgsjPrvrf5LD/15p6YAmkIho6xmBrG795TtDP0DyKB\n7t8em0RFiOsjCCmQJWnmUxgorK5fKxqeSnQf4Bw1yac2HYhlg/X04AihelOeZq/b\n61mOg/ndlGMcSZ6leqv6AscUezIo1dDdoddE1xRKV+93hwYdQSRh0qc+aoz5KXPf\nRSm1BZhGr1Cu4DD2AZhxJMg1cKemQQ2hG75DVb7ECsxgyWKWINHvQD3KizpwrTIN\nAQ61e/djAgMBAAECggEACeAFdrheY9KT44gKes8Rb1ImLM0nb4zq02E0LHts8S/H\ndD9aRfyb7FAqJ6k/Ve2drW4PbTw/jW0Oz/9yjED9YmVP2xesC7LqVhEy/Rv+RTbq\nZCzvaMGV2iCgAKm4sNgR+xj/ei/Ig+JmbTtyOfYqo5H8N5bW/bMkFWpZNr6+cmMP\nQtUbQJyokpuhSAQts67MmpCvxr8tg6trEGl612VwZXTc73D5FBKQYTPIbXJQBK6c\nqbPI0nxksQ6rke7h1S7pUwXpuoahwxHZ7ub25nVmV/LVDhHDp/98qnCetWUI4c1b\nFQg/xeJxgMzqV6p7idv7bCJ+uMG9vKhghEc/+xM7cQKBgQDlqOwuE8awnOych/qD\nVA0kftHTlPKFmh2SChP7j4eISgO4cV9SjA5wAH/jY4WJ0icjq2hgRjE1Rx3Igcwj\n4Nk+EEB2FbT1M/QpTilUobBXDo7zlM8ig2aFmrEHEbBS+hd60/DxUQ+RvzE69VIL\nNgaDuuXmkXjEXhAWjt9hHcsW2QKBgQDHAnpN1d5wYWlxh2d4nQu8rEWMuq8xUfkf\nPnz0bUacKwc2DSezV/KF3ENJTFftwlWZeIf1PtOxAbf0Niy9plreoCe2q/e+fdaE\nomsDFyAXYx87xpsRkl/84Tyo6mzofj39sZoKuuRo0URoNPWYvvruFNylYduyAGKx\nF3cuc8zymwKBgBiRiKqpPPE56GoadedEv58u3f2XipZWVWGBKIAZ67Ld0CYUItFu\n4ECFHSlTRT7oN32uYZ0jBTKg6APCNveDn1nvXSYEznYI187vaKaAIaA+k3Zlbf9Q\nNVCHqvaJouZNkON39uep91NtM7QN+HfwkKPZA6011MiVE32GTUlTaZ2JAoGASJuv\n0cwxDyGLXh9/8fKigKD98x19o+n7kZmz714bQAk25VKhZH62/n3hktGm1xlrL8ZZ\nHHJivBcbbZ+CbWNPjiAyvSQ7DKZO6S91CbibPc0tbRrGIwAbw2DOR/bX62974J62\nzClqApAvfDGuVZ+AX/L+mdx9UpFvcJtWIX2gjfcCgYA39wH91k21zn9y3Qqt5qU/\np1he7hAHo7jFAMslT7vtV16laJe2wSzfTobVT6Iw73wn8eMzmk6pgkEOO4DDDoSt\nCSbMUct341pJ0VPvxCQaqrG7kFmmbfsLuzYqmOtQQ/9RAfUcIqfaypPs7IX1sBfc\n9ZvZqbhfExAXqpMmlGpqSg==\n-----END PRIVATE KEY-----\n";
    $clientEmail  = "firebase-adminsdk-r1v38@driverapp-b527b.iam.gserviceaccount.com";
    $tokenUri     = "https://oauth2.googleapis.com/token";
    $now = time();
    $expires = $now + 3600; // 1 jam

    $payload = [
      "iss"   => $clientEmail,
      "scope" => "https://www.googleapis.com/auth/firebase.messaging",
      "aud"   => $tokenUri,
      "iat"   => $now,
      "exp"   => $expires,
    ];

    // Pakai firebase/php-jwt (sudah otomatis ke-install bareng google/auth)
    $jwt = JWT::encode($payload, $privateKey, 'RS256');

    // Request access token ke Google
    $client = new Client();
    $response = $client->post($tokenUri, [
      'form_params' => [
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'assertion'  => $jwt,
      ]
    ]);

    $body = json_decode((string) $response->getBody(), true);

    return $body['access_token'];
  }

  private function getAccessTokenSales()
{
    // Ambil dari file JSON yang baru saja di-generate
    $clientEmail = "firebase-adminsdk-fbsvc@irasa-sales.iam.gserviceaccount.com";
    $privateKey = "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDDzWAPi2DlhCan\n6wwULZxzbKL6yzd05l7BG/i4murBWhVqQ2ESim/LGf5wwDUggBUhgCtp2MTS3Hmo\nogieSS7/tBDuN9nz3IArJsfndpujEA5z5b7819c5pIISIOjrXXdIDJ21JWjNVRRl\nFZ8eXsXmmcGzOJHdI178wUg++1H7xOxZmsCRFWELLd+OpRDmC3lGwO7DKueDvs+3\nCqm0M4ka0L3/nGWSR6xKhAeKrqUZzkdvUj8DI0xuKjg1XUSB/A/efUlHWz7L95ri\n3TwC2rdDcXRp+S6UHV9TqzZFwpCPHEjJhncogpqyvY4Gs6Bg2fesDedfDhA/GAn3\ntZEXOaD1AgMBAAECggEANU0kr8aY75Hsdfyp0ppiAxfZPB1y8Ms/kyEasaJWcqEj\nwEQsWkA+U5M1bRsdu0WyuuZpqww79EzZf3rwjqpMdYZer4KbveNSLq0FcTCcCKU3\n0fwCZFEbgVETqXy0+1F7xazNh8DxySe2gBgFM17IT9CeZrvpFUJqOrMhCCghNsB4\nUR2712XdZtTMbiaUrHgIVlsmBRi/0+IP/HuPMC/jWMQWyoEXmK663uj/Xjj9dCO0\nGrlnJWUOVg9CcMWAxtgCHkPLFY975VcnqQZ54lRR2SptB3hMCJbhzhuWS5P8lyRs\n+jylNq0Fe+PqBFpWH6V8P/qz9ea/4rSX+FKvfg34pwKBgQDircnOmuE8VptvHs/4\nn1+njN9nX2lxj9J886xGSgWuuffExRQ4cxc91ke/RkU09842ua2Zg3lrUJX9EQLJ\nRu3C3LF8lsGInI7cgh/wfe6ZDf5E1R9tteUMudjvoOBmsI2NHwkhcsFvZ0Y3u8A8\nvk7ZFO/z6AysNZICBAAJZEsYIwKBgQDdISSjdFTrk+Nx4TMQcMpxjuXK215DvhJO\n1oRtE1Xqf2QgM0BVrSg+j52wY+r++MeITFrBmQBudIjseJtKJMgTVT0tF04a/fe4\nhyaXjVtaD2uQRN6jqVnYJLmRVl3nKENL9CoozIuQku1w4NqD0Et7RCgh/cANz/1z\ngkhBTCeoBwKBgQCvPHqOZd1JsAppVQChy1M/TABJAdGaIP0v65B6pi7ObKXGUDTZ\njt+gxk6g58oIsKmSVOiHjMQI2juZb9UflN2pjsMG9eSXn7Axd8cJO9GAMPkobTnm\nrn9r3yB933ia6lIDjsKYQQaZANWfsF1kmBqMZ0s422MwnhlJxZ3hpM8I0QKBgHJ+\nb6cGW9XiK9jR/oubquZjU83WCZfPuVECt2x2n3ycWy5k+wGhd331BHPJOGquSzni\nNveYjeWjByZRSC56nvGLp/JJ59IH/5SWvb+onE0kQNBhKFnbHL7SPRbofhRq/3U7\nRfz786N2v+Q7OEkZt4tqfdEjvqYoNBXztg/BK6NPAoGAVSgZX1XBrIZ6JS8CZ/wG\nHoVy2F4VvYSkwUuOSvZPNM3TvmEJxPaY33dsqbWOwwdp2bbqx5YCYogU2XYQlKQR\noRZtZSA6PPYdKN8VIBHcfCu236HBe0EgmMNEkT3H/lF6CnROsNAmwNjd3os9nlL7\nRDOM71a+tYjnO6f3FVs/ChM=\n-----END PRIVATE KEY-----\n";

    $tokenUri     = "https://oauth2.googleapis.com/token";
    $now = time();
    $expires = $now + 3600; // 1 jam

    $payload = [
      "iss"   => $clientEmail,
      "scope" => "https://www.googleapis.com/auth/firebase.messaging",
      "aud"   => $tokenUri,
      "iat"   => $now,
      "exp"   => $expires,
    ];

    // Pakai firebase/php-jwt (sudah otomatis ke-install bareng google/auth)
    $jwt = JWT::encode($payload, $privateKey, 'RS256');

    // Request access token ke Google
    $client = new Client();
    $response = $client->post($tokenUri, [
      'form_params' => [
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'assertion'  => $jwt,
      ]
    ]);

    $body = json_decode((string) $response->getBody(), true);

    return $body['access_token'];
}

  // ARTA | START | PO WO CHAT + MIGRASI FIREBASE V1 | September 2025
  public function sendNotifDevice($type, $title, $body = '', $screen = '', $screenid = '')
  {
    $projectId = "driverapp-b527b";
    // Ambil token device dari DB (contoh karyawan_id=639)
    // $arrToken = AppDriverFCM::where('karyawan_id', 252)->pluck('token')->filter()->toArray();
    $arrToken = AppDriverFCM::where('karyawan_id', 252)
      ->whereNotNull('token')
      ->where('token', '!=', '')
      ->orderBy('updated_at', 'desc') // Ambil yang paling baru diupdate
      ->get()
      ->unique('karyawan_id')
      ->pluck('token')
      ->toArray();

    if (empty($arrToken)) {
      return response()->json([
        'msg' => "Token tidak ditemukan di DB"
      ], 400);
    }

    $accessToken = $this->getAccessToken();
    // dd($accessToken);
    $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

    $headers = [
      "Authorization: Bearer {$accessToken}",
      "Content-Type: application/json"
    ];

    // jika banyak token, bisa di-loop
    $responses = [];
    foreach ($arrToken as $deviceToken) {
      $payload = [
        "message" => [
          "token" => $deviceToken,
          "notification" => [
            "title" => $title,
            "body"  => $body,
          ],
          "data" => [
            "type"     => $type,
            "title"    => $title,
            "body"     => $body,
            "screen"   => $screen,
            "screenid" => $screenid,
          ]
        ]
      ];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

      $result = curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);

      $responses[] = [
        'http_code' => $httpCode,
        'response'  => json_decode($result, true),
      ];
    }

    return response()->json([
      'msg' => "Response dari Firebase",
      'results' => $responses
    ]);
  }
  // ARTA | END | PO WO CHAT + MIGRASI FIREBASE V1 | September 2025

  public function sendNotifDeviceByNokendTanggal(
    $nokend,
    $tanggal, // Parameter ini tidak perlu dipakai untuk filter token, tapi mungkin dipakai untuk body notif
    $type,
    $title,
    $body = '',
    $screen = '',
    $screenid = ''
  ) {
    $projectId = "driverapp-b527b";

    // PERBAIKAN DISINI
    // Kita cari token milik kendaraan tersebut yang PALING BARU diupdate.
    // Tidak peduli updatenya kemarin atau hari ini, yang penting itu update terakhir.
    $arrToken = AppDriverFCM::where('nokend', $nokend)
      // ->whereDate('updated_at', $tanggal) // <--- HAPUS BARIS INI
      ->whereNotNull('token')
      ->where('token', '!=', '')
      ->orderBy('updated_at', 'desc') // Pastikan ambil yang paling baru
      ->take(1) // Ambil 1 saja yang paling baru (opsional, jika 1 mobil 1 hp)
      ->pluck('token')
      ->toArray();

    if (empty($arrToken)) {
      return [
        'status' => false,
        'msg'    => 'Token tidak ditemukan untuk Kendaraan: ' . $nokend
      ];
    }

    $accessToken = $this->getAccessToken();
    $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

    $headers = [
      "Authorization: Bearer {$accessToken}",
      "Content-Type: application/json"
    ];

    $responses = [];

    foreach ($arrToken as $deviceToken) {

      $payload = [
        "message" => [
          "token" => $deviceToken,
          "notification" => [
            "title" => $title,
            "body"  => $body,
          ],
          "data" => [
            "type"     => $type,
            "title"    => $title,
            "body"     => $body,
            "screen"   => $screen,
            "screenid" => $screenid,
          ]
        ]
      ];

      $ch = curl_init($url);
      curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => json_encode($payload)
      ]);

      $result = curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);

      $resultArr = json_decode($result, true);

      // 🔥 AUTO DELETE TOKEN INVALID
      if (
        $httpCode == 404 &&
        isset($resultArr['error']['details'][0]['errorCode']) &&
        $resultArr['error']['details'][0]['errorCode'] === 'UNREGISTERED'
      ) {
        AppDriverFCM::where('token', $deviceToken)->delete();
      }

      $responses[] = [
        'token' => substr($deviceToken, 0, 20) . '...',
        'http_code' => $httpCode,
        'response' => $resultArr
      ];
    }

    return [
      'status'  => true,
      'results' => $responses
    ];
  }

  public function sendToSales($karyawanId, $title, $body, $screen = 'MainActivity', $screenid = '')
  {
    try {
      // Menggunakan Eloquent Model AppSalesFCM
      $dataFCM = AppSalesFCM::where('karyawan_id', $karyawanId)
        ->whereNotNull('token')
        ->where('token', '!=', '')
        ->first();

      if (!$dataFCM) {
        return ['status' => false, 'msg' => 'Token Sales tidak ditemukan'];
      }

      $token = $dataFCM->token;
      $accessToken = $this->getAccessTokenSales();
      $projectId = "irasa-sales";
      $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

      $payload = [
        "message" => [
          "token" => $token,
          "notification" => [
            "title" => $title,
            "body"  => $body,
          ],
          "data" => [
            "title"    => $title,
            "body"     => $body,
            "screen"   => $screen,
            "screenid" => $screenid
          ]
        ]
      ];

      $headers = [
        "Authorization: Bearer {$accessToken}",
        "Content-Type: application/json"
      ];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

      $result = curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);

      $resultArr = json_decode($result, true);

      // --- VALIDASI TOKEN OTOMATIS ---
      // Jika Firebase merespon UNREGISTERED (app sudah di-uninstall), hapus dari DB
      if (
        $httpCode == 404 && isset($resultArr['error']['details'][0]['errorCode']) &&
        $resultArr['error']['details'][0]['errorCode'] === 'UNREGISTERED'
      ) {
        $dataFCM->delete();
      }

      return ['status' => true, 'response' => $resultArr];
    } catch (\Exception $e) {
      return ['status' => false, 'msg' => $e->getMessage()];
    }
  }
}
