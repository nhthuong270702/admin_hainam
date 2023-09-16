<?php

namespace App\Console\Commands;

use App\Mail\WarrantyEmail;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->where('orders.status', 2) // Đã bán
            ->where('users.type', 2)
            ->join('order_product', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->join('maintains', 'order_product.id', '=', 'maintains.order_product_id')
            ->where('maintains.date', '=', now()->format('d-m-Y'))
            ->select('users.id', 'users.name', 'users.email AS user_email', 'customers.company', 'customers.address', 'customers.name AS contact_person', 'customers.phone_number', 'products.name AS product_name')
            ->distinct()
            ->get();

        $employeeProducts = [];

        foreach ($orders as $order) {
            $userId = $order->id;
            $userName = $order->name;
            $userEmail = $order->user_email;
            $company = $order->company;
            $address = $order->address;
            $contact = $order->contact_person;
            $phone = $order->phone_number;
            $product = $order->product_name;

            if (!isset($employeeProducts[$userId])) {
                $employeeProducts[$userId] = [
                    'name' => $userName,
                    'product_count' => 1,
                    'products' => [$product],
                    'company' => $company,
                    'address' => $address,
                    'contact' => $contact,
                    'phone' => $phone,
                    'user_email' => $userEmail,
                ];
            } else {
                $employeeProducts[$userId]['product_count']++;
                $employeeProducts[$userId]['products'][] = $product;
            }
        }

        foreach ($employeeProducts as $employee) {
            $name = $employee['name'];
            $email = $employee['user_email'];
            $company = $employee['company'];
            $address = $employee['address'];
            $contact = $employee['contact'];
            $phone = $employee['phone'];
            $products = $employee['products'];

            $data = [
                'company' => $company,
                'address' => $address,
                'contact' => $contact,
                'phone_number' => $phone,
                'products' => $products,
                'name' => $name
            ];

            Mail::send('emails.warranty', ['data' => $data], function ($message) use ($email) {
                $message->to($email)->subject('Danh sách khách hàng cần bảo hành ngày ' . now()->format('d/m/Y'));
            });
        }
    }
}
