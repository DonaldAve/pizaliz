<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    public function show(int $id): UserResource
    {
        return new UserResource(User::findOrFail($id));
    }

    public function update(int $id, Request $request): UserResource
    {
        // Находим пользователя
        $user = User::findOrFail($id);

        // Валидация данных
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'surname' => 'sometimes|string|max:255|nullable',
            'email' => 'sometimes|email|max:255|unique:users,email,'.$user->id,
            'phone_number' => 'sometimes|string|max:20|nullable',
            'adress_delivery' => 'sometimes|string|max:500|nullable',
            'password' => 'sometimes|string|min:8'
        ]);

        // Хеширование пароля при необходимости
        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        // Обновление пользователя
        $user->update($validated);

        // Возвращаем обновленные данные
        return new UserResource($user->fresh());
    }




}
