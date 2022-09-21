<p><span style="font-weight: bold;">order id:</span> {{ $order->id }}</p>
<p><span style="font-weight: bold;">order name:</span> {{ $order->cu_naziv }}</p>
<p><span style="font-weight: bold;">price:</span> {{ $order->cu_znesek }}</p>
<p><span style="font-weight: bold;">cu_davcna:</span> {{ $order->cu_davcna }}</p>
<p><span style="font-weight: bold;">user name:</span> {{ $order->customer->user->name }}</p>

<h2><span style="font-weight: bold;">Bookings:</span></h2>
<ul>
    @foreach($order->storitevToOrders as $item)
        <li>
            <p><span style="font-weight: bold;">name:</span> {{ $item->o_naziv}}</p><br>
            <p><span style="font-weight: bold;">price:</span> {{ $item->o_cena }}</p><br>
            <p><span style="font-weight: bold;">count:</span> {{ $item->o_kolicina }}</p>
        </li>
    @endforeach
</ul>

