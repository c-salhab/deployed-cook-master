<x-app-layout>
    @yield('scripts')

    @section('content')
        <div class="ml-12 p-6">

            @yield('scripts')
            <table class="text-sm text-left text-gray-500 dark:text-gray-400 ml-12 pl-3" style="margin-left:30rem;">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Product name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Start Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        End Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Subtotal
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
                </thead>

                <tbody>
                @php $total = 0 @endphp
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" data-id="{{ $id }}">
                            <td class="px-6 py-4" data-th="Product">
                                <div class="col-sm-3 hidden-xs"><img src="{{ asset($details['image']) }}" width="100" height="100" class="img-responsive"/></div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </div>
                            </td>
                            <td data-th="Price">€{{ $details['price'] }}</td>


                            <td data-th="Quantity">
                                @php
                                    $productName = $details['name'];
                                    $maxQuantity = 1;

                                    $isRental = App\Models\Materials::where('name', $productName)->exists();
                                    $isEvent = App\Models\Events::where('name', $productName)->exists();
                                    if ($isRental) {
                                        $maxQuantity = App\Models\Materials::where('name', $productName)->value('quantity');
                                    } elseif ($isEvent) {
                                        $maxQuantity = 1;
                                    }
                                @endphp

                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" max="{{ $maxQuantity }}" onkeydown="validateQuantity(event, this)"/>

                            </td>

                            @php
                                $productName = $details['name'];
                                $isRental = App\Models\Materials::where('name', $productName)->exists();
                            @endphp

                            @if ($isRental)
                                <td data-th="StartTime">
                                    <input type="date" min="<?php echo date('Y-m-d'); ?>" id="start_time" name="start_time[]" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </td>
                                @error('start_time')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror

                                <td data-th="EndTime">
                                    <input type="date" min="<?php echo date('Y-m-d'); ?>" id="end_time" name="end_time[]" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </td>
                                @error('end_time')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            @else
                                <td></td>
                                <td></td>
                            @endif

                            <td data-th="Subtotal" class="text-center">€{{ $details['price'] * $details['quantity'] }}</td>
                            <td class="actions" data-th="">
                                <button class="btn btn-danger btn-sm cart_remove"><i class="fa fa-trash-o"></i> Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" style="text-align:left;"><h3><strong>Total €{{ $total }}</strong></h3></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right;">
                        <form action="/session" method="POST" >
                            <a href="{{ route('dashboard') }}" class="btn btn-danger" > <i class="fa fa-arrow-left"></i> Continue Shopping</a>
                            @csrf
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded" type="submit" id="checkout-live-button"><i class="fa fa-money"></i> Checkout</button>
                        </form>
                    </td>
                </tr>
                </tfoot>
            </table>

        </div>
    @endsection

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            $(".cart_update").change(function (e) {
                e.preventDefault();

                var ele = $(this);

                $.ajax({
                    url: '{{ route('update_cart') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id"),
                        quantity: ele.parents("tr").find(".quantity").val()
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });

            $(".cart_remove").click(function (e) {
                e.preventDefault();

                var ele = $(this);

                if(confirm("Do you really want to remove?")) {
                    $.ajax({
                        url: '{{ route('remove_from_cart') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr("data-id")
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            });

            function validateQuantity(event, input) {
                const key = event.key;

                if (key === 'ArrowUp' || key === 'ArrowDown' || key === 'Backspace') {
                    return;
                }

                const currentValue = Number(input.value + key);
                const max = Number(input.max);
                const min = Number(input.min);

                if (isNaN(currentValue) || currentValue < min || currentValue > max) {
                    event.preventDefault();
                }
            }

        </script>
    @endsection

</x-app-layout>
