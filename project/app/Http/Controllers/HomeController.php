<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function users()
    {
        $agent = DB::table('agent')->paginate(5);

        return view('users', ['agent' => $agent]);
    }

    public function product()
    {
        $product =
            DB::table('product')
            ->select(
                'product.product_name',
                'product.id',
                'product.category',
                'product_category.name',
                'product.price_agent',
                'product.price_promo'
            )
            ->join('product_category', 'product.category', '=', 'product_category.id')
            ->paginate(10);
        return view('product', ['product' => $product]);
    }

    public function orders()
    {
        $orders =
            DB::table('customer')
            ->select(
                'orders.name',
                'agent.store_name',
                'order_detail.qty'
            )
            ->join('orders', 'customer.id', '=', 'orders.customer_id')
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->join('agent', 'orders.agent_id', '=', 'agent.id')
            ->paginate(10);
        return view('orders', ['orders' => $orders]);
    }

    public function laporan()
    {
        return view('laporan');
    }

    public function laporantopagent()
    {
        $laporan =
            DB::table('agent')
            ->select(
                array(
                    'agent.store_name',
                    DB::raw('Count(orders.customer_id) as count')
                )
            )
            ->join('orders', 'orders.agent_id', '=', 'agent.id')
            ->groupBy(
                'agent.store_name'
            )
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();
        $pdf = PDF::loadView('topagent_pdf', ['topagent' => $laporan]);
        return $pdf->stream('topagent_pdf', array('Attachment' => 0));
    }

    public function laporantopcustomer()
    {
        $laporan =
            DB::table('customer')
            ->select(
                array(
                    'orders.name',
                    DB::raw('Sum(order_detail.qty) as sum')
                )
            )
            ->join('orders', 'customer.id', '=', 'orders.customer_id')
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->groupBy(
                'orders.name'
            )
            ->orderBy('sum', 'desc')
            ->take(10)
            ->get();
        $pdf = PDF::loadView('topcustomer_pdf', ['topcustomer' => $laporan]);
        return $pdf->stream('topcustomer_pdf', array('Attachment' => 0));
    }

    public function laporantopproduct()
    {
        $laporan =
            DB::table('product')
            ->select(
                array(
                    'product.product_name',
                    DB::raw('Sum(order_detail.qty) as sum')
                )
            )
            ->join('order_detail', 'order_detail.product_id', '=', 'product.id')
            ->groupBy(
                'product.product_name'
            )
            ->orderBy('sum', 'desc')
            ->take(10)
            ->get();
        $pdf = PDF::loadView('topproduct_pdf', ['topproduct' => $laporan]);
        return $pdf->stream('topproduct_pdf', array('Attachment' => 0));
    }

    public function laporanjualkategori()
    {
        // $laporan =
        //     DB::table('product')
        //     ->select(
        //         array(
        //             'product_category.name',
        //             DB::raw('Sum(product.price_sell) as harga', 'Sum(order_detail.qty) as jumlah')
        //         )
        //     )
        //     ->join('product_category', 'product.category', '=', 'product_category.id')
        //     ->from('orders')
        //     ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
        //     ->groupBy(
        //         'product_category.name'
        //     )
        //     ->get();
            $laporan = DB::table('vw_penjualan')->get();
        $pdf = PDF::loadView('jualkategori_pdf', ['jualkategori' => $laporan]);
        return $pdf->stream('jualkategori_pdf', array('Attachment' => 0));
    }
}
