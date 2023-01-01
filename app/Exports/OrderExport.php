<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\OrderProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orders =  Order::with(['users','orderProducts','deliveryAddress'])->select(['id','order_id','user_id','delivery_address_id','shipping_charge','coupon_code','coupon_discount','order_status','payment_status','payment_gateway','grand_total','courier_name','tracking_number'])
            ->latest()->get();

        foreach($orders as $order){
                $order->user_name = $order->users->name;
                $order->user_email = $order->users->email;
                $order->user_mobile = $order->users->mobile;
                $order->user_address = $order->users->address;
                $order->user_city = $order->users->city;
                $order->user_country = $order->users->country;

                $order->delivery_name = $order->deliveryAddress->name;
                $order->delivery_email = $order->deliveryAddress->email;
                $order->delivery_mobile = $order->deliveryAddress->mobile;
                $order->delivery_address = $order->deliveryAddress->address;
                $order->delivery_city = $order->deliveryAddress->city;
                $order->delivery_country = $order->deliveryAddress->country;

                $order->order_products = $order->orderProducts->map(function($orderProduct){
                    return $orderProduct->product->product_name;
                })->implode(',');

                $order->order_products_price = $order->orderProducts->map(function($orderProduct){
                    return $orderProduct->product->product_price;
                })->implode(',');

                $order->order_products_size = $order->orderProducts->map(function($orderProduct){
                    return $orderProduct->size;
                })->implode(',');

                $order->order_products_qty = $order->orderProducts->map(function($orderProduct){
                    return $orderProduct->qty;
                })->implode(',');

                $order->order_products_owner = $order->orderProducts->map(function($orderProduct){
                     if($orderProduct->product->vendor == null){
                         return  'Admin';
                        }else{
                            return $orderProduct->product->vendor->name;
                        }
                })->implode(',');

                //payment status
                if($order->payment_status == 0){
                    $order->payment_status = 'Cancel';
                }else if($order->payment_status == 1){
                    $order->payment_status = 'Completed';
                }else if($order->payment_status == 2){
                    $order->payment_status = 'Pending';
                }else if($order->payment_status == 3){
                    $order->payment_status = 'Incomplete';
                }

                //order status
                if($order->order_status == 0){
                    $order->order_status = 'Pending';
                }else if($order->order_status == 1){
                    $order->order_status = 'Processing';
                }else if($order->order_status == 2){
                    $order->order_status = 'Shipping';
                }else if($order->order_status == 3){
                    $order->order_status = 'Complete';
                }else if($order->order_status == 4){
                    $order->order_status = 'Cancel';
                }else if($order->order_status == 5){
                    $order->order_status = 'Delivered';
                }

                //payment gateway
                if($order->payment_gateway == 'COD'){
                    $order->payment_gateway = 'Cash On Delivery';
                }else{
                    $order->payment_gateway =  $order->payment_gateway;
                }


                unset($order->user_id);
                unset($order->delivery_address_id);

        }


     return $orders;





    }

    public function headings(): array
    {
        return [
            'ID',
            'Order Track ID',
            'Shipping Charge',
            'Coupon Code',
            'Coupon Discount',
            'Order Status',
            'Payment Status',
            'Payment Gateway',
            'Grand Total',
            'Courier Name',
            'Tracking Number',
            'User Name',
            'User Email',
            'User Mobile',
            'User Address',
            'User City',
            'User Country',
            'Delivery Address User Name',
            'Delivery Address User Email',
            'Delivery Address User Mobile',
            'Delivery Address',
            'Delivery City',
            'Delivery Country',
            'Order Products',
            'Order Products Price',
            'Order Products Size',
            'Order Products Qty',
            'Order Products Owner',

        ];
    }
}
