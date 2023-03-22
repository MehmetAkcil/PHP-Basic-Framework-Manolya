<?php


use Config\Respond;
use Models\UserModel;

class UserController extends Respond
{
    public function index()
    {
        $userModel = new UserModel();
        return self::response(200, [
            'data' => $userModel->find()
        ]);
    }

    public function show($id): void
    {
        echo 'uye bilgisi' . $id;
    }

    public function update($id): void
    {
        echo 'uye kaydet' . $id;
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