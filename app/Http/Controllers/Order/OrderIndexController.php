<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderIndexController extends Controller
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        return OrderResource::collection(
            $this->getOrders($request)
        );
    }

    protected function getOrders(Request $request): LengthAwarePaginator
    {
        return Order::query()
            ->when($request->has('id'), function(Builder $query) use($request) {
                $query->where('id', $request->input('id'));
            })
            ->when($request->has('statusId'), function(Builder $query) use($request) {
                $query->where('status_id', $request->input('statusId'));
            })
            ->when($request->has('dateFrom'), function(Builder $query) use($request) {
                $query->where('created_at', '>=', $request->input('dateFrom'));
            })
            ->when($request->has('dateUntil'), function(Builder $query) use($request) {
                $query->where('created_at', '<', $request->input('dateUntil'));
            })
            ->latest()
            ->paginate();
    }
}
