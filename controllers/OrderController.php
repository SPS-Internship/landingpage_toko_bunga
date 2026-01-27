<?php
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../config/database.php';

class OrderController {

    private $order;

    public function __construct() {
        $this->order = new Order();
    }

    /* DAFTAR SEMUA ORDER */
    public function index() {

        $data = $this->order->getAll();

        if (!$data) {
            echo json_encode([
                'status' => false,
                'message' => 'Data order tidak ditemukan'
            ]);
            return;
        }

        echo json_encode([
            'status' => true,
            'data' => $data
        ]);
    }

    /* AMBIL 1 ORDER */
    public function show($id) {

        $id = htmlspecialchars($id);

        if (empty($id)) {
            echo json_encode([
                'status' => false,
                'message' => 'ID order kosong'
            ]);
            return;
        }

        $data = $this->order->getById($id);

        if (!$data) {
            echo json_encode([
                'status' => false,
                'message' => 'Order tidak ditemukan'
            ]);
            return;
        }

        echo json_encode([
            'status' => true,
            'data' => $data
        ]);
    }

    /* SIMPAN ORDER BARU */
    public function store() {

        $input = file_get_contents("php://input");
        $data  = json_decode($input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode([
                'status' => false,
                'message' => 'Format JSON tidak valid'
            ]);
            return;
        }

        if (empty($data)) {
            echo json_encode([
                'status' => false,
                'message' => 'Data order kosong'
            ]);
            return;
        }

        /* DEFAULT STATUS */
        if (!isset($data['status'])) {
            $data['status'] = 'MENUNGGU BAYAR';
        }

        /* HITUNG TOTAL OTOMATIS JIKA ADA ITEMS */
        if (isset($data['items']) && is_array($data['items'])) {

            $total = 0;
            foreach ($data['items'] as $it) {
                $total += $it['price'] * $it['quantity'];
            }

            $data['total_price'] = $total;
        }

        $save = $this->order->create($data);

        if (!$save) {
            echo json_encode([
                'status' => false,
                'message' => 'Gagal menyimpan order'
            ]);
            return;
        }

        echo json_encode([
            'status' => true,
            'message' => 'Order berhasil dibuat'
        ]);
    }

    /* UPDATE ORDER */
    public function update($id) {

        $id = htmlspecialchars($id);

        $input = file_get_contents("php://input");
        $data  = json_decode($input, true);

        if (empty($id)) {
            echo json_encode([
                'status' => false,
                'message' => 'ID kosong'
            ]);
            return;
        }

        if (empty($data)) {
            echo json_encode([
                'status' => false,
                'message' => 'Data update kosong'
            ]);
            return;
        }

        /* UPDATE TOTAL JIKA ADA PERUBAHAN ITEMS */
        if (isset($data['items'])) {

            $total = 0;
            foreach ($data['items'] as $it) {
                $total += $it['price'] * $it['quantity'];
            }

            $data['total_price'] = $total;
        }

        $up = $this->order->update($id, $data);

        if (!$up) {
            echo json_encode([
                'status' => false,
                'message' => 'Gagal update order'
            ]);
            return;
        }

        echo json_encode([
            'status' => true,
            'message' => 'Order berhasil diupdate'
        ]);
    }

    /* HAPUS ORDER */
    public function destroy($id) {

        $id = htmlspecialchars($id);

        if (empty($id)) {
            echo json_encode([
                'status' => false,
                'message' => 'ID kosong'
            ]);
            return;
        }

        $del = $this->order->delete($id);

        if (!$del) {
            echo json_encode([
                'status' => false,
                'message' => 'Gagal hapus order'
            ]);
            return;
        }

        echo json_encode([
            'status' => true,
            'message' => 'Order berhasil dihapus'
        ]);
    }
}
?>
