<?php

namespace App\Http\Controllers\API\Map;

use App\Http\Controllers\Controller;
use App\Http\Requests\Map\UserMapLocationCreateRequest;
use App\Http\Requests\Map\UserMapLocationUpdateRequest;
use App\Http\Requests\Map\UserMapPlaceCreateRequest;
use App\Http\Requests\Map\UserMapPlaceUpdateRequest;
use App\Http\Resources\Map\Map;
use App\Http\Resources\Map\MapCollection;
use App\Models\UserMapPlace;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    public function getUserMapLocation(): Map
    {
        $user = Auth::user();
        return Map::make($user?->mapsLocation()->paginate());
    }

    public function getUserPlacePoints(): MapCollection
    {
        $user = Auth::user();
        return MapCollection::make($user?->mapsPlaces()->paginate());
    }

    public function createUserLocation(UserMapLocationCreateRequest $request): JsonResponse
    {
        $user = Auth::user();
        $data = $request->validated();
        $user?->mapsLocation()->create($data);

        return response()->json(['message' => __('map_location_success_creation'), 'location' => $user?->mapsLocation()->paginate()]);
    }

    public function createUserPlacePoint(UserMapPlaceCreateRequest $request): JsonResponse
    {
        $user = Auth::user();
        $data = $request->validated();
        $user?->mapsPlaces()->create($data);

        return response()->json(['message' => __('map_place_success_creation'), 'location' => $user?->mapsPlaces()->paginate()]);
    }

    public function updateUserLocation(UserMapLocationUpdateRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        $user?->mapsLocation()->update($data);

        return response()->json(['message' => __('map_location_success_update'), 'location' => $user?->mapsLocation()->paginate()]);
    }

    public function updateUserPlacePoint(UserMapPlace $point, UserMapPlaceUpdateRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        $user?->mapsPlaces()->where('id', $point->id)->update($data);

        return response()->json(['message' => __('map_place_success_update'), 'location' => $user?->mapsPlaces()->paginate()]);
    }

    public function deleteUserLocation(): JsonResponse
    {
        $user = Auth::user();
        $user?->mapsLocation()->delete();

        return response()->json(['message' => __('map_location_success_delete')]);
    }

    public function deleteUserPlacePoint(UserMapPlace $point): JsonResponse
    {
        $user = Auth::user();
        $user?->mapsPlaces()->where('id', $point->id)->delete();

        return response()->json(['message' => __('map_place_success_delete'), 'location' => $user?->mapsPlaces()->paginate()]);
    }
}
