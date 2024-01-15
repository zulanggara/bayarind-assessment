<?php
try {
    $data = json_decode(file_get_contents('php://input'), true);
    $totalBelanjaan = $data['input'];
    $pecahanUang = [100, 200, 500, 1000, 2000, 5000, 10000, 20000, 50000, 100000];
    $pilihanPembayaran = [];

    // Identifikasi pecahan diatas nominal pembayaran
    $moreThan = array_filter($pecahanUang, function ($value) use ($totalBelanjaan) {
        return $value >= $totalBelanjaan;
    });
    $pilihanPembayaran = array_values($moreThan);
    $batasMoreThan = 0;
    foreach ($moreThan as $key => $value) {
        if (empty($batasMoreThan)) {
            $batasMoreThan = $value;
        }
        break;
    }

    // Identifikasi pecahan dibawah nominal pembayaran
    // ---------------------------
    $lessThan = array_filter($pecahanUang, function ($value) use ($totalBelanjaan) {
        return $value < $totalBelanjaan;
    });

    $countLessThan = count($lessThan);
    foreach ($lessThan as $key => $value) {
        // cek masing-masing nominal itu sendiri apakah bisa dikalikan dan cukup untuk membayar
        $check_1a = ceil($totalBelanjaan / $value);
        $check_1b = $check_1a * $value;
        if ($check_1b > $totalBelanjaan) {
            if ($check_1b < $batasMoreThan) {
                array_push($pilihanPembayaran, $check_1b);
            }
        }
        // cek kombinasi mata uang
        for ($i = 0; $i < $countLessThan; $i++) {
            $j = 1;
            $check_b = 0;
            while ($check_b <= $totalBelanjaan) {
                $check_b = $value + ($lessThan[$i] * $j);
                $j++;
            }
            if ($check_b < $batasMoreThan) {
                array_push($pilihanPembayaran, $check_b);
            }
        }
    }
    // ---------------------------

    // Sorting data opsi pembayaran
    sort($pilihanPembayaran);

    // Tambah opsi "Uang Pas"
    array_push($pilihanPembayaran, 'Uang Pas');

    // data dikembalikan menjadi json dengan pilihanPembayaran yang akan ditampilkan dibuat unique(menghindari duplikasi nominal) dan diambil nilainya saja
    echo json_encode(['status' => true, 'totalBelanjaan' => $totalBelanjaan, 'pilihanPembayaran' => array_values(array_unique($pilihanPembayaran))]);
} catch (\Exception $e) {
    //throw $th;
    echo json_encode(['status' => false, 'totalBelanjaan' => $totalBelanjaan, 'message' => '', 'error' => $e->getMessage()]);
}
exit;
