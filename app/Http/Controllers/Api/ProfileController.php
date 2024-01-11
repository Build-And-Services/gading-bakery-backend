<?php

namespace App\Http\Controllers\Api;

use File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProfileResource;
use App\Http\Controllers\Api\BaseController as BaseController;

class ProfileController extends BaseController
{
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'image' => 'image|mimes:png,jpg,jpeg|max:5120',
            ]);


            $user = User::findOrFail($id);

            $request->user()->currentAccessToken()->delete();
            $newToken = $user->createToken('auth_token')->plainTextToken;

            $dataToUpdate = [
                'image' => $request->image,
                'name' => $request->name,
                'email' => $request->email,
                'remember_token' => $newToken
            ];

            if ($request->hasFile('image')) {
                $url = $user->image;
                $oldFile = pathinfo($url);
                $oldFilePath = public_path('images/profiles/' . $oldFile['basename']);

                if ($oldFile && File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }

                $fileName = date('YmdHis') . '-image' . '.' . $request->image->extension();
                $request->image->move(public_path('images/profiles'), $fileName);
                $dataToUpdate['image'] = url("/images/profiles/{$fileName}");
            }

            $user->update($dataToUpdate);

            return response()->json([
                // 'status' => getMessage(),
                'success' => true,
                'message' => 'Successfully updated user profile',
                'data' => $user,
                'access_token' => $newToken,
                'token_type' => 'Bearer',
            ], 202);

            // return $this->sendResponse(new ProfileResource($user), [
            //     'Successfully updated user profile',
            //     'access_token' => $newToken,
            //     'token_type' => 'Bearer',
            // ], 202);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}
