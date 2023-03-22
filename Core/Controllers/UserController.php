<?php
namespace Core\Controllers;
use Core\Config\Respond;
use Core\Models\UserModel;

class UserController extends Respond
{
    public function index(): false|string
    {
        $userModel = new UserModel();
        return self::respond([
            'data' => $userModel->findAll()
        ]);
    }

    public function show($id): string
    {
        return 'uye bilgisi' . $id;
    }

    public function update($id): string
    {
        return 'uye kaydet' . $id;
    }

    public function create(): string
    {
        return 'uye ekle post';
    }
    public function delete($id): string
    {
        return self::responseDelete([
            'message' => 'Islem Basarili'
        ]);
    }
}