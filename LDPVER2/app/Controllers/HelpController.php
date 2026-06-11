<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserRepository;
use App\Models\NotificationRepository;

class HelpController extends Controller
{
    private $userRepo;
    private $notifRepo;
    private $pdo;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $this->redirect(''); // Redirect to login
        }

        $this->pdo = $this->getDB();
        $this->userRepo = new UserRepository($this->pdo);
        $this->notifRepo = new NotificationRepository($this->pdo);
    }

    public function index()
    {
        $user_id = $_SESSION['user_id'];
        
        $data = [
            'user' => $this->userRepo->getUserById($user_id),
            'notifRepo' => $this->notifRepo,
            'pdo' => $this->pdo,
            'helpdesk_url' => $_ENV['ICT_HELPDESK_URL'] ?? '#',

            'satisfaction_url' => $_ENV['CLIENT_SATISFACTION_URL'] ?? '#'
        ];

        $this->view('help/index', $data);
    }
}
