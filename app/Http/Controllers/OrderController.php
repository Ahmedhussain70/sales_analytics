<?php

namespace App\Http\Controllers;

// use App\Application\UseCases\CreateOrder;
// use App\Application\UseCases\GetAnalytics;
use App\Infrastructure\Eloquent\EloquentOrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // protected $createOrder;
    // protected $getAnalytics;
    protected $orderRepository;

    // public function __construct(EloquentOrderRepository $orderRepository, CreateOrder $createOrder, GetAnalytics $getAnalytics)
    // {
    //     $this->createOrder = $createOrder;
    //     $this->getAnalytics = $getAnalytics;
    //     $this->orderRepository = $orderRepository;
    // }

    public function __construct(EloquentOrderRepository $orderRepository)
    {
        // $this->createOrder = $createOrder;
        // $this->getAnalytics = $getAnalytics;
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->getAll();

        return response()->json(['orders' => $orders]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $orderId = $this->orderRepository->create($validatedData);

        return response()->json(['message' => 'Order created successfully', 'order_id' => $orderId], 201);
    }

    public function analytics()
    {
        $analytics = $this->orderRepository->getRecentSales();

        return response()->json(['total_sales' => $analytics]);
    }
}
