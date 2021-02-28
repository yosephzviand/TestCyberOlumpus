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

    public function laporanusers()
    {
        $laporan = DB::table('agent')->get();

        $pdf = PDF::loadView('laporanusers_pdf', ['agent' => $laporan]);
        return $pdf->stream('laporanusers_pdf', array('Attachment' => 0));
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

    public function laporanproduct()
    {
        $laporan =
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
            ->get();
        $pdf = PDF::loadView('laporanproduct_pdf', ['product' => $laporan]);
        return $pdf->stream('laporanproduct_pdf', array('Attachment' => 0));
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

    public function laproranorders()
    {
        set_time_limit(0);
        $laporan =
            DB::table('customer')
            ->select(
                'orders.name',
                'agent.store_name',
                'order_detail.qty'
            )
            ->join('orders', 'customer.id', '=', 'orders.customer_id')
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->join('agent', 'orders.agent_id', '=', 'agent.id')
            ->get();
            $pdf = PDF::loadView('laporanoders_pdf', ['orders' => $laporan]);
            return $pdf->stream('laporanoders_pdf', array('Attachment' => 0));
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
        $laporan = DB::table('vw_penjualan')->get();
        $pdf = PDF::loadView('jualkategori_pdf', ['jualkategori' => $laporan]);
        return $pdf->stream('jualkategori_pdf', array('Attachment' => 0));
    }

    public function laporantotal()
    {
        return view('laptotal');
    }

    public function laporantotalproses(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');
        $laporan =
            DB::table('orders')
            ->selectRaw(
                'Sum(orders.delivery_fee) AS ongkir,
                Sum(orders.payment_final) AS pembayaran,
                Sum(orders.payment_discount) AS diskon,
                Sum(order_detail.qty) AS qty,
                Count(product.product_name) AS totalitem,
                Count(orders.id) AS totalorder'
            )
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->join('product', 'order_detail.product_id', '=', 'product.id')
            ->whereBetween('orders.payment_date', [$awal, $akhir])
            ->get();
        $pdf = PDF::loadView('laporantotal_pdf', ['laptotal' => $laporan]);
        return $pdf->stream('laporantotal_pdf', array('Attachment' => 0));
    }

    public function laporanorder()
    {
        return view('laporder');
    }

    public function laporanorderproses(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');
        $laporan =
            DB::table('orders')
            ->selectRaw(
                'orders.name,
                Sum(order_detail.qty) as jumlah'
            )
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->whereBetween('orders.payment_date', [$awal, $akhir])
            ->groupBy(
                'orders.name'
            )
            ->get();
        $pdf = PDF::loadView('laporanorder_pdf', ['laporder' => $laporan]);
        return $pdf->stream('laporanorder_pdf', array('Attachment' => 0));
    }

    public function laporanorderagent()
    {
        return view('laporderagent');
    }

    public function laporanorderagentproses(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');
        $laporan =
            DB::table('agent')
            ->selectRaw(
                'agent.store_name,
                Sum(order_detail.qty)as jumlah'
            )
            ->join('orders', 'orders.agent_id', '=', 'agent.id')
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->whereBetween('orders.payment_date', [$awal, $akhir])
            ->groupBy(
                'agent.store_name'
            )
            ->get();
        $pdf = PDF::loadView('laporanorderagent_pdf', ['laporderagent' => $laporan]);
        return $pdf->stream('laporanorderagent_pdf', array('Attachment' => 0));
    }

    public function laporanuntungproses(Request $request)
    {

        $laporan =
            DB::table('agent')
            ->selectRaw(
                'agent.store_name,
                Sum(order_detail.total_price) - Sum(order_detail.price) as keuntungan'
            )
            ->join('orders', 'orders.agent_id', '=', 'agent.id')
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->groupBy(
                'agent.store_name'
            )
            ->get();
        $pdf = PDF::loadView('laporanuntung_pdf', ['lapuntung' => $laporan]);
        return $pdf->stream('laporanuntung_pdf', array('Attachment' => 0));
    }

    public function laporanitem()
    {
        return view('lapitem');
    }

    public function laporanitemproses(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');
        $laporan =
            DB::table('orders')
            ->selectRaw(
                'product.product_name,
                Sum(order_detail.qty) as jumlah,
                Sum(orders.payment_total) as total'
            )
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->join('product', 'order_detail.product_id', '=', 'product.id')
            ->whereBetween('orders.payment_date', [$awal, $akhir])
            ->groupBy(
                'product.product_name'
            )
            ->get();
        $pdf = PDF::loadView('laporanitem_pdf', ['lapitem' => $laporan]);
        return $pdf->stream('laporanitem_pdf', array('Attachment' => 0));
    }
}
