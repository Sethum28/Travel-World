<?php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) session_start();

define('ROOT_PATH', dirname(__DIR__));
define('DATA_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'data');
define('UPLOAD_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'uploads');

if (!is_dir(DATA_PATH)) @mkdir(DATA_PATH, 0775, true);
if (!is_dir(UPLOAD_PATH)) @mkdir(UPLOAD_PATH, 0775, true);

function data_file(string $name): string { return DATA_PATH . DIRECTORY_SEPARATOR . $name . '.json'; }

function read_data(string $name, array $default = []): array {
    $file = data_file($name);
    if (!file_exists($file)) {
        write_data($name, $default);
        return $default;
    }
    $raw = file_get_contents($file);
    $data = json_decode($raw ?: '', true);
    return is_array($data) ? $data : $default;
}

function write_data(string $name, array $data): bool {
    $file = data_file($name);
    $tmp = $file . '.tmp';
    $ok = file_put_contents($tmp, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), LOCK_EX);
    if ($ok === false) return false;
    return rename($tmp, $file);
}

function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }

function redirect(string $url): never {
    header('Location: ' . $url);
    exit;
}

function json_response(bool $success, string $message = '', array $extra = []): never {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array_merge(['status'=>$success?'success':'error','message'=>$message], $extra));
    exit;
}

function is_admin(): bool { return !empty($_SESSION['admin']); }

function require_admin(): void {
    if (!is_admin()) redirect('login.php');
}

function admin_asset(string $path): string {
    return str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/') ? $path : '../' . ltrim($path, './');
}

function public_asset(string $path): string {
    return $path;
}

function save_uploaded_image(string $field, string $folder='uploads'): ?string {
    if (empty($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) return null;
    $file = $_FILES[$field];
    if ($file['size'] > 5 * 1024 * 1024) return null;
    $allowed = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp','image/gif'=>'gif'];
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    if (!isset($allowed[$mime])) return null;
    $dir = ROOT_PATH . '/' . trim($folder,'/');
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    $name = time() . '_' . bin2hex(random_bytes(4)) . '.' . $allowed[$mime];
    if (!move_uploaded_file($file['tmp_name'], $dir . '/' . $name)) return null;
    return trim($folder,'/') . '/' . $name;
}
function next_id(array $items): int {
    $max=0; foreach($items as $item) $max=max($max,(int)($item['id']??0)); return $max+1;
}
function setting(string $key, string $default=''): string {
    $s=read_data('settings',[]);
    return (string)($s[$key]??$default);
}
